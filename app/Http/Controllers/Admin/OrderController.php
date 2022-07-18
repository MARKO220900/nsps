<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::query();

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente = Order::where('status', 1)->count();
        $aceptado = Order::where('status', 2)->count();
        $entregado = Order::where('status', 3)->count();
        $devuelto = Order::where('status', 5)->count();
        $rechazado = Order::where('status', 7)->count();


        return view('admin.orders.index', compact('orders', 'pendiente', 'aceptado', 'entregado', 'devuelto', 'rechazado'));
    }

    public function show(Order $order){
        return view('admin.orders.show', compact('order'));
    }
}
