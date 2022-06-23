<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'date_time',
        'is_done',
    ];

    protected $appends = [
        'event_date',
        'is_passed',
    ];

    public function getEventDateAttribute()
    {
        if($this->date_time <= Carbon::now()->addDays(7)){
            return Carbon::create($this->date_time)->locale('id')->diffForHumans();
        }else{
            return Carbon::create($this->date_time)->locale('id')->isoFormat('ddd, D MMM Y - h:mm a');
        }
    }

    public function getIsPassedAttribute()
    {
        if(Carbon::create($this->date_time)->isoFormat('Y-M-d') <= Carbon::today()->isoFormat('Y-M-d')){
            return false;
        }
        return true;
    }
}
