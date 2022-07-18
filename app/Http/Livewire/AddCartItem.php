<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $qty = 1; 
    public $book, $quantity;
    public $options = [
        'grade_id'=> null
    ];

    public function mount(){
        $this->quantity = qty_available($this->book->id);
        $this->options['image'] = Storage::url($this->book->images->first()->url);
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add(['id' => $this->book->id, 
                    'name' => $this->book->title, 
                    'qty' => $this->qty, 
                    'price' => 9.99, 
                    'weight' => 550, 
                    'options' => $this->options
                    ]);
        $this->quantity = qty_available($this->book->id);

        $this->reset('qty');

        $this->emitTo('dropdow-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
