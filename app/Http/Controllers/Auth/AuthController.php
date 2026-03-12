<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Tipe Login dan Password terlebih dahulu
        $request->validate([
            'login_type' => 'required|in:email,phone',
            'password'   => 'required|string|min:4', // Sesuaikan minimal karakter
        ], [
            'password.required' => 'PIN / Kata Sandi wajib diisi.',
            'login_type.in' => 'Metode login tidak valid.'
        ]);

        $loginType = $request->input('login_type');
        $credentials = ['password' => $request->input('password')];
        $remember = $request->boolean('remember'); // Cek checkbox remember me

        // 2. Logika Berdasarkan Tipe Login
        if ($loginType === 'email') {

            // Validasi khusus untuk input email
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format email tidak valid.'
            ]);

            // Set key 'email' untuk dicari di database
            $credentials['email'] = $request->input('email');
        } elseif ($loginType === 'phone') {

            // Validasi khusus untuk input nomor telepon
            $request->validate([
                'phone' => 'required|numeric|digits_between:8,15',
            ], [
                'phone.required' => 'Nomor WhatsApp wajib diisi.',
                'phone.numeric' => 'Nomor WhatsApp hanya boleh berisi angka.',
                'phone.digits_between' => 'Nomor WhatsApp harus antara 8 hingga 15 digit.'
            ]);

            $phoneInput = $request->input('phone');

            // Opsional: Format nomor telepon agar seragam dengan database
            // Misal: user mengetik "0812...", kita buang "0" di depannya
            if (str_starts_with($phoneInput, '0')) {
                $phoneInput = ltrim($phoneInput, '0');
            }

            // Jika di databasemu formatnya pakai awalan "62" atau "+62", aktifkan baris di bawah ini:
            $phoneInput = '62' . $phoneInput;

            // Set key 'no_telp' (sesuaikan dengan nama kolom di tabel users kamu)
            $credentials['phone'] = $phoneInput;
        }

        // 3. Proses Autentikasi
        if (Auth::attempt($credentials, $remember)) {
            // Jika berhasil
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Ganti dengan route tujuan setelah login
        }

        // 4. Jika Gagal Login
        // Tentukan field mana yang akan dikembalikan error-nya (email atau phone)
        $failedField = $loginType === 'email' ? 'email' : 'phone';

        return back()->withErrors([
            $failedField => 'Kredensial yang kamu masukkan salah.',
        ])->onlyInput($failedField, 'login_type');
    }

    public function register(Request $request)
    {
        // Implement registration logic here
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
