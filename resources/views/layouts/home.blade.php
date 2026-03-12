<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BerkahPay PPOB</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Hide scrollbar for horizontal scroll areas */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Desktop Sidebar & Mobile Wrapper -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Desktop (Hidden di Mobile) -->
        <aside class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200">
            <div class="p-6 flex items-center gap-3">
                <div class="bg-emerald-100 p-2 rounded-xl text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-emerald-900">BerkahPay</span>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4 overflow-y-auto">
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Beranda
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                    Riwayat Transaksi
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    Kartu Tersimpan
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-emerald-600 rounded-xl font-medium transition-colors relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    Pesan
                    <span class="absolute right-4 top-3.5 flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-200">
                <!-- Tambahkan onsubmit untuk memanggil sweetalert -->
                <form action="#" method="POST" id="logout-form" onsubmit="confirmLogout(event)">
                    <!-- Ganti # dengan route('logout') di Laravel -->
                    <button type="submit"
                        class="flex w-full items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 relative overflow-y-auto overflow-x-hidden bg-slate-50 pb-24 md:pb-6">

            <!-- Header Mobile & Desktop -->
            <header
                class="bg-emerald-900 text-white pt-6 pb-24 px-4 sm:px-6 lg:px-8 relative rounded-b-[2rem] md:rounded-b-[3rem] shadow-md">
                <!-- Ornamen Background -->
                <div class="absolute inset-0 overflow-hidden rounded-b-[2rem] md:rounded-b-[3rem]">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-800 rounded-full mix-blend-multiply filter blur-2xl opacity-50">
                    </div>
                    <div
                        class="absolute -left-10 top-20 w-40 h-40 bg-emerald-700 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                    </div>
                </div>

                <div class="relative z-10 flex justify-between items-center mb-8">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fulan&background=10b981&color=fff&rounded=true"
                            alt="Profile" class="w-11 h-11 border-2 border-emerald-400 rounded-full shadow-sm">
                        <div>
                            <p class="text-emerald-100 text-xs">Assalamu'alaikum,</p>
                            <h2 class="font-bold text-lg leading-tight">Bpk. Ahmad Fulan</h2>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="bg-emerald-800/50 p-2.5 rounded-full backdrop-blur-sm relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5 text-emerald-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            <div
                                class="absolute top-2 right-2.5 w-2 h-2 bg-amber-400 rounded-full border-2 border-emerald-900">
                            </div>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Konten Utama (Ditarik ke atas agar menimpa header) -->
            <div class="relative z-20 px-4 sm:px-6 lg:px-8 -mt-20 max-w-5xl mx-auto space-y-6">

                <!-- Card Saldo -->
                <div class="bg-white rounded-2xl shadow-lg p-5 border border-slate-100">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                                Saldo BerkahPay
                                <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></button>
                            </p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800">Rp 2.450.000</h3>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-500 mb-1">Poin Ibadah</p>
                            <div class="flex items-center gap-1 justify-end text-amber-500 font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                        clip-rule="evenodd" />
                                </svg>
                                1,250
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button
                            class="flex-1 flex flex-col items-center justify-center py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-xl transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="text-xs font-semibold">Isi Saldo</span>
                        </button>
                        <button
                            class="flex-1 flex flex-col items-center justify-center py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <span class="text-xs font-semibold">Transfer</span>
                        </button>
                        <button
                            class="flex-1 flex flex-col items-center justify-center py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-semibold">Tarik Tunai</span>
                        </button>
                        <button
                            class="flex-1 flex flex-col items-center justify-center py-2 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-semibold">Riwayat</span>
                        </button>
                    </div>
                </div>

                <!-- Info Kurs Mini (Spesifik Umrah) -->
                <div
                    class="bg-amber-50 border border-amber-100 rounded-xl p-3 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">🇸🇦</span>
                        <div class="text-sm">
                            <p class="font-bold text-amber-900">Info Kurs Hari Ini</p>
                            <p class="text-amber-700 text-xs">1 SAR = Rp 4.150</p>
                        </div>
                    </div>
                    <button
                        class="text-xs font-bold text-emerald-600 bg-white px-3 py-1.5 rounded-lg shadow-sm border border-emerald-100">
                        Kalkulator
                    </button>
                </div>

                <!-- Menu PPOB Grid -->
                <div>
                    <h4 class="font-bold text-slate-800 mb-4 px-1">Layanan di Tanah Suci</h4>
                    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-5 gap-y-6 gap-x-2">
                        <!-- Menu 1: Pulsa Saudi -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Pulsa<br />Lokal
                                Arab</span>
                        </a>

                        <!-- Menu 2: Paket Roaming -->
                        <a href="{{ route('roaming-data.index') }}" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Paket<br />Roaming</span>
                        </a>

                        <!-- Menu 3: Bayar Dam/Sedekah -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors shadow-sm relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                <span
                                    class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full">Baru</span>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Dam
                                &<br />Sedekah</span>
                        </a>

                        <!-- Menu 4: Transfer Bank -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-slate-200 rounded-2xl flex items-center justify-center text-slate-700 group-hover:bg-slate-700 group-hover:text-white transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Transfer<br />Bank</span>
                        </a>

                        <!-- Menu 5: Semua Kategori -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 group-hover:bg-slate-200 transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Semua<br />Layanan</span>
                        </a>
                    </div>
                </div>

                <div class="h-px bg-slate-200 w-full my-6"></div>

                <!-- Menu Tagihan Indonesia -->
                <div>
                    <h4 class="font-bold text-slate-800 mb-4 px-1">Urus Tagihan di Indonesia</h4>
                    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-5 gap-y-6 gap-x-2">
                        <!-- PLN -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-yellow-500 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Token<br />PLN</span>
                        </a>
                        <!-- PDAM -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-blue-500 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Air<br />PDAM</span>
                        </a>
                        <!-- BPJS -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-teal-600 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">BPJS<br />Kesehatan</span>
                        </a>
                        <!-- Pulsa Indo -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-red-500 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Pulsa<br />Indonesia</span>
                        </a>
                        <!-- E-Wallet -->
                        <a href="#" class="flex flex-col items-center group">
                            <div
                                class="w-12 h-12 sm:w-14 sm:h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-purple-500 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] sm:text-xs text-center mt-2 font-medium text-slate-600 leading-tight">Top
                                Up<br />E-Wallet</span>
                        </a>
                    </div>
                </div>

                <!-- Banner Promo Slider (Horizontal Scroll) -->
                <div class="mt-8">
                    <div class="flex gap-4 overflow-x-auto pb-4 no-scrollbar snap-x">
                        <!-- Banner 1 -->
                        <div
                            class="min-w-[280px] sm:min-w-[320px] bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-2xl p-5 text-white snap-center relative overflow-hidden shadow-md">
                            <div class="relative z-10">
                                <h4 class="font-bold text-lg mb-1">Paket STC Arab Saudi</h4>
                                <p class="text-sm text-emerald-100 mb-3">Internet 10GB aktif 14 Hari</p>
                                <button class="bg-white text-emerald-700 text-xs font-bold px-4 py-2 rounded-lg">Beli
                                    Sekarang</button>
                            </div>
                            <svg class="absolute -bottom-4 -right-4 w-24 h-24 text-emerald-500 opacity-50"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z">
                                </path>
                            </svg>
                        </div>
                        <!-- Banner 2 -->
                        <div
                            class="min-w-[280px] sm:min-w-[320px] bg-gradient-to-r from-amber-500 to-amber-300 rounded-2xl p-5 text-white snap-center relative overflow-hidden shadow-md">
                            <div class="relative z-10">
                                <h4 class="font-bold text-lg mb-1">Promo Token PLN</h4>
                                <p class="text-sm text-amber-50 mb-3">Diskon admin bayar via BerkahPay</p>
                                <button class="bg-white text-amber-700 text-xs font-bold px-4 py-2 rounded-lg">Cek
                                    Promo</button>
                            </div>
                            <svg class="absolute -bottom-2 -right-2 w-20 h-20 text-amber-400 opacity-50"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="pb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-slate-800 px-1">Transaksi Terakhir</h4>
                        <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Lihat
                            Semua</a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 divide-y divide-slate-100">
                        <!-- Item 1 -->
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-50 p-2.5 rounded-xl text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-slate-800">Paket Data STC 10GB</p>
                                    <p class="text-xs text-slate-500">Hari ini, 09:41</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-sm text-slate-800">Rp 125.000</p>
                                <p class="text-xs text-emerald-500 font-medium">Berhasil</p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-slate-800">Token PLN - Rumah JKT</p>
                                    <p class="text-xs text-slate-500">Kemarin, 16:20</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-sm text-slate-800">Rp 502.500</p>
                                <p class="text-xs text-emerald-500 font-medium">Berhasil</p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-50 p-2.5 rounded-xl text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-slate-800">Top Up Saldo BCA</p>
                                    <p class="text-xs text-slate-500">12 Feb, 10:10</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-sm text-emerald-600">+ Rp 1.000.000</p>
                                <p class="text-xs text-emerald-500 font-medium">Berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Bottom Navigation (Hanya muncul di Mobile) -->
    <div
        class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 flex justify-around items-center pb-safe pt-2 px-2 z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <a href="#" class="flex flex-col items-center p-2 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 mb-1">
                <path
                    d="M11.47 3.84a.75.75 0 011.06 0l8.99 9a.75.75 0 11-1.06 1.06l-4.69-4.69V21a.75.75 0 01-.75.75h-3.6a.75.75 0 01-.75-.75v-5.6a.75.75 0 00-.75-.75h-1.5a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H6.26a.75.75 0 01-.75-.75v-11.8l-4.69 4.69a.75.75 0 11-1.06-1.06l8.99-9z" />
            </svg>
            <span class="text-[10px] font-semibold">Beranda</span>
        </a>
        <a href="#"
            class="flex flex-col items-center p-2 text-slate-400 hover:text-emerald-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-6 h-6 mb-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
            </svg>
            <span class="text-[10px] font-semibold">Riwayat</span>
        </a>

        <!-- Scan QRIS Center Button -->
        <div class="relative -top-5">
            <button
                class="bg-emerald-600 text-white p-3 rounded-full shadow-lg border-4 border-slate-50 flex items-center justify-center transform hover:scale-105 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                </svg>
            </button>
            <span
                class="text-[10px] font-semibold text-slate-500 absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-full text-center">QRIS</span>
        </div>

        <a href="#"
            class="flex flex-col items-center p-2 text-slate-400 hover:text-emerald-600 transition-colors relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-6 h-6 mb-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="absolute top-1 right-2 w-2 h-2 bg-amber-500 rounded-full border border-white"></span>
            <span class="text-[10px] font-semibold">Pesan</span>
        </a>
        <a href="#"
            class="flex flex-col items-center p-2 text-slate-400 hover:text-emerald-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-6 h-6 mb-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <span class="text-[10px] font-semibold">Akun</span>
        </a>
    </div>

    <!-- Script Javascript untuk konfirmasi SweetAlert -->
    <script>
        function confirmLogout(event) {
            // Mencegah form langsung disubmit secara otomatis
            event.preventDefault();

            Swal.fire({
                title: 'Keluar Aplikasi?',
                text: "Apakah Anda yakin ingin keluar dari BerkahPay?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // Warna merah (seperti class text-red-500)
                cancelButtonColor: '#94a3b8', // Warna abu-abu
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true, // Menaruh tombol konfirmasi di kanan
                customClass: {
                    popup: 'rounded-3xl', // Styling agar cocok dengan tema
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika di Laravel, Anda bisa mensubmit form setelah dikonfirmasi:
                    // document.getElementById('logout-form').submit();

                    // Untuk keperluan simulasi di sini, memunculkan notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil Keluar!',
                        text: 'Sesi Anda telah diakhiri.',
                        icon: 'success',
                        confirmButtonColor: '#10b981', // Warna hijau
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Dipanggil setelah notifikasi Swal selesai (karena timer atau ditutup)
                        window.location.href = '{{ route('auth.logout') }}';
                    });
                }
            });
        }
    </script>
</body>

</html>
