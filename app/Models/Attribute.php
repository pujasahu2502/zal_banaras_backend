<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model{
    use HasFactory, Sluggable;
    protected $guarded = [];
    protected $table = 'attributes';

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

    public function variations()
    {
        return $this->hasMany(Variation::class,'attribute_id')->where('status', '1');
    }
    

    public function activeVariations()
    {
        return $this->hasMany(Variation::class,'attribute_id')->where('status','1')->select('id','name','attribute_id','status','slug');
    }
}