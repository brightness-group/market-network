<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Snapshot;
use App\Models\SnapshotPackage;
use App\Models\User;
use App\Models\Package;
use App\Models\Comment;
use App\Models\SnapshotView;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Auth;

class SnapshotController extends Controller
{
    public function editSnapshot($id)
    {
        return view('snaps_edit')->with(compact('id'));
    }

    public function home()
    {
        return view('home');
    }
    
    public function search(Request $request)
    {
        $id = $request->category_id ?? null;
        $query = $request->input('query') ? strtolower($request->input('query')) : null;
        $tag = $request->input('tag') ? strtolower($request->input('tag')) : null;
        $category = (!is_null($id)) ? Category::find($id) : [];
        $snapQuery = Snapshot::with('user', 'tags', 'collaborators', 'media', 'snapshotpackages', 'likes')->where('status', 'active');
        if ((!is_null($id))) {
            if ($category->parent_id == 0) {
                $childCategories = Category::where('parent_id', $id)->pluck('id');
                $childCat = implode(',', $childCategories->toArray());
                $snapQuery->whereIn('category_id', [$childCat]);
            } else {
                $snapQuery->where('category_id', $id);
            }
        }
        
        if ((!is_null($query))) {
            $snapQuery->where('title', 'like', '%' . $query . '%');
            $snapQuery->orWhere('description', 'like', '%' . $query . '%');
            $snapQuery->orWhereHas('tags',function (Builder $q) use ($query) {
                return $q->where('name', 'like', '%' . $query . '%');
            })->get();
        }

        if ((!is_null($tag))) {
            $snapQuery->whereHas('tags',function (Builder $q) use ($tag) {
                return $q->where('name', 'like', '%' . $tag . '%');
             })->get();
        }

        $snapshots = $snapQuery->orderBy('id', 'ASC')->take(20)->get();
        
        $tags = $tagIds = [];
        foreach ($snapshots as $snapshot) {
            $packagePrice = []; 
            foreach ($snapshot->snapshotpackages as $snapPackages) {
                $packagePrice[] = $snapPackages->price;
            }
            $snapshot['package_start_from'] = (!empty($packagePrice)) ? min($packagePrice) : '' ;
            $snapshot['media_files_count'] = $snapshot->media->count();
            $isLiked = false;
            if (Auth::user()) {
                $likes = $snapshot->likes()->where('user_id', Auth::user()->id)->first();
                $isLiked = ($likes) ? true : false;
            }
            $snapshot['is_liked'] = $isLiked;

            foreach($snapshot->tags as $tagData) {
                if (!\in_array($tagData->id, $tagIds)) {
                    $tags[] = array('id' => $tagData->id, 'name' => $tagData->name);
                }
                $tagIds[] = $tagData->id;
            }
        }
        $tag = strtoupper($tag);
        return view('search')->with(compact('snapshots', 'query', 'category', 'tags', 'tag'));
    }
    
