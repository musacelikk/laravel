<nav class="border-b border-surface-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-2 lg:px-8">
        <div class="relative hidden lg:block" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                Categories
            </button>
            <div x-show="open" x-cloak x-transition class="absolute left-0 top-full z-50 mt-2 w-72 overflow-hidden rounded-2xl border border-surface-200 bg-white py-2 shadow-soft">
                @foreach ($storeCategories as $category)
                    <a href="{{ route('shop.category', $category) }}" class="flex items-center justify-between px-5 py-3 text-sm font-medium text-zinc-600 transition hover:bg-primary-50 hover:text-primary-700">
                        {{ $category->name }}
                        <svg class="h-4 w-4 text-surface-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endforeach
                <a href="{{ route('shop.index') }}" class="mx-3 mt-1 block rounded-xl bg-surface-50 px-4 py-2.5 text-center text-sm font-semibold text-primary-700 hover:bg-primary-50">View All</a>
            </div>
        </div>

        <div class="hidden flex-1 items-center gap-1 lg:flex">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Home</a>
            <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.index') ? 'nav-link-active' : '' }}">Shop</a>
            <a href="{{ route('shop.category', 'womens-clothing') }}" class="nav-link">Women</a>
            <a href="{{ route('shop.category', 'mens-clothing') }}" class="nav-link relative">
                Men
                <span class="ml-1 rounded-full bg-accent-500 px-2 py-0.5 text-[10px] font-bold text-white">NEW</span>
            </a>
            <a href="{{ route('shop.sales') }}" class="nav-link {{ request()->routeIs('shop.sales') ? 'nav-link-active' : '' }}">Sales</a>
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="nav-link flex items-center gap-1">
                    Pages
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-cloak x-transition class="absolute left-0 top-full z-50 mt-2 w-48 overflow-hidden rounded-2xl border border-surface-200 bg-white py-2 shadow-soft">
                    <a href="{{ route('pages.about') }}" class="block px-4 py-2.5 text-sm text-zinc-600 hover:bg-primary-50 hover:text-primary-700">About Us</a>
                    <a href="{{ route('pages.faq') }}" class="block px-4 py-2.5 text-sm text-zinc-600 hover:bg-primary-50 hover:text-primary-700">FAQ</a>
                    <a href="{{ route('pages.newsletter') }}" class="block px-4 py-2.5 text-sm text-zinc-600 hover:bg-primary-50 hover:text-primary-700">Newsletter</a>
                    <a href="{{ route('cart.index') }}" class="block px-4 py-2.5 text-sm text-zinc-600 hover:bg-primary-50 hover:text-primary-700">Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak x-transition class="border-t border-surface-200 px-4 py-4 lg:hidden">
        <div class="flex flex-col gap-1">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('shop.index') }}" class="nav-link">Shop</a>
            <a href="{{ route('shop.sales') }}" class="nav-link">Sales</a>
            @foreach ($storeCategories as $category)
                <a href="{{ route('shop.category', $category) }}" class="nav-link text-zinc-500">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</nav>
