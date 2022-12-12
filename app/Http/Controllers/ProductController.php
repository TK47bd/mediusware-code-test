<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $Variants = Variant::with('product_variants')->get();
        $Products = Product::with('product_variants')->paginate(10);
        $ProductVariants = ProductVariant::with('products', 'variants')->get();
        //$ProductVariantPrices = ProductVariantPrice::with('product_variants', 'products')->get();

        return view('products.index', compact("Products", "ProductVariants"));
    }

    public function Searched(Request $req)
    {
        if ($req->variant != '') {
            $Variants = Variant::with('product_variants')->where('title', $req->variant)->get();
        } else {
            $Variants = Variant::with('product_variants')->get();
        }

        if ($req->title != '' && $req->date != '') {
            $Products = Product::with('product_variants')->where('title', 'LIKE', '%' . $req->title . '%')->whereDate('updated_at', '=', $req->date)->paginate(10);
        } elseif ($req->title != '' && $req->date == '') {
            $Products = Product::with('product_variants')->where('title', 'LIKE', '%' . $req->title . '%')->paginate(10);
        } elseif ($req->title == '' && $req->date != '') {
            $Products = Product::with('product_variants')->whereDate('updated_at', '=', $req->date)->paginate(10);
        } else {
            $Products = Product::with('product_variants')->paginate(10);
        }

        $ProductVariants = ProductVariant::with('products', 'variants')->get();

        // if($req->price_from!='' && $req->price_to!=''){
        // $ProductVariantPrices = ProductVariantPrice::with('product_variants', 'products')->whereBetween('price', [$req->price_from, $req->price_to])->get();
        // }

        return view('products.index', compact("Products", "ProductVariants", "Variants"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}