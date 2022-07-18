<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public $open = false;

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function render()
    {
        if ($this->search) {
            $books = Book::where('title', 'LIKE', "%". $this->search . "%")
                        ->where('status',2)
                        ->take(6)
                        ->get();
        }else{
            $books = [];
        }
        return view('livewire.search', compact('books'));
    }
}
