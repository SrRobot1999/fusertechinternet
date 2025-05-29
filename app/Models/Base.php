<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public $timestamps = false;
    
    protected $table = 'bases';

    protected $fillable = [
        'nombre',
        'direccion',
        'fecha_funcionamiento',
        'altura',
        'color',
    ];
}
