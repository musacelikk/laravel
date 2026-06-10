@props(['title'])

<nav class="label-upper !text-luxe-muted">
    <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
    <span class="mx-2">/</span>
    <span class="text-luxe-ink">{{ $title }}</span>
</nav>
