<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $wishlist = auth()->user()->wishlists()->with('menu')->latest()->get();

        return view('wishlist', [
            'items' => $wishlist,
        ]);
    }

    public function toggle(Request $request, Menu $menu): RedirectResponse
    {
        $existing = auth()->user()->wishlists()->where('menu_id', $menu->id)->first();

        if ($existing) {
            $existing->delete();

            return back()->with('success', $menu->nama_menu.' dihapus dari wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'menu_id' => $menu->id,
        ]);

        return back()->with('success', $menu->nama_menu.' ditambahkan ke wishlist.');
    }
}
