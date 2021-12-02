<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('category')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    //Untuk menambahkan/menginsert data
    Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});

Route::resource('book', BookController::class);
