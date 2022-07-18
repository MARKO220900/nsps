<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart as Cart1;
use Livewire\Component;


class Cart extends Component
{
    protected $listeners =["render"];

    public function destroy(){
        Cart1::destroy();
        $this->emitTo('dropdow-cart', 'render');
    }
    
    public function delete($rowId){
        Cart1::remove($rowId);
        $this->emitTo('dropdow-cart', 'render');
    }


    public function create_order(){
        
        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->content = Cart1::content();

        $order->save();

        foreach (Cart1::content() as $item) {
            discount($item);
        }

        Cart1::destroy();

        return redirect()->route('orders.show', $order);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
