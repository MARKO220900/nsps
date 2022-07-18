<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;
    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //accesores

    public function getStockAttribute(){
        if ($this->subcategory->grade) {
             return BookGrade::whereHas('book', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        }else{
            return $this->quantity;
        }
    }

    //Relacion uno a muchos inversa
    public function author(){
        return $this->belongsTo(Author::class);
    }
    //Relacion uno a muchos inversa
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    //Relacion muchos a muchos poliformica
    public function grades(){
        return $this->belongsToMany(Grade::class)->withPivot('quantity', 'id');
    }
    //Relacion uno a muchos poliformica
    public function images(){
        return $this->morphMany(Image::class, "imagiable");
    }
    //url amigables
    public function getRouteKeyName(){
        return 'slug';
    }
}
