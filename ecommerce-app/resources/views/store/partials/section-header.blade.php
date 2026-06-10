@props(['eyebrow' => null, 'title', 'actionUrl' => null, 'actionLabel' => 'View All'])

<div class="section-divider flex items-end justify-between gap-6">
    <div>
        @if ($eyebrow)
            <p class="label-upper">{{ $eyebrow }}</p>
        @endif
        <h2 class="heading-section {{ $eyebrow ? 'mt-2' : '' }}">{{ $title }}</h2>
    </div>
    @if ($actionUrl)
        <a href="{{ $actionUrl }}" class="label-upper shrink-0 hover:text-luxe-gold">{{ $actionLabel }}</a>
    @endif
</div>
