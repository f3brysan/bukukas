<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-store', [AuthController::class, 'registerStore'])->name('register.store');
Route::post('/login-store', [AuthController::class, 'loginStore'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('categories', CategoryController::class);
    Route::get('categories/get/{type}', [CategoryController::class, 'getCategoriesByType'])->name('categories.get.type');

    Route::get('/transactions/get', [TransactionController::class, 'getTransactions'])->name('transactions.get');
    Route::get('/transactions/edit/{id}', [TransactionController::class, 'editTransaction'])->name('transactions.edit');
    Route::post('/transactions/store', [TransactionController::class, 'storeTransaction'])->name('transactions.store');
    Route::post('/transactions/delete', [TransactionController::class, 'deleteTransaction'])->name('transactions.delete');
});
