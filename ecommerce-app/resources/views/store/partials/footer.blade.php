<footer class="mt-20 bg-primary-900 text-primary-100">
    <div class="mx-auto max-w-7xl px-4 py-16 lg:px-8">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-extrabold text-white">E-SHOP</a>
                <p class="mt-4 text-sm leading-relaxed text-primary-200/80">
                    Curated fashion and lifestyle products. Thoughtfully designed, sustainably sourced, delivered with care.
                </p>
                <div class="mt-6 flex gap-2">
                    @foreach (['facebook', 'twitter', 'instagram'] as $social)
                        <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-800 text-primary-300 transition hover:bg-accent-500 hover:text-white">
                            <span class="sr-only">{{ ucfirst($social) }}</span>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-white">My Account</h4>
                <ul class="mt-5 space-y-3 text-sm text-primary-200/80">
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">My Account</a></li>
                    <li><a href="#" class="transition hover:text-white">Wishlist</a></li>
                    <li><a href="#" class="transition hover:text-white">Compare</a></li>
                    <li><a href="{{ route('cart.index') }}" class="transition hover:text-white">Checkout</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">Login</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-white">Support</h4>
                <ul class="mt-5 space-y-3 text-sm text-primary-200/80">
                    <li><a href="{{ route('pages.about') }}" class="transition hover:text-white">About Us</a></li>
                    <li><a href="#" class="transition hover:text-white">Shipping & Returns</a></li>
                    <li><a href="#" class="transition hover:text-white">Shipping Guide</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="transition hover:text-white">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-white">Newsletter</h4>
                <p class="mt-5 text-sm text-primary-200/80">Exclusive offers, straight to your inbox.</p>
                <form action="{{ route('pages.newsletter.subscribe') }}" method="POST" class="mt-4 flex flex-col gap-2">
                    @csrf
                    <input type="email" name="email" required placeholder="your@email.com" class="rounded-full border-0 bg-primary-800 px-5 py-3 text-sm text-white placeholder-primary-400 focus:ring-2 focus:ring-accent-500">
                    <button type="submit" class="rounded-full bg-accent-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-accent-600">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div class="border-t border-primary-800 py-6 text-center text-xs text-primary-400">
        &copy; {{ date('Y') }} E-SHOP. All rights reserved.
    </div>
</footer>
