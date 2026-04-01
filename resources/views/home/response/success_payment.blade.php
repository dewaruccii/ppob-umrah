<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pembayaran Berhasil</title>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden p-8 text-center border border-gray-100">

        <div class="flex justify-center mb-6">
            <div class="bg-emerald-100 p-4 rounded-full">
                <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Berhasil!</h1>
        <p class="text-gray-500 mb-8">Terima kasih atas pesanan Anda. Kami telah mengirimkan struk pembayaran ke email
            Anda.</p>

        <div class="bg-gray-50 rounded-2xl p-4 mb-8 text-left">
            <div class="flex justify-between py-2 border-bottom border-gray-100 text-sm">
                <span class="text-gray-400">ID Transaksi</span>
                <span class="font-medium text-gray-700">#TRX-992831</span>
            </div>
            <div class="flex justify-between py-2 text-sm">
                <span class="text-gray-400">Total Dibayar</span>
                <span class="font-bold text-emerald-600">Rp 250.000</span>
            </div>
            <div class="flex justify-between py-2 text-sm">
                <span class="text-gray-400">Metode</span>
                <span class="font-medium text-gray-700">Bank Transfer</span>
            </div>
        </div>

        <div class="flex flex-col gap-3">
            <button
                class="w-full bg-gray-900 hover:bg-black text-white font-semibold py-4 rounded-xl transition duration-300">
                Lacak Pesanan
            </button>
            <button
                class="w-full bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium py-3 rounded-xl transition duration-300 text-sm">
                Kembali ke Beranda
            </button>
        </div>

        <p class="mt-8 text-xs text-gray-400">
            Butuh bantuan? <a href="#" class="text-emerald-500 hover:underline">Hubungi kami</a>
        </p>
    </div>

</body>

</html>
