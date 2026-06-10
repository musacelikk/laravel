<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-SHOP')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ menuOpen: false, searchOpen: false, userMenuOpen: false }">

    @include('store.partials.header')

    @if (session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="flash-error">{{ session('error') }}</div>
    @endif

    @yield('content')

    @include('store.partials.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
