<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function newSubscription(Request $request)
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
            if ($user->subscribed('Suscripciones blog')) {
                $user->subscription('Suscripciones blog')->swap($request->id);
                return;
            }

            $defaultPaymentMethod = $user->defaultPaymentMethod()->id;

            $user->newSubscription('Suscripciones blog', $request->id)
                ->trialDays(60)
                ->create($defaultPaymentMethod);
        } catch (\Exception $e) {
            return back()->with('flash', [
                'error' => [
                    'message' => __($e->getMessage()),
                ]
            ]);
        }
    }

    public function resumeSubscription(Request $request)
    {
        $user = auth()->user();
        $user->subscription($request->name)->resume();
    }

    public function cancelSubscription(Request $request)
    {
        $user = auth()->user();
        $user->subscription($request->name)->cancel();
    }
}
