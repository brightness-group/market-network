<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promocode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getexpiredDateAttribute($expiry_date) {
        if (!is_null($expiry_date)) {
            $dateTime = $expiry_date." 00:00:00";
            return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('d/m/Y');
        }
    }

}
