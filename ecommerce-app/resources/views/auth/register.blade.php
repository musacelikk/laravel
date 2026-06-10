<x-guest-layout>
    <div>
        <p class="label-upper">Join us</p>
        <h2 class="heading-section mt-3">Create Account</h2>
        <p class="mt-2 text-sm text-luxe-muted">Register to start shopping and track your orders.</p>

        <x-validation-errors class="mt-6 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" />

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
            @csrf

            <div>
                <label for="name" class="label-upper">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="input-field mt-2"
                >
            </div>

            <div>
                <label for="email" class="label-upper">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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
                    autocomplete="new-password"
                    class="input-field mt-2"
                >
            </div>

            <div>
                <label for="password_confirmation" class="label-upper">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="input-field mt-2"
                >
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <label for="terms" class="flex cursor-pointer items-start gap-3">
                    <input id="terms" type="checkbox" name="terms" required class="mt-1 rounded border-luxe-ink/20 text-luxe-ink focus:ring-luxe-gold">
                    <span class="text-sm text-luxe-muted">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-luxe-ink underline hover:text-luxe-gold">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-luxe-ink underline hover:text-luxe-gold">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </span>
                </label>
            @endif

            <button type="submit" class="btn-gold w-full">
                {{ __('Create Account') }}
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-luxe-muted">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold uppercase tracking-widest text-luxe-ink hover:text-luxe-gold">Sign in</a>
        </p>
    </div>
</x-guest-layout>
