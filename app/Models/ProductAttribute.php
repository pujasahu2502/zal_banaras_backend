<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $table = "product_attributes";

    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'attribute_id');
    }

    public function totalVariation()
    {
        return $this->hasMany(Variation::class, 'attribute_id', 'attribute_id');
    }
}