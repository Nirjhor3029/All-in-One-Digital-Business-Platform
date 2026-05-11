<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class BlogSearch extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $results = collect();

        if (strlen($this->search) >= 2) {
            $results = Post::with('category')
                ->published()
                ->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                      ->orWhere('excerpt', 'like', "%{$this->search}%");
                })
                ->latest('published_at')
                ->take(5)
                ->get();
        }

        return view('livewire.blog-search', compact('results'));
    }
}
