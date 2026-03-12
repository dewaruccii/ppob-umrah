<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Roaming - BerkahPay PPOB</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine Logic -->
    <script>
        window.roamingData = function() {
            return {
                phoneNumber: '',
                activeTab: 'all',
                selectedPackage: null,
                showPaymentPopup: false,
                isProcessingMidtrans: false,
                tabs: [{
                        id: 'all',
                        name: 'Semua Paket'
                    },
                    {
                        id: 'data',
                        name: 'Internet'
                    },
                    {
                        id: 'voice',
                        name: 'Telepon & SMS'
                    },
                    {
                        id: 'promo',
                        name: 'Hot Promo 🔥'
                    }
                ],
                packages: [{
                        id: 1,
                        category: 'data',
                        name: 'RoaMAX Umrah Internet 5GB',
                        quota: '5 GB',
                        duration: 12,
                        description: 'Kuota Internet 5GB berlaku di Arab Saudi, UEA, Qatar, Turki, Mesir. Berlaku 12 Hari.',
                        price: 275000,
                        originalPrice: 300000,
                        isPromo: true
                    },
                    {
                        id: 2,
                        category: 'data',
                        name: 'RoaMAX Umrah Internet 10GB',
                        quota: '10 GB',
                        duration: 17,
                        description: 'Kuota Internet 10GB berlaku di Arab Saudi dan beberapa negara transit. Berlaku 17 Hari.',
                        price: 375000,
                        originalPrice: null,
                        isPromo: false
                    },
                    {
                        id: 3,
                        category: 'all',
                        name: 'RoaMAX Umrah Combo 10GB',
                        quota: '10 GB + Telepon',
                        duration: 17,
                        description: '10GB Internet + 45 Menit Telepon ke Indonesia/Lokal + 45 SMS. Berlaku 17 Hari.',
                        price: 450000,
                        originalPrice: null,
                        isPromo: false
                    },
                    {
                        id: 4,
                        category: 'voice',
                        name: 'RoaMAX Umrah Voice & SMS',
                        quota: null,
                        duration: 12,
                        description: '50 Menit Telepon ke Nomor Indonesia/Lokal Arab Saudi + 50 SMS. Berlaku 12 Hari.',
                        price: 150000,
                        originalPrice: null,
                        isPromo: false
                    },
                    {
                        id: 5,
                        category: 'promo',
                        name: 'Flash Sale Umrah 15GB',
                        quota: '15 GB',
                        duration: 20,
                        description: 'Promo Spesial! Kuota besar 15GB untuk menemani ibadah panjang Anda. Berlaku 20 Hari.',
                        price: 410000,
                        originalPrice: 480000,
                        isPromo: true
                    }
                ],
                get filteredPackages() {
                    if (this.activeTab === 'all') return this.packages;
                    if (this.activeTab === 'promo') return this.packages.filter(p => p.isPromo);
                    return this.packages.filter(p => p.category === this.activeTab || p.category === 'all');
                },
                get isValidNumber() {
                    return this.phoneNumber && this.phoneNumber.replace(/[^0-9]/g, '').length >= 9;
                },
                selectPackage(pkg) {
                    this.selectedPackage = pkg;
                },
                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                },
                openPaymentPopup() {
                    if (!this.phoneNumber || !this.selectedPackage) return;
                    this.showPaymentPopup = true;
                    // Mencegah background scroll saat modal terbuka
                    document.body.style.overflow = 'hidden';
                },
                closePaymentPopup() {
                    this.showPaymentPopup = false;
                    document.body.style.overflow = '';
                },
                payWithMidtrans() {
                    this.isProcessingMidtrans = true;

                    // Simulasi pemanggilan API ke Backend Laravel untuk mendapatkan Snap Token Midtrans
                    setTimeout(() => {
                        this.isProcessingMidtrans = false;
                        this.closePaymentPopup();

                        // Di Laravel asli, Anda akan menggunakan response token dari backend
                        // dan memanggil: window.snap.pay(snapToken, { onSuccess: ... })
                        alert(
                            `[SIMULASI] Membuka Popup Midtrans Snap...\n\nMemproses pembayaran:\n${this.selectedPackage.name}\nTotal: ${this.formatRupiah(this.selectedPackage.price)}`
                            );
                    }, 1500);
                }
            };
        };
    </script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased" x-data="roamingData()">

    <!-- Header & App Bar -->
    <header class="bg-emerald-900 text-white sticky top-0 z-40 shadow-md">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-800 rounded-full mix-blend-multiply filter blur-2xl opacity-50">
            </div>
        </div>

        <div class="relative z-10 px-4 h-16 flex items-center justify-between max-w-5xl mx-auto">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                    class="p-2 -ml-2 rounded-full hover:bg-emerald-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h1 class="text-lg font-bold">Paket Roaming</h1>
            </div>
            <button class="p-2 rounded-full hover:bg-emerald-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </button>
        </div>

        <div class="h-12 bg-emerald-900 rounded-b-[2rem] w-full absolute -bottom-6 left-0 right-0 z-0 shadow-sm"></div>
    </header>

    <!-- Main Content -->
    <main class="relative z-10 px-4 pt-2 pb-32 max-w-5xl mx-auto space-y-6">

        <!-- Input Nomor -->
        <div class="bg-white rounded-2xl shadow-md p-4 border border-slate-100 mt-2 relative">
            <label class="block text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wide">Nomor Tujuan</label>
            <div class="flex items-center gap-3 relative">
                <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>

                <input type="tel" x-model="phoneNumber" placeholder="Contoh: 081234567890"
                    class="w-full bg-transparent text-lg font-bold text-slate-800 focus:outline-none placeholder-slate-300">

                <button class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-xl transition-colors shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </button>
            </div>

            <div x-show="phoneNumber.length > 3" x-cloak
                class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-medium">
                <span class="text-slate-500">Provider terdeteksi:</span>
                <span class="text-red-600 font-bold px-2 py-1 bg-red-50 rounded-md">Telkomsel</span>
            </div>
        </div>

        <!-- Negara Tujuan -->
        <div>
            <div class="flex justify-between items-center mb-3 px-1">
                <h2 class="font-bold text-slate-800">Negara Tujuan</h2>
                <button class="text-xs font-semibold text-emerald-600">Ubah</button>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-3 flex items-center gap-3 shadow-sm">
                <span class="text-2xl">🇸🇦</span>
                <div>
                    <p class="font-bold text-slate-800 text-sm">Arab Saudi</p>
                    <p class="text-xs text-slate-500">Khusus Umrah & Haji</p>
                </div>
            </div>
        </div>

        <!-- State Belum Masukkan Nomor -->
        <div x-show="!isValidNumber" x-transition.opacity class="text-center py-12 px-4 mt-4">
            <div class="bg-slate-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-10 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Ketik Nomor Tujuan</h3>
            <p class="text-sm text-slate-500 max-w-[250px] mx-auto">Masukkan nomor telepon untuk melihat daftar paket
                roaming yang tersedia.</p>
        </div>

        <!-- Wrapper Paket (Hanya muncul jika nomor valid) -->
        <div x-show="isValidNumber" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-6 mt-6">

            <!-- Tabs Kategori -->
            <div class="flex gap-2 overflow-x-auto no-scrollbar py-1">
                <template x-for="tab in tabs" :key="tab.id">
                    <button @click="activeTab = tab.id"
                        :class="activeTab === tab.id ? 'bg-emerald-600 text-white shadow-md' :
                            'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'"
                        class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-all"
                        x-text="tab.name"></button>
                </template>
            </div>

            <!-- Daftar Paket -->
            <div>
                <h2 class="font-bold text-slate-800 mb-3 px-1">Pilih Paket</h2>
                <div class="space-y-3">
                    <template x-for="pkg in filteredPackages" :key="pkg.id">
                        <!-- Card Paket -->
                        <div @click="selectPackage(pkg)"
                            :class="selectedPackage?.id === pkg.id ?
                                'border-emerald-500 bg-emerald-50 shadow-md ring-1 ring-emerald-500' :
                                'border-slate-200 bg-white shadow-sm hover:border-emerald-300'"
                            class="rounded-2xl p-4 border cursor-pointer transition-all relative overflow-hidden group">
                            <!-- Badge Promo (opsional) -->
                            <div x-show="pkg.isPromo"
                                class="absolute top-0 right-0 bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg z-10">
                                PROMO
                            </div>

                            <div class="flex justify-between items-start mb-2">
                                <div class="pr-8">
                                    <h3 class="font-bold text-slate-800 text-base mb-1" x-text="pkg.name"></h3>
                                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                        <span class="flex items-center gap-1 bg-slate-100 px-2 py-1 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span x-text="pkg.duration + ' Hari'"></span>
                                        </span>
                                        <span
                                            class="flex items-center gap-1 bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md"
                                            x-show="pkg.quota">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-16.5v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                            <span x-text="pkg.quota"></span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Radio Button Indikator -->
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0"
                                    :class="selectedPackage?.id === pkg.id ? 'border-emerald-600' : 'border-slate-300'">
                                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-600 transition-transform scale-0"
                                        :class="selectedPackage?.id === pkg.id ? 'scale-100' : ''"></div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2" x-text="pkg.description"></p>

                            <!-- Harga -->
                            <div class="flex justify-between items-end pt-3 border-t"
                                :class="selectedPackage?.id === pkg.id ? 'border-emerald-200' : 'border-slate-100'">
                                <div>
                                    <p class="text-[10px] text-slate-400 line-through" x-show="pkg.originalPrice"
                                        x-text="formatRupiah(pkg.originalPrice)"></p>
                                    <p class="text-emerald-700 font-bold text-lg" x-text="formatRupiah(pkg.price)">
                                    </p>
                                </div>
                                <span class="text-[10px] font-semibold text-emerald-600 hover:underline">Lihat
                                    Detail</span>
                            </div>
                        </div>
                    </template>

                    <!-- Empty State jika tidak ada paket -->
                    <div x-show="filteredPackages.length === 0" x-cloak class="text-center py-10">
                        <div class="bg-slate-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-medium">Paket tidak tersedia untuk kategori ini.</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Bottom Action Bar (Muncul saat paket dipilih) -->
    <div x-show="selectedPackage" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full shadow-none"
        x-transition:enter-end="translate-y-0 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.1)]"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.1)]"
        x-transition:leave-end="translate-y-full shadow-none" x-cloak
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 p-4 z-40 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.1)]">
        <div class="max-w-5xl mx-auto flex items-center justify-between gap-4">
            <div class="flex-1">
                <p class="text-xs text-slate-500 font-medium mb-0.5">Total Pembayaran</p>
                <p class="font-bold text-lg text-slate-800"
                    x-text="selectedPackage ? formatRupiah(selectedPackage.price) : 'Rp 0'"></p>
            </div>

            <button @click="openPaymentPopup()" :disabled="!phoneNumber"
                class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-sm transition-colors flex justify-center items-center disabled:opacity-50 disabled:cursor-not-allowed">
                <span>Beli Sekarang</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <!-- Peringatan jika nomor kosong -->
        <p x-show="!phoneNumber && selectedPackage" x-cloak
            class="text-[10px] text-red-500 mt-2 text-right w-full absolute -top-6 right-4 drop-shadow-md">
            *Masukkan nomor tujuan terlebih dahulu
        </p>
    </div>

    <!-- Modal/Popup Konfirmasi Pembayaran -->
    <div x-show="showPaymentPopup" x-cloak class="fixed inset-0 z-50 flex items-end sm:items-center justify-center">
        <!-- Overlay Gelap -->
        <div x-show="showPaymentPopup" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="closePaymentPopup()"
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- Panel Modal (Bottom Sheet di Mobile) -->
        <div x-show="showPaymentPopup" x-transition:enter="ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full sm:translate-y-4 sm:opacity-0"
            x-transition:enter-end="translate-y-0 sm:translate-y-0 sm:opacity-100"
            x-transition:leave="ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0 sm:translate-y-0 sm:opacity-100"
            x-transition:leave-end="translate-y-full sm:translate-y-4 sm:opacity-0"
            class="relative bg-white w-full max-w-md rounded-t-3xl sm:rounded-3xl shadow-2xl flex flex-col max-h-[90vh]">
            <!-- Handle drag untuk mobile -->
            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mt-3 mb-2 sm:hidden"></div>

            <!-- Header Modal -->
            <div class="px-6 pb-4 pt-2 sm:pt-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-slate-800">Konfirmasi Pembayaran</h3>
                <button @click="closePaymentPopup()"
                    class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body Modal (Scrollable) -->
            <div class="px-6 py-4 overflow-y-auto" x-show="selectedPackage">

                <!-- Info Tujuan -->
                <div class="mb-5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Informasi Tujuan</p>
                    <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3 border border-slate-100">
                        <div
                            class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Nomor Handphone</p>
                            <p class="font-bold text-slate-800 text-lg" x-text="phoneNumber"></p>
                        </div>
                    </div>
                </div>

                <!-- Info Paket -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Detail Paket</p>
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-emerald-200 rounded-full opacity-50 blur-xl">
                        </div>
                        <h4 class="font-bold text-slate-800 text-md mb-1 relative z-10"
                            x-text="selectedPackage?.name"></h4>
                        <p class="text-xs text-slate-600 mb-3 relative z-10" x-text="selectedPackage?.description">
                        </p>
                        <div class="flex justify-between items-end border-t border-emerald-200/60 pt-3 relative z-10">
                            <span class="text-sm font-medium text-slate-600">Harga</span>
                            <span class="font-bold text-emerald-700 text-lg"
                                x-text="selectedPackage ? formatRupiah(selectedPackage.price) : 'Rp 0'"></span>
                        </div>
                    </div>
                </div>

                <!-- Pilihan Metode Pembayaran (Midtrans Info) -->
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Metode Pembayaran</p>
                    <div class="border-2 border-slate-200 rounded-xl p-4 bg-white flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <!-- Logo Midtrans Simulated -->
                            <div
                                class="bg-blue-900 text-white font-bold italic px-2 py-1 rounded text-xs flex items-center justify-center">
                                midtrans
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-sm">Semua Metode Pembayaran</p>
                                <p class="text-xs text-slate-500">VA, E-Wallet, QRIS, Kartu Kredit</p>
                            </div>
                        </div>
                        <div class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Modal (Tombol Bayar) -->
            <div class="p-6 border-t border-slate-100 bg-white sm:rounded-b-3xl">
                <button @click="payWithMidtrans()" :disabled="isProcessingMidtrans"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-6 rounded-xl shadow-md transition-all flex justify-center items-center disabled:opacity-70 disabled:cursor-not-allowed">
                    <span x-show="!isProcessingMidtrans">Lanjut Pembayaran</span>
                    <span x-show="isProcessingMidtrans">Menyiapkan Pembayaran...</span>

                    <svg x-show="!isProcessingMidtrans" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>

                    <!-- Loading Spinner -->
                    <svg x-show="isProcessingMidtrans" x-cloak class="animate-spin ml-2 h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>
                <p class="text-center text-[10px] text-slate-400 mt-3 flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    Pembayaran aman didukung oleh Midtrans
                </p>
            </div>
        </div>
    </div>

</body>

</html>
