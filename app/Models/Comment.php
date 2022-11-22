<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Snapshot;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function snapshot()
    {
        return $this->belongsTo(Snapshot::class);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->diffForHumans(['options' => Carbon::NO_ZERO_DIFF]);
    }
}
