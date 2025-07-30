<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia{
    use HasFactory, Sluggable, InteractsWithMedia;
    protected $table = 'products';
    protected $guarded = [];

   

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id');
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategories::class,'product_id')->with('category');
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class,'product_id')->with('attribute', 'totalVariation');
    }

    public function productVariation()
    {
        return $this->hasMany(ProductVariation::class,'product_id')->with('variation')->orderBy('created_at', 'DESC');
    }

    public function seoAnalysis()
    {
        return $this->hasOne(SeoAnalysis::class, 'from_id')->where('from', 'Product');
    }

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


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(500)
              ->height(500);
    }
}