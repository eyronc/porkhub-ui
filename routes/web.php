<?php

use App\Http\Controllers\PorkHubController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/porkhub/create', [PorkHubController::class, 'createProductForm']);
    Route::get('/products', [PorkHubController::class, 'showProduct'])->name('products.index');
    Route::post('/porkhub', [PorkHubController::class, 'storeProduct']);
    Route::get('/porkhub/list', [PorkHubController::class, 'showProduct']);
    Route::get('/porkhub/edit/{id}', [PorkHubController::class, 'editProduct']);
    Route::post('/porkhub/edit/{id}', [PorkHubController::class, 'updateProduct']);
    Route::post('/porkhub/delete/{id}', [PorkHubController::class, 'deleteProduct']);
});


Route::middleware('auth')->group(function () {
    Route::get('/porkhub/order', [PorkHubController::class, 'placeOrder'])->name('user.menu');
    Route::get('/porkhub/userhome', [PorkHubController::class, 'userHome'])->name('user.home');
    Route::post('/porkhub/addOrderToCart/{id}', [PorkHubController::class, 'addOrderToCart'])->name('user.addOrderToCart');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
