<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'zonas';

    protected $fillable = ['nombre', 'descripcion', 'base_id'];

    public function base()
    {
        return $this->belongsTo(Base::class, 'base_id');
    }
}
