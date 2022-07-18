<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Livewire\Admin\ShowBooks;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\CreateBook;
use App\Http\Livewire\Admin\EditBook;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\UserComponent;


Route::get('/', ShowBooks::class)->name('admin.index');

Route::get('books/{book}/edit', CreateBook::class)->name('admin.books.edit');

Route::get('books/create', CreateBook::class)->name('admin.books.create');

Route::get('book/{book}/edit', EditBook::class)->name('admin.books.edit');

Route::post('books/{book}/files', [BookController::class, 'files'])->name('admin.books.files');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');

Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

/* Route::get('authors', CreateAuthor::class, 'index')->name('admin.authors.index'); */

Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::get('users', UserComponent::class)->name('admin.users.index');