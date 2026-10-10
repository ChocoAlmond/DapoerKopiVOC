@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="mb-8 flex items-end justify-between gap-4">
    <div><p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Riwayat</p><h1 class="font-serif text-4xl font-bold text-amber-950">Pesanan Saya</h1></div>
    <a href="{{ route('menus.index') }}" class="text-sm font-semibold text-amber-800">Kembali ke katalog</a>
</div>
@if (session('success')) <div class="mb-6 border-l-4 border-emerald-600 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div> @endif
<div class="space-y-5">
    @forelse ($orders as $order)
        <article class="border border-stone-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap justify-between gap-3 border-b border-stone-200 pb-4"><h2 class="font-semibold text-amber-950">Pesanan #{{ $order->id }}</h2><span class="text-sm text-stone-500">{{ $order->created_at->format('d M Y, H:i') }}</span></div>
            <ul class="divide-y divide-stone-100">@foreach ($order->items as $item)<li class="flex justify-between gap-4 py-3 text-sm"><span>{{ $item->nama_menu }} × {{ $item->jumlah }}</span><span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span></li>@endforeach</ul>
            <div class="mt-3 flex justify-between border-t border-stone-200 pt-4 font-semibold"><span>Total</span><span class="text-amber-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span></div>
        </article>
    @empty
        <div class="border border-stone-200 bg-white px-6 py-12 text-center text-stone-600">Belum ada pembelian.</div>
    @endforelse
</div>
@endsection