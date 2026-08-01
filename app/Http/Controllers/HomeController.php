<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        $services = Service::with('plans')
            ->published()
            ->latest()
            ->take(8)
            ->get();

        $courses = Course::with(['instructor', 'category'])
            ->withCount(['enrollments', 'sections'])
            ->published()
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('settings', 'services', 'courses'));
    }
}
