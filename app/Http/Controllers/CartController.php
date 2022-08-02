<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart', [
            'carts' => Cart::with(['product.galleries', 'user'])->where('users_id', auth()->user()->id)->get()
        ]);
    }

    public function success()
    {
        return view('pages.success');
    }

    public function Add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => auth()->user()->id
        ];

        Cart::create($data);
        return redirect()->route('cart');
    }

    public function Delete($id)
    {
        $item = Cart::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
