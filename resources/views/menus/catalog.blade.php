@extends('layouts.app')

@section('title', 'Katalog Kopi')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-800">Biji kopi sangrai</p>
        <h1 class="font-serif text-4xl font-bold text-amber-950">Pilihan Kopi DKVoc</h1>
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

<form method="GET" action="{{ route('menus.index') }}" class="mb-8 rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
    <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-800">Cari kopi</p>
            <h2 class="mt-1 font-serif text-2xl font-bold text-amber-950">Temukan rasa yang cocok</h2>
        </div>
        @if ($search !== '' || $priceFilter !== 'all' || $sort !== 'newest')
            <a href="{{ route('menus.index') }}" class="text-sm font-semibold text-stone-600 hover:text-amber-900">Reset filter</a>
        @endif
    </div>

    <div class="grid gap-3 md:grid-cols-[1.5fr_0.9fr_0.9fr]">
        <label class="block">
            <span class="mb-1 block text-xs font-semibold uppercase tracking-[0.15em] text-stone-500">Pencarian</span>
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari biji kopi atau deskripsi..."
                class="w-full border border-stone-300 bg-stone-50 px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-amber-800 focus:bg-white"
            >
        </label>

        <label class="block">
            <span class="mb-1 block text-xs font-semibold uppercase tracking-[0.15em] text-stone-500">Range harga</span>
            <select name="price" class="w-full border border-stone-300 bg-stone-50 px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-amber-800 focus:bg-white">
                <option value="all" {{ $priceFilter === 'all' ? 'selected' : '' }}>Semua harga</option>
                <option value="under_20000" {{ $priceFilter === 'under_20000' ? 'selected' : '' }}>Di bawah Rp20.000</option>
                <option value="20000_40000" {{ $priceFilter === '20000_40000' ? 'selected' : '' }}>Rp20.000 - Rp40.000</option>
                <option value="40000_60000" {{ $priceFilter === '40000_60000' ? 'selected' : '' }}>Rp40.000 - Rp60.000</option>
                <option value="above_60000" {{ $priceFilter === 'above_60000' ? 'selected' : '' }}>Di atas Rp60.000</option>
            </select>
        </label>

        <label class="block">
            <span class="mb-1 block text-xs font-semibold uppercase tracking-[0.15em] text-stone-500">Urutkan</span>
            <select name="sort" class="w-full border border-stone-300 bg-stone-50 px-4 py-3 text-sm text-stone-900 outline-none transition focus:border-amber-800 focus:bg-white">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga: terendah</option>
                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga: tertinggi</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Paling lama</option>
            </select>
        </label>
    </div>

    <div class="mt-4 flex items-center justify-between gap-3 border-t border-stone-200 pt-4">
        <p class="text-sm text-stone-600">Menampilkan {{ $menus->total() }} produk</p>
        <button type="submit" class="bg-amber-950 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-900">Terapkan filter</button>
    </div>
</form>

<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($menus as $menu)
        @php($userReview = auth()->check() ? $menu->reviews->firstWhere('user_id', auth()->id()) : null)
        @php($isWishlisted = auth()->check() && auth()->user()->wishlists()->where('menu_id', $menu->id)->exists())
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
                <div class="mt-3 flex items-center justify-between gap-2 text-sm text-stone-600">
                    <span>{{ number_format($menu->averageRating(), 1) }}★</span>
                    <span>{{ $menu->reviewCount() }} ulasan</span>
                </div>
                <p class="mt-3 min-h-12 text-sm leading-6 text-stone-600">{{ $menu->deskripsi ?: 'Biji kopi sangrai pilihan dari DKVoc.' }}</p>
                @auth
                    <div class="mt-4 flex items-center justify-between gap-2">
                        <form action="{{ route('wishlist.toggle', $menu) }}" method="POST">
                            @csrf
                            <button type="submit" class="border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold uppercase tracking-[0.15em] text-red-700 hover:bg-red-100">
                                {{ $isWishlisted ? 'Hapus wishlist' : 'Wishlist' }}
                            </button>
                        </form>
                        <a href="{{ route('wishlist.index') }}" class="text-xs font-semibold uppercase tracking-[0.15em] text-amber-800">Lihat wishlist</a>
                    </div>
                @endauth
                @auth
                <form action="{{ route('cart.store', $menu) }}" method="POST" class="mt-5 flex gap-2">
                    @csrf
                    <input type="number" name="jumlah" value="1" min="1" max="99" aria-label="Jumlah {{ $menu->nama_menu }}" class="w-20 border border-stone-300 px-3 py-2 text-sm">
                    <button type="submit" class="flex-1 bg-amber-950 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">Tambah ke keranjang</button>
                </form>
                <div class="mt-5 border-t border-stone-200 pt-4">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.15em] text-stone-500">Beri rating</p>
                    <form action="{{ route('menus.rate', $menu) }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="flex flex-wrap gap-2">
                            @foreach ([5, 4, 3, 2, 1] as $star)
                                <label class="flex items-center gap-1 rounded border border-stone-200 px-2 py-1 text-xs font-medium text-stone-700">
                                    <input type="radio" name="rating" value="{{ $star }}" {{ $userReview && $userReview->rating === $star ? 'checked' : '' }}>
                                    <span>{{ $star }}★</span>
                                </label>
                            @endforeach
                        </div>
                        <textarea name="review" rows="2" placeholder="Tulis ulasan singkat..." class="w-full resize-none border border-stone-300 bg-stone-50 px-3 py-2 text-sm text-stone-900 outline-none focus:border-amber-800 focus:bg-white">{{ $userReview?->review }}</textarea>
                        <button type="submit" class="w-full bg-stone-900 px-4 py-2 text-sm font-semibold text-white hover:bg-stone-700">Kirim rating</button>
                    </form>
                </div>
                @else
                    <a href="{{ route('login') }}" class="mt-5 flex min-h-10 items-center justify-center bg-amber-950 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">Masuk untuk tambah ke keranjang</a>
                @endauth
            </div>
        </article>
    @empty
        <div class="col-span-full rounded-2xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center">
            <p class="font-serif text-2xl font-bold text-amber-950">Belum ada kopi yang cocok</p>
            <p class="mt-2 text-stone-600">Coba ubah pencarian, range harga, atau urutan untuk menemukan produk yang lebih cocok.</p>
        </div>
    @endforelse
</div>

<div class="mt-8">{{ $menus->links() }}</div>
@endsection