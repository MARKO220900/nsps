<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateBook extends Component
{

    public $categories, $subcategories=[], $authors=[];

    public $category_id ="", $subcategory_id="", $author, $idioma = "";

    public $title, $slug, $description, $isbn_number, $paginas, $año, $editorial, $quantity;
    
    public $isbn = 0;

    public $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'title' => 'required',
        'slug' => 'required|unique:books',
        'isbn' => 'required',
        'author' => 'required',
        'idioma' => 'required',
        'paginas' => 'required',
        'editorial' => 'required',
        'año' => 'required',
        'description' => 'required'
    ];

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        
        $this->reset(['subcategory_id']);
    }

    public function updatedTitle($value){
        $this->slug = Str::slug($value);
    }

    public function getSubcategoryProperty(){
        return Subcategory::find($this->subcategory_id);
    }

    public function mount(){
        $this->categories = Category::all();
    }
    public function updatedIsbn($value){
        if ($value == 1) {
            $this->resetValidation([
                'isbn_number'
            ]);
        }
    }

    public function save(){
        $rules = $this->rules;
        if ($this->isbn ==1) {
            $rules['isbn_number'] = 'required';
        }
        if ($this->subcategory_id) {
            if (!$this->subcategory->grade) {
                $rules['quantity'] = 'required';   
            }
        }
        $this->validate($rules);

        $book = new Book();

        $book->title = $this->title;
        $book->slug = $this->slug;
        $book->subcategory_id = $this->subcategory_id;
        $book->author = $this->author;
        $book->isbn = $this->isbn;
        if ($this->isbn ==1) {
            $book->isbn_number = $this->isbn_number;
        }
        if ($this->subcategory_id) {
            if (!$this->subcategory->grade) {
                $book->quantity = $this->quantity;   
            }
        }
        $book->editorial = $this->editorial;
        $book->paginas = $this->paginas;
        $book->año = $this->año;
        $book->idioma = $this->idioma;
        $book->description = $this->description;

        $book->save();
        
        return redirect()->route('admin.books.edit', $book);
    }

    public function render()
    {
        return view('livewire.admin.create-book')->layout('layouts.admin');
    }
}
