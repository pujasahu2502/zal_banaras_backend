<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Webinar extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'slug',
        'total_seats',
        'consumed_seats',
        'category_id',
        'description',
        'type',
        'size',
        'sku',
        'manufacturer',
        'price',
        'land_price',
        'webinar_credentials',
        'currency',
        'webinar_link',
        'webinar_link_note',
        'live_status',
        'webinar_video',
        'webinar_video_note',
        'status',
        'gift_card_status',
        'releasing_date',
        'releasing_time',
        'display_date',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function webinar()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function giftCard()
    {
        return $this->hasOne(GiftCard::class);
    }
    
    public function webinar_name()
    {
        return $this->hasMany(Webinar::class);
    }

    public function booking_per_person()
    {
        return $this->hasMany(BookingPerPerson::class,'webinar_id');
    }
    public function booking()
    {
        return $this->hasone(Booking::class,'webinar_id')->where('user_id',auth()->id());
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class,'webinar_id');
    }
  
}
