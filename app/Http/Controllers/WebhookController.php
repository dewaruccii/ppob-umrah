<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Pastikan key di config sesuai (tadi kita bahas server_key)
        $serverKey = config('midtrans.serverKey');

        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signatureKey = $request->signature_key;
        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status;
        $paymentType = $request->payment_type;

        // 1. Validasi input dasar
        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // 2. Simpan Log Webhook (Raw Response)
        DB::table('webhook_logs')->insert([
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'transaction_status' => $transactionStatus,
            'raw_response' => json_encode($request->all()),
            'created_at' => now(), // Tambahkan created_at manual jika tidak otomatis
        ]);

        // 3. Verifikasi Signature Key (Wajib untuk keamanan)
        $hashed = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        if ($hashed !== $signatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 4. Ambil data transaksi dari database
        $transaction = Transaction::where('order_id', $orderId)->first();
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        $vaNumber = null;
        $storeName = null;
        if ($paymentType == 'bank_transfer' && isset($request->va_numbers[0])) {
            $vaNumber = $request->va_numbers[0]['va_number'];
            $bank = $request->va_numbers[0]['bank'];
        }
        if ($paymentType == 'cstore') {
            $storeName = $request->store;
        }


        /**
         * 5. LOGIKA STATUS BERDASARKAN PAYMENT METHOD
         * 'capture' -> Khusus Kartu Kredit
         * 'settlement' -> GoPay, QRIS, VA, Indomaret/Alfamart
         */

        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $transaction->transaction_status = 'challenge';
                } else {
                    $transaction->transaction_status = 'success';
                    $transaction->order_status = 'processing';
                }
            }
        } else if ($transactionStatus == 'settlement') {
            // Berhasil untuk metode non-kartu kredit
            $transaction->transaction_status = 'success';
            $transaction->order_status = 'processing';

            // Trigger kirim pulsa/roaming di sini
            // $this->processProviderRoaming($transaction);

        } else if ($transactionStatus == 'pending') {
            $transaction->transaction_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $transaction->transaction_status = 'failed';
            $transaction->order_status = 'failed';
        } else if ($transactionStatus == 'expire') {
            $transaction->transaction_status = 'expired';
            $transaction->order_status = 'failed';
        } else if ($transactionStatus == 'cancel') {
            $transaction->transaction_status = 'canceled';
            $transaction->order_status = 'failed';
        }

        // Simpan info tipe pembayaran yang digunakan user
        $transaction->transaction_id = $request->transaction_id;
        $transaction->settlement_time = $request->settlement_time;
        $transaction->expired_at = $request->expiry_time;
        $transaction->transaction_time = $request->transaction_time;
        if ($vaNumber) {
            $transaction->bank_name = $bank;
        }
        if ($storeName) {
            $transaction->store_name = $storeName;
        }

        $transaction->payment_type = $paymentType;
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification processed'
        ], 200);
    }
}
