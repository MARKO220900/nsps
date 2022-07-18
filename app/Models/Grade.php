<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //Relacion muchos a muchos
    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
