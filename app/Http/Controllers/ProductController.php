<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
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

        return Inertia::render('Products/Show', compact('product', 'paymentMethods', 'defaultPaymentMethod'));
    }
}
