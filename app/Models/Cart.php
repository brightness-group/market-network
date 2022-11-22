<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Snapshot;


class Cart extends Model
{
    protected $table = 'cart';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function cart_items()
    {
        return $this->hasMany(CartItems::class);
    }
}
