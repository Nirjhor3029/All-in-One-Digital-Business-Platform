<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
            ->withCount('approvedComments')
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $featured = Post::with(['author', 'category'])
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::where('type', 'blog')
            ->where('is_active', true)
            ->withCount(['posts' => fn ($q) => $q->published()])
            ->get();

        $tags = Tag::withCount(['posts' => fn ($q) => $q->published()])
            ->orderByDesc('posts_count')
            ->take(15)
            ->get();

        return view('blog.index', compact('posts', 'featured', 'categories', 'tags'));
    }

    public function category(Category $category)
    {
        $posts = Post::with(['author', 'tags'])
            ->withCount('approvedComments')
            ->published()
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'))->with('category', $category);
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['author', 'category'])
            ->withCount('approvedComments')
            ->published()
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'))->with('tag', $tag);
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $post->load(['author', 'category', 'tags', 'approvedComments.user', 'approvedComments' => fn ($q) => $q->latest()]);

        $related = Post::with('category')
            ->published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
