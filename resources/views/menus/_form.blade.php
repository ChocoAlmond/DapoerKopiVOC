@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="nama_menu" class="mb-2 block text-sm font-semibold text-stone-700">Nama biji kopi / produk</label>
        <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu ?? '') }}" required
            class="w-full border-stone-300 bg-white px-4 py-3 text-stone-900 shadow-sm outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
        @error('nama_menu') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="harga" class="mb-2 block text-sm font-semibold text-stone-700">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga ?? '') }}" min="0" required
            class="w-full border-stone-300 bg-white px-4 py-3 text-stone-900 shadow-sm outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">
        @error('harga') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="foto" class="mb-2 block text-sm font-semibold text-stone-700">Foto produk</label>
        <input type="file" id="foto" name="foto" accept="image/*"
            class="block w-full border border-stone-300 bg-white px-4 py-2.5 text-sm text-stone-600 file:mr-4 file:border-0 file:bg-amber-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-amber-900">
        <p class="mt-1 text-xs text-stone-500">JPG, PNG, WEBP. Maksimal 2 MB.</p>
        @error('foto') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label for="deskripsi" class="mb-2 block text-sm font-semibold text-stone-700">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5"
            class="w-full border-stone-300 bg-white px-4 py-3 text-stone-900 shadow-sm outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-200">{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3 border-t border-stone-200 pt-6">
    <a href="{{ route('admin.menus.index') }}" class="px-4 py-2.5 text-sm font-semibold text-stone-600 transition hover:text-stone-900">Batal</a>
    <button type="submit" class="bg-amber-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-900">{{ $submitLabel }}</button>
</div>
