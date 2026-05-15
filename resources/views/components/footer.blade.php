<footer class="bg-gray-900 text-gray-300 pt-16 pb-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 pb-12">
            <div>
                @php
                    $logo = \App\Models\Setting::get('site_logo');
                    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
                @endphp
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 mb-4">
                    @if($logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="{{ $siteName }}" class="h-8 w-auto">
                    @else
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent to-indigo-700 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    @endif
                    {{-- <span class="text-lg font-display font-bold text-white">{{ $siteName }}</span> --}}
                </a>
                <p class="text-sm text-gray-400 leading-relaxed mb-6">
                    {{ \App\Models\Setting::get('footer_description', "Bangladesh's first all-in-one digital platform — premium courses, ready-made software, and expert support.") }}
                </p>
                <div class="flex items-center gap-3">
                    @php $fb = \App\Models\Setting::get('social_facebook'); @endphp
                    <a href="{{ $fb ? 'https://facebook.com/' . $fb : '#' }}" class="w-9 h-9 rounded-lg bg-gray-800 hover:bg-accent flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @php $tw = \App\Models\Setting::get('social_twitter'); @endphp
                    <a href="{{ $tw ? 'https://twitter.com/' . $tw : '#' }}" class="w-9 h-9 rounded-lg bg-gray-800 hover:bg-accent flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @php $li = \App\Models\Setting::get('social_linkedin'); @endphp
                    <a href="{{ $li ? 'https://linkedin.com/in/' . $li : '#' }}" class="w-9 h-9 rounded-lg bg-gray-800 hover:bg-accent flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Platform</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('courses.index') }}" class="text-sm text-gray-400 hover:text-white transition">কোর্স</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm text-gray-400 hover:text-white transition">Services</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition">Projects</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-white transition">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Support</h4>
                <ul class="space-y-3">
                    {{-- <li><a href="{{ route('faq') }}" class="text-sm text-gray-400 hover:text-white transition">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition">Contact</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-sm text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-sm text-gray-400 hover:text-white transition">Terms of Service</a></li> --}}
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Newsletter</h4>
                <p class="text-sm text-gray-400 mb-4">Get updates on new courses and products.</p>
                <form method="POST" action="#" class="flex gap-2">
                    @csrf
                    <input type="email" placeholder="Your email" required
                           class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-btn text-sm text-white placeholder:text-gray-500 focus:outline-none focus:border-accent">
                    <button type="submit" class="px-4 py-2.5 bg-accent text-white text-sm font-semibold rounded-btn hover:bg-accent-hover transition shrink-0">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-800 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p class="flex items-center gap-1">Made in Bangladesh 🇧🇩</p>
        </div>
    </div>
</footer>
