<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                            ->whereHas('product', function($product) {
                                                $product->where('users_id', auth()->user()->id);
                                            });
        $revenue = $transactions->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();
        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(), 
            'transaction_data' => $transactions->get(), 
            'revenue' => $revenue, 
            'customer' => $customer
        ]);
    }
}
