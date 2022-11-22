<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Snapshot;

class Upsell extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function snapshot()
    {
        return $this->belongsTo(Snapshot::class);
    }
}
