<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $appends = ['package_name'];
     
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getPackageNameAttribute()
    {
        if (!is_null($this->type)) {
            return ucfirst($this->type);
        }
        return '';
    }
}
