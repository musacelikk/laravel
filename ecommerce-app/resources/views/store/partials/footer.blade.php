{{-- Newsletter band --}}
<section class="mt-24 bg-luxe-ink px-6 py-16 text-luxe-cream">
    <div class="mx-auto flex max-w-[1400px] flex-col items-center justify-between gap-8 md:flex-row">
        <div>
            <p class="label-upper !text-luxe-gold">Newsletter</p>
            <h2 class="mt-2 font-display text-3xl md:text-4xl">Join the inner circle</h2>
        </div>
        <form action="{{ route('pages.newsletter.subscribe') }}" method="POST" class="flex w-full max-w-md gap-0">
            @csrf
            <input type="email" name="email" required placeholder="Email address" class="flex-1 border-0 border-b border-luxe-cream/30 bg-transparent px-0 py-3 text-sm text-luxe-cream placeholder-luxe-muted focus:border-luxe-gold focus:ring-0">
            <button type="submit" class="btn-gold !bg-luxe-gold !text-luxe-ink hover:!bg-luxe-gold-light">Join</button>
        </form>
    </div>
</section>

<footer class="border-t border-luxe-ink/10 px-6 py-12">
    <div class="mx-auto grid max-w-[1400px] gap-10 md:grid-cols-4">
        <div class="md:col-span-1">
            <span class="font-display text-2xl">E—SHOP</span>
            <p class="mt-3 text-sm leading-relaxed text-luxe-muted">Curated essentials for the modern wardrobe.</p>
        </div>
        <div>
            <p class="label-upper">Shop</p>
            <ul class="mt-4 space-y-2 text-sm text-luxe-muted">
                <li><a href="{{ route('shop.index') }}" class="hover:text-luxe-ink">All Products</a></li>
                <li><a href="{{ route('shop.sales') }}" class="hover:text-luxe-ink">Sale</a></li>
                <li><a href="{{ route('shop.category', 'womens-clothing') }}" class="hover:text-luxe-ink">Women</a></li>
                <li><a href="{{ route('shop.category', 'mens-clothing') }}" class="hover:text-luxe-ink">Men</a></li>
            </ul>
        </div>
        <div>
            <p class="label-upper">Help</p>
            <ul class="mt-4 space-y-2 text-sm text-luxe-muted">
                <li><a href="{{ route('pages.about') }}" class="hover:text-luxe-ink">About</a></li>
                <li><a href="{{ route('pages.faq') }}" class="hover:text-luxe-ink">FAQ</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-luxe-ink">Checkout</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-luxe-ink">Account</a></li>
            </ul>
        </div>
        <div>
            <p class="label-upper">Follow</p>
            <div class="mt-4 flex gap-4 text-sm text-luxe-muted">
                <a href="#" class="hover:text-luxe-gold">Instagram</a>
                <a href="#" class="hover:text-luxe-gold">Pinterest</a>
                <a href="#" class="hover:text-luxe-gold">Twitter</a>
            </div>
        </div>
    </div>
    <p class="mx-auto mt-12 max-w-[1400px] text-center text-[11px] uppercase tracking-widest text-luxe-muted">
        &copy; {{ date('Y') }} E-SHOP · <a href="{{ route('admin.dashboard') }}" class="hover:text-luxe-ink">Admin</a>
    </p>
</footer>
