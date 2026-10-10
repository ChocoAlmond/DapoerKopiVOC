<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        return view('cart.index', [
            'cart' => $cart,
            'total' => collect($cart)->sum(fn (array $item): int => $item['harga'] * $item['jumlah']),
        ]);
    }

    public function store(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = $request->session()->get('cart', []);
        $id = (string) $menu->id;
        $jumlah = $validated['jumlah'] ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = min($cart[$id]['jumlah'] + $jumlah, 99);
        } else {
            $cart[$id] = [
                'menu_id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'foto' => $menu->foto,
                'jumlah' => $jumlah,
            ];
        }

        $request->session()->put('cart', $cart);

        return to_route('menus.index')->with('success', $menu->nama_menu.' ditambahkan ke keranjang.');
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah' => ['required', 'integer', 'min:1', 'max:99'],
        ]);
        $cart = $request->session()->get('cart', []);
        $id = (string) $menu->id;

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = $validated['jumlah'];
            $request->session()->put('cart', $cart);
        }

        return to_route('cart.index');
    }

    public function destroy(Request $request, Menu $menu): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[(string) $menu->id]);
        $request->session()->put('cart', $cart);

        return to_route('cart.index');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if ($cart === []) {
            return to_route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $total = collect($cart)->sum(fn (array $item): int => $item['harga'] * $item['jumlah']);

        $order = DB::transaction(function () use ($cart, $total): Order {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'simulated',
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'menu_id' => $item['menu_id'],
                    'nama_menu' => $item['nama_menu'],
                    'harga' => $item['harga'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['harga'] * $item['jumlah'],
                ]);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return to_route('orders.index')->with('success', 'Pesanan #'.$order->id.' berhasil dibuat.');
    }
}