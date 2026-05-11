<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentSection extends Component
{
    public Post $post;
    public string $body = '';
    public string $guestName = '';
    public string $guestEmail = '';

    protected function rules(): array
    {
        if (auth()->check()) {
            return ['body' => 'required|min:2|max:2000'];
        }
        return [
            'body' => 'required|min:2|max:2000',
            'guestName' => 'required|min:2|max:100',
            'guestEmail' => 'required|email|max:255',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'guest_name' => auth()->check() ? null : $this->guestName,
            'guest_email' => auth()->check() ? null : $this->guestEmail,
            'body' => $this->body,
            'is_approved' => false,
        ]);

        $this->reset('body', 'guestName', 'guestEmail');

        session()->flash('success', 'Comment submitted for approval.');

        $this->dispatch('comment-submitted');
    }

    public function render()
    {
        $comments = $this->post->approvedComments()->with('user')->latest()->get();

        return view('livewire.comment-section', [
            'comments' => $comments,
        ]);
    }
}
