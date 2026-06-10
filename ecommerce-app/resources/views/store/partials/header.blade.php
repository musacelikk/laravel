<header class="border-b border-luxe-ink/10 bg-luxe-cream">
    {{-- Utility strip --}}
    <div class="hidden border-b border-luxe-ink/5 lg:block">
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-2 text-[11px] uppercase tracking-widest text-luxe-muted">
            <span>Complimentary shipping over $50</span>
            <div class="flex gap-8">
                <a href="{{ route('pages.faq') }}" class="hover:text-luxe-ink">Help</a>
                <a href="{{ route('pages.newsletter') }}" class="hover:text-luxe-ink">Newsletter</a>
                <select class="cursor-pointer border-0 bg-transparent text-[11px] uppercase tracking-widest focus:ring-0">
                    <option>EN</option><option>TR</option>
                </select>
                <select class="cursor-pointer border-0 bg-transparent text-[11px] uppercase tracking-widest focus:ring-0">
                    <option>USD</option><option>TRY</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Main header: logo center editorial style --}}
    <div class="mx-auto max-w-[1400px] px-6 py-6">
        <div class="flex items-center justify-between lg:grid lg:grid-cols-3">
            {{-- Left: mobile menu + search --}}
            <div class="flex items-center gap-3">
                <button @click="menuOpen = !menuOpen" class="btn-icon lg:hidden">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </button>
                <button @click="searchOpen = !searchOpen" class="btn-icon hidden sm:inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <nav class="hidden gap-6 lg:flex">
                    <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">Shop</a>
                    <a href="{{ route('shop.sales') }}" class="label-upper hover:text-luxe-gold">Sale</a>
                </nav>
            </div>

            {{-- Center logo --}}
            <a href="{{ route('home') }}" class="text-center">
                <span class="font-display text-3xl font-semibold tracking-[0.08em] text-luxe-ink lg:text-4xl">E—SHOP</span>
            </a>

            {{-- Right: account + cart --}}
            <div class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="label-upper hidden hover:text-luxe-gold sm:inline">{{ Auth::user()->name }}</a>
                @else
                    <a href="{{ route('login') }}" class="label-upper hidden hover:text-luxe-gold sm:inline">Account</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2">
                    <span class="label-upper">Bag</span>
                    @if ($cartCount > 0)
                        <span class="flex h-5 min-w-5 items-center justify-center bg-luxe-gold px-1 text-[10px] font-bold text-luxe-ink">{{ $cartCount }}</span>
                    @endif
                    <span class="hidden text-sm font-medium text-luxe-ink md:inline">${{ number_format($cartTotal, 2) }}</span>
                </a>
            </div>
        </div>

        {{-- Desktop nav row --}}
        <nav class="mt-5 hidden items-center justify-center gap-10 border-t border-luxe-ink/5 pt-5 lg:flex">
            <a href="{{ route('home') }}" class="label-upper {{ request()->routeIs('home') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Home</a>
            <a href="{{ route('shop.category', 'womens-clothing') }}" class="label-upper {{ request()->is('shop/category/womens-clothing') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Women</a>
            <a href="{{ route('shop.category', 'mens-clothing') }}" class="label-upper {{ request()->is('shop/category/mens-clothing') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Men</a>
            <a href="{{ route('shop.category', 'bags-shoes') }}" class="label-upper {{ request()->is('shop/category/bags-shoes') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Bags</a>
            <a href="{{ route('shop.category', 'jewelry-watches') }}" class="label-upper {{ request()->is('shop/category/jewelry-watches') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Watches</a>
            <a href="{{ route('shop.index') }}" class="label-upper {{ request()->routeIs('shop.index') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">All</a>
            <a href="{{ route('pages.about') }}" class="label-upper hover:text-luxe-gold">About</a>
        </nav>
    </div>

    {{-- Search overlay --}}
    <div x-show="searchOpen" x-cloak @click.outside="searchOpen = false" class="border-t border-luxe-ink/10 bg-luxe-sand px-6 py-5">
        <form action="{{ route('shop.index') }}" method="GET" class="mx-auto flex max-w-2xl gap-3">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search the collection..." class="flex-1 border-0 border-b border-luxe-ink/20 bg-transparent px-0 py-2 text-sm focus:border-luxe-ink focus:ring-0">
            <button type="submit" class="btn-gold !px-6 !py-2">Search</button>
        </form>
    </div>

    {{-- Mobile menu --}}
    <div x-show="menuOpen" x-cloak class="border-t border-luxe-ink/10 px-6 py-6 lg:hidden">
        <nav class="flex flex-col gap-4">
            <a href="{{ route('home') }}" class="font-display text-2xl">Home</a>
            <a href="{{ route('shop.index') }}" class="font-display text-2xl">Shop</a>
            <a href="{{ route('shop.sales') }}" class="font-display text-2xl">Sale</a>
            @foreach ($storeCategories as $category)
                <a href="{{ route('shop.category', $category) }}" class="text-sm text-luxe-muted hover:text-luxe-ink">{{ $category->name }}</a>
            @endforeach
            <a href="{{ route('login') }}" class="label-upper mt-4">Account</a>
        </nav>
    </div>
</header>
