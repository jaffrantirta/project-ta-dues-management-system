<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPenalty extends Model
{
    use HasFactory;
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
