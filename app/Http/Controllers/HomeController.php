<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use App\Models\Project;
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

        $stats = json_decode($settings['stats'] ?? '[]', true) ?: [
            ['icon' => '📚', 'value' => '50+', 'label' => 'Courses', 'sub' => 'Expert-led'],
            ['icon' => '👥', 'value' => '2,450+', 'label' => 'Students', 'sub' => 'Active learners'],
            ['icon' => '🛠', 'value' => '20+', 'label' => 'Products', 'sub' => 'SaaS solutions'],
            ['icon' => '⭐', 'value' => '4.9/5', 'label' => 'Rating', 'sub' => 'Student reviews'],
        ];

        $projects = Project::active()->ordered()->get();

        return view('welcome', compact(
            'categories', 'settings',
            'featuredCourses', 'courses',
            'services',
            'featuredPost', 'recentPosts',
            'stats', 'projects'
        ));
    }
}
