<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusBook extends Component
{
    public $book, $status;

    public function mount(){
        $this->status = $this->book->status;
    }

    public function save(){
        $this->book->status = $this->status;
        $this->book->save();
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.status-book');
    }
}
