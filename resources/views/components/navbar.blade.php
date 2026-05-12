<nav x-data="{ mobileOpen: false, scrolled: {{ request()->routeIs('home') ? 'false' : 'true' }} }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm' : 'bg-transparent'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:h-20 items-center">
            <div class="flex items-center gap-10">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent to-indigo-700 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-display font-bold" :class="scrolled ? 'text-primary' : 'text-white'">
                        {{ config('app.name') }}
                    </span>
                </a>
                <div class="hidden lg:flex items-center gap-8">
                    @foreach([
                        ['label' => 'কোর্স', 'route' => 'courses.index', 'key' => 'courses*'],
                        ['label' => 'Services', 'route' => 'services.index', 'key' => 'services*'],
                        ['label' => 'Projects', 'route' => '#', 'key' => 'projects*'],
                        ['label' => 'Blog', 'route' => 'blog.index', 'key' => 'blog*'],
                        ['label' => 'About', 'route' => 'about', 'key' => 'about'],
                    ] as $link)
                    <a href="{{ $link['route'] }}"
                       class="text-sm transition font-medium"
                       :class="scrolled ? 'text-primary/70 hover:text-accent' : 'text-white/80 hover:text-white'">
                        {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-medium" :class="scrolled ? 'text-emerald-600' : 'text-emerald-300'">Live Support</span>
                </div>
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-medium px-4 py-2 rounded-btn transition"
                       :class="scrolled ? 'bg-accent text-white hover:bg-accent-hover' : 'bg-white/20 text-white hover:bg-white/30'">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline-flex text-sm font-medium transition px-4 py-2 rounded-btn"
                       :class="scrolled ? 'text-primary/70 hover:text-accent border border-gray-200 hover:border-accent' : 'text-white/80 hover:text-white border border-white/30 hover:border-white/60'">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-sm font-semibold px-5 py-2.5 rounded-btn transition"
                       :class="scrolled ? 'bg-accent text-white hover:bg-accent-hover' : 'bg-white text-primary hover:bg-gray-100'">
                        শুরু করুন
                    </a>
                @endauth
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2" :class="scrolled ? 'text-primary' : 'text-white'">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': mobileOpen, 'hidden': !mobileOpen}" class="lg:hidden border-t bg-white shadow-lg">
        <div class="px-4 py-3 space-y-1">
            @foreach([
                ['label' => 'কোর্স', 'route' => 'courses.index'],
                ['label' => 'Services', 'route' => 'services.index'],
                ['label' => 'Projects', 'route' => '#'],
                ['label' => 'Blog', 'route' => 'blog.index'],
                ['label' => 'About', 'route' => 'about'],
            ] as $link)
            <a href="{{ $link['route'] }}" class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">
                {{ $link['label'] }}
            </a>
            @endforeach
            @guest
                <hr class="my-2">
                <a href="{{ route('login') }}" class="block py-2.5 text-sm text-primary/70 hover:text-accent font-medium">Sign In</a>
                <a href="{{ route('register') }}" class="block py-2.5 text-sm text-accent font-semibold">শুরু করুন</a>
            @endguest
        </div>
    </div>
</nav>
