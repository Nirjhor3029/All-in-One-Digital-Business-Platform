<x-app-layout>
    <x-slot:title>My Wishlist - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-5xl mx-auto px-4">
        <h1 class="font-display text-3xl font-bold mb-8">My Wishlist</h1>

        @if($wishlists->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-500 mb-2">Your wishlist is empty</h2>
                <p class="text-muted mb-6">Start adding courses you're interested in.</p>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Browse Courses
                </a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($wishlists as $wish)
                    <div class="relative">
                        @if($wish->wishlistable)
                            <x-course-card :course="$wish->wishlistable" />
                            <form method="POST" action="{{ route('wishlist.toggle', ['course', $wish->wishlistable->id]) }}"
                                  class="absolute top-3 right-3 z-10">
                                @csrf
                                <button type="submit"
                                        class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow hover:bg-red-50 transition group"
                                        title="Remove from wishlist">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-app-layout>
