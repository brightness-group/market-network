<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['display_name_upper_case'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getBannerAttribute($banner)
    {
        if ($banner != '') {
            
            if (strpos($banner, 'banner/') !== false) {
                return asset(\Storage::url($banner));
            }
            
            if (strpos($banner, 'category-img/') !== false) {
                return asset($banner);
            }
            return asset('/assets/images/seen-logo-white.png');
            // if (file_exists(asset($banner))) {
            //     dd("rrewrrewrew");
            //     return asset($banner);  
            // }

            // return asset(\Storage::url($banner));
        } else {
            return '';
        }
    }

    public function getSlugAttribute($slug) {
        return str_replace('&', 'and', $slug);
    }

    public function getDisplayNameAttribute($display_name)
    {
        return $display_name;
    }

    public function getDisplayNameUpperCaseAttribute()
    {
        return !empty($this->display_name) ? strtoupper($this->display_name) : '';
    }

    public function snapshots()
    {
        return $this->hasMany(Snapshot::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
