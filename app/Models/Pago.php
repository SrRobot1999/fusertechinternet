<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'pagos';

    protected $fillable = [
        'cliente_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
        'referencia',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
