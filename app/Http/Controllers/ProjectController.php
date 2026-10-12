<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::active()->ordered()->get();

        return view('portfolio.index', compact('projects'));
    }
}
