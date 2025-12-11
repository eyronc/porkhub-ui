<?php

use App\Http\Controllers\PorkHubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantBranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [PorkHubController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/users/edit/{id}', [PorkHubController::class, 'editUser'])->name('users.edit');
    Route::post('/users/edit/{id}', [PorkHubController::class, 'updateUser'])->name('users.update');
    Route::post('/users/delete/{id}', [PorkHubController::class, 'deleteUser'])->name('users.delete');
    Route::post('/admin/orders/{order}/update-status', [PorkHubController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::delete('/admin/orders/{order}', [PorkHubController::class, 'deleteOrder'])->name('admin.orders.delete');
    Route::post('/reviews/store', [PorkHubController::class, 'storeReview'])->name('admin.reviews.store');
    Route::get('/dashboard', [PorkHubController::class, 'adminDashboard'])->name('dashboard');
    Route::delete('/admin/reviews/{id}', [PorkHubController::class, 'deleteReview'])->name('admin.reviews.delete');
    Route::get('/admin/reviews', [PorkHubController::class, 'adminDashboard'])->name('admin.reviews');
    Route::get('/porkhub/create', [PorkHubController::class, 'createProductForm']);
    Route::get('/products', [PorkHubController::class, 'showProduct'])->name('products.index');
    Route::post('/porkhub', [PorkHubController::class, 'storeProduct']);
    Route::get('/porkhub/list', [PorkHubController::class, 'showProduct']);
    Route::get('/porkhub/edit/{id}', [PorkHubController::class, 'editProduct']);
    Route::post('/porkhub/edit/{id}', [PorkHubController::class, 'updateProduct']);
    Route::post('/porkhub/delete/{id}', [PorkHubController::class, 'deleteProduct']);
    Route::get('/branches/list',[RestaurantBranchController::class, 'showBranches'])->name('branches.list');
    Route::get('/branches/create',[RestaurantBranchController::class,'createBranch'])->name('branches.create');
    Route::post('/branches/store',[RestaurantBranchController::class,'storeBranch'])->name('branches.store');
    Route::get('/branches/edit/{id}', [RestaurantBranchController::class, 'editBranch'])->name('branches.edit'); 
    Route::post('/branches/edit/{id}', [RestaurantBranchController::class, 'updateBranch'])->name('branches.update');
    Route::post('/branches/delete/{id}', [RestaurantBranchController::class, 'deleteBranch'])->name('branches.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/porkhub/order', [PorkHubController::class, 'placeOrder'])->name('user.menu');
    Route::get('/porkhub/userhome', [PorkHubController::class, 'userHome'])->name('user.home');
    Route::get('/review', [PorkHubController::class, 'showUserReviewForm'])->name('user.reviews');
    Route::post('/review/submit', [PorkHubController::class, 'storeReview'])->name('user.submitReview');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::get('/porkhub/addOrderToCart/{id}', [CartController::class, 'addToCartForm'])->name('cart.addForm');
    Route::post('/porkhub/addOrderToCart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/porkhub/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('cart.checkout');
    Route::post('/porkhub/finalize-order', [CheckoutController::class, 'finalizeOrder'])->name('order.finalize');
    Route::get('/porkhub/order-success', [CheckoutController::class, 'orderSuccess'])->name('order.success');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->post('/close-review-popup', function () {
    session(['review_popup_dismissed' => true]);
    session(['review_popup_shown' => false]);  
    return response()->json(['success' => true]);
})->name('review.popup.close');


require __DIR__.'/auth.php';