@extends('layouts.app')

@section('title', 'Kelola Produk Kopi')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Panel pengelola</p>
        <h1 class="font-serif text-4xl font-bold text-amber-950">Produk Kopi</h1>
        <p class="mt-2 text-stone-600">Kelola biji kopi sangrai yang tampil di katalog.</p>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center justify-center bg-amber-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-amber-900">+ Tambah produk</a>
</div>

<div class="overflow-hidden border border-stone-200 bg-white shadow-sm">
    @if ($menus->isEmpty())
        <div class="px-6 py-16 text-center">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Belum ada produk kopi</h2>
            <p class="mt-2 text-stone-600">Tambahkan biji kopi sangrai pertama ke katalog.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="border-b border-stone-200 bg-stone-50 text-xs uppercase tracking-wider text-stone-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Produk</th>
                        <th class="px-6 py-4 font-semibold">Harga</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach ($menus as $menu)
                        <tr class="align-middle hover:bg-stone-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($menu->foto)
                                        <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="h-14 w-14 object-cover">
                                    @else
                                        <div class="flex h-14 w-14 items-center justify-center bg-amber-100 text-xl text-amber-900">☕</div>
                                    @endif
                                    <span class="font-semibold text-stone-900">{{ $menu->nama_menu }}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-amber-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td class="max-w-sm px-6 py-4 text-stone-600">{{ $menu->deskripsi ?: '—' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="font-semibold text-amber-800 hover:text-amber-950">Edit</a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-700 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($menus->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">{{ $menus->links() }}</div>
        @endif
    @endif
</div>
@endsection
