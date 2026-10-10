@extends('layouts.guest')

@section('title', 'Register')
@section('intro-heading', 'Temukan teman seduhmu.')
@section('intro-copy', 'Buat akun untuk menjelajahi pilihan biji kopi dan menyimpan produk pilihanmu di keranjang.')

@section('content')
<form action="{{ url('/register') }}" method="POST" class="auth-form">
    @csrf
    <h1 class="font-serif text-3xl font-bold text-amber-950">Buat akun</h1>
    <p class="mt-2 text-sm text-stone-600">Buat akun Dapoer Kopi VOC.</p>

    <div class="mt-6 space-y-5">
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-stone-700">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
            @error('name') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-semibold text-stone-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
            @error('email') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-stone-700">Password</label>
            <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
            @error('password') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-stone-700">Konfirmasi password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" autocomplete="new-password"
                class="w-full border-stone-300 bg-white px-4 py-3 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
        </div>
    </div>

    <button type="submit" class="mt-7 w-full bg-amber-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-amber-900">Daftar</button>
    <p class="mt-6 text-center text-sm text-stone-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-amber-800 hover:text-amber-950">Masuk</a></p>
</form>
@endsection