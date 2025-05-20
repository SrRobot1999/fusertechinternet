<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

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
        return $this->belongsTo(User::class, 'usuario_id'); //corregir para que aparezca usuario en la vista Ticket
    }
}
