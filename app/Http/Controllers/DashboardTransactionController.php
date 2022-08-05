<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $buytransactions = TransactionDetail::with(['product.galleries', 'transaction.user', 'product.category'])
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('users_id', auth()->user()->id);
                        })
                        ->get();
        $selltransactions = TransactionDetail::with(['product.galleries', 'transaction.user', 'product.category'])
                        ->whereHas('product', function($product){
                            $product->where('users_id', auth()->user()->id);
                        })
                        ->get();
        return view('pages.dashboard-transaction', [
            'selltransactions' => $selltransactions,
            'buytransactions' => $buytransactions
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['product.galleries', 'transaction.user'])->findOrFail($id);
        return view('pages.dashboard-transaction-details', [
            'transaction' => $transaction, 
        ]); 
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);

        return redirect()->back();
    }
}
