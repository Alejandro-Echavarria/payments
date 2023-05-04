<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\SubscriptionController;

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

// Products
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// Articles
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Billing
Route::get('billings', [BillingController::class, 'index'])->name('billings.index');
Route::post('billings/addpaymentmethod', [BillingController::class, 'addPaymentMethod'])->name('billings.addpaymentmethod');
Route::put('billings/defaultpaymentmethod', [BillingController::class, 'defaultPaymentMethod'])->name('billings.defaultpaymentmethod');
Route::delete('billings/removepaymentmethod', [BillingController::class, 'removePaymentMethod'])->name('billings.removepaymentmethod');

// Subscription
Route::post('subscriptions', [SubscriptionController::class, 'newSubscription'])->name('subscriptions.store');
Route::put('subscriptions/resumesubscription', [SubscriptionController::class, 'resumeSubscription'])->name('subscriptions.resumesubscription');
Route::delete('subscriptions/cancelsubscription', [SubscriptionController::class, 'cancelSubscription'])->name('subscriptions.cancelsubscription');

// Invoices
Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});

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
