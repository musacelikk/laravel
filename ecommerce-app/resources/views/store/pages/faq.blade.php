@extends('layouts.store')

@section('title', 'FAQ')

@section('content')
<section class="border-b border-luxe-ink/10 px-6 py-6">
    <div class="mx-auto max-w-[900px]">
        <nav class="label-upper !text-luxe-muted">
            <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
            <span class="mx-2">/</span>
            <span class="text-luxe-ink">FAQ</span>
        </nav>
    </div>
</section>

<section class="mx-auto max-w-[900px] px-6 py-16" x-data="{ open: {{ $faqs->isNotEmpty() ? 0 : 'null' }} }">
    <p class="label-upper text-center">Support</p>
    <h1 class="heading-section mt-3 text-center">Frequently Asked Questions</h1>
    <p class="mx-auto mt-4 max-w-xl text-center text-sm leading-relaxed text-luxe-muted">
        Find quick answers about shipping, returns, orders, and more.
    </p>

    @if ($faqs->isEmpty())
        <p class="mt-12 text-center text-sm text-luxe-muted">No questions have been published yet.</p>
    @else
        <div class="mt-12 divide-y divide-luxe-ink/10 border border-luxe-ink/10">
            @foreach ($faqs as $index => $faq)
                <div class="bg-luxe-cream">
                    <button
                        type="button"
                        @click="open = open === {{ $index }} ? null : {{ $index }}"
                        class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left transition hover:bg-luxe-sand/60"
                        :aria-expanded="open === {{ $index }}"
                    >
                        <span class="font-display text-lg text-luxe-ink">{{ $faq->question }}</span>
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center border border-luxe-ink/15 text-lg text-luxe-gold" x-text="open === {{ $index }} ? '−' : '+'"></span>
                    </button>
                    <div
                        x-show="open === {{ $index }}"
                        x-cloak
                        class="border-t border-luxe-ink/5 px-6 pb-6 pt-2 text-sm leading-relaxed text-luxe-muted"
                    >
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
