@extends('layouts.store')

@section('title', 'Home')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
    <div class="flex gap-8">
        @include('store.partials.category-sidebar')

        <div class="min-w-0 flex-1">
            <div class="relative overflow-hidden rounded-[2rem]" x-data="{ slide: 0, slides: [
                { title: 'Bags Collection', subtitle: 'Up to 50% off', image: 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=1200&h=500&fit=crop', cta: '{{ route('shop.category', 'bags-shoes') }}' },
                { title: 'Summer Essentials', subtitle: 'New season arrivals', image: 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=500&fit=crop', cta: '{{ route('shop.sales') }}' },
                { title: 'Style Forward', subtitle: 'Discover the latest', image: 'https://images.unsplash.com/photo-1483985988350-763728e3685b?w=1200&h=500&fit=crop', cta: '{{ route('shop.index') }}' },
            ] }">
                <template x-for="(item, index) in slides" :key="index">
                    <div x-show="slide === index" x-transition class="relative">
                        <img :src="item.image" :alt="item.title" class="h-72 w-full object-cover sm:h-96 lg:h-[440px]">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/80 via-primary-800/50 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-center px-8 sm:px-14">
                            <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-200" x-text="item.subtitle"></p>
                            <h2 class="mt-3 max-w-md text-4xl font-extrabold leading-tight text-white sm:text-5xl" x-text="item.title"></h2>
                            <a :href="item.cta" class="btn-primary mt-8 w-fit">Explore Collection</a>
                        </div>
                    </div>
                </template>
                <button @click="slide = slide === 0 ? slides.length - 1 : slide - 1" class="absolute left-5 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-3 text-white backdrop-blur transition hover:bg-white/25">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="slide = slide === slides.length - 1 ? 0 : slide + 1" class="absolute right-5 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-3 text-white backdrop-blur transition hover:bg-white/25">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
                <div class="absolute bottom-5 right-8 flex gap-2">
                    <template x-for="(item, index) in slides" :key="'dot-'+index">
                        <button @click="slide = index" :class="slide === index ? 'w-8 bg-white' : 'w-2 bg-white/40'" class="h-2 rounded-full transition-all"></button>
                    </template>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-4">
                @foreach ([
                    ['img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=400&h=300&fit=crop', 'label' => 'Women', 'color' => 'from-primary-600/60'],
                    ['img' => 'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=400&h=300&fit=crop', 'label' => 'Men', 'color' => 'from-zinc-900/60'],
                    ['img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop', 'label' => 'Watches', 'color' => 'from-accent-600/60'],
                    ['img' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&h=300&fit=crop', 'label' => 'Shoes', 'color' => 'from-primary-800/60'],
                ] as $tile)
                    <a href="{{ route('shop.index') }}" class="group relative overflow-hidden rounded-2xl">
                        <img src="{{ $tile['img'] }}" alt="{{ $tile['label'] }}" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t {{ $tile['color'] }} to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-sm font-bold text-white">{{ $tile['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <section class="mt-16">
        <div class="flex items-end justify-between">
            <h2 class="section-title">Deals of the <span>Day</span></h2>
            <a href="{{ route('shop.sales') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">View all →</a>
        </div>
        <div class="mt-8 grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-4">
            @foreach ($dealProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-end justify-between">
            <h2 class="section-title">Latest <span>Arrivals</span></h2>
            <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">View all →</a>
        </div>
        <div class="mt-8 grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-4">
            @foreach ($latestProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
</div>
@endsection
