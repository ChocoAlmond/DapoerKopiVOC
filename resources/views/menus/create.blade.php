@extends('layouts.app')

@section('title', 'Tambah Produk Kopi')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-8">
        <a href="{{ route('admin.menus.index') }}" class="text-sm font-semibold text-amber-800 hover:text-amber-950">← Kembali ke produk</a>
        <h1 class="mt-5 font-serif text-4xl font-bold text-amber-950">Tambah Produk Kopi</h1>
        <p class="mt-2 text-stone-600">Tambahkan biji kopi sangrai ke katalog toko.</p>
    </div>

    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
        @include('menus._form', ['submitLabel' => 'Simpan produk'])
    </form>
</div>
@endsection
