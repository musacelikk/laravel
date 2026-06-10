@extends('layouts.store')

@section('title', 'Home')

@section('content')
@include('store.partials.hero-slider', ['slides' => $slides])

<section class="border-b border-luxe-ink/10 bg-white/60 py-5">
    <div class="section-shell">
        @include('store.partials.category-pills')
    </div>
</section>

<section class="section-shell py-16 md:py-20">
    @include('store.partials.section-header', [
        'eyebrow' => 'Browse',
        'title' => 'Categories & Subcategories',
        'actionUrl' => route('shop.index'),
    ])
    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @include('store.partials.category-tree-home', ['nodes' => $categoryTree])
    </div>
</section>

<section class="bg-luxe-sand/40 py-16 md:py-20">
    <div class="section-shell">
        @include('store.partials.section-header', [
            'eyebrow' => 'New Arrivals',
            'title' => 'Latest Products',
            'actionUrl' => route('shop.index'),
        ])
        <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-12 md:grid-cols-4 md:gap-x-6">
            @forelse ($latestProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @empty
                <p class="col-span-full py-16 text-center text-luxe-muted">No products yet.</p>
            @endforelse
        </div>
    </div>
</section>

@if ($featuredProducts->isNotEmpty())
<section class="section-shell py-16 md:py-20">
    @include('store.partials.section-header', [
        'eyebrow' => 'Editorial',
        'title' => 'Curated Edit',
        'actionUrl' => route('shop.index'),
    ])
    <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-12 md:grid-cols-4 md:gap-x-6">
        @foreach ($featuredProducts as $index => $product)
            @include('store.partials.product-card', ['product' => $product, 'large' => $index === 0])
        @endforeach
    </div>
</section>
@endif

@if ($dealProducts->isNotEmpty())
<section class="border-t border-luxe-ink/10 bg-luxe-ink py-16 text-luxe-cream md:py-20">
    <div class="section-shell">
        <div class="section-divider flex items-end justify-between gap-6 border-luxe-cream/20">
            <div>
                <p class="label-upper !text-luxe-gold">Limited Time</p>
                <h2 class="heading-section mt-2 !text-luxe-cream">Today's Offers</h2>
            </div>
            <a href="{{ route('shop.sales') }}" class="label-upper shrink-0 !text-luxe-gold hover:!text-luxe-cream">All Deals</a>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-12 md:grid-cols-4 md:gap-x-6">
            @foreach ($dealProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

@if ($recentMessages->isNotEmpty())
<section class="section-shell py-16 md:py-20">
    @include('store.partials.section-header', [
        'eyebrow' => 'Community',
        'title' => 'Recent Messages',
        'actionUrl' => route('pages.about').'#contact',
        'actionLabel' => 'Bize Ulaşın',
    ])
    <div class="mt-8 grid gap-4 md:grid-cols-3">
        @foreach ($recentMessages as $msg)
            <article class="card-luxe p-6 transition hover:shadow-md">
                <p class="font-display text-xl text-luxe-ink">{{ $msg->name }}</p>
                <p class="mt-3 text-sm leading-relaxed text-luxe-muted line-clamp-3">{{ $msg->message }}</p>
                <p class="mt-4 text-[10px] uppercase tracking-widest text-luxe-muted">{{ $msg->created_at?->diffForHumans() }}</p>
            </article>
        @endforeach
    </div>
</section>
@endif
@endsection
