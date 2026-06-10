<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-SHOP') — Boutique Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased" x-data="{ mobileMenu: false }">

    @include('store.partials.topbar')
    @include('store.partials.header')
    @include('store.partials.nav')

    @if (session('success'))
        <div class="bg-primary-600 px-4 py-3 text-center text-sm font-medium text-white">
            {{ session('success') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('store.partials.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
