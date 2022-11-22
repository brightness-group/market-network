<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CartItems extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function snapshotpackages()
    {
        return $this->hasOne(SnapshotPackage::class, 'id', 'snapshot_package_id');
    }
    
    public function getIsUpsellAttribute($is_upsell) {
        return ($is_upsell === 1) ? true : false; 
    }
    
    public function getArrangeDeliveryLaterAttribute($arrange_delivery_later) {
        return ($arrange_delivery_later === 1) ? true : false; 
    }

    public function getDeliveryDateAttribute($delivery_date) {
        if (!is_null($delivery_date)) {
            $dateTime = $delivery_date." 00:00:00";
            return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('m/d/Y');
        }
    }
}
