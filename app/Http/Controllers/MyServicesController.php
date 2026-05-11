<?php

namespace App\Http\Controllers;

use App\Models\ServicePurchase;

class MyServicesController extends Controller
{
    public function index()
    {
        $purchases = ServicePurchase::with(['servicePlan.service', 'order'])
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('my-services.index', compact('purchases'));
    }
}
