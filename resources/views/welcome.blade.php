<x-app-layout>
    {{-- HERO --}}
    <section class="min-h-[90vh] bg-primary relative overflow-hidden flex items-center">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-1/4 w-96 h-96 bg-accent/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-1/4 w-80 h-80 bg-indigo-800/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 py-20 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <span class="inline-flex items-center gap-2 bg-accent/20 text-accent-light border border-accent/30 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                    All-in-One Platform
                </span>
                <h1 class="font-display text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    Learn.<br>Build.<br>
                    <span class="text-accent">Grow.</span>
                </h1>
                <p class="text-white/70 text-lg leading-relaxed mb-8">
                    The first platform in Bangladesh where you get premium courses, ready-made software, and expert support all in one place.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-accent hover:bg-accent-hover text-white rounded-btn font-semibold transition">
                        Get Started
                    </a>
                    <a href="#" class="px-6 py-3 border border-white/30 hover:bg-white/10 text-white rounded-btn font-semibold transition">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="aspect-video rounded-2xl bg-gradient-to-br from-accent/30 to-indigo-900/50 shadow-2xl w-full flex items-center justify-center">
                        <span class="text-white/40 text-lg">Platform Dashboard</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <section class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                @foreach([
                    ['value' => '50+', 'label' => 'Courses', 'icon' => '🎓'],
                    ['value' => '1000+', 'label' => 'Students', 'icon' => '👥'],
                    ['value' => '30+', 'label' => 'Products', 'icon' => '🛠️'],
                    ['value' => '4.9/5', 'label' => 'Rating', 'icon' => '⭐'],
                ] as $stat)
                <div>
                    <div class="text-2xl font-bold text-primary">{{ $stat['icon'] }} {{ $stat['value'] }}</div>
                    <div class="text-sm text-muted mt-1">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="py-20 max-w-7xl mx-auto px-4">
        <h2 class="font-display text-3xl font-bold text-center mb-12">How It Works</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['step' => '01', 'icon' => '🔍', 'title' => 'Choose', 'desc' => 'Select a course or software service that fits your needs'],
                ['step' => '02', 'icon' => '💳', 'title' => 'Payment', 'desc' => 'Secure payment via SSLCommerz, bKash, Nagad or Card'],
                ['step' => '03', 'icon' => '🚀', 'title' => 'Start', 'desc' => 'Instant access, manage everything from your dashboard'],
            ] as $step)
            <div class="text-center">
                <div class="w-24 h-24 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-4xl">{{ $step['icon'] }}</span>
                </div>
                <div class="text-xs text-accent font-bold tracking-widest mb-2">STEP {{ $step['step'] }}</div>
                <h3 class="font-semibold text-xl mb-2">{{ $step['title'] }}</h3>
                <p class="text-muted text-sm">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA BANNER --}}
    <section class="bg-gradient-to-r from-accent to-indigo-700 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center text-white">
            <h2 class="font-display text-3xl lg:text-4xl font-bold mb-4">Start Today</h2>
            <p class="text-white/80 text-lg mb-8">Special discount for the first month — limited time offer</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-accent font-bold rounded-btn hover:bg-gray-100 transition">
                    Register Now
                </a>
                <a href="#" class="px-8 py-3 border border-white/50 text-white font-bold rounded-btn hover:bg-white/10 transition">
                    Watch Demo
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
