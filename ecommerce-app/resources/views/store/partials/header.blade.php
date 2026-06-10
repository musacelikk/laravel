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
                <div class="relative hidden sm:block">
                    <button
                        type="button"
                        @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center gap-2 text-left"
                    >
                        <span class="btn-icon !h-9 !w-9">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <span class="hidden md:block">
                            <span class="label-upper block text-luxe-ink">{{ Auth::user()?->name ?? 'Account' }}</span>
                            @auth
                                <span class="text-[10px] uppercase tracking-widest text-luxe-muted">Logout</span>
                            @endauth
                        </span>
                        <svg class="h-3 w-3 text-luxe-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div
                        x-show="userMenuOpen"
                        x-cloak
                        @click.outside="userMenuOpen = false"
                        class="absolute right-0 z-50 mt-3 w-64 border border-luxe-ink/10 bg-luxe-cream shadow-lg"
                    >
                        <div class="h-1 bg-luxe-gold"></div>
                        <nav class="py-2">
                            @auth
                                <a href="{{ route('account.profile') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                    <svg class="h-4 w-4 text-luxe-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    My Account
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                    <svg class="h-4 w-4 text-luxe-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Login
                                </a>
                            @endauth
                            <a href="{{ route('wishlist') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                <svg class="h-4 w-4 text-luxe-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                My Wishlist
                            </a>
                            <a href="{{ route('compare') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                <svg class="h-4 w-4 text-luxe-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                Compare
                            </a>
                            <a href="{{ route('checkout') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                <svg class="h-4 w-4 text-luxe-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                                Checkout
                            </a>
                            @guest
                                <a href="{{ route('register') }}" class="flex items-center gap-3 px-5 py-3 text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                    <svg class="h-4 w-4 text-luxe-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    Create an Account
                                </a>
                            @else
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-luxe-ink hover:bg-luxe-sand">
                                        <svg class="h-4 w-4 text-luxe-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Logout
                                    </button>
                                </form>
                            @endguest
                        </nav>
                    </div>
                </div>

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
            @auth
                <a href="{{ route('account.profile') }}" class="font-display text-2xl">My Account</a>
                <a href="{{ route('account.reviews') }}" class="font-display text-2xl">My Reviews</a>
                <a href="{{ route('checkout') }}" class="font-display text-2xl">Checkout</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="label-upper text-luxe-muted hover:text-luxe-gold">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="label-upper mt-4">Login</a>
                <a href="{{ route('register') }}" class="label-upper">Create Account</a>
            @endauth
        </nav>
    </div>
</header>
