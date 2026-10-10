@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="mb-8">
    <a href="{{ route('menus.index') }}" class="text-sm font-semibold text-amber-800 hover:text-amber-950">← Kembali ke katalog</a>
    <h1 class="mt-5 font-serif text-4xl font-bold text-amber-950">Keranjang Anda</h1>
</div>

@if (session('error'))
    <div class="mb-6 border-l-4 border-red-600 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
@endif

@if ($cart === [])
    <div class="border border-stone-200 bg-white px-6 py-16 text-center shadow-sm">
        <h2 class="font-serif text-2xl font-bold text-amber-950">Keranjang masih kosong</h2>
        <a href="{{ route('menus.index') }}" class="mt-5 inline-block bg-amber-950 px-5 py-3 text-sm font-semibold text-white">Lihat katalog</a>
    </div>
@else
    <div class="grid gap-8 lg:grid-cols-[1fr_20rem]">
        <div class="divide-y divide-stone-200 border border-stone-200 bg-white shadow-sm">
            @foreach ($cart as $item)
                <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="font-serif text-xl font-bold text-amber-950">{{ $item['nama_menu'] }}</h2>
                        <p class="mt-1 text-sm text-stone-600">Rp {{ number_format($item['harga'], 0, ',', '.') }} per menu</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <form action="{{ route('cart.update', $item['menu_id']) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" max="99" aria-label="Jumlah {{ $item['nama_menu'] }}" class="w-20 border border-stone-300 px-3 py-2 text-sm">
                            <button type="submit" class="text-sm font-semibold text-amber-800">Update</button>
                        </form>
                        <form action="{{ route('cart.destroy', $item['menu_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-semibold text-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <aside class="h-fit border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Ringkasan</h2>
            <div class="mt-5 flex justify-between border-t border-stone-200 pt-4 font-semibold"><span>Total</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="mt-6 w-full bg-amber-950 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-900">Beli sekarang</button>
            </form>
        </aside>
    </div>
@endif
@endsection