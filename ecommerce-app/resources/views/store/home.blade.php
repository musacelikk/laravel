@extends('layouts.store')

@section('title', 'Home')

@section('content')
{{-- Dynamic slider (hardcoded in config/home.php) --}}
@include('store.partials.hero-slider', ['slides' => $slides])

{{-- Category pills --}}
<section class="border-b border-luxe-ink/10 px-6 py-5">
    <div class="mx-auto max-w-[1400px]">
        @include('store.partials.category-pills')
    </div>
</section>

{{-- Category & SubCategory tree --}}
<section class="mx-auto max-w-[1400px] px-6 py-16">
    <div class="flex items-end justify-between border-b border-luxe-ink/10 pb-6">
        <div>
            <p class="label-upper">Browse</p>
            <h2 class="heading-section mt-2">Categories & Subcategories</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">View All</a>
    </div>
    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @include('store.partials.category-tree-home', ['nodes' => $categoryTree])
    </div>
</section>

{{-- Latest products from database --}}
<section class="bg-luxe-sand/50 px-6 py-16">
    <div class="mx-auto max-w-[1400px]">
        <div class="flex items-end justify-between border-b border-luxe-ink/10 pb-6">
            <div>
                <p class="label-upper">New Arrivals</p>
                <h2 class="heading-section mt-2">Latest Products</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="label-upper hover:text-luxe-gold">View All</a>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
            @forelse ($latestProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @empty
                <p class="col-span-full text-center text-luxe-muted">No products yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Featured products --}}
@if ($featuredProducts->isNotEmpty())
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
@endif

{{-- Deals --}}
@if ($dealProducts->isNotEmpty())
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
@endif
@endsection
