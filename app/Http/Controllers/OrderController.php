<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('items')->where('user_id', Auth::id())->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function adminIndex(): View
    {
        $orders = Order::with(['user', 'items'])->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }
}