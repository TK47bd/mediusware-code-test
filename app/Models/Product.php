<?php

namespace App\Models;

use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // public function product_variant_price()
    // {
    //     return $this->hasMany(ProductVariantPrice::class);
    // }
}