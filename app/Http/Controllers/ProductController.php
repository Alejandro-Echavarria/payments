<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['show']);
    }

    public function index()
    {
        $products = Product::paginate(9);

        return Inertia::render('Products/Index', compact('products'));
    }

    public function show(Product $product)
    {
        $user = auth()->user();
        $paymentMethods = $user->paymentMethods();
        $defaultPaymentMethod = $user->defaultPaymentMethod();
        $intent = $user->createSetupIntent();
        $STRIPE_KEY = config('stripe.stripe_key');

        return Inertia::render('Products/Show', compact([
            'product', 'paymentMethods', 'defaultPaymentMethod', 'intent', 'STRIPE_KEY'
        ]));
    }

    public function admin()
    {
        return Inertia::render('Products/Admin');
    }
}
