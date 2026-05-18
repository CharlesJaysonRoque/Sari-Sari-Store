<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BlockListController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentTermsController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return redirect()->route('stocks.index');
});

Route::resource('stocks', StocksController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('stockin', StockInController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('stockout', StockOutController::class);
Route::resource('reasons', ReasonController::class);
Route::resource('customers', CustomerController::class);
Route::resource('blocklist', BlockListController::class);
Route::resource('violations', ViolationController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('paymentmethods', PaymentMethodController::class);
Route::resource('paymentterms', PaymentTermsController::class);
Route::resource('sales', SaleController::class);
