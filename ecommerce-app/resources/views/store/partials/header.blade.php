<header class="border-b border-luxe-ink/10 bg-luxe-cream">
    <div class="hidden border-b border-luxe-ink/5 lg:block">
        <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-2 text-[11px] uppercase tracking-widest text-luxe-muted">
            <span>Complimentary shipping over $50</span>
            <div class="flex gap-8">
                <a href="{{ route('pages.faq') }}" class="hover:text-luxe-ink">Help</a>
                <a href="{{ route('pages.about') }}#contact" class="hover:text-luxe-ink">Bize Ulaşın</a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-[1400px] px-6 py-6">
        <div class="flex items-center justify-between lg:grid lg:grid-cols-3">
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

            <a href="{{ route('home') }}" class="text-center">
                <span class="font-display text-3xl font-semibold tracking-[0.08em] text-luxe-ink lg:text-4xl">E—SHOP</span>
            </a>

            <div class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="label-upper hidden hover:text-luxe-gold sm:inline">{{ Auth::user()->name }}</a>
                @else
                    <a href="{{ route('login') }}" class="label-upper hidden hover:text-luxe-gold sm:inline">Account</a>
                @endif
                <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2">
                    <span class="label-upper">Bag</span>
                    @if ($cartCount > 0)
                        <span class="flex h-5 min-w-5 items-center justify-center bg-luxe-gold px-1 text-[10px] font-bold text-luxe-ink">{{ $cartCount }}</span>
                    @endif
                    <span class="hidden text-sm font-medium text-luxe-ink md:inline">${{ number_format($cartTotal, 2) }}</span>
                </a>
            </div>
        </div>

        <nav class="mt-5 hidden items-center justify-center gap-8 border-t border-luxe-ink/5 pt-5 lg:flex">
            <a href="{{ route('home') }}" class="label-upper {{ request()->routeIs('home') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Home</a>
            @include('store.partials.nav-categories')
            <a href="{{ route('shop.index') }}" class="label-upper {{ request()->routeIs('shop.index') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">All</a>
            <a href="{{ route('pages.about') }}" class="label-upper {{ request()->routeIs('pages.about') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">Hakkımızda</a>
            <a href="{{ route('pages.faq') }}" class="label-upper {{ request()->routeIs('pages.faq') ? 'text-luxe-gold' : '' }} hover:text-luxe-gold">FAQ</a>
        </nav>
    </div>

    <div x-show="searchOpen" x-cloak @click.outside="searchOpen = false" class="border-t border-luxe-ink/10 bg-luxe-sand px-6 py-5">
        <form action="{{ route('shop.index') }}" method="GET" class="mx-auto flex max-w-2xl gap-3">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search the collection..." class="flex-1 border-0 border-b border-luxe-ink/20 bg-transparent px-0 py-2 text-sm focus:border-luxe-ink focus:ring-0">
            <button type="submit" class="btn-gold !px-6 !py-2">Search</button>
        </form>
    </div>

    <div x-show="menuOpen" x-cloak class="border-t border-luxe-ink/10 px-6 py-6 lg:hidden">
        <nav class="flex flex-col gap-3">
            <a href="{{ route('home') }}" class="font-display text-2xl">Home</a>
            <a href="{{ route('shop.index') }}" class="font-display text-2xl">Shop</a>
            <a href="{{ route('shop.sales') }}" class="font-display text-2xl">Sale</a>
            @foreach ($navCategoryTree as $parent)
                <div>
                    <a href="{{ route('shop.category', $parent) }}" class="font-display text-xl text-luxe-ink">{{ $parent->title }}</a>
                    @foreach ($parent->children as $child)
                        <a href="{{ route('shop.category', $child) }}" class="mt-1 block pl-4 text-sm text-luxe-muted hover:text-luxe-gold">— {{ $child->title }}</a>
                    @endforeach
                </div>
            @endforeach
            <a href="{{ route('pages.about') }}" class="label-upper mt-4">Hakkımızda & İletişim</a>
            <a href="{{ route('pages.faq') }}" class="font-display text-2xl">FAQ</a>
        </nav>
    </div>
</header>
