<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemGrade extends Component
{
    public $qty = 1; 
    public $book, $grades; 
    public $grade_id ="";
    public $quantity = 0;

    public $options = [];

    public function mount(){
        $this->grades = $this->book->grades;
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
        $this->quantity = qty_available($this->book->id, $this->grade_id);

        $this->reset('qty');

        $this->emitTo('dropdow-cart', 'render');
    }
    
    public function render()
    {
        return view('livewire.add-cart-item-grade');
    }

    public function updatedGradeId($value){
        $grade = $this->book->grades->find($value);
        $this->quantity = qty_available($this->book->id, $grade->id);
        $this->options['grade'] = $grade->name;
        $this->options['grade_id'] = $grade->id;
    }
}
