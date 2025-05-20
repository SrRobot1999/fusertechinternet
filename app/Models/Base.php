<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table = 'bases';

    protected $fillable = [
        'nombre',
        'direccion',
        'fecha_funcionamiento',
        'altura',
        'color',
    ];
}
