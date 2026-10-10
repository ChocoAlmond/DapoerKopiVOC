@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="mb-8 flex items-end justify-between gap-4"><div><p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Panel admin</p><h1 class="font-serif text-4xl font-bold text-amber-950">Pesanan Masuk</h1></div><a href="{{ route('admin.menus.index') }}" class="text-sm font-semibold text-amber-800">Kelola produk</a></div>
<div class="overflow-x-auto border border-stone-200 bg-white shadow-sm"><table class="w-full min-w-[700px] text-left text-sm"><thead class="border-b border-stone-200 bg-stone-50 text-xs uppercase tracking-wider text-stone-500"><tr><th class="px-6 py-4">Pesanan</th><th class="px-6 py-4">Pembeli</th><th class="px-6 py-4">Produk</th><th class="px-6 py-4">Total</th><th class="px-6 py-4">Status</th></tr></thead><tbody class="divide-y divide-stone-100">@forelse ($orders as $order)<tr><td class="px-6 py-4 font-semibold">#{{ $order->id }}<div class="text-xs font-normal text-stone-500">{{ $order->created_at->format('d M Y, H:i') }}</div></td><td class="px-6 py-4">{{ $order->user->name }}<div class="text-xs text-stone-500">{{ $order->user->email }}</div></td><td class="px-6 py-4">{{ $order->items->sum('jumlah') }} produk</td><td class="px-6 py-4 font-semibold text-amber-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td><td class="px-6 py-4">Tercatat</td></tr>@empty<tr><td colspan="5" class="px-6 py-12 text-center text-stone-600">Belum ada pesanan.</td></tr>@endforelse</tbody></table></div>
<div class="mt-6">{{ $orders->links() }}</div>
@endsection