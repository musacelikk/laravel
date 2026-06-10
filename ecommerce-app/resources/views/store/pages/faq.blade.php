@extends('layouts.store')

@section('title', 'FAQ')

@section('content')
<section class="mx-auto max-w-2xl px-6 py-16" x-data="{ open: null }">
    <h1 class="heading-section text-center">Questions</h1>
    @foreach ([
        ['q' => 'How long does shipping take?', 'a' => 'Standard delivery is 3–5 business days. Express options available at checkout.'],
        ['q' => 'What is your return policy?', 'a' => '30-day returns on unworn items with original tags attached.'],
        ['q' => 'Do you ship internationally?', 'a' => 'Yes — we deliver to over 50 countries worldwide.'],
        ['q' => 'How do I track my order?', 'a' => 'A tracking link is sent to your email once your order ships.'],
    ] as $index => $faq)
        <div class="mt-6 border-b border-luxe-ink/10">
            <button @click="open = open === {{ $index }} ? null : {{ $index }}" class="flex w-full items-center justify-between py-5 text-left">
                <span class="font-display text-lg">{{ $faq['q'] }}</span>
                <span class="text-luxe-gold text-xl" x-text="open === {{ $index }} ? '−' : '+'"></span>
            </button>
            <div x-show="open === {{ $index }}" x-cloak class="pb-5 text-sm leading-relaxed text-luxe-muted">
                {{ $faq['a'] }}
            </div>
        </div>
    @endforeach
</section>
@endsection
