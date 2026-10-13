<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('items')->where('user_id', Auth::id())->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function dashboard(): View
    {
        $totalRevenue = Order::sum('total');
        $totalOrders = Order::count();
        $averageOrderValue = (float) Order::avg('total') ?: 0.0;
        $itemsSold = OrderItem::sum('jumlah');

        $menuBreakdown = OrderItem::with('menu')
            ->get()
            ->groupBy('menu_id')
            ->map(function ($items): array {
                $menu = $items->first()->menu;

                return [
                    'label' => $menu?->nama_menu ?? 'Produk tidak tersedia',
                    'value' => (int) $items->sum('subtotal'),
                ];
            })
            ->sortByDesc('value')
            ->values();

        $topMenu = $menuBreakdown->first();

        $recentOrders = Order::with(['user', 'items'])->latest()->take(5)->get();
        $topMenus = Menu::with('reviews')->get()->map(function (Menu $menu): array {
            return [
                'menu' => $menu,
                'average_rating' => $menu->averageRating(),
                'review_count' => $menu->reviewCount(),
            ];
        })->sortByDesc('average_rating')->take(3)->values();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'itemsSold',
            'menuBreakdown',
            'topMenu',
            'recentOrders',
            'topMenus'
        ));
    }

    public function adminIndex(): View
    {
        $orders = Order::with(['user', 'items'])->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }
}