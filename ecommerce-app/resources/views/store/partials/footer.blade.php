<section class="mt-20 bg-luxe-ink px-6 py-16 text-luxe-cream md:py-20">
    <div class="mx-auto flex max-w-[1400px] flex-col items-center justify-between gap-8 md:flex-row">
        <div class="text-center md:text-left">
            <p class="label-upper !text-luxe-gold">Newsletter</p>
            <h2 class="mt-2 font-display text-3xl md:text-4xl">Join the inner circle</h2>
            <p class="mt-3 max-w-md text-sm text-luxe-cream/60">Exclusive drops, early access, and style notes — delivered weekly.</p>
        </div>
        <form action="{{ route('pages.newsletter.subscribe') }}" method="POST" class="flex w-full max-w-md flex-col gap-3 sm:flex-row">
            @csrf
            <input type="email" name="email" required placeholder="Email address" class="flex-1 border border-luxe-cream/20 bg-transparent px-4 py-3 text-sm text-luxe-cream placeholder:text-luxe-cream/40 focus:border-luxe-gold focus:outline-none focus:ring-0">
            <button type="submit" class="btn-gold shrink-0 !bg-luxe-gold !text-luxe-ink hover:!bg-luxe-gold-light">Join</button>
        </form>
    </div>
</section>

<footer class="border-t border-luxe-ink/10 bg-white px-6 py-14">
    <div class="mx-auto grid max-w-[1400px] gap-10 md:grid-cols-2 lg:grid-cols-5">
        <div class="lg:col-span-2">
            <span class="font-display text-3xl tracking-wide text-luxe-ink">E—SHOP</span>
            <p class="mt-4 max-w-sm text-sm leading-relaxed text-luxe-muted">
                Curated essentials for the modern wardrobe. Timeless design, thoughtful craftsmanship.
            </p>
        </div>
        <div>
            <p class="label-upper">Shop</p>
            <ul class="mt-4 space-y-2.5 text-sm text-luxe-muted">
                <li><a href="{{ route('shop.index') }}" class="transition hover:text-luxe-gold">All Products</a></li>
                <li><a href="{{ route('shop.sales') }}" class="transition hover:text-luxe-gold">Sale</a></li>
                <li><a href="{{ route('shop.category', 'womens-clothing') }}" class="transition hover:text-luxe-gold">Women</a></li>
                <li><a href="{{ route('shop.category', 'mens-clothing') }}" class="transition hover:text-luxe-gold">Men</a></li>
            </ul>
        </div>
        <div>
            <p class="label-upper">Account</p>
            <ul class="mt-4 space-y-2.5 text-sm text-luxe-muted">
                <li><a href="{{ route('account.profile') }}" class="transition hover:text-luxe-gold">My Profile</a></li>
                <li><a href="{{ route('account.orders') }}" class="transition hover:text-luxe-gold">My Orders</a></li>
                <li><a href="{{ route('cart.index') }}" class="transition hover:text-luxe-gold">Shopping Bag</a></li>
                <li><a href="{{ route('checkout') }}" class="transition hover:text-luxe-gold">Checkout</a></li>
            </ul>
        </div>
        <div>
            <p class="label-upper">Help</p>
            <ul class="mt-4 space-y-2.5 text-sm text-luxe-muted">
                <li><a href="{{ route('pages.about') }}" class="transition hover:text-luxe-gold">Hakkımızda</a></li>
                <li><a href="{{ route('pages.about') }}#contact" class="transition hover:text-luxe-gold">Bize Ulaşın</a></li>
                <li><a href="{{ route('pages.faq') }}" class="transition hover:text-luxe-gold">FAQ</a></li>
                <li><a href="{{ route('login') }}" class="transition hover:text-luxe-gold">Sign In</a></li>
            </ul>
        </div>
    </div>
    <p class="mx-auto mt-12 max-w-[1400px] border-t border-luxe-ink/10 pt-8 text-center text-[11px] uppercase tracking-widest text-luxe-muted">
        &copy; {{ date('Y') }} E-SHOP · Crafted with care · <a href="{{ route('admin.dashboard') }}" class="hover:text-luxe-ink">Admin</a>
    </p>
</footer>
