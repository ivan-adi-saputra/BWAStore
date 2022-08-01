<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;

class DetailController extends Controller
{
    public function index($id)
    {
        // $product = Product::where('slug', $slug)->firstOrFail();
        // $gallery = ProductGallery::where('products_id', $product->id);
        return view('pages.detail', [
            'product' => Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail(), 
            // 'galleries' => $gallery
        ]);
    }
}
