<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-6">
            <h1 class="text-xl font-display font-bold">Welcome Back</h1>
            <p class="text-sm text-muted mt-1">Sign in to your account</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-accent shadow-sm focus:ring-accent" name="remember">
                <span class="ms-2 text-sm text-muted">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-accent hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full px-4 py-2.5 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-medium text-sm">
                {{ __('Sign In') }}
            </button>
        </div>

        <p class="text-center text-sm text-muted mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-accent hover:underline font-medium">Register</a>
        </p>
    </form>
</x-guest-layout>
