<footer class="w-full py-section-gap px-margin-mobile md:px-margin-desktop bg-surface border-t border-surface-container">
    <div class="max-w-container-max mx-auto flex flex-col lg:flex-row justify-between items-start gap-12">
        <div class="max-w-sm">
            @php
                $logo = \App\Models\Setting::get('site_logo');
                $siteName = \App\Models\Setting::get('site_name', 'আপনার Business');
            @endphp
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 mb-4">
                @if ($logo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="{{ $siteName }}"
                        class="h-8 w-auto">
                @else
                    <span
                        class="w-8 h-8 rounded-lg bg-primary text-on-primary flex items-center justify-center font-bold text-sm">AB</span>
                @endif
                <span class="font-headline-md text-headline-md font-bold text-primary">{{ $siteName }}</span>
            </a>
            <p class="font-body-md text-body-md text-secondary leading-relaxed mb-8">
                {{ \App\Models\Setting::get('footer_description', 'Empowering entrepreneurs to scale through elite technology and strategic consulting.') }}
            </p>
            <div class="flex gap-4">
                @php
                    $fb = \App\Models\Setting::get('social_facebook');
                    $tw = \App\Models\Setting::get('social_twitter');
                    $li = \App\Models\Setting::get('social_linkedin');
                @endphp
                <a href="{{ $fb ? 'https://facebook.com/' . $fb : '#' }}"
                    class="text-secondary hover:text-primary transition" title="Facebook">
                    <span class="material-symbols-outlined">qr_code_2</span>
                </a>
                <a href="{{ $tw ? 'https://twitter.com/' . $tw : '#' }}"
                    class="text-secondary hover:text-primary transition" title="Twitter">
                    <span class="material-symbols-outlined">alternate_email</span>
                </a>
                <a href="{{ $li ? 'https://linkedin.com/in/' . $li : '#' }}"
                    class="text-secondary hover:text-primary transition" title="LinkedIn">
                    <span class="material-symbols-outlined">link</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-12 gap-y-10">
            <div class="flex flex-col gap-4">
                <span class="label-sm text-primary font-bold">Company</span>
                <a href="{{ url('/about') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">About</a>
                <a href="{{ url('/') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Success Stories</a>
                <a href="{{ url('/contact') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Contact</a>
            </div>
            <div class="flex flex-col gap-4">
                <span class="label-sm text-primary font-bold">Platform</span>
                <a href="{{ route('courses.index') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Courses</a>
                <a href="{{ route('services.index') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Services</a>
                <a href="{{ route('blog.index') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Blog</a>
            </div>
            <div class="flex flex-col gap-4">
                <span class="label-sm text-primary font-bold">Legal</span>
                <a href="{{ url('/privacy-policy') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Privacy Policy</a>
                <a href="{{ url('/terms') }}"
                    class="font-label-sm text-secondary hover:text-primary hover:underline transition">Terms of Service</a>
            </div>
        </div>
    </div>

    <div class="max-w-container-max mx-auto mt-12 pt-8 border-t border-surface-container flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="font-label-sm text-secondary">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p class="font-label-sm text-secondary">Empowering entrepreneurs to scale.</p>
    </div>
</footer>
