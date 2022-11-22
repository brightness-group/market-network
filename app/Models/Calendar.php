<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->hasOne(CalendarCategories::class, 'id', 'category_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'calendar_attendees', 'calendar_id', 'attendee_id');
    }
    
    public function getStartDateTimeAttribute($start_date_time) {
        if (!is_null($start_date_time)) {
            // return Carbon::createFromFormat('Y-m-d H:i:s', $start_date_time)->setTimezone('Asia/Kolkata')->format('m/d/Y H:i');

            return (isset($this->attributes['start_date_time']) && !empty('UTC')) ?
            Carbon::parse($this->attributes['start_date_time'])->setTimezone('UTC')
                ->format('Y-m-d H:i') :
                null;
        }
    }
    
    public function getEndDateTimeAttribute($end_date_time) {
        if (!is_null($end_date_time)) {
            // return Carbon::createFromFormat('Y-m-d H:i:s', $end_date_time)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i');

            return (isset($this->attributes['end_date_time']) && !empty('UTC')) ?
            Carbon::parse($this->attributes['end_date_time'])->setTimezone('UTC')
                ->format('Y-m-d H:i') :
                null;
        }
    }
}
