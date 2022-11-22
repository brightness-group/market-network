<?php
namespace App\Repositories\Snapshot;

use App\Models\User;
use App\Models\Snapshot;
use Auth;
use App\Models\Media;
use App\Models\Package;
use App\Models\Category;
use App\Models\SnapshotPackage;
use App\Models\Upsell;
use App\Models\Tag;
use File;

class SnapshotRepository implements SnapshotRepositoryInterface
{
    /**
     * @var App\Models\Snapshot
     */
    public $snapshot;

    /**
     * Create a new Snapshot repository instance.
     *
     * @param  App\Models\Snapshot $snapshot
     * @return void
     */
    public function __construct(
        Snapshot $snapshot
    ) {
        $this->snapshot = $snapshot;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Array $request
     * @return App\Models\Snapshot
     */
    public function store(array $request): Snapshot
    {
        // Check record is exist or not
        if (!empty($request['snapshot_id'])) {
            $snapshot = Snapshot::find($request['snapshot_id']);
        } else {
            $snapshot = new Snapshot;
            $snapshot->status = 'draft';
        }

        // Prepare data
        $snapshot->title = $request['title'];
        $snapshot->user_id = Auth::user()->id;
        $snapshot->category_id = $request['category_id'];
        $snapshot->description = $request['description'];
        $snapshot->draft = $request['draft'];
        $snapshot->save();

        // Unlink media from snapshot
        if (!empty($request['snapshot_id'])) {
            $mediaFiles = Media::where(['snapshot_id' => $request['snapshot_id'],'user_id' => Auth::user()->id])->get();
            foreach ($mediaFiles as $data) {
                $path = storage_path('app/public/uploads/'.$data->name);
                if (File::exists($path)) {
                    File::delete($path);
                }
                $data->delete();
            }
        }

        // Update snapshot_id in media table
        $media = Media::whereNull('snapshot_id')
                ->where('user_id', Auth::user()->id)
                ->whereIn('id', $request['uploaded_file_ids'])
                ->update(['snapshot_id' => $snapshot->id]);

        // Add collaborators data
        $snapshot->collaborators()->sync($request['selectedCollaborators'], true);

        // Check if any new tag is added or not. If added, add it into master table before sync
        $tagsArray = Tag::pluck('id')->all();
        $tags = [];
        foreach ($request['selectedTags'] as $selectedTag) {
            if (!in_array($selectedTag, $tagsArray)) {
                $newTag = Tag::create(['name' => $selectedTag]);
                $tags[] = $newTag->id;
            } else {
                $tags[] = $selectedTag;
            }
        }

        // Add tags data
        $snapshot->tags()->sync($tags, true);

        // Add snapshot packages
        $packages[] = $request['bronze'];
        $packages[] = $request['silver'];
        $packages[] = $request['gold'];

        foreach ($packages as $package) {

            if (!$package['keep_current_setting']) {
                // Create a new record
                $snapshotPackage = SnapshotPackage::updateOrCreate([
                    'type' => $package['type'],
                    'snapshot_id'=> $snapshot->id
                ],[
                    'type' => $package['type'],
                    'price' => $package['price'],
                    'per_price' => $package['per_price'],
                    'offer' => $package['offer'],
                    'description' => $package['description'],
                    'includes' => $package['includes'],
                    'quantity' => $package['quantity'],
                    'snapshot_id'=> $snapshot->id
                ]);
            } else {
                $userPackage = Package::where([
                    'user_id' => Auth::user()->id,
                    'type' => $package['type']
                ])->first();

                $snapshotPackage = SnapshotPackage::updateOrCreate([
                    'type' => $userPackage->type,
                    'snapshot_id'=> $snapshot->id
                ],[
                    'type' => $userPackage->type,
                    'price' => $userPackage->price,
                    'per_price' => $userPackage->per_price,
                    'offer' => $userPackage->offer,
                    'description' => $userPackage->description,
                    'includes' => $userPackage->includes,
                    'snapshot_id'=> $snapshot->id
                ]);
            }
        }

        if ($request['upsell']) {
            $snapshotPackage = Upsell::updateOrcreate([
                'snapshot_id'=> $snapshot->id
            ],
            [
                'title' => $request['upsell_title'],
                'price' => $request['upsell_price'],
                'description' => $request['upsell_description'],
                'snapshot_id'=> $snapshot->id
            ]);
        }

        return $snapshot;
    }

    /**
     * Upload snapshot picture.
     *
     * @param $request
     * @return App\Models\Media
     */
    public function uploadSnapshotImage($request)
    {
        $media = new Media;

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

        $media->name = time().'_'.$request->file->getClientOriginalName();
        $media->user_id = Auth::user() ? Auth::user()->id : null;
        $media->path = $filePath;
        $media->media_type = $request->file('file')->extension();
        $media->type = Media::TYPE_SNAPS;
        $media->save();

        return $media;
    }

    /**
     * Find specified resource in storage.
     *
     * @param int $id
     * @return Snapshot
     */
    public function find(int $id): Snapshot
    {
        return $this->snapshot->findOrFail($id);
    }

    /**
     * Get new snapshots from storage
     *
     * @param int | null  $take
     *
     */
    public function getNewSnapshots($take = null)
    {
        $currentDate = \Carbon\Carbon::now();
        $lastWeekDate = $currentDate->subDays(7);
        $snapshots = $this->snapshot->with(['category','user'])
            ->where('created_at', '>', $lastWeekDate);
        if ($take) {
            $snapshots = $snapshots->take($take);
        }
        return $snapshots->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get count of snapshots.
     *
     * @return int $id
     */
    public function getTotalSnapshotsCount(): int
    {
        return $this->snapshot->count();
    }
}
