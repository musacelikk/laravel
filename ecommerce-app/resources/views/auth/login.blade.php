<x-guest-layout>
    <div>
        <p class="label-upper">Welcome back</p>
        <h2 class="heading-section mt-3">Sign In</h2>
        <p class="mt-2 text-sm text-luxe-muted">Enter your credentials to access your account.</p>

        <x-validation-errors class="mt-6 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" />

        @session('status')
            <div class="mt-6 border border-luxe-gold/30 bg-luxe-sand px-4 py-3 text-sm text-luxe-ink">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <div>
                <label for="email" class="label-upper">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="input-field mt-2"
                >
            </div>

            <div>
                <label for="password" class="label-upper">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="input-field mt-2"
                >
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex cursor-pointer items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-luxe-ink/20 text-luxe-ink focus:ring-luxe-gold">
                    <span class="text-sm text-luxe-muted">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs uppercase tracking-widest text-luxe-muted hover:text-luxe-gold">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-gold w-full">
                {{ __('Sign In') }}
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-luxe-muted">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-semibold uppercase tracking-widest text-luxe-ink hover:text-luxe-gold">Create one</a>
        </p>
    </div>
</x-guest-layout>
