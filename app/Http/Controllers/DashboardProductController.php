<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'galleries'])
                            ->where('users_id', auth()->user()->id)
                            ->get()
                            ;
        return view('pages.dashboard-product', [
            'products' => $products
        ]);
    }

    public function details(Request $request, $id)
    {
        return view('pages.dashboard-product-details', [
            'product' => Product::with(['galleries', 'user', 'category'])->findOrFail($id), 
            'categories' => Category::all(), 
        ]);
    }

    public function create()
    {
        return view('pages.dashboard-product-create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = ProductGallery::create([
            'products_id' => $product->id,
            'photos' => $request->file('photos')->store('galleries')
        ]);

        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('dashboard-product');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('galleries');

        ProductGallery::create($data);
        return redirect()->back();
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }
}
