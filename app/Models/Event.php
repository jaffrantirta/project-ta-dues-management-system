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
    ];

    protected $appends = [
        'event_date',
    ];

    public function getEventDateAttribute()
    {
        if($this->date_time <= Carbon::now()->addDays(7)){
            return Carbon::create($this->date_time)->locale('id')->diffForHumans();
        }else{
            return Carbon::create($this->date_time)->locale('id')->isoFormat('ddd, D MMM');
        }
    }
}
