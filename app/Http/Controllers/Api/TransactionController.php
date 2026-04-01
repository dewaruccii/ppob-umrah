<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');
    }
    public function createTransaction(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,uuid',
            'phone_number' => 'required|string'
            // 'quantity' => 'required|integer|min:1',
            // 'payment_method' => 'required|string'
        ]);

        $product = Product::where('uuid', $request->product_id)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Logika untuk membuat transaksi baru
        // Misalnya, hitung total harga berdasarkan product_id dan quantity
        // Simpan transaksi ke database
        // Integrasi dengan Midtrans untuk pembayaran




        try {
            $transaction = new Transaction();
            $transaction->order_id = generateOrderId($product->product_reference);
            $transaction->transaction_status = 'pending';
            $transaction->initial_price = $product->initial_price;
            $transaction->fixed_price = $product->fixed_price;
            $transaction->order_status = 'pending';
            $transaction->product_id = $product->uuid;
            $transaction->phone_number = $request->phone_number;
            $transaction->order_by = Auth::user()->uuid;
            $transaction->save();
            $params = array(
                'transaction_details' => array(
                    'order_id' => $transaction->order_id,
                    'gross_amount' => $transaction->fixed_price,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'phone' => $transaction->phone_number,
                ),
                'item_details' => array(
                    array(
                        'id' => $product->uuid,
                        'price' => $transaction->fixed_price,
                        'quantity' => 1,
                        'name' => $product->name
                    )
                )
            );
            // 3. Gunakan createTransaction untuk mendapatkan redirect_url
            $midtransResponse = Snap::createTransaction($params);

            // 4. Simpan token dan link ke database (opsional tapi disarankan)
            $transaction->snap_token = $midtransResponse->token;
            $transaction->snap_url = $midtransResponse->redirect_url;
            $transaction->save();

            return response()->json([
                'success' => true,
                'message' => 'Silahkan selesaikan pembayaran',
                'data' => [
                    'order_id' => $transaction->order_id,
                    'snap_token' => $midtransResponse->token,
                    'payment_url' => $midtransResponse->redirect_url // Link ini yang dibuka di mobile
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung ke server pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }
    public function checkStatus($order_id)
    {
        $transaction = Transaction::where('order_id', $order_id)->first();
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status transaksi berhasil diambil',
            'data' => [
                'orderId' => $transaction->order_id,
                'transactionStatus' => $transaction->transaction_status,
                'orderStatus' => $transaction->order_status,
                'amount' => $transaction->fixed_price,
                'product' => $transaction->Product,
                'phone' => $transaction->phone_number,
            ]
        ], 200);
    }
}
