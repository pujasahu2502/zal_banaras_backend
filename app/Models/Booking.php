<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
     
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'user_id',
            'webinar_id',
            'shipping_address_id',
            'billing_address_id',
            'address_type',
            'payment_id',
            'invoice_id',
            'order_number',
            'total_amount',
            'payment_status',
            'total_booking'
        ];

        public function bookingPerPerson()
        {
            return $this->hasMany(BookingPerPerson::class, 'booking_id', 'id');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id','id')->with('address')->withCount('booking');
        }

        public function webinar()
        {
            return $this->belongsTo(Webinar::class, 'webinar_id','id')->select('id','name','slug','total_seats','consumed_seats','category_id','type','price','gift_card_status','webinar_link','webinar_link_note','webinar_video','webinar_video_note','webinar_credentials','gift_card_status','status','releasing_date','releasing_time');
        }


        public function payment()
        {
            return $this->belongsTo(Payment::class)->with('giftCard');
        }

        public function shippingAddress()
        {
            return $this->belongsTo(Address::class,'shipping_address_id','id');
        }

        public function billingAddress()
        {
            return $this->belongsTo(Address::class,'billing_address_id','id');
        }

}