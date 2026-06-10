@props(['order'])

<span {{ $attributes->merge(['class' => 'inline-flex px-3 py-1 text-[10px] font-semibold uppercase tracking-widest '.$order->storeBadgeClass()]) }}>
    {{ $order->statusLabel() }}
</span>
