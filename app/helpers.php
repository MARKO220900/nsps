<?php

use App\Models\Book;
use App\Models\Grade;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($book_id, $grade_id = null)
{

    $book = book::find($book_id);

    if ($grade_id) {
        $quantity = $book->grades->find($grade_id)->pivot->quantity;
    } else {
        $quantity = $book->quantity;
    }

    return $quantity;
}

function qty_added($book_id, $grade_id = null)
{

    $cart = Cart::content();

    $item = $cart->where('id', $book_id)
        ->where('options.grade_id', $grade_id)->first();

    if ($item) {
        return $item->qty;
    }else{
        return 0;
    }
}

function qty_available($book_id, $grade_id = null){
    return quantity($book_id, $grade_id) - qty_added($book_id, $grade_id);
}

function discount($item){
    $book = Book::find($item->id);
    $qty_available = qty_available($item->id, $item->options->grade_id);

    if ($item->options->grade_id) {
        $book->grades()->detach($item->options->grade_id);
        $book->grades()->attach([
            $item->options->grade_id => ['quantity' => $qty_available]
        ]);
    }else{
        $book->quantity = $qty_available;
        $book->save();
    }
}

function increase($item){
    $book = Book::find($item->id);
    $quantity = quantity($item->id, $item->options->grade_id) + $item->qty;

    if ($item->options->grade_id) {
        $book->grades()->detach($item->options->grade_id);
        $book->grades()->attach([
            $item->options->grade_id => ['quantity' => $quantity]
        ]);
    }else{
        $book->quantity = $quantity;
        $book->save();
    }
}


