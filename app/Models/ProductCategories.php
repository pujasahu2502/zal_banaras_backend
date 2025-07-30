<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $table = "product_categories";

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}