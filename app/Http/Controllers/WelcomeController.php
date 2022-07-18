<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;

class WelcomeController extends Controller
{
    public function __invoke(){

        if (auth()->user()) {
            $entregado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
            if ($entregado) {
                $mensaje = "Tienes $entregado préstamos por entregar. <a class='font-bold' href='" . route('orders.index') ."?status=3'>Ver</a>";
                session()->flash('flash.banner', $mensaje);
            }
            
        }
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
}
