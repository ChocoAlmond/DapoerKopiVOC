<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kelola Menu') - {{ config('app.name', 'DKVoc') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/DapoerKopiIcon.png') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="app-page min-h-screen text-stone-900">
    <header class="app-header border-b">
        <div class="app-header-inner">
            <a href="{{ url('/') }}" class="app-brand inline-flex items-center gap-3 text-2xl font-bold text-amber-950">
                <img src="{{ asset('images/DapoerKopiIcon.png') }}" alt="" aria-hidden="true" class="size-10 shrink-0 object-contain">
                <span>DKVoc</span>
            </a>
            <nav class="app-nav" aria-label="Navigasi akun">
                <a href="{{ url('/') }}" class="font-medium text-stone-600">Beranda</a>
                <a href="{{ route('menus.index') }}" class="font-medium text-stone-600">Katalog kopi</a>
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-amber-800">Dashboard</a>
                        <a href="{{ route('admin.menus.index') }}" class="font-semibold text-amber-800">Kelola produk</a>
                        <a href="{{ route('admin.orders.index') }}" class="font-semibold text-amber-800">Pesanan masuk</a>
                    @else
                        <a href="{{ route('wishlist.index') }}" class="font-semibold text-stone-600">Wishlist</a>
                        <a href="{{ route('orders.index') }}" class="font-semibold text-stone-600">Pesanan saya</a>
                        <a href="{{ route('cart.index') }}" class="app-nav-cta">Keranjang ({{ count(session('cart', [])) }})</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-semibold text-red-700">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-stone-600">Masuk</a>
                    <a href="{{ route('register') }}" class="app-nav-cta">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="app-main py-10">
        @if (session('success'))
            <div class="mb-6 border-l-4 border-emerald-600 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 border-l-4 border-red-600 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
