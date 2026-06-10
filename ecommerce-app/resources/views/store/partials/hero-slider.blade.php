@php
    $slides = collect($slides)->map(function ($slide) {
        if (isset($slide['route_param'])) {
            $slide['url'] = route($slide['route'], $slide['route_param']);
        } else {
            $slide['url'] = route($slide['route']);
        }

        return $slide;
    });
@endphp

<section
    class="relative overflow-hidden bg-luxe-charcoal"
    x-data="{
        current: 0,
        total: {{ $slides->count() }},
        autoplay: null,
        go(i) { this.current = (i + this.total) % this.total },
        next() { this.go(this.current + 1) },
        prev() { this.go(this.current - 1) },
        start() { this.autoplay = setInterval(() => this.next(), 5000) },
        stop() { clearInterval(this.autoplay) }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
>
    <div class="relative aspect-[16/7] min-h-[320px] md:min-h-[420px] lg:min-h-[520px]">
        @foreach ($slides as $index => $slide)
            <div
                x-show="current === {{ $index }}"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
                @if ($index > 0) x-cloak @endif
            >
                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-luxe-ink/80 via-luxe-ink/40 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="mx-auto w-full max-w-[1400px] px-6 lg:px-16">
                        <p class="label-upper !text-luxe-gold">{{ $slide['eyebrow'] }}</p>
                        <h2 class="mt-4 max-w-xl font-display text-4xl text-luxe-cream md:text-5xl lg:text-6xl">{{ $slide['title'] }}</h2>
                        <p class="mt-4 max-w-md text-sm leading-relaxed text-luxe-cream/80">{{ $slide['subtitle'] }}</p>
                        <a href="{{ $slide['url'] }}" class="btn-gold mt-8 !bg-luxe-gold !text-luxe-ink hover:!opacity-90">{{ $slide['cta'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button type="button" @click="prev()" class="absolute left-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center border border-luxe-cream/30 bg-luxe-ink/40 text-luxe-cream backdrop-blur-sm transition hover:bg-luxe-ink/70" aria-label="Previous slide">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" @click="next()" class="absolute right-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center border border-luxe-cream/30 bg-luxe-ink/40 text-luxe-cream backdrop-blur-sm transition hover:bg-luxe-ink/70" aria-label="Next slide">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <div class="absolute bottom-6 left-0 right-0 z-10 flex justify-center gap-2">
        @foreach ($slides as $index => $slide)
            <button
                type="button"
                @click="go({{ $index }})"
                class="h-1.5 transition-all"
                :class="current === {{ $index }} ? 'w-8 bg-luxe-gold' : 'w-3 bg-luxe-cream/40'"
                aria-label="Go to slide {{ $index + 1 }}"
            ></button>
        @endforeach
    </div>
</section>
