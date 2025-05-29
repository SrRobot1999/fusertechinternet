<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'tickets';

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'asunto',
        'descripcion',
        'estado',
        'fecha_creacion',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id'); // Asegúrate de usar el namespace correcto
    }
}