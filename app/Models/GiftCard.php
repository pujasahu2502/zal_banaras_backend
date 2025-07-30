<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;
    
    protected $table = "gift_cards";
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'webinar_id',
        'code',
        'price',
        'start_date',
        'end_date',
        'status',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class,'webinar_id','id');
    }

    public function assignGiftCard()
    {
        return $this->hasOne(AssignGiftCard::class,'gift_card_id','id')->with('user','webinar');
    }
 
    
  
}
