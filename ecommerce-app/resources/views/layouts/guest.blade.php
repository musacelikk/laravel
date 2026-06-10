<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Account' }} — E-SHOP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-luxe-cream text-luxe-ink antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="relative hidden overflow-hidden bg-luxe-charcoal lg:block">
            <img
                src="https://images.unsplash.com/photo-1483985988350-763728e3685b?w=900&h=1200&fit=crop"
                alt=""
                class="absolute inset-0 h-full w-full object-cover opacity-60"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-luxe-ink via-luxe-ink/40 to-transparent"></div>
            <div class="relative flex h-full flex-col justify-between p-12 text-luxe-cream">
                <a href="{{ route('home') }}" class="font-display text-3xl font-semibold tracking-[0.08em]">E—SHOP</a>
                <div>
                    <p class="label-upper !text-luxe-gold">Members</p>
                    <h1 class="mt-4 font-display text-5xl leading-tight">Your personal<br><em class="italic text-luxe-gold">shopping</em> space</h1>
                    <p class="mt-6 max-w-sm text-sm leading-relaxed text-luxe-cream/70">
                        Sign in to track orders, save favourites, and enjoy a seamless checkout experience.
                    </p>
                </div>
                <p class="text-xs uppercase tracking-widest text-luxe-cream/40">&copy; {{ date('Y') }} E-SHOP</p>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="flex items-center justify-between px-6 py-6 lg:px-12">
                <a href="{{ route('home') }}" class="font-display text-2xl font-semibold tracking-[0.08em] lg:hidden">E—SHOP</a>
                <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">Continue Shopping</a>
            </div>

            <div class="flex flex-1 items-center justify-center px-6 pb-12 lg:px-12">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
