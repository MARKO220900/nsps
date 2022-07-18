<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(){

        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $aceptado = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $devuelto = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();
        $rechazado = Order::where('status', 7)->where('user_id', auth()->user()->id)->count();

        return view('orders.index', compact('orders', 'pendiente', 'aceptado', 'entregado', 'devuelto', 'rechazado'));
    }


    public function show(Order $order){

        $this->authorize('author', $order);
        $items = json_decode($order->content);

        return view ('orders.show', compact('order', 'items'));
    }
}
