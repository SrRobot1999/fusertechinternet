<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'equipos';

    // Campos que se pueden asignar masivamente
    protected $fillable = ['tipo', 'marca', 'modelo', 'mac_address', 'stock'];
}
