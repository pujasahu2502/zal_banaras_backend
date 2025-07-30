<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignGiftCard extends Model
{
    use HasFactory;
    protected $table = "assign_gift_cards";

    protected $fillable = [
        'gift_card_id',
        'purchase_webinar_id',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function webinar()
    {
        return $this->hasOne(Webinar::class,'id','purchase_webinar_id');
    }

    public function giftCard()
    {
        return $this->hasOne(GiftCard::class,'id','gift_card_id');
    }

    
}
