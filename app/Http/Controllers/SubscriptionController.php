<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function newSubscription(Request $request)
    {
        
        $user = auth()->user();
        $defaultPaymentMethod = $user->defaultPaymentMethod()->id;
        
        $user->newSubscription('Suscripciones blog', $request->id)
            ->create($defaultPaymentMethod);
    }
}
