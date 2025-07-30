<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ["orderItems","orderCharges"];

    public function orderItems() {
        return $this->hasMany(OrderItem::class,'order_id','id')->with("product");
    }

    public function orderCharges() {
        return $this->hasMany(OrderCharge::class,'order_id','id');
    }

    public function reviews() {
        return $this->hasMany(Review::class,'order_id','id');
    }

    public function customer() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function shippingAddress() {
        return $this->hasOne(Address::class,'id','shipping_address_id');
    }

    public function billingAddress() {
        return $this->hasOne(Address::class,'id','billing_address_id');
    }
}