<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditBook extends Component
{

    public $book, $categories, $subcategories, $slug, $isbn;

    public $category_id, $isbn_number, $subcategory_id;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'book.title' => 'required',
        'slug' => 'required|unique:books,slug',
        'isbn' => 'required',
        'book.author' => 'required',
        'book.idioma' => 'required',
        'book.paginas' => 'required',
        'book.editorial' => 'required',
        'book.año' => 'required',
        'book.description' => 'required',
        'book.quantity' => 'numeric'
    ];

    protected $listeners = ['refreshBook', 'delete'];

    public function mount(Book $book){
        $this->book = $book;
        $this->categories = Category::all();
        $this->category_id = $book->subcategory->category->id;
        $this->subcategory_id = $book->subcategory_id;
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        $this->slug = $this->book->slug;
        $this->isbn = $this->book->isbn;
        $this->isbn_number = $this->book->isbn_number;
    }

    public function refreshBook(){
        $this->book = $this->book->fresh();
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        
        /* $this->reset(['subcategory_id']); */
        $this->book->subcategory_id = "";
    }

    public function updatedBookTitle($value){
        $this->slug = Str::slug($value);
    }

    public function getSubcategoryProperty(){
        return Subcategory::find($this->book->subcategory_id);
    }

    public function save(){
        $rules = $this->rules;

        $rules['slug'] = 'required|unique:books,slug,' . $this->book->id;

        if ($this->isbn == 1) {
            $rules['isbn_number'] = 'required';
        }
        if ($this->book->subcategory_id) {
            if (!$this->book->subcategory->grade) {
                $rules['book.quantity'] = 'required';   
            }
        }
        
        $this->validate($rules);

        $this->book->isbn = $this->isbn;

        $this->book->isbn_number = $this->isbn_number;

        $this->book->subcategory_id = $this->subcategory_id;

        if ($this->isbn == 0) {
            $this->book->isbn_number = NULL;
        }
        if ($this->book->subcategory->grade) {
            $this->book->quantity = NULL;
        }

        $this->book->slug = $this->slug;

        
        if ($this->book->subcategory_id != $this->subcategory_id) {
            $this->book->grades->detach();
            
        }
        $this->book->save();

        $this->emit('saved');
        
    }

    public function deleteImage(Image $image){
        Storage::disk('public')->delete([$image->url]);
        $image->delete();

        $this->book = $this->book->fresh();
    }

    public function delete(){
        $images = $this->book->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete([$image->url]);
            $image->delete();
            /* $this->refreshBook(); */
        }
        $this->book->delete();
        
        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.admin.edit-book')->layout('layouts.admin');
    }
}
