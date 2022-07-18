<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function files(Book $book, Request $request){

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        /* Storage::put('public/books', $request->file('file')); */

        $book->images()->create([
            'url' => Storage::put('public/books', $request->file('file'))
        ]);
    }
}
