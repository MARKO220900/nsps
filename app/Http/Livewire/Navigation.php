<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Image;
use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.navigation', compact('categories'));
    }
}
