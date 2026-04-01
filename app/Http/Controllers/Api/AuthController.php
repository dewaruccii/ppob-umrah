<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function requestMagicLink(Request $request)
    {
        // Validasi nomor HP
        $request->validate([
            'phone' => 'required|numeric'
        ]);

        $phoneInput = $request->input('phone');
        if (str_starts_with($phoneInput, '0')) {
            $phoneInput = ltrim($phoneInput, '0');
        }

        // Jika di databasemu formatnya pakai awalan "62" atau "+62", aktifkan baris di bawah ini:
        $phoneInput = '62' . $phoneInput;

        // Set key 'no_telp' (sesuaikan dengan nama kolom di tabel users kamu)
        $credentials['phone'] = $phoneInput;

        // Cari user, atau buat user baru jika belum terdaftar (opsional, tergantung bisnis proses Anda)
        $user = User::firstWhere(['phone' => $phoneInput]);
        if (!$user) {
            // Buat user baru jika belum terdaftar
            return response()->json([
                'message' => 'Nomor HP belum terdaftar. Silakan daftar terlebih dahulu.'
            ], 404);
        }

        // Generate token acak (misal 60 karakter)
        $plainToken = Str::random(60);

        $user->login_token = hash('sha256', $plainToken); // Simpan hash token di database
        $user->token_expires_at = now()->addMinutes(15); // Set expired 15 menit
        $user->save();

        // Buat Link
        // Jika frontend Anda React Native/Expo, gunakan skema Deep Link aplikasi Anda
        // Contoh: myapp://verify?token=... atau exp://127.0.0.1:8081/--/verify?token=...
        // Jika frontend Anda Web (Next.js dll): https://domainanda.com/verify?token=...

        // $link = "myapp://verify?token=" . $plainToken;
        $link = "exp://172.16.247.246:8081/--/verify?token=" . $plainToken;

        // TODO: Di dunia nyata, Anda mengirim $link ini via SMS atau WhatsApp API di sini.
        // Untuk sekarang, kita kembalikan di response API agar mudah dites di Postman.

        return response()->json([
            'message' => 'Link login berhasil dibuat.',
            'link' => $link, // Hapus baris ini saat production, link harusnya dikirim via WA/SMS
            'token_plain' => $plainToken
        ]);
    }
    public function verifyMagicLink(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        // Cari user berdasarkan token yang di-hash dan pastikan belum kadaluarsa
        $user = User::where('login_token', hash('sha256', $request->token))
            ->where('token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'Link login tidak valid atau sudah kadaluarsa.'
            ], 401);
        }

        // Hapus token agar hanya bisa dipakai sekali (One-Time Use)
        $user->login_token = null;
        $user->token_expires_at = null;
        $user->save();

        // Generate token Sanctum seperti biasa
        $accessToken = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
    public function checkSession()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'message' => 'Session valid.',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Session tidak valid.'
        ], 401);
    }
}
