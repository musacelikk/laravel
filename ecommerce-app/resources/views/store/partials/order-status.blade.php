@props(['order'])

@php
    $class = match ($order->status) {
        \App\Models\Order::STATUS_APPROVED => 'status-approved',
        \App\Models\Order::STATUS_CANCELLED => 'status-cancelled',
        default => 'status-pending',
    };
@endphp

<span {{ $attributes->merge(['class' => $class]) }} aria-label="{{ $order->statusLabel() }}">
    {{ $order->statusLabel() }}
</span>
