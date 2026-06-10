<header class="sticky top-0 z-40 border-b border-surface-200/80 bg-white/80 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center gap-4 px-4 py-5 lg:gap-8 lg:px-8">
        <a href="{{ route('home') }}" class="shrink-0 text-2xl tracking-tight">
            <span class="logo-text">E-SHOP</span>
        </a>

        <form action="{{ route('shop.index') }}" method="GET" class="hidden flex-1 md:flex">
            <div class="flex w-full max-w-2xl items-center overflow-hidden rounded-full border border-surface-200 bg-surface-50 pl-1 transition focus-within:border-primary-300 focus-within:ring-4 focus-within:ring-primary-500/10">
                <select name="category" class="rounded-full border-0 bg-transparent px-4 py-3 text-sm font-medium text-zinc-600 focus:ring-0">
                    <option value="">All Categories</option>
                    @foreach ($storeCategories as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <div class="h-6 w-px bg-surface-200"></div>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="What are you looking for?" class="flex-1 border-0 bg-transparent px-4 py-3 text-sm focus:ring-0">
                <button type="submit" class="m-1 rounded-full bg-primary-600 px-5 py-2.5 text-white transition hover:bg-primary-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>
        </form>

        <div class="ml-auto flex items-center gap-2 sm:gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-secondary hidden !py-2 sm:inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary hidden !py-2 sm:inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Login</span>
                </a>
            @endauth

            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-2.5 rounded-full bg-zinc-900 px-5 py-2.5 text-white transition hover:bg-zinc-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                @if ($cartCount > 0)
                    <span class="absolute -right-0.5 -top-0.5 flex h-5 w-5 items-center justify-center rounded-full bg-accent-500 text-[10px] font-bold">{{ $cartCount }}</span>
                @endif
                <span class="hidden text-sm font-semibold sm:inline">${{ number_format($cartTotal, 2) }}</span>
            </a>

            <button @click="mobileMenu = !mobileMenu" class="btn-icon !h-10 !w-10 md:hidden">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</header>
