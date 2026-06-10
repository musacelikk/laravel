@extends('layouts.store')

@section('title', 'My Reviews')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'User Comment'])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <h1 class="heading-section border-b-2 border-luxe-gold pb-4">User Comments & Reviews</h1>

            @if (session('success'))
                <div class="mt-6 border border-luxe-gold/30 bg-luxe-sand px-4 py-3 text-sm">{{ session('success') }}</div>
            @endif

            <div class="mt-8 overflow-x-auto border border-luxe-ink/10">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="border-b border-luxe-ink/10 bg-luxe-sand/50 text-xs uppercase tracking-widest text-luxe-muted">
                        <tr>
                            <th class="px-4 py-3">Id</th>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Review</th>
                            <th class="px-4 py-3">Rate</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-luxe-ink/10">
                        @forelse ($reviews as $review)
                            <tr>
                                <td class="px-4 py-4">{{ $review->id }}</td>
                                <td class="px-4 py-4">
                                    <a href="{{ route('products.show', $review->product) }}" class="font-medium hover:text-luxe-gold">
                                        {{ $review->product?->name ?? '—' }}
                                    </a>
                                </td>
                                <td class="px-4 py-4 text-luxe-muted">{{ Str::limit($review->comment, 80) }}</td>
                                <td class="px-4 py-4">
                                    @include('store.partials.star-rating', ['rating' => $review->rate, 'size' => 'sm'])
                                </td>
                                <td class="px-4 py-4 capitalize">{{ $review->status }}</td>
                                <td class="px-4 py-4">
                                    <form action="{{ route('account.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold uppercase tracking-wider text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-luxe-muted">You have not posted any reviews yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
