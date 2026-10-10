@extends('layouts.guest')

@section('title', 'Login')
@section('intro-heading', 'Selamat datang kembali.')
@section('intro-copy', 'Masuk untuk menjelajahi katalog biji kopi, mencoba keranjang, dan melihat riwayat pesanan.')

@section('content')
<form action="{{ url('/login') }}" method="POST" class="auth-form">
    @csrf
    <h1 class="font-serif text-3xl font-bold text-amber-950">Masuk</h1>
    <p class="mt-2 text-sm text-stone-600">Masuk ke akun Dapoer Kopi VOC.</p>

    <div class="mt-6 space-y-5">
        <div>
            <label for="email" class="mb-2 block text-sm font-semibold text-stone-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
            @error('email') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-stone-700">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
            @error('password') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-stone-600">
            <input type="checkbox" name="remember" value="1" class="border-stone-300 text-amber-900 focus:ring-amber-700">
            Ingat saya
        </label>
    </div>

    <button type="submit" class="mt-7 w-full bg-amber-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-amber-900">Masuk</button>
    <p class="mt-6 text-center text-sm text-stone-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-amber-800 hover:text-amber-950">Daftar</a></p>
</form>
@endsection