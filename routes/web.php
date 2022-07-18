<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\Cart;

Route::get('/', WelcomeController::class);

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

Route::middleware(['auth'])->group(function(){

    Route::get('cart', Cart::class)->name('cart');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show'); 
});

/* Route::get('prueba', function(){

    $orders = Order::where('status', 4)
                    ->orwhere('status', 5) 
                    ->get();

             foreach ($orders as $order) {
                $items = json_decode($order->content);
                foreach ($items as $item) {
                    increase($item);
                }
                $order->status = 5;
                $order->save();
            }
    return $orders;
}); */
/* Route::get('prueba', function(){
    \Cart::destroy();
}); */
