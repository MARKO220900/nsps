<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Grade;

class UpdateCartItemGrade extends Component
{
    public $rowId, $qty, $quantity;
    
    public function mount(){
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;

        $grade = Grade::where('name', $item->options->grade)->first();

        $this->quantity = qty_available($item->id, $grade->id);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;

        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }
    public function increment(){
        $this->qty = $this->qty + 1;

        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }
    
    public function render()
    {
        return view('livewire.update-cart-item-grade');
    }
}
