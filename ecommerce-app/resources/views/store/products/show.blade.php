@extends('layouts.store')

@section('title', $product->name)

@section('content')
@php
    $averageRating = round($reviews->avg('rate') ?? 0, 1);
    $reviewCount = $reviews->count();
@endphp

<section class="border-b border-luxe-ink/10 px-6 py-6">
    <div class="mx-auto max-w-[1400px]">
        <nav class="label-upper !text-luxe-muted">
            <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.category', $product->category) }}" class="hover:text-luxe-ink">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-luxe-ink">{{ $product->name }}</span>
        </nav>
    </div>
</section>

<section class="mx-auto max-w-[1400px] px-6 py-12" x-data="{ selectedSize: '{{ $product->sizes[0] ?? '' }}', selectedColor: '{{ $product->colors[0] ?? '#1a1814' }}', qty: 1, activeImage: '{{ $galleryImages[0] ?? $product->imageUrl() }}' }">
    <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
        <div>
            <p class="label-upper mb-3">Product Image Gallery</p>
            <div class="relative bg-luxe-sand">
                @if ($product->is_new)
                    <span class="absolute left-0 top-0 z-10 bg-luxe-ink px-4 py-2 text-[10px] font-semibold uppercase tracking-widest text-luxe-cream">New</span>
                @endif
                @if ($discount = $product->discountPercent())
                    <span class="absolute right-0 top-0 z-10 bg-luxe-gold px-4 py-2 text-[10px] font-semibold uppercase tracking-widest text-luxe-ink">-{{ $discount }}%</span>
                @endif
                <img :src="activeImage" alt="{{ $product->name }}" class="aspect-[4/5] w-full object-cover transition duration-300">
            </div>
            @if (count($galleryImages) > 0)
                <div class="mt-4">
                    <p class="mb-2 text-xs uppercase tracking-widest text-luxe-muted">{{ count($galleryImages) }} {{ Str::plural('image', count($galleryImages)) }}</p>
                    <div class="flex gap-2 overflow-x-auto scrollbar-hide pb-1">
                        @foreach ($galleryImages as $index => $image)
                            <button
                                type="button"
                                @click="activeImage = '{{ $image }}'"
                                class="shrink-0 overflow-hidden border-2 transition"
                                :class="activeImage === '{{ $image }}' ? 'border-luxe-gold' : 'border-luxe-ink/10 opacity-70 hover:opacity-100'"
                            >
                                <img src="{{ $image }}" alt="Gallery {{ $index + 1 }}" class="h-20 w-20 object-cover md:h-24 md:w-24">
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex flex-col justify-center">
            <p class="label-upper">{{ $product->brand }}</p>
            <h1 class="heading-section mt-3">{{ $product->name }}</h1>

            <div class="mt-6 flex items-baseline gap-4 border-b border-luxe-ink/10 pb-6">
                <span class="font-display text-4xl text-luxe-ink">${{ number_format($product->price, 2) }}</span>
                @if ($product->compare_price)
                    <span class="text-lg text-luxe-muted line-through">${{ number_format($product->compare_price, 2) }}</span>
                @endif
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-3">
                @include('store.partials.star-rating', ['rating' => $averageRating, 'size' => 'md'])
                <span class="text-sm text-luxe-muted">
                    {{ $reviewCount }} {{ Str::plural('Review', $reviewCount) }}
                    <span class="mx-1">/</span>
                    <a href="#reviews" class="text-luxe-gold hover:text-luxe-ink">Add Review</a>
                </span>
            </div>

            <div class="mt-6 text-sm leading-relaxed text-luxe-muted">{!! $product->description !!}</div>
            @if ($product->detail)
                <div class="mt-4 text-sm leading-relaxed text-luxe-muted">{!! $product->detail !!}</div>
            @endif

            <div class="mt-4 flex gap-6 text-xs uppercase tracking-widest">
                <span class="{{ $product->inStock() ? 'text-luxe-ink' : 'text-red-600' }}">{{ $product->inStock() ? 'In Stock' : 'Sold Out' }}</span>
            </div>

            @if ($product->sizes)
                <div class="mt-8">
                    <p class="label-upper">Size</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($product->sizes as $size)
                            <button type="button" @click="selectedSize = '{{ $size }}'" :class="selectedSize === '{{ $size }}' ? 'bg-luxe-ink text-luxe-cream' : 'border-luxe-ink/15 text-luxe-ink'" class="border px-5 py-2.5 text-xs font-medium uppercase tracking-wider transition">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($product->colors)
                <div class="mt-6">
                    <p class="label-upper">Color</p>
                    <div class="mt-3 flex gap-3">
                        @foreach ($product->colors as $color)
                            <button type="button" @click="selectedColor = '{{ $color }}'" :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-luxe-gold ring-offset-2' : ''" class="h-8 w-8 border border-luxe-ink/10 transition" style="background-color: {{ $color }}"></button>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <p class="label-upper">Quantity</p>
                <div class="mt-3 inline-flex items-center border border-luxe-ink/15">
                    <button type="button" @click="qty = Math.max(1, qty - 1)" class="px-4 py-2 text-luxe-muted hover:text-luxe-ink">−</button>
                    <input type="number" x-model="qty" min="1" class="w-14 border-0 bg-transparent text-center text-sm focus:ring-0">
                    <button type="button" @click="qty++" class="px-4 py-2 text-luxe-muted hover:text-luxe-ink">+</button>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-3">
                @if ($product->inStock())
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" x-bind:value="qty">
                        <button type="submit" class="btn-gold">Add to Bag</button>
                    </form>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" x-bind:value="qty">
                        <input type="hidden" name="redirect" value="cart">
                        <button type="submit" class="btn-outline">Buy Now</button>
                    </form>
                @else
                    <button type="button" class="btn-gold cursor-not-allowed opacity-50" disabled>Sold Out</button>
                @endif
                <button type="button" class="btn-outline">Wishlist</button>
                <button type="button" class="btn-icon" title="Compare">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </button>
                <button type="button" class="btn-icon" title="Share" onclick="navigator.share?.({title: '{{ $product->name }}', url: window.location.href})">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="mt-20 border-t border-luxe-ink/10 pt-12" id="reviews" x-data="{ tab: 'reviews' }">
        <div class="flex gap-8 border-b border-luxe-ink/10">
            <button type="button" @click="tab = 'details'" class="pb-4 text-xs font-semibold uppercase tracking-widest transition" :class="tab === 'details' ? 'border-b-2 border-luxe-gold text-luxe-ink' : 'text-luxe-muted hover:text-luxe-ink'">Details</button>
            <button type="button" @click="tab = 'reviews'" class="pb-4 text-xs font-semibold uppercase tracking-widest transition" :class="tab === 'reviews' ? 'border-b-2 border-luxe-gold text-luxe-ink' : 'text-luxe-muted hover:text-luxe-ink'">Reviews ({{ $reviewCount }})</button>
        </div>

        <div x-show="tab === 'details'" class="mt-8 max-w-3xl text-sm leading-relaxed text-luxe-muted">
            @if ($product->detail)
                {!! $product->detail !!}
            @else
                <p>{!! $product->description !!}</p>
            @endif
        </div>

        <div x-show="tab === 'reviews'" x-cloak class="mt-10">
            @if (session('success'))
                <div class="mb-8 border border-luxe-gold/30 bg-luxe-sand px-4 py-3 text-sm text-luxe-ink">{{ session('success') }}</div>
            @endif

            <div class="grid gap-12 lg:grid-cols-2 lg:gap-16">
                <div>
                    <h2 class="font-display text-2xl text-luxe-ink">Customer Reviews</h2>
                    @if ($reviews->isEmpty())
                        <p class="mt-6 text-sm text-luxe-muted">No reviews yet. Be the first to share your experience.</p>
                    @else
                        <ul class="mt-8 space-y-8">
                            @foreach ($reviews as $review)
                                <li class="border-b border-luxe-ink/10 pb-8 last:border-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-luxe-sand text-xs font-semibold uppercase text-luxe-ink">
                                            {{ Str::substr($review->displayName(), 0, 1) }}
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-luxe-ink">{{ $review->displayName() }}</p>
                                            <p class="text-xs text-luxe-muted">{{ $review->created_at->format('d M Y / g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @include('store.partials.star-rating', ['rating' => $review->rate, 'size' => 'sm'])
                                    </div>
                                    <p class="mt-3 text-sm leading-relaxed text-luxe-muted">{{ $review->comment }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="border border-luxe-ink/10 bg-luxe-sand/40 p-6 lg:p-8" x-data="{ rate: {{ old('rate', 5) }} }">
                    <h2 class="font-display text-2xl text-luxe-ink">Write Your Review</h2>
                    <p class="mt-2 text-xs text-luxe-muted">Your review will be published immediately.</p>

                    <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="mt-6 space-y-5">
                        @csrf

                        @guest
                            <div>
                                <label for="reviewer_name" class="label-upper">Your Name</label>
                                <input type="text" name="reviewer_name" id="reviewer_name" value="{{ old('reviewer_name') }}" required class="mt-2 w-full border border-luxe-ink/15 bg-luxe-cream px-4 py-3 text-sm focus:border-luxe-gold focus:ring-0">
                                @error('reviewer_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="reviewer_email" class="label-upper">Email Address</label>
                                <input type="email" name="reviewer_email" id="reviewer_email" value="{{ old('reviewer_email') }}" class="mt-2 w-full border border-luxe-ink/15 bg-luxe-cream px-4 py-3 text-sm focus:border-luxe-gold focus:ring-0">
                                <p class="mt-1 text-xs text-luxe-muted">Your email will not be published.</p>
                                @error('reviewer_email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        @endguest

                        <div>
                            <label for="comment" class="label-upper">Your Review</label>
                            <textarea name="comment" id="comment" rows="5" required class="mt-2 w-full border border-luxe-ink/15 bg-luxe-cream px-4 py-3 text-sm focus:border-luxe-gold focus:ring-0">{{ old('comment') }}</textarea>
                            @error('comment')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <p class="label-upper">Your Rating</p>
                            <div class="mt-3 flex items-center gap-1">
                                @for ($star = 1; $star <= 5; $star++)
                                    <button type="button" @click="rate = {{ $star }}" class="transition hover:scale-110" aria-label="Rate {{ $star }} stars">
                                        <svg class="h-6 w-6" :class="rate >= {{ $star }} ? 'text-luxe-gold' : 'text-luxe-ink/20'" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rate" x-model="rate">
                            @error('rate')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn-gold w-full sm:w-auto">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <div class="mt-24 border-t border-luxe-ink/10 pt-16">
            <h2 class="heading-section">You May Also Like</h2>
            <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
                @foreach ($relatedProducts as $product)
                    @include('store.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
