<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->first();

        if ($page) {
            return view('pages.dynamic', compact('page'));
        }

        $view = 'pages.' . $slug;
        if (view()->exists($view)) {
            return view($view);
        }

        abort(404);
    }
}
