<nav x-data="{ mobileOpen: false, scrolled: {{ request()->routeIs('home') ? 'false' : 'true' }} }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY >
    20)" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100' : 'bg-transparent'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:h-20 items-center">
            {{-- LEFT: Logo + Nav Links (always visible) --}}
            <div class="flex items-center gap-10">
                @php
                    $logo = \App\Models\Setting::get('site_logo');
                    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
                @endphp
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
                    @if ($logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="{{ $siteName }}"
                            class="h-10 w-auto">
                    @else
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent to-indigo-700 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                    {{-- <span class="text-lg font-display font-bold" :class="scrolled ? 'text-primary' : 'text-white'">
                        {{ $siteName }}
                    </span> --}}
                </a>
                <div class="hidden lg:flex items-center gap-8">
                    @foreach ([['label' => 'Courses', 'route' => 'courses.index', 'key' => 'courses*'], ['label' => 'Services', 'route' => 'services.index', 'key' => 'services*'], ['label' => 'Blog', 'route' => 'blog.index', 'key' => 'blog*'], ['label' => 'Shop', 'route' => '#', 'key' => 'shop*']] as $link)
                        <a href="{{ $link['route'] }}" class="text-sm transition font-medium"
                            :class="scrolled ? 'text-primary/70 hover:text-accent' : 'text-white/80 hover:text-white'">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Auth Toolbar or Guest Actions --}}
            @php
                $cartCount = auth()->check()
                    ? \App\Models\Cart::where('user_id', auth()->id())
                            ->withCount('items')
                            ->first()?->items_count ?? 0
                    : 0;
                $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
            @endphp
            <div class="flex items-center gap-2 lg:gap-3">
                @auth
                    @livewire('notification-bell')
                    <a href="{{ route('wishlist.index') }}"
                        class="hidden sm:inline-flex p-2 text-gray-500 hover:text-accent transition relative"
                        title="Wishlist">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        @if ($wishlistCount > 0)
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $wishlistCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('cart.index') }}"
                        class="hidden sm:inline-flex p-2 text-gray-500 hover:text-accent transition relative"
                        title="Cart">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-accent text-white text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-semibold px-4 py-2 bg-accent text-white rounded-btn hover:bg-accent-hover transition">
                        Dashboard
                    </a>
                @else
                    <div class="hidden sm:flex items-center gap-2 mr-2">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-medium" :class="scrolled ? 'text-emerald-600' : 'text-emerald-300'">Live
                            Support</span>
                    </div>
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex text-sm font-medium transition px-4 py-2 rounded-btn"
                        :class="scrolled ? 'text-primary/70 hover:text-accent border border-gray-200 hover:border-accent' :
                            'text-white/80 hover:text-white border border-white/30 hover:border-white/60'">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold px-5 py-2.5 rounded-btn transition"
                        :class="scrolled ? 'bg-accent text-white hover:bg-accent-hover' :
                            'bg-white text-primary hover:bg-gray-100'">
                        শুরু করুন
                    </a>
                @endauth
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2"
                    :class="scrolled || auth()->check() ? 'text-primary' : 'text-white'">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': mobileOpen, 'inline-flex': !mobileOpen }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !mobileOpen, 'inline-flex': mobileOpen }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{ 'block': mobileOpen, 'hidden': !mobileOpen }" class="lg:hidden border-t bg-white shadow-lg">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('courses.index') }}"
                class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Courses</a>
            <a href="{{ route('services.index') }}"
                class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Services</a>
            <a href="{{ route('blog.index') }}"
                class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Blog</a>
            <a href="#" class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Shop</a>
            <hr class="my-2">
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2.5 text-sm text-accent font-semibold">Dashboard</a>
                <a href="{{ route('wishlist.index') }}"
                    class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Wishlist @if ($wishlistCount > 0)
                        ({{ $wishlistCount }})
                    @endif
                </a>
                <a href="{{ route('cart.index') }}"
                    class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Cart @if ($cartCount > 0)
                        ({{ $cartCount }})
                    @endif
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Settings</a>
                <hr class="my-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left py-2.5 text-sm text-red-500 hover:text-red-600 font-medium">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Sign In</a>
                <a href="{{ route('register') }}" class="block py-2.5 text-sm text-accent font-semibold">শুরু করুন</a>
            @endauth
        </div>
    </div>
</nav>
