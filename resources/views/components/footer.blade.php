<footer class="bg-primary text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-lg font-display font-bold mb-4">{{ config('app.name') }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                    Your all-in-one digital business platform. Learn, build, and grow with our comprehensive suite of tools and resources.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-sm mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ \Illuminate\Support\Facades\Route::has('courses.index') ? route('courses.index') : '#' }}" class="hover:text-white transition">Courses</a></li>
                    <li><a href="{{ \Illuminate\Support\Facades\Route::has('services.index') ? route('services.index') : '#' }}" class="hover:text-white transition">Services</a></li>
                    <li><a href="{{ \Illuminate\Support\Facades\Route::has('blog.index') ? route('blog.index') : '#' }}" class="hover:text-white transition">Blog</a></li>
                    <li><a href="{{ \Illuminate\Support\Facades\Route::has('shop.index') ? route('shop.index') : '#' }}" class="hover:text-white transition">Shop</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-sm mb-4">Support</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</footer>
