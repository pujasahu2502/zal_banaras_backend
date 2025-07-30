<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $table = "taxes";
    protected $appends = ["taxInDollar"];

    public function getTaxInDollarAttribute()
    {
        return  number_format((\Cart::subtotal() * ($this->tax/100 )),2);
    }
}