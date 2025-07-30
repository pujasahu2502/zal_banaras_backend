<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $with = ["review","productVariation"];
    protected $appends = ['total_amount'];
    public function getTotalAmountAttribute()
    {
        return (($this->sell_price ?? 0) * ($this->quantity ?? 0) );
    }

    public  function product()
    {
        return $this->hasOne(Product::class,'id','product_id')->with('productAttribute');
    }

    public function review()
    {
        return $this->hasMany(Review::class,'order_id','order_id');
    }

    public function productVariation()
    {
        return $this->hasOne(ProductVariation::class,"id","variation_id")->with("variation")->where("status","1");
    }

}