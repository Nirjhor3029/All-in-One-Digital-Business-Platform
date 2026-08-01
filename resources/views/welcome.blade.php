<x-app-layout>
    @php
    $serviceCards = [
    ['icon' => 'partner_exchange', 'title' => 'Business Consultation', 'desc' => 'Strategic planning and operational optimization for your venture.'],
    ['icon' => 'developer_mode', 'title' => 'Custom Software', 'desc' => 'Bespoke software systems built to solve unique challenges.'],
    ['icon' => 'smartphone', 'title' => 'Mobile App Dev', 'desc' => 'High-performance iOS and Android applications focused on user experience.'],
    ['icon' => 'web', 'title' => 'Website Development', 'desc' => 'Clean, editorial-grade web experiences that communicate authority.'],
    ['icon' => 'precision_manufacturing', 'title' => 'Business Automation', 'desc' => 'Removing manual labor through intelligent API integrations and AI tools.'],
    ['icon' => 'school', 'title' => 'Business Starter Courses', 'desc' => 'Guided learning paths for founders looking to master business building.'],
    ['icon' => 'inventory_2', 'title' => 'SaaS Products', 'desc' => 'Enterprise-grade supply chain and management systems for local markets.'],
    ['icon' => 'transform', 'title' => 'Digital Transformation', 'desc' => 'Modernizing traditional business workflows for the digital age.'],
    ];

    $saasProducts = [
    ['title' => 'Inventory Pro XL', 'desc' => 'An enterprise-grade supply chain and warehouse management system designed for the local market.'],
    ['title' => 'RetailFlow CRM', 'desc' => 'Customer relationship management tailored for fast-growing retail brands and service providers.'],
    ['title' => 'EduScale Portal', 'desc' => 'Complete LMS and administrative backbone for coaching centers and private universities.'],
    ];

    $courseCards = [
    ['title' => 'Startup Foundation 101', 'desc' => 'Mastering legal, structural, and financial basics for Bangladeshi entrepreneurs.', 'img' => 'course-foundation', 'modules' => 8, 'price' => '৫,০০০'],
    ['title' => 'Automation Masterclass', 'desc' => 'Learn to use Zapier, AI, and APIs to put your business on autopilot.', 'img' => 'course-automation', 'modules' => 12, 'price' => '১২,০০০'],
    ['title' => 'The Scale Framework', 'desc' => 'Advanced strategies for hiring, delegation, and geographic expansion.', 'img' => 'course-scale', 'modules' => 15, 'price' => '১৫,০০০'],
    ];

    $journeyCards = [
    ['img' => 'icon-idea', 'title' => 'I have an idea', 'desc' => 'I want to start a new business and need guidance from idea to launch.', 'cta' => 'Get Started', 'url' => route('register')],
    ['img' => 'icon-business', 'title' => 'I already have a business', 'desc' => 'I want to improve, digitize, or streamline my existing business.', 'cta' => 'Modernize', 'url' => route('services.index')],
    ['img' => 'icon-software', 'title' => 'I need software', 'desc' => 'I need a website, mobile app, custom software, or SaaS solution.', 'cta' => 'Build Now', 'url' => url('/contact')],
    ['img' => 'icon-growth', 'title' => 'I want to grow', 'desc' => 'I want to automate operations, increase sales, and scale my business.', 'cta' => 'Scale Up', 'url' => route('courses.index')],
    ];

    $journeySteps = [
    ['icon' => 'lightbulb', 'label' => 'Idea'],
    ['icon' => 'edit_note', 'label' => 'Planning'],
    ['icon' => 'brush', 'label' => 'Brand'],
    ['icon' => 'language', 'label' => 'Website'],
    ['icon' => 'terminal', 'label' => 'Software'],
    ['icon' => 'automation', 'label' => 'Automation'],
    ['icon' => 'trending_up', 'label' => 'Growth'],
    ];
    @endphp

    {{-- ===================== SPLIT HERO ===================== --}}
    <section
        class="min-h-screen flex flex-col items-center justify-center px-margin-mobile md:px-margin-desktop py-32 md:py-48 relative overflow-hidden bg-surface">
        <div class="max-w-container-max mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-left">
                <h1
                    class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl mb-8 leading-tight text-primary">
                    আপনার ব্যবসা শুরু থেকে Scale পর্যন্ত।</h1>
                <p class="font-body-lg text-body-lg text-secondary max-w-xl mb-12 leading-relaxed">We help businesses
                    launch, automate and grow with technology. Experience precision engineering for the modern
                    entrepreneur.</p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="{{ route('courses.index') }}"
                        class="bg-primary text-on-primary px-10 py-5 font-label-sm text-label-sm tracking-widest uppercase transition-all hover:opacity-90 active:scale-95 text-center">Start
                        Your Business</a>
                    <a href="{{ url('/contact') }}"
                        class="border border-primary text-primary px-10 py-5 font-label-sm text-label-sm tracking-widest uppercase transition-all hover:bg-surface-container active:scale-95 text-center">Book
                        Consultation</a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="aspect-video w-full flex items-center justify-center">
                    <img alt="Abstract line graphic illustrating business growth"
                        src="{{ asset('img/hero-graphic.png') }}" class="w-full h-auto object-contain opacity-90">
                </div>
            </div>
        </div>
        <div class="absolute top-1/2 right-0 -translate-y-1/2 w-1/2 h-full opacity-[0.03] pointer-events-none lg:hidden">
            <img alt="" src="{{ asset('img/hero-graphic.png') }}" class="w-full h-full object-cover">
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
            @foreach ($journeySteps as $step)
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
                @foreach ($serviceCards as $serviceCard)
                <div
                    class="bg-surface border border-surface-container p-8 hover:border-primary transition-all duration-300 group flex flex-col">
                    <span class="material-symbols-outlined text-4xl mb-6 text-primary"
                        style="font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 48;">{{ $serviceCard['icon'] }}</span>
                    <h3 class="font-headline-md text-headline-md mb-3">{{ $serviceCard['title'] }}</h3>
                    <p class="font-body-md text-body-md text-secondary mb-6">{{ $serviceCard['desc'] }}</p>
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
                    @foreach ($saasProducts as $i => $product)
                    <div class="border-b border-on-tertiary-container/30 pb-8 cursor-pointer group">
                        <h3
                            class="font-headline-md text-headline-md mb-2 {{ $i === 0 ? 'text-white' : 'text-on-tertiary-container group-hover:text-white transition-colors' }}">
                            {{ $product['title'] }}
                        </h3>
                        <p class="font-body-md text-body-md text-on-tertiary-container {{ $i === 0 ? '' : 'opacity-60' }}">{{ $product['desc'] }}</p>
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
                @foreach ($courseCards as $course)
                <div class="flex flex-col">
                    <a href="{{ route('courses.index') }}"
                        class="aspect-[4/3] bg-surface-container mb-6 overflow-hidden block">
                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                            src="{{ asset('img/' . $course['img'] . '.jpg') }}" alt="{{ $course['title'] }}">
                    </a>
                    <h4 class="font-headline-md text-headline-md text-primary mb-2">{{ $course['title'] }}</h4>
                    <p class="font-body-md text-body-md text-secondary mb-4">{{ $course['desc'] }}</p>
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
                    @foreach ([
                    ['01', 'Partnership over Projects', "We don't just deliver code; we embed ourselves in your growth journey as your dedicated technical partner."],
                    ['02', 'Simplicity by Design', 'Technology should solve problems, not create them. We build tools that are intuitive and powerful.'],
                    ['03', 'Local Context, Global Tech', 'We understand the unique challenges of the Bangladeshi market and solve them with world-class engineering.'],
                    ] as $point)
                    <div class="flex gap-6">
                        <div
                            class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary text-on-primary font-bold">{{ $point[0] }}</div>
                        <div>
                            <h4 class="font-headline-md text-headline-md text-primary mb-2">{{ $point[1] }}</h4>
                            <p class="font-body-md text-body-md text-secondary">{{ $point[2] }}</p>
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
                @foreach ([
                ['storefront', '"আপনার Business replaced our manual bookkeeping with a custom CRM. Our efficiency tripled in 4 months."', 'RAHAT CHOWDHURY', 'CEO, Modina Logistics'],
                ['rocket_launch', '"From a simple idea to a fully automated SaaS platform. They are the best technical team I\'ve ever worked with."', 'SARAH ISLAM', 'Founder, EduNext BD'],
                ] as $story)
                <div
                    class="bg-surface p-12 flex flex-col md:flex-row gap-8 items-center border border-outline-variant">
                    <div
                        class="w-24 h-24 shrink-0 rounded-full bg-surface-container-highest flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-primary">{{ $story[0] }}</span>
                    </div>
                    <div>
                        <p class="font-body-lg text-body-lg text-primary italic mb-6">{{ $story[1] }}</p>
                        <h5 class="font-label-sm text-label-sm font-bold text-primary">{{ $story[2] }}</h5>
                        <p class="font-label-sm text-label-sm text-secondary">{{ $story[3] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ===================== CHOOSE YOUR JOURNEY (BENTO) ===================== --}}
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop">
        <div class="max-w-container-max mx-auto">
            <header class="mb-20 text-center md:text-left">
                <h2
                    class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary max-w-3xl mb-6">
                    Where are you in your business journey?</h2>
                <p class="font-body-lg text-body-lg text-secondary max-w-xl">
                    Choose your current stage so we can guide you to the right solution.</p>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                @foreach ($journeyCards as $card)
                <a class="journey-card group flex flex-col p-12 bg-surface-container-lowest border border-surface-container h-[420px] justify-between"
                    href="{{ $card['url'] }}">
                    <div>
                        <div
                            class="mb-10 w-24 h-24 flex items-center justify-center border border-surface-container rounded-full group-hover:border-primary transition-colors overflow-hidden">
                            <img class="w-16 h-16 object-contain grayscale"
                                src="{{ asset('img/' . $card['img'] . '.png') }}" alt="{{ $card['title'] }}">
                        </div>
                        <h3 class="font-headline-lg text-headline-lg text-primary mb-4">{{ $card['title'] }}</h3>
                        <p class="font-body-md text-body-md text-secondary max-w-sm">{{ $card['desc'] }}</p>
                    </div>
                    <div
                        class="flex items-center gap-2 font-label-sm text-primary group-hover:gap-4 transition-all uppercase tracking-widest">
                        <span>{{ $card['cta'] }}</span>
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
                class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-primary mb-8">পরবর্তী
                ধাপে যেতে প্রস্তুত?</h2>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto mb-12">আপনার বিজনেস আইডিয়া বা চলমান
                সমস্যা নিয়ে আমাদের সাথে আলোচনা করুন। আমরা আছি আপনার পাশে।</p>
            <a href="{{ route('register') }}"
                class="inline-block bg-primary text-on-primary px-12 py-5 font-label-sm text-label-sm tracking-widest uppercase hover:scale-105 transition-transform active:scale-95">Book
                Your Free Call</a>
        </div>
    </section>
</x-app-layout>