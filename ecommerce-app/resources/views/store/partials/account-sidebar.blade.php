@php
    $navClass = fn (array $routes) => request()->routeIs($routes)
        ? 'account-nav-link account-nav-link-active'
        : 'account-nav-link account-nav-link-idle';
@endphp

<aside class="lg:w-72 lg:shrink-0">
    <div class="account-shell">
        <div class="border-b border-luxe-ink/10 pb-5">
            <p class="label-upper">User Menu</p>
            @auth
                <p class="mt-2 font-display text-2xl text-luxe-ink">{{ Auth::user()->name }}</p>
                <p class="mt-1 text-xs text-luxe-muted">{{ Auth::user()->email }}</p>
            @endauth
        </div>

        <nav class="mt-2 space-y-0.5">
            <a href="{{ route('account.profile') }}" class="{{ $navClass(['account.profile']) }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                My Profile
            </a>
            <a href="{{ route('account.orders') }}" class="{{ $navClass(['account.orders', 'account.orders.show']) }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                My Orders
            </a>
            <a href="{{ route('account.reviews') }}" class="{{ $navClass(['account.reviews']) }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                My Reviews
            </a>
            <a href="{{ route('checkout') }}" class="{{ $navClass(['checkout', 'checkout.complete']) }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                Checkout
            </a>
            <a href="{{ route('account.products') }}" class="{{ $navClass(['account.products']) }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                My Products
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-6 border-t border-luxe-ink/10 pt-5">
            @csrf
            <button type="submit" class="account-nav-link account-nav-link-idle w-full text-left">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>
