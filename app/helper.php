<?php

use Illuminate\Support\Str;

function generateOrderId($reference)
{
    // Prefix untuk Roaming Telkomsel
    $prefix = "{$reference}"; // Contoh: RM-TSEL

    // Tanggal hari ini
    $date = date('YmdHis');

    // String acak 5 karakter (Huruf Kapital & Angka)
    $random = strtoupper(bin2hex(random_bytes(2)));

    // Hasil: RM-TSEL-20260330-8F2B
    return "{$prefix}-{$date}-{$random}";
}


function uuidGenerator()
{
    return (string) Str::uuid();
}
