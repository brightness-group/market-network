<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Snapshot;

class SnapshotController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function snapshots()
    {
        return view('admin.snapshots');
    }

    /**
     * Get resource.
     *
     */
    public function snapshot($slug)
    {
        $snapshot = Snapshot::where('slug', $slug)->first();
        $id = $snapshot->id;
        return view('admin.snapshotdetail')->with(compact('slug', 'id'));
    }
    
    /**
     * Snapshot approval.
     *
     */
    public function snapshotApproval($slug)
    {
        $snapshot = Snapshot::where('slug', $slug)->first();
        $id = $snapshot->id;
        return view('admin.snapshotapproval')->with(compact('slug', 'id'));
    }
}
