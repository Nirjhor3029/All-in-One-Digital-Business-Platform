<x-app-layout>
    {{-- ===================== SPLIT HERO ===================== --}}
    <section
        class="min-h-screen flex flex-col items-center justify-center px-margin-mobile md:px-margin-desktop py-32 md:py-48 relative overflow-hidden bg-surface">
        <div class="max-w-container-max mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-left">
                @if($settings['hero_badge'] ?? false)
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-4 block">{{ $settings['hero_badge'] }}</span>
                @endif
                <h1
                    class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl mb-8 leading-tight text-primary">
                    {{ $settings['hero_headline'] ?? 'আপনার ব্যবসা শুরু থেকে Scale পর্যন্ত।' }}
                </h1>
                <p class="font-body-lg text-body-lg text-secondary max-w-xl mb-12 leading-relaxed">{{ $settings['hero_subtitle'] ?? 'We help businesses launch, automate and grow with technology. Experience precision engineering for the modern entrepreneur.' }}</p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="{{ $settings['hero_cta_url'] ?? '/courses' }}"
                        class="bg-primary text-on-primary px-10 py-5 font-label-sm text-label-sm tracking-widest uppercase transition-all hover:opacity-90 active:scale-95 text-center">{{ $settings['hero_cta_text'] ?? 'Start Your Business' }}</a>
                    <a href="{{ $settings['hero_demo_url'] ?? '/contact' }}"
                        class="border border-primary text-primary px-10 py-5 font-label-sm text-label-sm tracking-widest uppercase transition-all hover:bg-surface-container active:scale-95 text-center">{{ $settings['hero_demo_text'] ?? 'Book Consultation' }}</a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="aspect-video w-full flex items-center justify-center">
                    @if($settings['hero_image'] ?? false)
                        <img alt="Hero illustration"
                            src="{{ asset('storage/' . $settings['hero_image']) }}" class="w-full h-auto object-contain opacity-90">
                    @else
                        <img alt="Abstract line graphic illustrating business growth"
                            src="{{ asset('img/hero-graphic.png') }}" class="w-full h-auto object-contain opacity-90">
                    @endif
                </div>
            </div>
        </div>
        <div class="absolute top-1/2 right-0 -translate-y-1/2 w-1/2 h-full opacity-[0.03] pointer-events-none lg:hidden">
            @if($settings['hero_bg_image'] ?? false)
                <img alt="" src="{{ asset('storage/' . $settings['hero_bg_image']) }}" class="w-full h-full object-cover">
            @else
                <img alt="" src="{{ asset('img/hero-graphic.png') }}" class="w-full h-full object-cover">
            @endif
        </div>
    </section>

    {{-- ===================== BUSINESS JOURNEY (7 STEPS) ===================== --}}
    <section class="bg-surface-container-low py-section-gap px-margin-mobile md:px-margin-desktop overflow-hidden">
        <div class="max-w-container-max mx-auto text-center mb-16">
            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-4 block">The
                Process</span>
            <h2 class="font-headline-lg text-headline-lg text-primary">Your Roadmap to Dominance</h2>
        </div>
        <div
            class="relative max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center journey-line gap-12 md:gap-4">
            @foreach ($journey_steps as $step)
            <div class="relative z-10 flex flex-col items-center text-center bg-surface-container-low px-4">
                <div
                    class="w-12 h-12 rounded-full border border-primary flex items-center justify-center bg-surface mb-4">
                    <span class="material-symbols-outlined text-primary">{{ $step['icon'] }}</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-2">{{ $step['label'] }}</h3>
            </div>
            @endforeach
        </div>
    </section>


    {{-- ===================== CORE SERVICES GRID ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop" id="services">
        <div class="max-w-container-max mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16">
                <div class="max-w-xl">
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-4 block">Core
                        Services</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary">End-to-End Solutions for Modern
                        Enterprise</h2>
                </div>
                <p class="font-body-md text-body-md text-secondary max-w-sm">Tailored technological interventions
                    designed to remove friction and amplify your output.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($core_services as $serviceCard)
                <div
                    class="bg-surface border border-surface-container p-8 hover:border-primary transition-all duration-300 group flex flex-col">
                    <span class="material-symbols-outlined text-4xl mb-6 text-primary"
                        style="font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 48;">{{ $serviceCard['icon'] }}</span>
                    <h3 class="font-headline-md text-headline-md mb-3">{{ $serviceCard['title'] }}</h3>
                    <p class="font-body-md text-body-md text-secondary mb-6">{{ $serviceCard['description'] }}</p>
                    <a href="{{ route('services.index') }}"
                        class="mt-auto font-label-sm text-label-sm text-primary flex items-center gap-2 group-hover:gap-4 transition-all uppercase tracking-widest">LEARN
                        MORE <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== FEATURED SAAS PRODUCTS ===================== --}}
    <section class="py-section-gap bg-primary text-on-primary px-margin-mobile md:px-margin-desktop" id="products">
        <div class="max-w-container-max mx-auto">
            <div class="text-center mb-16">
                <span
                    class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-widest mb-4 block">Proprietary
                    Solutions</span>
                <h2 class="font-headline-lg text-headline-lg text-white">Scale Effortlessly with Our SaaS Products</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    @foreach ($saas_products as $i => $product)
                    <div class="border-b border-on-tertiary-container/30 pb-8 cursor-pointer group">
                        <h3
                            class="font-headline-md text-headline-md mb-2 {{ $i === 0 ? 'text-white' : 'text-on-tertiary-container group-hover:text-white transition-colors' }}">
                            {{ $product['title'] }}
                        </h3>
                        <p class="font-body-md text-body-md text-on-tertiary-container {{ $i === 0 ? '' : 'opacity-60' }}">{{ $product['description'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div
                    class="relative aspect-video bg-white/5 border border-white/10 rounded-lg overflow-hidden flex items-center justify-center p-8">
                    <img class="w-full h-full object-cover rounded" src="{{ asset('img/dashboard-mock.jpg') }}"
                        alt="SaaS dashboard interface preview">
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== BUSINESS COURSES ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop bg-surface-container-lowest" id="courses">
        <div class="max-w-container-max mx-auto">
            <div class="max-w-xl mb-16">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Expertise, shared.</h2>
                <p class="font-body-md text-body-md text-secondary">Our courses are built from real-world battle scars.
                    No fluff, just the systems and frameworks needed to win.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($business_courses as $course)
                <div class="flex flex-col">
                    <a href="{{ route('courses.index') }}"
                        class="aspect-[4/3] bg-surface-container mb-6 overflow-hidden block">
                        @if($course['image'] ?? false)
                            <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                src="{{ asset('storage/courses/' . $course['image']) }}" alt="{{ $course['title'] }}">
                        @else
                            <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                src="{{ asset('img/' . $course['image']) }}" alt="{{ $course['title'] }}">
                        @endif
                    </a>
                    <h4 class="font-headline-md text-headline-md text-primary mb-2">{{ $course['title'] }}</h4>
                    <p class="font-body-md text-body-md text-secondary mb-4">{{ $course['description'] }}</p>
                    <div class="mt-auto pt-4 border-t border-surface-container flex justify-between items-center">
                        <span class="font-label-sm text-label-sm text-primary">{{ $course['modules'] }} MODULES</span>
                        <span class="font-label-sm text-label-sm text-primary font-bold">৳ {{ $course['price'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== WHY "আপনার Business"? ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop">
        <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-8">Why "আপনার Business"?</h2>
                <div class="space-y-12">
                    @foreach ($why_points as $point)
                    <div class="flex gap-6">
                        <div
                            class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary text-on-primary font-bold">{{ $point['number'] }}</div>
                        <div>
                            <h4 class="font-headline-md text-headline-md text-primary mb-2">{{ $point['title'] }}</h4>
                            <p class="font-body-md text-body-md text-secondary">{{ $point['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square bg-surface-container overflow-hidden rounded-lg">
                    <img class="w-full h-full object-cover grayscale"
                        src="{{ asset('img/team-collab.jpg') }}" alt="Our team collaborating in the studio">
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== SUCCESS STORIES ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop bg-surface-container" id="stories">
        <div class="max-w-container-max mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-primary">Real Results. Real Growth.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach ($success_stories as $story)
                <div
                    class="bg-surface p-12 flex flex-col md:flex-row gap-8 items-center border border-outline-variant">
                    <div
                        class="w-24 h-24 shrink-0 rounded-full bg-surface-container-highest flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-primary">{{ $story['icon'] }}</span>
                    </div>
                    <div>
                        <p class="font-body-lg text-body-lg text-primary italic mb-6">{{ $story['quote'] }}</p>
                        <h5 class="font-label-sm text-label-sm font-bold text-primary">{{ $story['name'] }}</h5>
                        <p class="font-label-sm text-label-sm text-secondary">{{ $story['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== CLIENT JOURNEY (8-STAGE ROADMAP) ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop">
        <header class="max-w-container-max mx-auto px-0 text-center mb-24">
            <h1
                class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary mb-6">
                The Client Journey: From Idea to Scale</h1>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto">
                A definitive roadmap designed for visionaries. We take your seed of an idea and cultivate it into a
                global enterprise through our 8-stage architectural process.</p>
        </header>
        <div class="max-w-4xl mx-auto px-0 relative">
            <div class="roadmap-line"></div>
            <div class="flex flex-col gap-12 relative">
                @foreach ($roadmap_stages as $i => $stage)
                    @if ($i % 2 === 0)
                        <div class="flex items-start md:justify-center group">
                            <div class="hidden md:flex flex-1 justify-end pr-12 pt-4">
                                <span
                                    class="text-surface-dim font-headline-md opacity-20">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div
                                class="z-10 bg-primary w-12 h-12 rounded-full flex items-center justify-center text-on-primary font-bold border-4 border-background shrink-0">{{ $i + 1 }}</div>
                            <div class="flex-1 pl-8 md:pl-12">
                                <div
                                    class="stage-card bg-surface-container-lowest border border-surface-container p-8 rounded-lg">
                                    <h3 class="font-headline-lg text-primary">{{ $stage['title'] }}</h3>
                                    <p class="detail-text text-secondary font-body-md">{{ $stage['subtitle'] }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start md:justify-center group">
                            <div class="flex-1 pr-8 md:pr-12 text-right hidden md:block">
                                <div
                                    class="stage-card bg-surface-container-lowest border border-surface-container p-8 rounded-lg">
                                    <h3 class="font-headline-lg text-primary">{{ $stage['title'] }}</h3>
                                    <p class="detail-text text-secondary font-body-md">{{ $stage['subtitle'] }}</p>
                                </div>
                            </div>
                            <div
                                class="z-10 bg-primary w-12 h-12 rounded-full flex items-center justify-center text-on-primary font-bold border-4 border-background shrink-0">{{ $i + 1 }}</div>
                            <div class="flex-1 pl-8 md:pl-12 block md:hidden">
                                <div
                                    class="stage-card bg-surface-container-lowest border border-surface-container p-8 rounded-lg">
                                    <h3 class="font-headline-lg text-primary">{{ $stage['title'] }}</h3>
                                    <p class="detail-text text-secondary font-body-md">{{ $stage['subtitle'] }}</p>
                                </div>
                            </div>
                            <div class="hidden md:flex flex-1 justify-start pl-12 pt-4">
                                <span
                                    class="text-surface-dim font-headline-md opacity-20">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <hr>
        {{-- ===================== CHOOSE YOUR JOURNEY (BENTO) ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop bg-surface-container">
        <div class="max-w-container-max mx-auto">
            <header class="mb-20 text-center md:text-left">
                <h2
                    class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary max-w-3xl mb-6">
                    Where are you in your business journey?</h2>
                <p class="font-body-lg text-body-lg text-secondary max-w-xl">
                    Choose your current stage so we can guide you to the right solution.</p>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                @foreach ($journey_cards as $card)
                <a class="journey-card group flex flex-col p-12 bg-surface-container-lowest border border-surface-container h-[420px] justify-between"
                    href="{{ $card['cta_url'] }}">
                    <div>
                        <div
                            class="mb-10 w-24 h-24 flex items-center justify-center border border-surface-container rounded-full group-hover:border-primary transition-colors overflow-hidden">
                            @if($card['image'] ?? false)
                                <img class="w-16 h-16 object-contain grayscale"
                                    src="{{ asset('storage/journey/' . $card['image']) }}" alt="{{ $card['title'] }}">
                            @else
                                <img class="w-16 h-16 object-contain grayscale"
                                    src="{{ asset('img/' . $card['image']) }}" alt="{{ $card['title'] }}">
                            @endif
                        </div>
                        <h3 class="font-headline-lg text-headline-lg text-primary mb-4">{{ $card['title'] }}</h3>
                        <p class="font-body-md text-body-md text-secondary max-w-sm">{{ $card['description'] }}</p>
                    </div>
                    <div
                        class="flex items-center gap-2 font-label-sm text-primary group-hover:gap-4 transition-all uppercase tracking-widest">
                        <span>{{ $card['cta_text'] }}</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ===================== CONSULTATION CTA ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop text-center">
        <div class="max-w-container-max mx-auto border-y border-surface-container py-24">
            <h2
                class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary mb-8">{{ $settings['consultation_headline'] ?? 'পরবর্তী ধাপে যেতে প্রস্তুত?' }}</h2>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto mb-12">{{ $settings['consultation_description'] ?? 'আপনার বিজনেস আইডিয়া বা চলমান সমস্যা নিয়ে আমাদের সাথে আলোচনা করুন। আমরা আছি আপনার পাশে।' }}</p>
            <a href="{{ $settings['consultation_cta_url'] ?? '/register' }}"
                class="inline-block bg-primary text-on-primary px-12 py-5 font-label-sm text-label-sm tracking-widest uppercase hover:scale-105 transition-transform active:scale-95">{{ $settings['consultation_cta_text'] ?? 'Book Your Free Call' }}</a>
        </div>
    </section>
</x-app-layout>