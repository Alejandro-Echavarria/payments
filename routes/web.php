<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingController;

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

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

// Billing routes
Route::get('billings', [BillingController::class, 'index'])->name('billings.index');
Route::post('billings/addpaymentmethod', [BillingController::class, 'addPaymentMethod'])->name('billings.addpaymentmethod');
Route::delete('billings/removepaymentmethod', [BillingController::class, 'removePaymentMethod'])->name('billings.removepaymentmethod');

// Otros --
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
