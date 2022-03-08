<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\OrderController::class,'index'])->name('order.form');
Route::post('order_submit', [App\Http\Controllers\OrderController::class,'submit'])->name('order.submit');

Route::resource('item', App\Http\Controllers\ItemsController::class);
//need to change seller controller for seller controller
//Route::get('order', [App\Http\Controllers\ItemsController::class,'order'])->name('seller.order');

//Route::get('order/{order}/approve', [App\Http\Controllers\ItemsController::class,'approve'])->name('order.approve');

//Route::get('order/{order}/ready', [App\Http\Controllers\OrderController::class,'orderList'])->name('order.orderList');

//Auth::routes();
Auth::routes([
    'register' => false, //Registration false
    'reset' => false, // Password reset routes false
    'verify' => false,
]);




