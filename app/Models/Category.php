<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =['name', 'slug', 'image', 'icon'];

    //Relacion uno a muchos
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function books(){
        return $this->hasManyThrough(Book::class, Subcategory::class);
    }

    //url amigables
    public function getRouteKeyName(){
        return 'slug';
    }
}
