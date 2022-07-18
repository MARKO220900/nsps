<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;

class CreateAuthor extends Component
{

    public $authors, $author;

    public $name, $ename;

    protected $listeners = ['delete'];

    /* public $crearForm=[
        'name' => null
    ]; */

    public $editarForm=[
        'open' => false
    ];

    public $rules = [
        'name' => 'required'
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'ename' => 'nombre',
    ];

    public function mount(Author $author){

        $this->getAuthors();
        $this->author = $author;
        $this->ename = $author->name;
    }

    public function getAuthors(){
        $this->authors = Author::all();
    }

    public function save(){
        $this->validate();
        $author = new Author;
        $author->name = $this->name;
        $author->save();

        /* Author::create($this->crearForm); */

        $this->reset(['name']);

        $this->getAuthors();
    }

    public function edit(Author $author){
        $this->author = $author;

        $this->editarForm['open'] = true;
        /* $this->ename = $author->name; */
    }

    public function update(Author $author){
        $this->validate([
            'ename' => 'required'
        ]);
        /* $author->name =  */
        $author->update(['name' => $this->ename]);
        $this->reset('editarForm');

        $this->getAuthors();
    }

    public function delete(Author $author){
        $author->delete();
        $this->getAuthors();
    }

    public function render()
    {
        return view('livewire.admin.create-author')->layout('layouts.admin');
    }
}
