<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $defaultPaymentMethod = $user->defaultPaymentMethod();
        $subscriptions = $user->subscriptions()->get();
        $invoices = $user->invoices();

        $subscriptionData = $subscriptions->map(function ($subscription) {
            return [
                'name' => $subscription->name,
                'stripe_price' => $subscription->stripe_price,
                'stripe_status' => $subscription->stripe_status,
                'ends_at' => $subscription->ends_at
            ];
        });

        Inertia::share([
            'STRIPE_KEY'=> env('STRIPE_KEY'),
            'defaultPaymentMethod' => $defaultPaymentMethod,
            'subscriptions' => $subscriptionData,
        ]);

        return Inertia::render('Billings/Index', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods(),
            'invoices' => $invoices,
        ]);
    }

    public function addPaymentMethod(Request $request)
    {
        $id = implode(',', array_keys($request->all()));

        auth()->user()->addPaymentMethod($id);

        if (!auth()->user()->hasDefaultPaymentMethod()) {

            auth()->user()->updateDefaultPaymentMethod($id);
        }
    }

    public function defaultPaymentMethod(Request $request)
    {
        $id = implode(',', array_keys($request->all()));

        auth()->user()->updateDefaultPaymentMethod($id);
    }

    public function removePaymentMethod(Request $request)
    {
        $id = implode(',', array_keys($request->all()));

        auth()->user()->deletePaymentMethod($id);
    }
}
