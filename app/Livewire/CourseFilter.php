<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseFilter extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selectedCategories = [];
    public array $selectedLevels = [];
    public string $priceRange = 'all';
    public string $sortBy = 'newest';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedLevels' => ['except' => []],
        'priceRange' => ['except' => 'all'],
        'sortBy' => ['except' => 'newest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::where('type', 'course')->where('is_active', true)->orderBy('sort_order')->get();

        $courses = Course::query()
            ->with(['instructor', 'category'])
            ->withCount('enrollments')
            ->published()
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('short_description', 'like', "%{$this->search}%")
            )
            ->when($this->selectedCategories, fn($q) =>
                $q->whereIn('category_id', $this->selectedCategories)
            )
            ->when($this->selectedLevels, fn($q) =>
                $q->whereIn('level', $this->selectedLevels)
            )
            ->when($this->priceRange === 'free', fn($q) => $q->where('is_free', true))
            ->when($this->priceRange === 'paid', fn($q) => $q->where('is_free', false))
            ->orderBy(
                match($this->sortBy) {
                    'popular' => 'enrollments_count',
                    'price_asc' => 'price',
                    'price_desc' => 'price',
                    default => 'created_at',
                },
                $this->sortBy === 'price_asc' ? 'asc' : 'desc'
            )
            ->paginate(12);

        return view('livewire.course-filter', compact('courses', 'categories'));
    }
}
