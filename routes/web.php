<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Lib\RoamingDataController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// Route::group(['prefix' => 'auth', 'controller' => AuthController::class, 'as' => 'auth.'], function () {
//     Route::get('/', 'index')->name('index')->middleware('guest');
//     Route::post('/', 'login')->name('login')->middleware('guest');
//     Route::post('/register', 'register')->name('register')->middleware('guest');
//     Route::get('/logout', 'logout')->name('logout')->middleware('auth');
// });

Route::group(['prefix' => 'v1',  'as' => 'v1.'], function () {
    // Jangan lupa tambahkan middleware auth di setiap route yang butuh proteksi
    Route::post('webhook/midtrans', [WebhookController::class, 'handle'])->name('webhook.handle');
    Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');

    // Route::group(['prefix' => 'transactions', 'as' => 'transactions.', 'middleware' => ['auth'], 'controller' => TransactionController::class], function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('/{id}', 'show')->name('show');
    //     Route::post('/', 'store')->name('store');
    // });
});
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/roaming-data', [RoamingDataController::class, 'index'])->name('roaming-data.index');
// });
// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });
