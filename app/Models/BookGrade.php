<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookGrade extends Model
{
    use HasFactory;
    protected $table = "book_grade";

    //Relacion uno a mucos inversa

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}