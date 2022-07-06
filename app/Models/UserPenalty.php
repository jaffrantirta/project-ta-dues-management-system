<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPenalty extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'fee',
        'is_paid',
    ];
    protected $appends = [
        'fee_text',
        'paid_text',
    ];
    public function getFeeTextAttribute()
    {
        return 'Rp.'.number_format($this->fee);
    }
    public function getPaidTextAttribute()
    {
        if($this->is_paid){
            return 'Sudah bayar';
        }
        return 'Belum bayar';
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
