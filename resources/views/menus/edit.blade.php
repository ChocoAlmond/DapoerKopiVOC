@extends('layouts.app')

@section('title', 'Edit Produk Kopi')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-8">
        <a href="{{ route('admin.menus.index') }}" class="text-sm font-semibold text-amber-800 hover:text-amber-950">← Kembali ke produk</a>
        <h1 class="mt-5 font-serif text-4xl font-bold text-amber-950">Edit Produk Kopi</h1>
        <p class="mt-2 text-stone-600">Perbarui detail {{ $menu->nama_menu }}.</p>
    </div>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
        @method('PUT')
        @if ($menu->foto)
            <div class="mb-6 flex items-center gap-4 border-b border-stone-200 pb-6">
                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="h-20 w-20 object-cover">
                <p class="text-sm text-stone-600">Foto saat ini. Unggah foto baru untuk menggantinya.</p>
            </div>
        @endif
        @include('menus._form', ['submitLabel' => 'Simpan perubahan'])
    </form>
</div>
@endsection
