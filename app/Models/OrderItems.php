<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function snapshotpackages()
    {
        return $this->hasOne(SnapshotPackage::class, 'id', 'snapshot_package_id');
    }
    
    public function snapusers()
    {
        return $this->hasOne(User::class, 'id', 'snapshot_package_user_id');
    }
}
