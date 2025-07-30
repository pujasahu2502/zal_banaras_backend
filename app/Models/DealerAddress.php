<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealerAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dealer_address';

    protected $fillable = [
        'dealer_id',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'longitude',
        'latitude'
    ];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
