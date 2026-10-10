@extends('layouts.app')

@section('title', 'Katalog Kopi')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Biji kopi sangrai</p>
        <h1 class="font-serif text-4xl font-bold text-amber-950">Pilihan Kopi Dapoer Kopi VOC</h1>
        <p class="mt-2 text-stone-600">Pilih biji kopi untuk seduhan di rumah.</p>
    </div>
    @auth
    <div class="flex gap-3">
        <a href="{{ route('orders.index') }}" class="border border-stone-300 px-4 py-3 text-sm font-semibold text-stone-700 hover:border-amber-800 hover:text-amber-900">Pesanan saya</a>
        <a href="{{ route('cart.index') }}" class="bg-amber-950 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-900">Keranjang ({{ count(session('cart', [])) }})</a>
    </div>
    @else
        <a href="{{ route('login') }}" class="bg-amber-950 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-900">Masuk untuk belanja</a>
    @endauth
</div>

@if (session('error'))
    <div class="mb-6 border-l-4 border-red-600 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
@endif

<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($menus as $menu)
        <article class="overflow-hidden border border-stone-200 bg-white shadow-sm">
            @if ($menu->foto)
                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="h-48 w-full object-cover">
            @else
                <div class="flex h-48 items-center justify-center bg-amber-100 text-6xl text-amber-900">☕</div>
            @endif
            <div class="p-5">
                <div class="flex items-start justify-between gap-3">
                    <h2 class="font-serif text-2xl font-bold text-amber-950">{{ $menu->nama_menu }}</h2>
                    <span class="whitespace-nowrap text-sm font-semibold text-amber-800">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                </div>
                <p class="mt-3 min-h-12 text-sm leading-6 text-stone-600">{{ $menu->deskripsi ?: 'Biji kopi sangrai pilihan dari Dapoer Kopi VOC.' }}</p>
                @auth
                <form action="{{ route('cart.store', $menu) }}" method="POST" class="mt-5 flex gap-2">
                    @csrf
                    <input type="number" name="jumlah" value="1" min="1" max="99" aria-label="Jumlah {{ $menu->nama_menu }}" class="w-20 border border-stone-300 px-3 py-2 text-sm">
                    <button type="submit" class="flex-1 bg-amber-950 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">Tambah ke keranjang</button>
                </form>
                @else
                    <a href="{{ route('login') }}" class="mt-5 flex min-h-10 items-center justify-center bg-amber-950 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">Masuk untuk tambah ke keranjang</a>
                @endauth
            </div>
        </article>
    @empty
        <p class="text-stone-600">Belum ada biji kopi yang tersedia.</p>
    @endforelse
</div>

<div class="mt-8">{{ $menus->links() }}</div>
@endsection