<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function getStatusAttribute($status)
    {
        return ucfirst($status);
    }

    public function getStatusChangedAtAttribute($status_changed_at) {
        if (!is_null($status_changed_at)) {
            $dateTime = $status_changed_at." 00:00:00";
            return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('d.m.Y');
        }
    }
}
