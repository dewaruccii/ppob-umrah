<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController; // Import ini agar tidak perlu nulis full path di bawah
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {

    Route::post('/request-login', [AuthController::class, 'requestMagicLink']);
    Route::post('/verify-login', [AuthController::class, 'verifyMagicLink']);

    /*
    |--------------------------------------------------------------------------
    | Protected Routes (Auth Sanctum)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/check-session', [AuthController::class, 'checkSession']);

        Route::post('/logout', [AuthController::class, 'logout']);

        // Group Products
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::get('/tabs', [ProductController::class, 'tabsNavigation']);
            Route::get('/{id}', [ProductController::class, 'show']);
        });

        // Group Transactions
        Route::prefix('transactions')->group(function () {
            // Menggunakan 'store' adalah penamaan standar RESTful API untuk create
            Route::post('/', [TransactionController::class, 'createTransaction']);
            Route::get('/{order_id}', [TransactionController::class, 'checkStatus']);

            // Opsional: Route untuk cek status atau history transaksi user tersebut
            // Route::get('/', [TransactionController::class, 'userHistory']);
            // Route::get('/{order_id}', [TransactionController::class, 'checkStatus']);
        });
    });
});
