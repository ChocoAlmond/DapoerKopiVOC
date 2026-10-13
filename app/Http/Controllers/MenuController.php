<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $query = Menu::query()->with(['reviews.user', 'wishlists']);
        $search = trim((string) $request->query('search', ''));
        $priceFilter = (string) $request->query('price', 'all');
        $sort = (string) $request->query('sort', 'newest');

        if ($search !== '') {
            $query->where(function ($menuQuery) use ($search): void {
                $menuQuery->where('nama_menu', 'like', '%'.$search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        if ($priceFilter !== 'all') {
            match ($priceFilter) {
                'under_20000' => $query->where('harga', '<', 20000),
                '20000_40000' => $query->whereBetween('harga', [20000, 40000]),
                '40000_60000' => $query->whereBetween('harga', [40000, 60000]),
                'above_60000' => $query->where('harga', '>', 60000),
                default => null,
            };
        }

        match ($sort) {
            'price_asc' => $query->orderBy('harga'),
            'price_desc' => $query->orderByDesc('harga'),
            'oldest' => $query->oldest(),
            default => $query->latest(),
        };

        $menus = $query->paginate(9)->appends([
            'search' => $search,
            'price' => $priceFilter,
            'sort' => $sort,
        ]);

        $view = request()->routeIs('admin.*') ? 'menus.index' : 'menus.catalog';

        return view($view, compact('menus', 'search', 'priceFilter', 'sort'));
    }

    public function rate(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string', 'max:1000'],
        ]);

        $menu->reviews()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'rating' => $validated['rating'],
                'review' => trim((string) ($validated['review'] ?? '')) ?: null,
            ]
        );

        return back()->with('success', 'Ulasan dan rating untuk '.$menu->nama_menu.' berhasil disimpan.');
    }

    public function create(): View
    {
        return view('menus.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menus', 'public');
        }

        Menu::create($validated);

        return to_route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu): View
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }

            $validated['foto'] = $request->file('foto')->store('menus', 'public');
        }

        $menu->update($validated);

        return to_route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return to_route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}