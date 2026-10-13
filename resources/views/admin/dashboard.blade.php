@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
@php($chartMax = $menuBreakdown->max('value') ?? 0)

<div class="mb-8 flex items-end justify-between gap-4">
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Panel admin</p>
        <h1 class="font-serif text-4xl font-bold text-amber-950">Dashboard DKVoc</h1>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="text-sm font-semibold text-amber-800">Kelola produk</a>
</div>

<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Total pendapatan</p>
        <h2 class="mt-4 font-serif text-4xl font-bold text-amber-950">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
    </div>
    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Pesanan</p>
        <h2 class="mt-4 font-serif text-4xl font-bold text-amber-950">{{ $totalOrders }}</h2>
    </div>
    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Rata-rata order</p>
        <h2 class="mt-4 font-serif text-4xl font-bold text-amber-950">Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</h2>
    </div>
    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Produk terjual</p>
        <h2 class="mt-4 font-serif text-4xl font-bold text-amber-950">{{ $itemsSold }}</h2>
    </div>
</div>

<div class="mt-10 grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between gap-3">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Penjualan per menu</h2>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Revenue</span>
        </div>

        <div class="flex h-64 items-end gap-3 overflow-x-auto pb-2">
            @forelse ($menuBreakdown as $item)
                @php($percentage = $chartMax > 0 ? ($item['value'] / $chartMax) * 100 : 0)
                <div class="flex min-w-[72px] flex-1 flex-col items-center justify-end gap-3">
                    <span class="text-xs font-semibold text-stone-600">Rp {{ number_format($item['value'], 0, ',', '.') }}</span>
                    <div class="flex h-full w-full items-end rounded-t-lg bg-gradient-to-t from-amber-800 to-amber-400" style="height: {{ max($percentage, 12) }}%"></div>
                    <span class="text-center text-[10px] font-medium uppercase tracking-[0.12em] text-stone-500">{{ substr($item['label'], 0, 12) }}</span>
                </div>
            @empty
                <div class="text-sm text-stone-600">Belum ada data penjualan.</div>
            @endforelse
        </div>
    </div>

    <div class="border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-serif text-2xl font-bold text-amber-950">Highlight</h2>
        <div class="mt-6 space-y-4">
            <div class="rounded-xl border border-stone-200 bg-stone-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Menu paling laris</p>
                <p class="mt-3 font-serif text-2xl font-bold text-amber-950">{{ $topMenu['label'] ?? 'Belum ada data' }}</p>
                <p class="mt-2 text-sm text-stone-600">Rp {{ number_format($topMenu['value'] ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-xl border border-stone-200 bg-stone-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Status toko</p>
                <p class="mt-3 font-serif text-2xl font-bold text-amber-950">Tersedia</p>
                <p class="mt-2 text-sm text-stone-600">Sistem siap menerima order baru.</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-10 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="border border-stone-200 bg-white shadow-sm">
        <div class="border-b border-stone-200 px-6 py-4">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Pesanan terbaru</h2>
        </div>
        <div class="divide-y divide-stone-100">
            @forelse ($recentOrders as $order)
                <div class="flex flex-col gap-2 px-6 py-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="font-semibold text-stone-900">#{{ $order->id }} · {{ $order->user->name }}</p>
                        <p class="text-sm text-stone-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <p class="font-semibold text-amber-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-stone-500">{{ $order->status }}</p>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center text-stone-600">Belum ada pesanan.</div>
            @endforelse
        </div>
    </div>

    <div class="border border-stone-200 bg-white shadow-sm">
        <div class="border-b border-stone-200 px-6 py-4">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Produk unggulan</h2>
        </div>
        <div class="space-y-4 p-6">
            @forelse ($topMenus as $entry)
                @php($menu = $entry['menu'])
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="font-semibold text-stone-900">{{ $menu->nama_menu }}</p>
                            <p class="text-xs text-stone-500">{{ $entry['review_count'] }} ulasan</p>
                        </div>
                        <span class="font-semibold text-amber-900">{{ number_format($entry['average_rating'], 1) }}★</span>
                    </div>
                </div>
            @empty
                <div class="text-sm text-stone-600">Belum ada rating untuk produk.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
