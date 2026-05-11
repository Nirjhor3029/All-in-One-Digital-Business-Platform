<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'course')->where('is_active', true)->orderBy('sort_order')->get();
        $settings = Setting::pluck('value', 'key');

        return view('welcome', compact('categories', 'settings'));
    }
}
