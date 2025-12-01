<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->controller(LoginController::class)->middleware(['guest'])->group(function(){
    Route::get('/', 'login')->name('owner.login');
    Route::post('/', 'loginPost')->name('loginPost');
});

Route::post('/logout', [AccountController::class, 'logout'])->name('logout');

Route::prefix('dashboard')->controller(dashboardController::class)->middleware(['owner'])->group(function(){
    Route::get('/', 'index')->name('home');
});

Route::prefix('account')->controller(AccountController::class)->middleware(['owner'])->group(function(){
    Route::get('/change-password', 'changePasswordIndex')->name('changePasswordIndex');
    Route::post('/change-password', 'changePasswordPost')->name('changePasswordPost');
    
    Route::get('settings', 'AccountSettings')->name('AccountSettings');
    Route::get('changeUsername', 'changeUsername')->name('changeUsername');
    Route::put('changeCreds', 'changeCreds')->name('changeCreds');
});

Route::prefix('category')->controller(CategoryController::class)->middleware(['owner'])->group(function(){
    Route::get('/' ,'index')->name('categoryIndex');
    
    Route::post('/' ,'storeCategory')->name('storeCategory');

    Route::get('{id}/edit', 'editCategory')->name('editCategory');
    Route::put('{id}', 'updateCategory')->name('updateCategory');
    Route::delete('{id}', 'deleteCategory')->name('deleteCategory');
});

Route::prefix('product')->controller(ProductController::class)->middleware(['owner'])->group(function(){

    Route::get('/', 'add')->name('addProduct');
    Route::post('/','store')->name('storeProduct');

    Route::get('list', 'productList')->name('productList');
});