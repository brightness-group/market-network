<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Snapshot;

class Media extends Model
{
    protected $table = 'media';

    const TYPE_SNAPS = 'snaps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'path', 'media_type', 'type', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function snapshot()
    {
        return $this->belongsTo(Snapshot::class);
    }

    public function getPathAttribute($path)
    {
        return !empty($path) ? asset(\Storage::url($path)) : asset('/assets/images/default_snap.png');
    }
}