    public function getSnapshot($slug)
    {
        $snapshots = Snapshot::with('user', 'tags', 'collaborators', 'media', 'upsell', 'snapshotpackages', 'likes', 'user.profession')->where('status', 'active')->orderBy('id', 'ASC')->take(5)->get();
        foreach ($snapshots as $snap) {
            $packagePrice = [];
            foreach ($snap->snapshotpackages as $snapPackages) {
                $packagePrice[] = $snapPackages->price;
            }
            $snap['package_start_from'] = (!empty($packagePrice)) ? min($packagePrice) : '' ;
            $snap['media_files_count'] = $snap->media->count();
            $isLiked = false;
            if (Auth::user()) {
                $likes = $snap->likes()->where('user_id', Auth::user()->id)->first();
                $isLiked = ($likes) ? true : false;
            }
            $snap['is_liked'] = $isLiked;            
        }

        $snapshot = Snapshot::with('tags', 'collaborators', 'media', 'upsell', 'snapshotpackages', 'likes', 'category', 'user', 'user.profession', 'collaborators.profession')->where('slug', $slug)->first();
        if (Auth::user()) {
            $this->createSnapshotViewLog($snapshot);
        }

        $packages = SnapshotPackage::where('snapshot_id', $snapshot->id)->get();
        $packageData = [];
        foreach ($packages as $package) {
            $packageData[$package->type] = $package;
        }
        $allFiles = [];
        foreach ($snapshot->media as $media) {
            $allFiles[] = $media['path'];
        }

        $snapshot['short_description'] = \substr($snapshot['description'], 0, 80);
        
        $isLiked = false;
        if (Auth::user()) {
            $likes = $snapshot->likes()->where('user_id', Auth::user()->id)->first();
            $isLiked = ($likes) ? true : false;
        }
        $snapshot['is_liked'] = $isLiked;
        $snapshot['packages'] = $packageData;
        $snapshot['allFiles'] = $allFiles;
        $snapshot['selectedTags'] = $snapshot->tags->pluck('id');
        $snapshot['selectedCollaborators'] = $snapshot->collaborators->pluck('id');
        $snapshot['published_on'] =  Carbon::parse($snapshot->created_at)->format('F jS Y');
        $snapshot['saves'] = $snapshot->moodboards->count();
        $snapshot['loves'] = $snapshot->likes->count();
        $snapshot['views'] = $snapshot->snapshotviews->count();
        $snapshot['next_url'] = Snapshot::where('id', '>', $snapshot->id)->first('slug');
        $snapshot['previous_url'] = Snapshot::where('id', '<', $snapshot->id)->orderBy('id', 'DESC')->first('slug');
        $snapCategory = $snapshot->category_id;

        $snapUsers = $snapshot->collaborators;

        $ownedUser = $snapshot->user;
        $ownedUser['packages'] = SnapshotPackage::where('snapshot_id', $snapshot->id)
        ->orderByRaw("FIELD(type, 'bronze', 'silver', 'gold')")->get()->toArray();
       
        $users[] = $ownedUser;
        foreach ($snapUsers as $snapUser) {
            if ( $ownedUser->id != $snapUser->id) {
                $snapUser['packages'] = Package::where('user_id', $snapUser->id)->orderByRaw("FIELD(type, 'bronze', 'silver', 'gold')")->get()->toArray();
                $users[] = $snapUser;
            }
        }

        $comments = Comment::with('user')->where('snapshot_id', $snapshot->id)->orderBy('created_at', 'DESC')->take(5)->get();
        $user = (Auth::user()) ?? [];
        
        $usersnaps = Snapshot::with('user', 'tags', 'collaborators', 'media', 'upsell', 'snapshotpackages', 'likes')->where('user_id', $snapshot->user_id)->where('status', 'active')->where('id', '<>', $snapshot->id)->orderBy('id', 'ASC')->get();
        foreach ($usersnaps as $usersnap) {
            $packagePrice = [];
            foreach ($usersnap->snapshotpackages as $snapPackages) {
                $packagePrice[] = $snapPackages->price;
            }
            $usersnap['package_start_from'] = (!empty($packagePrice)) ? min($packagePrice) : '' ;
            $usersnap['media_files_count'] = $usersnap->media->count();
            $usersnap['is_liked'] = ($usersnap->likes) ? ($usersnap->likes->count() > 0 ? true : false) : false;
            $isLiked = false;
            if (Auth::user()) {
                $likes = $usersnap->likes()->where('user_id', Auth::user()->id)->first();
                $isLiked = ($likes) ? true : false;
            }
            $usersnap['is_liked'] = $isLiked;
        }

        return view('snaps-detail')->with(compact('snapshot', 'snapshots', 'users', 'comments', 'user', 'usersnaps'));
    }

    /**
     * Log snapshot view with viewer details.
     *
     * @param $snapshot
     *
     * @return bool
     */
    public function createSnapshotViewLog($snapshot)
    {
        $snapshotView = SnapshotView::where(['snapshot_id' => $snapshot->id, 'user_id' => \Auth::user()->id])->first();
        if (is_null($snapshotView)) {
            $snapshotView = new SnapshotView();
        }
        $snapshotView->snapshot_id = $snapshot->id;
        $snapshotView->slug = $snapshot->slug;
        $snapshotView->url = \Request::url();
        $snapshotView->session_id = \Request::getSession() ? \Request::getSession()->getId() : null;
        $snapshotView->user_id = \Auth::user()->id;
        $snapshotView->ip = \Request::getClientIp();
        $snapshotView->agent = \Request::header('User-Agent');
        $snapshotView->save();

        return true;
    }

}
