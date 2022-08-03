<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function proccess(Request $request)
    {
        // save user 
        $user = auth()->user();
        $user->update($request->except('total_price'));

        // checkout proccess
        $code = 'STORE-' . mt_rand(00000, 99999);
        $carts = Cart::with(['product', 'user'])->where('users_id', auth()->user()->id)->get();

        // transaction create
        $transaction = Transaction::create([
            'users_id' => auth()->user()->id, 
            'inscurance_price' => 0,
            'shipping_price' => 0, 
            'total_price' => $request->total_price, 
            'transaction_status' => 'PENDING', 
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(00000, 99999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id, 
                'products_id' => $cart->product->id, 
                'price' => $cart->product->price, 
                'shipping_status' => $request->total_price, 
                'resi' => 'PENDING',
                'code' => $trx
            ]);
        }

        // delete data cart
        Cart::where('users_id', auth()->user()->id)->delete();

        // midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                'order_id' => $code, 
                'gross_amount' => (int) $request->total_price
            ], 
            'customer_details' => [
                'first_name' => auth()->user()->name, 
                'email' => auth()->user()->email
            ], 
            'enabled_payments' => [
                'bca_klikbca', 'permata_va', 'bca_va', 'gopay', 'shopeepay', 'bank_transfer'
            ], 
            'vtweb' => []
        ];

        try{
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            return redirect($paymentUrl);
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function callback()
    {

    }
}
