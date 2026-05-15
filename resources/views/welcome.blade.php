<x-app-layout>
    @push('styles')
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 5s ease-in-out infinite 1s; }
        .animate-float-slow { animation: float-slow 6s ease-in-out infinite 0.5s; }
        .animate-count {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush

    {{-- ===================== HERO ===================== --}}
    <section class="relative min-h-screen bg-gradient-to-br from-primary via-primary to-indigo-950 overflow-hidden flex items-center pt-20 lg:pt-24">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-accent/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 w-[600px] h-[600px] bg-indigo-500/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-indigo-400/10 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 bg-accent/20 text-accent-light border border-accent/30 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                        {{ $settings['hero_badge'] ?? "Bangladesh's All-in-One Platform" }}
                    </span>
                    <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold leading-[1.1] text-white mb-6" style="line-height: 1.4">
                        <span class="mb-2">{{ $settings['hero_headline_line1'] ?? 'শিখুন।' }}</span><br>
                        <span class="text-accent">{{ $settings['hero_headline_line2'] ?? 'বানান।' }}</span><br>
                        <span>{{ $settings['hero_headline_line3'] ?? 'বাড়ান।' }}</span>
                    </h1>
                    <p class="text-white/60 text-lg leading-relaxed max-w-lg mb-8">
                        {{ $settings['hero_subtitle'] ?? "Bangladesh's first platform where you get premium courses, ready-made SaaS products, and expert support — all in one place." }}
                    </p>
                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="{{ $settings['hero_cta_url'] ?? route('courses.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-accent hover:bg-accent-hover text-white rounded-btn font-semibold transition shadow-lg shadow-accent/30">
                            {{ $settings['hero_cta_text'] ?? 'কোর্স দেখুন' }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="#"
                           class="inline-flex items-center gap-2 px-6 py-3 border border-white/30 hover:bg-white/10 text-white rounded-btn font-semibold transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $settings['hero_demo_text'] ?? 'Demo দেখুন' }}
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-3">
                            @foreach(['https://ui-avatars.com/api/?name=RA&background=6366F1&color=fff&size=40','https://ui-avatars.com/api/?name=SK&background=10B981&color=fff&size=40','https://ui-avatars.com/api/?name=MT&background=F59E0B&color=fff&size=40','https://ui-avatars.com/api/?name=NH&background=EF4444&color=fff&size=40','https://ui-avatars.com/api/?name=+&background=8B5CF6&color=fff&size=40'] as $avatar)
                            <img src="{{ $avatar }}" alt="" class="w-10 h-10 rounded-full border-2 border-white">
                            @endforeach
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">{{ $settings['hero_social_proof'] ?? '2,450+ জন শিখছেন' }}</p>
                            <div class="flex items-center gap-1 text-amber-400 text-xs">
                                <span class="text-white/70">★★★★★</span>
                                <span class="text-white/80 ml-1">{{ $settings['hero_rating_text'] ?? '4.9/5' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <div class="relative w-full max-w-lg mx-auto">
                        <div class="bg-white rounded-2xl shadow-2xl p-6 animate-float">
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Dashboard Overview</span>
                                <span class="text-xs text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full font-medium">● Live</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-xs text-gray-400 mb-1">Total Revenue</p>
                                    <p class="text-2xl font-bold text-primary">৳45,500</p>
                                    <span class="text-xs text-emerald-600 font-medium">↑ +12.5%</span>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-xs text-gray-400 mb-1">Enrollments</p>
                                    <p class="text-2xl font-bold text-primary">1,240</p>
                                    <span class="text-xs text-emerald-600 font-medium">↑ +8.3%</span>
                                </div>
                            </div>
                            <div class="h-20 bg-gray-50 rounded-xl p-4 flex items-end">
                                <div class="w-full flex items-end gap-1.5">
                                    @foreach([40,65,45,80,55,70,90] as $h)
                                    <div class="flex-1 bg-gradient-to-t from-accent to-accent/40 rounded-t" style="height: {{ $h }}%"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex justify-between mt-3 text-[10px] text-gray-400">
                                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                            </div>
                        </div>
                        <div class="absolute -top-4 -right-4 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 shadow-lg animate-float-delayed" style="animation-delay: 0.5s">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm font-medium text-emerald-800">✓ Payment সফল!</span>
                            </div>
                        </div>
                        <div class="absolute -bottom-3 left-8 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 shadow-lg animate-float-slow" style="animation-delay: 0.3s">
                            <span class="text-sm font-medium text-amber-800">+12 আজকে</span>
                        </div>
                        <div class="absolute top-1/3 -left-12 bg-indigo-50 border border-indigo-200 rounded-xl px-4 py-3 shadow-lg animate-float" style="animation-delay: 1s">
                            <span class="text-sm font-medium text-indigo-800">48 Active SaaS Clients</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== STATS BAR ===================== --}}
    <section class="bg-gray-50 py-10 lg:py-14 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($stats as $stat)
                <div class="text-center group">
                    <div class="text-3xl mb-2 group-hover:scale-110 transition-transform duration-300 inline-block">{{ $stat['icon'] }}</div>
                    <div class="text-3xl lg:text-4xl font-bold text-primary">{{ $stat['value'] }}</div>
                    <div class="text-sm text-muted mt-1">{{ $stat['label'] }}</div>
                    <div class="text-xs text-gray-400">{{ $stat['sub'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== FEATURED COURSES ===================== --}}
    @if($courses->isNotEmpty())
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">LMS Platform</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">জনপ্রিয় কোর্সসমূহ</h2>
                <p class="text-muted mt-3 max-w-lg mx-auto">Expert-led courses designed to take your skills to the next level</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($courses as $course)
                <div class="group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="h-44 bg-gradient-to-br from-accent/20 via-accent/10 to-indigo-100 relative overflow-hidden">
                        @if(in_array($loop->index, [0,1,2]))
                            @php $badges = ['Bestseller', 'New', 'Popular']; $colors = ['bg-amber-500', 'bg-emerald-500', 'bg-accent']; @endphp
                            <span class="absolute top-3 left-3 {{ $colors[$loop->index] }} text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider z-10">{{ $badges[$loop->index] }}</span>
                        @endif
                        @php $levels = ['Beginner' => 'bg-emerald-100 text-emerald-700', 'Intermediate' => 'bg-amber-100 text-amber-700', 'Advanced' => 'bg-red-100 text-red-700']; @endphp
                        <span class="absolute top-3 right-3 text-[10px] font-semibold px-2.5 py-1 rounded-full {{ $levels[$course->level] ?? 'bg-gray-100 text-gray-600' }}">{{ $course->level ?? 'All Levels' }}</span>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-accent/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="p-5">
                        @if($course->category)
                        <span class="text-[11px] font-semibold text-accent uppercase tracking-wider">{{ $course->category->name }}</span>
                        @endif
                        <h3 class="font-semibold text-base mt-1.5 leading-snug line-clamp-2">{{ $course->title }}</h3>
                        <p class="text-sm text-muted mt-1">{{ $course->instructor?->name }}</p>
                        <div class="flex items-center gap-3 mt-3 text-xs text-muted">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span>4.8</span>
                            </div>
                            <span>({{ $course->enrollments_count ?? 0 }})</span>
                        </div>
                        <div class="flex items-center gap-3 mt-3 text-xs text-muted">
                            <span>{{ $course->sections->sum(fn($s) => $s->lectures->count()) }} lectures</span>
                            <span>•</span>
                            <span>{{ $course->duration_formatted }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                            <div>
                                <span class="text-lg font-bold text-primary">৳{{ $course->current_price }}</span>
                                @if($course->discount_price && $course->discount_price < $course->price)
                                <span class="text-xs text-muted line-through ml-2">৳{{ number_format($course->price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('courses.show', $course->slug) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-accent/10 text-accent text-sm font-semibold rounded-btn hover:bg-accent hover:text-white transition">
                                কিনুন
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-gray-200 text-primary font-semibold rounded-btn hover:border-accent hover:text-accent transition">
                    সব কোর্স দেখুন
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================== SOFTWARE SERVICES ===================== --}}
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">Software Marketplace</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">আমাদের Software Solutions</h2>
                <p class="text-muted mt-3 max-w-lg mx-auto">Ready-made enterprise software for your business needs</p>
            </div>
            @if($services->isNotEmpty())
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services as $service)
                <div class="group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center mb-4 group-hover:bg-accent group-hover:text-white transition">
                        <svg class="w-5 h-5 text-accent group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-accent/10 text-accent uppercase tracking-wider">SaaS</span>
                    <h3 class="font-semibold text-base mt-2">{{ $service->title }}</h3>
                    <p class="text-sm text-muted mt-1.5 line-clamp-2">{{ $service->short_description ?? $service->title }}</p>
                    @if($service->plans->isNotEmpty())
                    <p class="text-accent font-bold text-lg mt-4">৳{{ number_format($service->plans->min('price'), 0) }}/মাস</p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4', 'title' => 'Coaching Management', 'desc' => 'Complete coaching center management with student, teacher & payment tracking.', 'price' => '3,000'],
                    ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'title' => 'School ERP', 'desc' => 'Comprehensive school management system with attendance, fees & results.', 'price' => '5,000'],
                    ['icon' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', 'title' => 'SMS Automation', 'desc' => 'Bulk SMS marketing & notification system with advanced scheduling.', 'price' => '1,500'],
                    ['icon' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2', 'title' => 'Inventory ERP', 'desc' => 'Inventory & warehouse management with barcode scanning & reporting.', 'price' => '4,000'],
                ] as $item)
                <div class="group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center mb-4 group-hover:bg-accent group-hover:text-white transition">
                        <svg class="w-5 h-5 text-accent group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-accent/10 text-accent uppercase tracking-wider">SaaS</span>
                    <h3 class="font-semibold text-base mt-2">{{ $item['title'] }}</h3>
                    <p class="text-sm text-muted mt-1.5 line-clamp-2">{{ $item['desc'] }}</p>
                    <p class="text-accent font-bold text-lg mt-4">৳ {{ $item['price'] }}/মাস</p>
                </div>
                @endforeach
            </div>
            @endif
            <div class="text-center mt-10">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-gray-200 text-primary font-semibold rounded-btn hover:border-accent hover:text-accent transition">
                    সব Services দেখুন
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===================== PROJECT SHOWCASE ===================== --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">Portfolio</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">Project Showcase</h2>
                <p class="text-muted mt-3 max-w-lg mx-auto">Real projects built with our platform and technologies</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-6 lg:gap-8">
                @forelse($projects as $project)
                <div class="group bg-white rounded-2xl border border-gray-100 hover:border-gray-200 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl relative">
                    <div style="height: 7px; background: {{ $project->color }}" class="w-full"></div>
                    <div class="p-6">
                        <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: {{ $project->color }}15">
                                <svg class="w-5 h-5" style="color: {{ $project->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $project->icon_path }}"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-lg">{{ $project->title }}</h3>
                        </div>
                        <p class="text-sm text-muted leading-relaxed">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach($project->tech_stack as $tech)
                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-600">{{ is_array($tech) ? ($tech['tech'] ?? $tech) : $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-12 text-muted">
                    <p>No projects to show yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===================== BLOG HIGHLIGHTS ===================== --}}
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">Blog & Tutorials</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">সাম্প্রতিক লেখালেখি</h2>
                <p class="text-muted mt-3 max-w-lg mx-auto">Tips, tutorials, and insights from our experts</p>
            </div>
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
                @if($featuredPost)
                <div class="lg:col-span-2 group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="h-56 bg-gradient-to-br from-accent/20 via-accent/10 to-indigo-100 relative">
                        <span class="absolute top-4 left-4 text-[10px] font-bold px-3 py-1.5 rounded-full bg-white/90 text-accent uppercase tracking-wider">
                            {{ $featuredPost->category?->name ?? 'Featured' }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-xl leading-snug">{{ $featuredPost->title }}</h3>
                        <p class="text-sm text-muted mt-2 line-clamp-2">{{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}</p>
                        <div class="flex items-center gap-4 mt-4 text-xs text-muted">
                            <span>{{ $featuredPost->author?->name }}</span>
                            <span>•</span>
                            <span>{{ $featuredPost->published_at?->format('M d, Y') ?? $featuredPost->created_at->format('M d, Y') }}</span>
                            <span>•</span>
                            <span>5 min read</span>
                            <span>•</span>
                            <span>142 views</span>
                        </div>
                    </div>
                </div>
                @endif
                <div class="space-y-6">
                    @if($recentPosts->isNotEmpty())
                        @foreach($recentPosts as $post)
                        <div class="group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-accent/10 text-accent uppercase tracking-wider">{{ $post->category?->name ?? 'Article' }}</span>
                            <h3 class="font-semibold text-base mt-2 leading-snug">{{ $post->title }}</h3>
                            <p class="text-xs text-muted mt-2 line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}</p>
                            <div class="flex items-center gap-3 mt-3 text-xs text-muted">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>3 min read</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        @foreach([
                            ['title' => 'How to Build a SaaS Platform with Laravel', 'cat' => 'Tutorial', 'date' => 'May 10, 2026'],
                            ['title' => 'Top 10 Features of a Modern LMS', 'cat' => 'Insights', 'date' => 'May 8, 2026'],
                        ] as $post)
                        <div class="group bg-white rounded-2xl border border-gray-100 hover:border-accent/30 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-accent/10 text-accent uppercase tracking-wider">{{ $post['cat'] }}</span>
                            <h3 class="font-semibold text-base mt-2 leading-snug">{{ $post['title'] }}</h3>
                            <p class="text-xs text-muted mt-2">Expert tips and best practices for building and scaling your platform.</p>
                            <div class="flex items-center gap-3 mt-3 text-xs text-muted">
                                <span>{{ $post['date'] }}</span>
                                <span>•</span>
                                <span>3 min read</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-gray-200 text-primary font-semibold rounded-btn hover:border-accent hover:text-accent transition">
                    সব লেখা পড়ুন
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===================== TESTIMONIALS ===================== --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">Client Feedback</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">তারা কী বলছেন?</h2>
            </div>
            <div class="max-w-2xl mx-auto" x-data="testimonialSlider()" x-init="init()">
                <template x-for="(t, i) in testimonials" :key="i">
                    <div x-show="current === i" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="text-center">
                        <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center text-white font-bold text-xl" :style="'background: ' + t.color">
                            <span x-text="t.initials"></span>
                        </div>
                        <div class="flex items-center justify-center gap-1 text-amber-400 mb-4">
                            <template x-for="s in 5"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg></template>
                        </div>
                        <blockquote class="text-lg text-gray-600 italic leading-relaxed max-w-lg mx-auto mb-6">
                            "<span x-text="t.quote"></span>"
                        </blockquote>
                        <p class="font-semibold text-primary" x-text="t.name"></p>
                        <p class="text-sm text-muted" x-text="t.role"></p>
                        <span class="inline-block text-[10px] font-bold px-3 py-1 rounded-full mt-3" :class="t.badgeClass" x-text="t.badge"></span>
                    </div>
                </template>
                <div class="mt-8 flex flex-col items-center gap-3">
                    <div class="w-48 h-1 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-accent rounded-full transition-all duration-500" :style="'width: ' + ((current + 1) / testimonials.length * 100) + '%'"></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-for="(t, i) in testimonials" :key="i">
                            <button @click="current = i" class="w-2.5 h-2.5 rounded-full transition-all duration-300" :class="current === i ? 'bg-accent w-6' : 'bg-gray-300 hover:bg-gray-400'"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function testimonialSlider() {
            return {
                current: 0,
                testimonials: [
                    { initials: 'RA', color: '#6366F1', quote: 'Apnar Business has completely transformed how we run our coaching center. The LMS platform with student management and payment tracking is exactly what we needed. Highly recommended!', name: 'রফিকুল আলম', role: 'Director, EduCare Coaching', badge: 'Coaching Management', badgeClass: 'bg-accent/10 text-accent' },
                    { initials: 'SK', color: '#10B981', quote: 'We deployed the School ERP across our campus and the results were immediate. Attendance tracking, fee collection, and parent communication — all in one dashboard.', name: 'Shahina Khanam', role: 'Principal, Sunshine Academy', badge: 'School ERP', badgeClass: 'bg-emerald-100 text-emerald-700' },
                    { initials: 'MT', color: '#F59E0B', quote: 'The SMS Automation service saved us thousands in marketing costs. The scheduling and bulk messaging features are incredibly powerful yet easy to use.', name: 'Md. Tariqul Islam', role: 'CEO, TechMart BD', badge: 'SMS Automation', badgeClass: 'bg-amber-100 text-amber-700' },
                ],
                init() {
                    setInterval(() => {
                        this.current = (this.current + 1) % this.testimonials.length;
                    }, 5000);
                }
            }
        }
    </script>
    @endpush

    {{-- ===================== HOW IT WORKS ===================== --}}
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-accent font-semibold">How It Works</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mt-3">শুধু ৩টি ধাপ</h2>
                <p class="text-muted mt-3 max-w-lg mx-auto">Getting started with Apnar Business is quick and easy</p>
            </div>
            <div class="relative grid md:grid-cols-3 gap-8 lg:gap-12">
                <div class="hidden md:block absolute top-16 left-[16%] right-[16%] h-px border-t-2 border-dashed border-gray-200"></div>
                @foreach([
                    ['num' => '01', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'color' => 'from-accent to-indigo-700', 'title' => 'বেছে নিন', 'desc' => 'Browse our courses and SaaS products. Find the perfect fit for your learning or business needs.'],
                    ['num' => '02', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'from-emerald-500 to-emerald-700', 'title' => 'Payment করুন', 'desc' => 'Secure payment via SSLCommerz, bKash, Nagad, or Card. Instant access upon confirmation.'],
                    ['num' => '03', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'from-amber-500 to-amber-700', 'title' => 'শুরু করুন', 'desc' => 'Start learning or using your software. Access everything from your personalized dashboard.'],
                ] as $step)
                <div class="relative text-center group">
                    <div class="relative z-10 w-20 h-20 rounded-2xl bg-gradient-to-br {{ $step['color'] }} flex items-center justify-center mx-auto mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="text-[11px] text-accent font-bold tracking-[0.2em] mb-2">STEP {{ $step['num'] }}</div>
                    <h3 class="font-semibold text-xl mb-2">{{ $step['title'] }}</h3>
                    <p class="text-sm text-muted max-w-xs mx-auto">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== CTA BANNER ===================== --}}
    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white rounded-3xl border-2 border-accent/20 p-8 lg:p-12 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-accent/[0.02] to-transparent pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl lg:text-4xl font-bold text-primary mb-4">আজই শুরু করুন</h2>
                    <p class="text-muted text-lg max-w-lg mx-auto mb-8">
                        Join {{ $settings['hero_social_proof'] ?? '2,450+ learners' }} and business owners already growing with us. 
                        <span class="text-accent font-semibold">Special discount available for first month!</span>
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-8 py-3.5 bg-accent hover:bg-accent-hover text-white font-bold rounded-btn transition shadow-lg shadow-accent/30">
                            Register করুন — বিনামূল্যে
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#"
                           class="inline-flex items-center gap-2 px-8 py-3.5 border border-gray-200 text-primary font-bold rounded-btn hover:border-accent hover:text-accent transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Demo দেখুন
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center justify-center gap-6 mt-8 text-xs text-gray-400">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            SSL Secured
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            30-day Refund
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            24/7 Support
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
