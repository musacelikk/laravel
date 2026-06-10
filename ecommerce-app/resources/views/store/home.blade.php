@extends('layouts.store')

@section('title', 'Home')

@section('content')
{{-- Split hero --}}
<section class="grid lg:grid-cols-2">
    <div class="flex flex-col justify-center px-6 py-16 lg:px-16 lg:py-24">
        <p class="label-upper">Spring / Summer 2026</p>
        <h1 class="heading-display mt-6">The Art of<br><em class="font-normal italic text-luxe-gold">Refined</em> Living</h1>
        <p class="mt-6 max-w-md text-sm leading-relaxed text-luxe-muted">
            Discover a curated collection of timeless pieces — crafted for those who appreciate understated elegance.
        </p>
        <div class="mt-10 flex flex-wrap gap-4">
            <a href="{{ route('shop.index') }}" class="btn-gold">Explore Collection</a>
            <a href="{{ route('shop.sales') }}" class="btn-outline">View Sale</a>
        </div>
    </div>
    <div class="relative min-h-[400px] lg:min-h-full">
        <img src="https://images.unsplash.com/photo-1483985988350-763728e3685b?w=900&h=1100&fit=crop" alt="Hero" class="absolute inset-0 h-full w-full object-cover">
        <a href="{{ route('shop.index') }}" class="absolute bottom-8 left-8 bg-luxe-cream/95 px-6 py-4 backdrop-blur-sm transition hover:bg-luxe-cream">
            <p class="label-upper !text-luxe-gold">Featured</p>
            <p class="mt-1 font-display text-xl">New Season Arrivals →</p>
        </a>
    </div>
</section>

{{-- Category pills --}}
<section class="border-y border-luxe-ink/10 px-6 py-5">
    <div class="mx-auto max-w-[1400px]">
        @include('store.partials.category-pills')
    </div>
</section>

{{-- Browse categories --}}
<section class="mx-auto max-w-[1400px] px-6 py-16">
    <div class="flex items-end justify-between border-b border-luxe-ink/10 pb-6">
        <div>
            <p class="label-upper">Departments</p>
            <h2 class="heading-section mt-2">Shop by Category</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">View All</a>
    </div>
    <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-6">
        @foreach ($storeCategories as $category)
            @include('store.partials.category-card', ['category' => $category])
        @endforeach
    </div>
</section>

{{-- Featured grid: asymmetric --}}
<section class="mx-auto max-w-[1400px] px-6 py-16">
    <div class="flex items-end justify-between border-b border-luxe-ink/10 pb-6">
        <h2 class="heading-section">Curated Edit</h2>
        <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">View All</a>
    </div>
    <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
        @foreach ($featuredProducts as $index => $product)
            @include('store.partials.product-card', ['product' => $product, 'large' => $index === 0])
        @endforeach
    </div>
</section>

{{-- Full-width promo banner --}}
<section class="relative mx-6 mb-16 overflow-hidden bg-luxe-charcoal lg:mx-0">
    <div class="grid lg:grid-cols-2">
        <a href="{{ route('shop.category', 'bags-shoes') }}" class="block">
            <img src="https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=800&h=600&fit=crop" alt="Bags" class="h-64 w-full object-cover transition duration-700 hover:scale-[1.02] lg:h-auto">
        </a>
        <div class="flex flex-col justify-center px-8 py-12 text-luxe-cream lg:px-16">
            <p class="label-upper !text-luxe-gold">Limited Offer</p>
            <h2 class="mt-4 font-display text-4xl">Leather Collection<br>Up to 40% Off</h2>
            <a href="{{ route('shop.category', 'bags-shoes') }}" class="btn-gold mt-8 w-fit !bg-luxe-gold !text-luxe-ink">Shop Bags</a>
        </div>
    </div>
</section>

{{-- Deals --}}
<section class="mx-auto max-w-[1400px] px-6 pb-20">
    <div class="flex items-end justify-between border-b border-luxe-ink/10 pb-6">
        <h2 class="heading-section">Today's Offers</h2>
        <a href="{{ route('shop.sales') }}" class="label-upper hover:text-luxe-gold">All Deals</a>
    </div>
    <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
        @foreach ($dealProducts as $product)
            @include('store.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endsection
