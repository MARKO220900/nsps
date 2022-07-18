<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    const PENDIENTE = 1;

    const ACEPTADO = 2;

    const ENTREGADO = 3;

    const PREDEVUELTO = 4;

    const DEVUELTO = 5;

    const PRERECHAZADO = 6;

    const RECHAZADO = 7;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
