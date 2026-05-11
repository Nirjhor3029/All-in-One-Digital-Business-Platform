<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::with(['provider', 'category', 'plans' => fn ($q) => $q->where('is_active', true)])
            ->withCount('plans')
            ->published()
            ->latest()
            ->paginate(12);

        $featured = Service::with('provider')
            ->published()
            ->featured()
            ->take(6)
            ->get();

        return view('services.index', compact('services', 'featured'));
    }

    public function show(Service $service): View
    {
        abort_unless($service->is_published, 404);

        $service->load(['provider', 'category', 'plans' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')]);

        return view('services.show', compact('service'));
    }
}
