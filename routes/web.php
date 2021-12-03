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

Route::view('test-login', 'auth.login-new');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        // Untuk insert data menggunakan post
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        // Untuk update data menggunakan put atau patch
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        // Untuk hapus data menggunakan delete
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/all', [CategoryController::class, 'getAllCategory'])->name('category.all');
    });

    Route::resource('book', BookController::class);
});
