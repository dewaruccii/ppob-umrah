<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - BerkahPay PPOB Umrah</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk interaksi UI (Tab login & Show/Hide Password) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800">

    <!-- x-data mengatur state Alpine.js (pengganti useState di React) -->
    <div x-data="{ loginMethod: 'phone', showPassword: false, isLoading: false }" class="flex flex-col md:flex-row min-h-screen w-full">

        <!-- Bagian Kiri - Branding & Gambar -->
        <div class="hidden md:flex md:w-1/2 lg:w-3/5 relative bg-emerald-900 overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay"
                style="background-image: url('https://images.unsplash.com/photo-1565552643983-61629090ddbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')">
            </div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-900/80 to-transparent"></div>

            <!-- Konten Branding -->
            <div class="relative z-10 flex flex-col justify-end p-12 lg:p-20 h-full text-white">
                <div
                    class="bg-emerald-800/50 backdrop-blur-md p-4 rounded-2xl inline-block w-max mb-6 border border-emerald-600/50">
                    <!-- Icon HeartHandshake (SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-amber-400 w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                    Fokus Ibadah,<br />
                    <span class="text-amber-400">Urusan Transaksi Biar Kami.</span>
                </h1>
                <p class="text-emerald-100 text-lg max-w-md mb-8">
                    Aplikasi PPOB khusus jamaah Umrah. Beli pulsa, bayar tagihan keluarga di tanah air, hingga top up
                    dompet digital dengan mudah langsung dari Tanah Suci.
                </p>

                <div class="flex items-center space-x-4 text-sm text-emerald-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Aman & Terpercaya
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Layanan 24/7
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan - Form Login -->
        <div class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center p-6 sm:p-12 min-h-screen relative">
            <!-- Dekorasi Background Mobile -->
            <div class="absolute top-0 left-0 right-0 h-64 bg-emerald-800 rounded-b-[3rem] md:hidden"></div>

            <div
                class="w-full max-w-md relative z-10 bg-white rounded-3xl shadow-xl md:shadow-none md:bg-transparent p-8 md:p-0">

                <!-- Header Form -->
                <div class="text-center md:text-left mb-8">
                    <div class="flex justify-center md:justify-start items-center mb-4 md:hidden">
                        <div class="bg-emerald-100 p-3 rounded-full text-emerald-700">
                            <!-- Icon Heart (Mobile) -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm sm:text-base">Masuk ke akun BerkahPay Anda untuk melanjutkan.</p>
                </div>

                <!-- Notifikasi Error dari Laravel (jika ada) -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 text-red-600 p-3 rounded-xl text-sm border border-red-100">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Tab Pilihan Login -->
                <div class="flex bg-slate-100 p-1 rounded-xl mb-6">
                    <button type="button" @click="loginMethod = 'phone'"
                        :class="loginMethod === 'phone' ? 'bg-white text-emerald-700 shadow-sm' :
                            'text-slate-500 hover:text-slate-700'"
                        class="flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200">
                        No. WhatsApp
                    </button>
                    <button type="button" @click="loginMethod = 'email'"
                        :class="loginMethod === 'email' ? 'bg-white text-emerald-700 shadow-sm' :
                            'text-slate-500 hover:text-slate-700'"
                        class="flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200">
                        Email
                    </button>
                </div>

                <!-- Form Laravel -->
                <form method="POST" action="{{ route('auth.login') }}" @submit="isLoading = true" class="space-y-5">
                    @csrf

                    <!-- Input Tersembunyi untuk deteksi jenis login di backend -->
                    <input type="hidden" name="login_type" :value="loginMethod">

                    <!-- Input Identitas (Berubah dinamis pakai Alpine.js) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5"
                            x-text="loginMethod === 'phone' ? 'Nomor WhatsApp' : 'Alamat Email'"></label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <!-- Icon Phone -->
                                <svg x-show="loginMethod === 'phone'" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.496-3.909-7.186-6.866l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <!-- Icon Email -->
                                <svg x-cloak x-show="loginMethod === 'email'" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>

                            <div x-show="loginMethod === 'phone'"
                                class="absolute inset-y-0 left-11 flex items-center pointer-events-none text-slate-500 font-medium">
                                +62
                            </div>

                            <!-- Input dinamis -->
                            <input :type="loginMethod === 'phone' ? 'tel' : 'email'"
                                :name="loginMethod === 'phone' ? 'phone' : 'email'"
                                :placeholder="loginMethod === 'phone' ? '81234567890' : 'nama@contoh.com'"
                                :class="loginMethod === 'phone' ? 'pl-20' : 'pl-11'"
                                value="{{ old('email') ?? old('phone') }}"
                                class="block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors py-3 pr-4 border"
                                required />
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="block text-sm font-medium text-slate-700">PIN / Kata Sandi</label>
                            <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                                Lupa PIN?
                            </a>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <!-- Icon Lock -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>

                            <input :type="showPassword ? 'text' : 'password'" name="password"
                                class="block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors py-3 pl-11 pr-12 border"
                                placeholder="Masukkan PIN Anda" required />

                            <!-- Toggle Password Visibility -->
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
                                <!-- Icon Eye -->
                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Icon EyeOff -->
                                <svg x-cloak x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Pilihan Ingat Saya (Opsional untuk Laravel) -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-700">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" :disabled="isLoading"
                        class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-base font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all disabled:opacity-70 disabled:cursor-not-allowed mt-2">
                        <!-- Loading Spinner -->
                        <div x-show="isLoading"
                            class="w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>

                        <!-- Text -->
                        <div x-show="!isLoading" class="flex items-center">
                            Masuk Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="ml-2 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </button>
                </form>

                <!-- Footer Form -->
                <div class="mt-8 text-center text-sm text-slate-600">
                    Belum punya akun?
                    <a href="#" class="font-bold text-emerald-600 hover:text-emerald-800 transition-colors">
                        Daftar di sini
                    </a>
                </div>

                <div class="mt-8 text-center md:hidden">
                    <p class="text-xs text-slate-400">
                        Aman & Terpercaya • Dukungan CS 24/7
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
