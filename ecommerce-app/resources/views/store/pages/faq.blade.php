@extends('layouts.store')

@section('title', 'FAQ')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-14 lg:px-8" x-data="{ open: null }">
    <h1 class="section-title">Frequently <span>Asked</span></h1>
    @foreach ([
        ['q' => 'How long does shipping take?', 'a' => 'Standard shipping takes 3-5 business days. Express shipping is available at checkout.'],
        ['q' => 'What is your return policy?', 'a' => 'We offer 30-day hassle-free returns on all unused items in original packaging.'],
        ['q' => 'Do you ship internationally?', 'a' => 'Yes, we ship to over 50 countries worldwide.'],
        ['q' => 'How can I track my order?', 'a' => 'Once shipped, you will receive a tracking number via email.'],
    ] as $index => $faq)
        <div class="card mt-4 overflow-hidden">
            <button @click="open = open === {{ $index }} ? null : {{ $index }}" class="flex w-full items-center justify-between px-6 py-5 text-left font-semibold text-zinc-800">
                {{ $faq['q'] }}
                <svg class="h-5 w-5 text-primary-500 transition" :class="open === {{ $index }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open === {{ $index }}" x-cloak class="border-t border-surface-100 px-6 py-4 text-sm leading-relaxed text-zinc-500">
                {{ $faq['a'] }}
            </div>
        </div>
    @endforeach
</div>
@endsection
