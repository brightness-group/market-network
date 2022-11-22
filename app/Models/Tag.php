<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Snapshot;

class Tag extends Model
{ 
    protected $guarded = [];

    public function snapshots()
    {
        return $this->belongsToMany(Snapshot::class);
    }
}
