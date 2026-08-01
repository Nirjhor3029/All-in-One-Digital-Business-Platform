<nav x-data="{ mobileOpen: false }"
    class="fixed top-0 z-50 w-full max-w-container-max mx-auto left-1/2 -translate-x-1/2 bg-surface/80 backdrop-blur-md border-b border-surface-container flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4">
    {{-- LEFT: Logo (design text) --}}
    <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-bold text-primary whitespace-nowrap">আপনার
        Business</a>

    {{-- CENTER: Design menu --}}
    @php
        $navLinks = [
            ['label' => 'Home', 'href' => route('home'), 'active' => request()->routeIs('home')],
            ['label' => 'Services', 'href' => route('services.index'), 'active' => request()->routeIs('services*')],
            ['label' => 'Products', 'href' => url('/#products'), 'active' => false],
            ['label' => 'Courses', 'href' => route('courses.index'), 'active' => request()->routeIs('courses*')],
            ['label' => 'Success Stories', 'href' => url('/#stories'), 'active' => false],
            ['label' => 'About', 'href' => url('/about'), 'active' => request()->is('about')],
        ];
    @endphp
    <div class="hidden lg:flex items-center gap-8">
        @foreach ($navLinks as $link)
            <a href="{{ $link['href'] }}"
                class="font-body-md text-body-md transition-colors {{ $link['active'] ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-secondary hover:text-primary' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>

    {{-- RIGHT: Auth toolbar or guest actions --}}
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
                class="hidden sm:inline-flex p-2 text-primary hover:opacity-70 transition relative"
                title="Wishlist">
                <span class="material-symbols-outlined text-[22px]">favorite</span>
                @if ($wishlistCount > 0)
                    <span
                        class="absolute -top-0.5 -right-0.5 bg-primary text-on-primary text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $wishlistCount }}</span>
                @endif
            </a>
            <a href="{{ route('cart.index') }}"
                class="hidden sm:inline-flex p-2 text-primary hover:opacity-70 transition relative"
                title="Cart">
                <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                @if ($cartCount > 0)
                    <span
                        class="absolute -top-0.5 -right-0.5 bg-primary text-on-primary text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">{{ $cartCount }}</span>
                @endif
            </a>

            <a href="{{ route('dashboard') }}"
                class="hidden md:inline-flex font-label-sm text-label-sm uppercase tracking-wider text-on-primary bg-primary px-6 py-2 hover:opacity-90 transition active:scale-95">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="hidden sm:inline-flex font-label-sm text-label-sm uppercase tracking-wider text-primary border border-primary px-6 py-2 hover:bg-surface-container transition active:scale-95">
                Sign In
            </a>
            <a href="{{ route('register') }}"
                class="hidden sm:inline-flex font-label-sm text-label-sm uppercase tracking-wider text-on-primary bg-primary px-6 py-2 hover:opacity-90 transition active:scale-95">
                শুরু করুন
            </a>
            <a href="{{ url('/contact') }}"
                class="hidden sm:inline-flex font-label-sm text-label-sm uppercase tracking-wider text-on-primary bg-primary px-6 py-2 hover:opacity-90 transition active:scale-95">
                Contact
            </a>
        @endauth
        <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-primary">
            <span class="material-symbols-outlined" :class="{ 'hidden': mobileOpen, 'inline-flex': !mobileOpen }">menu</span>
            <span class="material-symbols-outlined hidden" :class="{ 'hidden': !mobileOpen, 'inline-flex': mobileOpen }">close</span>
        </button>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{ 'block': mobileOpen, 'hidden': !mobileOpen }"
        class="lg:hidden border-t border-surface-container bg-surface shadow-sm">
        <div class="px-margin-mobile py-4 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}"
                    class="block py-2.5 font-body-md text-body-md {{ $link['active'] ? 'text-primary font-semibold' : 'text-secondary' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <hr class="my-2 border-surface-container">
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2.5 text-sm text-primary font-semibold">Dashboard</a>
                <a href="{{ route('wishlist.index') }}"
                    class="block py-2.5 text-sm text-secondary">Wishlist @if ($wishlistCount > 0)
                        ({{ $wishlistCount }})
                    @endif
                </a>
                <a href="{{ route('cart.index') }}"
                    class="block py-2.5 text-sm text-secondary">Cart @if ($cartCount > 0)
                        ({{ $cartCount }})
                    @endif
                </a>
                <a href="{{ route('profile.edit') }}" class="block py-2.5 text-sm text-secondary">Settings</a>
                <hr class="my-2 border-surface-container">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left py-2.5 text-sm text-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2.5 text-sm text-secondary">Sign In</a>
                <a href="{{ route('register') }}" class="block py-2.5 text-sm text-primary font-semibold">শুরু করুন</a>
                <a href="{{ url('/contact') }}" class="block py-2.5 text-sm text-secondary">Contact</a>
            @endauth
        </div>
    </div>
</nav>
