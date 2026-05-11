<nav x-data="{ mobileOpen: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-xl font-display font-bold text-primary">
                    {{ config('app.name') }}
                </a>
                <div class="hidden lg:flex items-center gap-6">
                    <a href="{{ route('courses.index') }}"
                       class="text-sm transition font-medium {{ request()->routeIs('courses*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Courses
                    </a>
                    <a href="{{ route('services.index') }}"
                       class="text-sm transition font-medium {{ request()->routeIs('services*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Services
                    </a>
                    <a href="{{ route('blog.index') }}"
                       class="text-sm transition font-medium {{ request()->routeIs('blog*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Blog
                    </a>
                    <a href="{{ \Illuminate\Support\Facades\Route::has('shop.index') ? route('shop.index') : '#' }}"
                       class="text-sm transition font-medium {{ request()->routeIs('shop*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Shop
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->withCount('items')->first()?->items_count ?? 0;
                        $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                    @endphp
                    <a href="{{ route('wishlist.index') }}"
                       class="hidden sm:inline-flex p-2 text-gray-500 hover:text-accent transition relative"
                       title="Wishlist">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        @if($wishlistCount > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $wishlistCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('cart.index') }}"
                       class="hidden sm:inline-flex p-2 text-gray-500 hover:text-accent transition relative"
                       title="Cart">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-accent text-white text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('courses.my-courses') }}"
                       class="hidden sm:inline-flex text-sm transition font-medium {{ request()->routeIs('courses.my-courses') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        My Courses
                    </a>
                    <a href="{{ route('services.my-services') }}"
                       class="hidden sm:inline-flex text-sm transition font-medium {{ request()->routeIs('services.my-services') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        My Services
                    </a>
                    <a href="{{ route('subscriptions.my-subscriptions') }}"
                       class="hidden sm:inline-flex text-sm transition font-medium {{ request()->routeIs('subscriptions.my-subscriptions') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Subscriptions
                    </a>
                    <a href="{{ route('orders.index') }}"
                       class="hidden sm:inline-flex text-sm text-gray-500 hover:text-accent transition font-medium">
                        Orders
                    </a>
                    <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-primary/70 hover:text-accent transition font-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                        Get Started
                    </a>
                @endauth
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': mobileOpen, 'hidden': !mobileOpen}" class="lg:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('courses.index') }}"
               class="block py-2 text-sm transition {{ request()->routeIs('courses*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                Courses
            </a>
            <a href="{{ route('services.index') }}"
               class="block py-2 text-sm transition {{ request()->routeIs('services*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">Services</a>
            <a href="{{ route('blog.index') }}"
               class="block py-2 text-sm transition {{ request()->routeIs('blog*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">Blog</a>
            <a href="{{ \Illuminate\Support\Facades\Route::has('shop.index') ? route('shop.index') : '#' }}"
               class="block py-2 text-sm text-primary/70 hover:text-accent">Shop</a>
        </div>
    </div>
</nav>
