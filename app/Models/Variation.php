<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model{
    use HasFactory, Sluggable;
    protected $table = 'variations';
    protected $guarded = [];
    protected $with = ["attribute","allAttribute"];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function attribute()
    {
        return $this->hasOne(Attribute::class,'id','attribute_id')->where('status', '1');
    }

    public function allAttribute()
    {
        return $this->hasOne(Attribute::class,'id','attribute_id');
    }
}