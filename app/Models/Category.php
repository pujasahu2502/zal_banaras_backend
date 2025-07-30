<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia{
    use HasFactory, Sluggable, InteractsWithMedia;
    protected $guarded = [];
    protected $table = "categories";

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

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategories::class);
    }

    public function productCategoryActive()
    {
        return $this->hasMany(ProductCategories::class)->whereRelation('products','status','1');
    }

    public function seoAnalysis()
    {
        return $this->hasOne(SeoAnalysis::class, 'from_id')->where('from', 'Category');
    }
}