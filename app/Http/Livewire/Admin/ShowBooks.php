<?php

namespace App\Http\Livewire\Admin;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class ShowBooks extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        
        $books = Book::where('title', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.admin.show-books', compact('books'))->layout('layouts.admin');
    }
}
