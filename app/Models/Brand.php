<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use HasFactory ,Sluggable;
    protected $guarded = [];
    protected $table = "brands";

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function product()
    {
        return $this->hasMany(Product::class,"brand_id","id")->where("status","1");
    }
}
