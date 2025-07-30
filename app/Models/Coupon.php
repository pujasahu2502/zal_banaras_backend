<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $table = "coupons";

    public function couponApply()
    {
        return $this->hasMany(CouponApply::class, 'coupon_id');
    }

    public function getTypetextAttribute(){
        $type = $this->type;
        if($type == 1){
            return 'Flat Rate';
        }elseif($type == 2){
            return 'Fixed Price';
        }elseif($type == 3){
            return 'Buy 1 Get 1 Free';
        }else{
            return '-';
        }
    }
}