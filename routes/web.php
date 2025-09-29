<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->controller(OwnerController::class)->middleware('guest')->group(function(){
    Route::get('/', 'loginForm')->name('owner.login');
    Route::post('/', 'loginPost')->name('loginPost');
});

Route::post('/logout', [AccountController::class, 'logout'])->name('logout')->middleware('owner');

Route::prefix('dashboard')->controller(dashboardController::class)->middleware('owner')->group(function(){
    Route::get('/', 'index')->name('home');
});

Route::prefix('account')->controller(AccountController::class)->middleware('owner')->group(function(){
    Route::get('/change-password', 'changePasswordIndex')->name('changePasswordIndex');
    Route::post('/change-password', 'changePasswordPost')->name('changePasswordPost');
});