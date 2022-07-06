<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserEvent extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'event_id',
    ];
    protected $appends = [
        'attend_time',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAttendTimeAttribute()
    {
        return Carbon::create($this->created_at)->isoFormat('h:mm a');
    }
}
