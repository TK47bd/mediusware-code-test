<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'variant', 'variant_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function variant()
    // {
    //     return $this->hasMany(Variant::class);
    // }
}