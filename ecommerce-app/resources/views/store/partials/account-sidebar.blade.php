@php
    $linkClass = fn (string $route) => request()->routeIs($route)
        ? 'border-luxe-gold text-luxe-ink'
        : 'border-transparent text-luxe-muted hover:border-luxe-ink/20 hover:text-luxe-ink';
@endphp

<aside class="lg:w-64 lg:shrink-0">
    <p class="label-upper">User Menu</p>
    <nav class="mt-4 space-y-1 border-t border-luxe-ink/10 pt-4">
        <a href="{{ route('account.profile') }}" class="flex items-center gap-3 border-l-2 py-3 pl-4 text-sm font-medium uppercase tracking-wider transition {{ $linkClass('account.profile') }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            My Profile
        </a>
        <a href="{{ route('account.orders') }}" class="flex items-center gap-3 border-l-2 py-3 pl-4 text-sm font-medium uppercase tracking-wider transition {{ request()->routeIs('account.orders*') ? 'border-luxe-gold text-luxe-ink' : 'border-transparent text-luxe-muted hover:border-luxe-ink/20 hover:text-luxe-ink' }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            My Orders
        </a>
        <a href="{{ route('account.reviews') }}" class="flex items-center gap-3 border-l-2 py-3 pl-4 text-sm font-medium uppercase tracking-wider transition {{ $linkClass('account.reviews') }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            My Reviews
        </a>
        <a href="{{ route('checkout') }}" class="flex items-center gap-3 border-l-2 py-3 pl-4 text-sm font-medium uppercase tracking-wider transition {{ $linkClass('checkout') }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
            Checkout
        </a>
        <a href="{{ route('account.products') }}" class="flex items-center gap-3 border-l-2 py-3 pl-4 text-sm font-medium uppercase tracking-wider transition {{ $linkClass('account.products') }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            My Products
        </a>
        <form method="POST" action="{{ route('logout') }}" class="border-t border-luxe-ink/10 pt-4">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 border-l-2 border-transparent py-3 pl-4 text-left text-sm font-medium uppercase tracking-wider text-luxe-muted transition hover:border-luxe-ink/20 hover:text-luxe-ink">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </nav>
</aside>
