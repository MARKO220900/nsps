<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request){
        
        $name = $request->name;

        $books = Book::where('title', 'LIKE', "%". $name . "%")
                        ->where('status',2)
                        ->paginate(8);

        return view('search', compact('books'));
    }
}
