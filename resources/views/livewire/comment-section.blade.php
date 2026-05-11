<div>
    @if(session('success'))
        <div class="bg-green-50 text-green-700 text-sm p-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    @if($comments->isNotEmpty())
        <div class="space-y-4 mb-8">
            @foreach($comments as $comment)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <span>{{ $comment->user?->name ?? $comment->guest_name }}</span>
                        <span class="text-xs text-muted font-normal">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-700 mt-1">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-sm text-muted mb-6">No comments yet. Be the first to comment!</p>
    @endif

    <form wire:submit="submit" class="space-y-4">
        @if(!auth()->check())
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" wire:model="guestName" class="w-full rounded-lg border-gray-200 text-sm">
                    @error('guestName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" wire:model="guestEmail" class="w-full rounded-lg border-gray-200 text-sm">
                    @error('guestEmail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium mb-1">Comment</label>
            <textarea wire:model="body" rows="4" class="w-full rounded-lg border-gray-200 text-sm" placeholder="Write your comment..."></textarea>
            @error('body') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-6 py-2.5 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
            Submit Comment
        </button>
    </form>
</div>
