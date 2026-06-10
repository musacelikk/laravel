@extends('layouts.store')

@section('title', $title ?? 'Shop')

@section('content')
@if (isset($activeCategory))
    <section class="relative overflow-hidden bg-luxe-charcoal text-luxe-cream">
        <div class="mx-auto grid max-w-[1400px] lg:grid-cols-2">
            <div class="flex flex-col justify-center px-6 py-14 lg:px-16 lg:py-20">
                <nav class="label-upper !text-luxe-gold">
                    <a href="{{ route('home') }}" class="hover:text-luxe-cream">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('shop.index') }}" class="hover:text-luxe-cream">Shop</a>
                    @if ($activeCategory->parent_id && isset($parentCategory))
                        <span class="mx-2">/</span>
                        <a href="{{ route('shop.category', $parentCategory) }}" class="hover:text-luxe-cream">{{ $parentCategory->title }}</a>
                    @endif
                    <span class="mx-2">/</span>
                    <span>{{ $activeCategory->title }}</span>
                </nav>
                <h1 class="heading-section mt-6 !text-luxe-cream">{{ $activeCategory->title }}</h1>
                <p class="mt-4 max-w-md text-sm leading-relaxed text-luxe-cream/70">{{ $activeCategory->tagline() }}</p>
                <p class="mt-6 label-upper !text-luxe-cream/50">{{ $products->total() }} pieces available</p>
            </div>
            <div class="relative hidden min-h-[320px] lg:block">
                <img src="{{ $activeCategory->coverImage() }}" alt="{{ $activeCategory->name }}" class="absolute inset-0 h-full w-full object-cover opacity-90">
            </div>
        </div>
    </section>
@elseif (request()->routeIs('shop.sales'))
    <section class="bg-luxe-ink px-6 py-14 text-luxe-cream">
        <div class="mx-auto max-w-[1400px] text-center">
            <nav class="label-upper !text-luxe-gold">
                <a href="{{ route('home') }}" class="hover:text-luxe-cream">Home</a>
                <span class="mx-2">/</span>
                <span>Sale</span>
            </nav>
            <h1 class="heading-section mt-6 !text-luxe-cream">Season Sale</h1>
            <p class="mx-auto mt-4 max-w-lg text-sm leading-relaxed text-luxe-cream/70">
                Exceptional pieces at reduced prices — limited time only.
            </p>
            <p class="mt-6 label-upper !text-luxe-gold">{{ $products->total() }} deals</p>
        </div>
    </section>
@else
    <section class="border-b border-luxe-ink/10 px-6 py-8">
        <div class="mx-auto max-w-[1400px]">
            <nav class="label-upper !text-luxe-muted">
                <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
                <span class="mx-2">/</span>
                <span class="text-luxe-ink">{{ $title ?? 'Shop' }}</span>
            </nav>
            <h1 class="heading-section mt-4">{{ $title ?? 'Shop' }}</h1>
            <p class="mt-2 text-sm text-luxe-muted">{{ $products->total() }} pieces</p>
        </div>
    </section>
@endif

<section class="border-b border-luxe-ink/10 px-6 py-5">
    <div class="mx-auto max-w-[1400px] space-y-3">
        @if (isset($subCategories) && $subCategories->isNotEmpty())
            @include('store.partials.category-sub-pills')
        @else
            @include('store.partials.category-pills')
        @endif
    </div>
</section>

@if (!isset($activeCategory) && !request()->routeIs('shop.sales'))
    <section class="mx-auto max-w-[1400px] px-6 py-12">
        <p class="label-upper">Browse</p>
        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-6">
            @foreach ($storeCategories as $category)
                @include('store.partials.category-card', ['category' => $category])
            @endforeach
        </div>
    </section>
@endif

<section class="mx-auto max-w-[1400px] px-6 py-12">
    @if (isset($activeCategory) || request()->routeIs('shop.sales'))
        <div class="mb-10 flex items-end justify-between border-b border-luxe-ink/10 pb-6">
            <h2 class="font-display text-2xl text-luxe-ink">
                {{ isset($activeCategory) ? 'All ' . $activeCategory->name : 'All Deals' }}
            </h2>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            @include('store.partials.product-card', ['product' => $product])
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="font-display text-2xl text-luxe-muted">No pieces found</p>
                <a href="{{ route('shop.index') }}" class="btn-gold mt-6 inline-flex">Browse All</a>
            </div>
        @endforelse
    </div>
    <div class="mt-16 border-t border-luxe-ink/10 pt-8">
        {{ $products->links() }}
    </div>
</section>
@endsection
