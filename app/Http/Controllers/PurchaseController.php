<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Product $product)
    {
        $user = auth()->user();

        if (!$user->defaultPaymentMethod()) {
            return back()->with('flash', [
                'error' => [
                    'message' => 'Debes seleccionar un método de pago',
                ]
            ]);
        }

        try {
            $defaultPaymentMethod = $user->defaultPaymentMethod()->id;
            $user->charge($product->price * 100, $defaultPaymentMethod);
        } catch (\Exception $e) {
            return back()->with('flash', [
                'error' => [
                    'message' => __($e->getMessage()),
                ]
            ]);
        }

        return Inertia::render('Thanks');
    }
}
