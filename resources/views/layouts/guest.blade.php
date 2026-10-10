<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Dapoer Kopi VOC') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="auth-page">
    <div class="auth-shell">
        <header class="auth-header">
            <a href="{{ url('/') }}" class="auth-brand">Dapoer Kopi VOC<small>BIJI KOPI SANGRAI PILIHAN</small></a>
            <a href="{{ url('/') }}" class="auth-home-link">Kembali ke beranda</a>
        </header>

        <main class="auth-main">
            <section class="auth-intro">
                <div class="eyebrow">DAPOER KOPI VOC</div>
                <h1>@yield('intro-heading')</h1>
                <p>@yield('intro-copy')</p>
                <img class="auth-photo" src="{{ asset('images/DapoerKOpiFotoBijiKopi2.png') }}" alt="Biji kopi sangrai untuk diseduh di rumah">
            </section>
            <section class="auth-form-area">
                @if (session('success'))
                    <div class="mb-5 border-l-4 border-emerald-700 bg-emerald-50 px-4 py-3 text-sm text-emerald-900" role="status">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </section>
        </main>
        <footer class="auth-footer">Kopi untuk jeda sehari-hari · {{ date('Y') }}</footer>
    </div>
</body>
</html>