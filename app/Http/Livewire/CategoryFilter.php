<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $subcategoria;

    public $view = 'grid';

    protected $queryString = ['subcategoria'];

    public function limpiar(){
        $this->reset(['subcategoria', 'page']);
    }
    public function updatedSubcategoria(){
        $this->resetPage();
    }
    public function render()
    {

        /* $books = $this->category->books()
                        ->where('status', 2)->paginate(5); */
        $booksQuery = Book::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id);
        });
        if ($this->subcategoria) {
            $booksQuery = $booksQuery->whereHas('subcategory', function(Builder $query){
                $query->where('slug', $this->subcategoria);
            });
        }
        
        $books = $booksQuery->paginate(8);

        return view('livewire.category-filter', compact('books'));
    }
}
