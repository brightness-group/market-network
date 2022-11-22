<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Snapshot;

class SnapshotPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['package_name'];

    public function snapshot()
    {
        return $this->belongsTo(Snapshot::class);
    }
    
    public function cartItems()
    {
        return $this->hasMany(CartItems::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function snap()
    {
        return $this->hasOne(Snapshot::class, 'id', 'snapshot_id');
    }

    public function getPackageNameAttribute()
    {
        if (!is_null($this->type)) {
            return ucfirst($this->type);
        }
        return '';
    }
}
