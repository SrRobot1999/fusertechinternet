<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'clientes';
    // Campos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'dni_ruc', 'telefono', 'direccion', 'zona_id', 'estado'];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
