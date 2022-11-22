<?php
namespace App\Repositories\Snapshot;

use App\Models\User;
use App\Models\Snapshot;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface SnapshotRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Array $request
     * @return App\Models\Snapshot
     */
    public function store(Array $request): Snapshot;

    /**
     * Upload snapshot picture.
     *
     * @param $request
     * @return App\Models\Media
     */
    public function uploadSnapshotImage($request);

    /**
     * Find specified resource in storage.
     *
     * @param  int  $id
     * @return App\Models\Snapshot
     */
    public function find(int $id): Snapshot;

    /**
     * Get new snapshots from storage
     *
     * @param int | null  $take
     *
     */
    public function getNewSnapshots($take = null);

    /**
     * Get count of snapshots.
     *
     * @return int $id
     */
    public function getTotalSnapshotsCount(): int;
}
