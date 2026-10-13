@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Favoritku</p>
        <h1 class="font-serif text-4xl font-bold text-amber-950">Wishlist kopi pilihan</h1>
    </div>
    <a href="{{ route('menus.index') }}" class="bg-amber-950 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-900">Lanjutkan belanja</a>
</div>

@if ($items->isEmpty())
    <div class="rounded-2xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center">
        <p class="font-serif text-2xl font-bold text-amber-950">Belum ada kopi favorit</p>
        <p class="mt-2 text-stone-600">Simpan kopi yang ingin kamu coba lagi dari katalog.</p>
    </div>
@else
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($items as $item)
            @php($menu = $item->menu)
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
                    <p class="mt-3 text-sm leading-6 text-stone-600">{{ $menu->deskripsi ?: 'Kopi pilihan dari DKVoc.' }}</p>
                    <div class="mt-5 flex gap-2">
                        <form action="{{ route('wishlist.toggle', $menu) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">Hapus wishlist</button>
                        </form>
                        <form action="{{ route('cart.store', $menu) }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="jumlah" value="1">
                            <button type="submit" class="w-full bg-amber-950 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">Tambah</button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endif
@endsection
