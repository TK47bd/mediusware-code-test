<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductVariantPrice;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'variant', 'variant_id', 'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'id', 'variant_id');
    }

    // public function product_variant_price()
    // {
    //     return $this->hasMany(ProductVariantPrice::class);
    // }
}