@extends('layouts.store')

@section('title', 'My Orders')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'My Orders'])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <h1 class="heading-section border-b-2 border-luxe-gold pb-4">My Orders</h1>

            <div class="mt-8 overflow-x-auto border border-luxe-ink/10">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="border-b border-luxe-ink/10 bg-luxe-sand/50 text-xs uppercase tracking-widest text-luxe-muted">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-luxe-ink/10">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="px-4 py-4 font-medium">#{{ $order->id }}</td>
                                <td class="px-4 py-4 text-luxe-muted">{{ $order->created_at?->format('d M Y') }}</td>
                                <td class="px-4 py-4">${{ number_format($order->total, 2) }}</td>
                                <td class="px-4 py-4 capitalize">{{ $order->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-12 text-center text-luxe-muted">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
