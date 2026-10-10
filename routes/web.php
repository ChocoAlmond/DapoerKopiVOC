<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'menus' => Menu::latest()->take(3)->get(),
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('menus', [MenuController::class, 'index'])->name('menus.index');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{menu}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('cart/{menu}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{menu}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function (): void {
        Route::resource('menus', MenuController::class)->except('show');
        Route::get('orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    });
});
