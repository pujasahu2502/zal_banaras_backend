<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'assign_gift_card_id',
        'user_id',
        'type',
    ];


    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class,'assign_gift_card_id','id');
    }
}
