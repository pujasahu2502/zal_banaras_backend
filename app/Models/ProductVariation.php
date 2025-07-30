<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductVariation extends Model implements HasMedia{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $table = "product_variations";
    protected $casts = ['variation_id' => 'json'];
    protected $appends = ["variationIDs"];
    
    public function variation() {
        return $this->belongsToJson(Variation::class, 'variation_id');
    }

    public function getVariationIDsAttribute()
    {
        return ($this->variation_id);
    }
}