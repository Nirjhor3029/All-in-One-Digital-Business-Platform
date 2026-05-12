<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('typeRel', fn($q) => $q->where('slug', 'course'))
            ->where('is_active', true)->orderBy('sort_order')->get();

        $settings = Setting::pluck('value', 'key');

        $featuredCourses = Course::with(['instructor', 'category'])
            ->withCount('enrollments')
            ->published()
            ->featured()
            ->take(6)
            ->get();

        $courses = Course::with(['instructor', 'category'])
            ->withCount('enrollments')
            ->published()
            ->latest()
            ->take(6)
            ->get();

        $services = Service::with('plans')
            ->published()
            ->latest()
            ->take(4)
            ->get();

        $featuredPost = Post::with('author', 'category')
            ->published()
            ->latest()
            ->first();

        $recentPosts = Post::with('author')
            ->published()
            ->latest()
            ->skip(1)
            ->take(2)
            ->get();

        return view('welcome', compact(
            'categories', 'settings',
            'featuredCourses', 'courses',
            'services',
            'featuredPost', 'recentPosts'
        ));
    }
}
