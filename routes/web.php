<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Lib\RoamingDataController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class, 'as' => 'auth.'], function () {
    Route::get('/', 'index')->name('index')->middleware('guest');
    Route::post('/', 'login')->name('login')->middleware('guest');
    Route::post('/register', 'register')->name('register')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/roaming-data', [RoamingDataController::class, 'index'])->name('roaming-data.index');
});
Route::get('/', function () {
    return redirect()->route('dashboard');
});
