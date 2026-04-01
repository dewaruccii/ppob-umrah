<?php
return [
    'serverKey' => env('SERVER_KEY'),
    'clientKey' => env('CLIENT_KEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true)
];
