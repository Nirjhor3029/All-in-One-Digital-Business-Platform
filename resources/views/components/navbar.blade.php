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
                    <a href="{{ \Illuminate\Support\Facades\Route::has('services.index') ? route('services.index') : '#' }}"
                       class="text-sm transition font-medium {{ request()->routeIs('services*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Services
                    </a>
                    <a href="{{ \Illuminate\Support\Facades\Route::has('blog.index') ? route('blog.index') : '#' }}"
                       class="text-sm transition font-medium {{ request()->routeIs('blog*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Blog
                    </a>
                    <a href="{{ \Illuminate\Support\Facades\Route::has('shop.index') ? route('shop.index') : '#' }}"
                       class="text-sm transition font-medium {{ request()->routeIs('shop*') ? 'text-accent font-semibold' : 'text-primary/70 hover:text-accent' }}">
                        Shop
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                @auth
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
            <a href="{{ \Illuminate\Support\Facades\Route::has('services.index') ? route('services.index') : '#' }}"
               class="block py-2 text-sm text-primary/70 hover:text-accent">Services</a>
            <a href="{{ \Illuminate\Support\Facades\Route::has('blog.index') ? route('blog.index') : '#' }}"
               class="block py-2 text-sm text-primary/70 hover:text-accent">Blog</a>
            <a href="{{ \Illuminate\Support\Facades\Route::has('shop.index') ? route('shop.index') : '#' }}"
               class="block py-2 text-sm text-primary/70 hover:text-accent">Shop</a>
        </div>
    </div>
</nav>
