<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\Subcategory;

class BookObserver
{
    public function updated(Book $book){
        $subcategory_id = $book->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if ($book->grades->count()) {
            $book->grades()->detach();
        }
        
    }
}
