<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'servicios';

    protected $fillable = [
        'cliente_id',
        'plan_id',
        'zona_id',
        'fecha_inicio',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
