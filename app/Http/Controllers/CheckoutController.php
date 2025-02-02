<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // TODO: Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses checkout
        $code = 'STORE-' . mt_rand(0000,9999);
        $carts = Cart::with(['product','user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        // $transaction = Transaction::create([
        //     'users_id' => Auth::user()->id,
        //     'inscurance_price' => 0,
        //     'shipping_price' => 0,
        //     'total_price' => $request->total_price,
        //     'transaction_status' => 'PENDING',
        //     'code' => $code]);
        
        // Biaya admin dan biaya pengiriman
        $shippingPrice = 25000; // Biaya pengiriman
        $adminPrice = 3000; // Biaya admin
        $totalPrice = (int) $request->total_price;

        // Hitung total harga dengan biaya pengiriman dan admin
        $grandTotal = $totalPrice + $shippingPrice + $adminPrice;
        
        // Simpan transaksi
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => $adminPrice, // Biaya admin
            'shipping_price' => $shippingPrice, // Biaya pengiriman
            'total_price' => $grandTotal,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $smnp = 'SMNP-' . mt_rand(0000,9999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $smnp
            ]);
        }

        // Delete Data Cart
        Cart::where('users_id', Auth::user()->id)->delete();

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat array untuk dikirim ke midtrans
        $midtrans = [
            // 'transaction_details' => [
            //     'order_id' =>  $code,
            //     'gross_amount' => (int) $request->total_price,
            // ],
            'transaction_details' => [
            'order_id' =>  $code,
            'gross_amount' => $grandTotal, // Total termasuk biaya pengiriman dan admin
            ],
            'customer_details' => [
                'first_name'    => Auth::user()->name,
                'email'         => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va','bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect ke halaman midtrans
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
