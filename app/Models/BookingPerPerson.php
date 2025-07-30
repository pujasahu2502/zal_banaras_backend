<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPerPerson extends Model
{
    
    use HasFactory;

    protected $table = 'booking_per_persons';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'first_name',
        'last_name',
        'seat_number',
        'webinar_id'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id', 'booking_id');
    }

    public function booking_per_person(){
        return $this->belongsTo(Webinar::class,'webinar_id');
    }
}
