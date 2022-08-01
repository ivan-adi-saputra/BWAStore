<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['galleries'])->latest()->paginate(16);
        return view('pages.category', [
            'products' => $products, 
            'categories' => $categories
        ]);
    }

    public function details($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(16);
        return view('pages.category', [
            'categories' => $categories, 
            'products' => $products
        ]);
    }
}
