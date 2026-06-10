@extends('layouts.store')

@section('title', 'Order #'.$order->id)

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'Order #'.$order->id])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b-2 border-luxe-gold pb-4">
                <h1 class="heading-section">Order #{{ $order->id }}</h1>
                @include('store.partials.order-status', ['order' => $order])
            </div>

            <div class="mt-6 grid gap-4 text-sm sm:grid-cols-2">
                <div><span class="text-luxe-muted">Date:</span> {{ $order->created_at?->format('d M Y H:i') }}</div>
                <div><span class="text-luxe-muted">Total:</span> <strong>${{ number_format($order->total, 2) }}</strong></div>
                <div><span class="text-luxe-muted">Email:</span> {{ $order->email }}</div>
                <div><span class="text-luxe-muted">Phone:</span> {{ $order->phone }}</div>
                <div class="sm:col-span-2"><span class="text-luxe-muted">Address:</span> {{ $order->address }}</div>
                @if ($order->note)
                    <div class="sm:col-span-2"><span class="text-luxe-muted">Note:</span> {{ $order->note }}</div>
                @endif
            </div>

            @if ($order->status === \App\Models\Order::STATUS_APPROVED)
                <div class="mt-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    Your order has been approved. Thank you for shopping with us.
                </div>
            @elseif ($order->status === \App\Models\Order::STATUS_CANCELLED)
                <div class="mt-6 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    Your order was rejected. Please contact support if you have questions.
                </div>
            @else
                <div class="mt-6 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    Your order is pending admin approval.
                </div>
            @endif

            <div class="mt-10 overflow-x-auto border border-luxe-ink/10">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="border-b border-luxe-ink/10 bg-luxe-sand/50 text-xs uppercase tracking-widest text-luxe-muted">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-luxe-ink/10">
                        @foreach ($order->orderProducts as $line)
                            <tr>
                                <td class="px-4 py-4">
                                    <a href="{{ route('products.show', $line->product) }}" class="hover:text-luxe-gold">
                                        {{ $line->product?->name ?? 'Product' }}
                                    </a>
                                </td>
                                <td class="px-4 py-4">${{ number_format($line->price, 2) }}</td>
                                <td class="px-4 py-4">{{ $line->amount }}</td>
                                <td class="px-4 py-4">${{ number_format($line->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('account.orders') }}" class="btn-outline mt-8 inline-flex">Back to Orders</a>
        </div>
    </div>
</section>
@endsection
