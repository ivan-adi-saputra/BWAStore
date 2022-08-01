<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'categories' => Category::limit(6)->get(), 
            'products' => Product::with('galleries')->limit(8)->latest()->get(), 
        ]);
    }
}
