<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles'; // <-- nombre real de tu tabla

    public $timestamps = false; // <-- si tu tabla "rol" no tiene created_at y updated_at

    protected $fillable = ['nombre']; // <-- o los campos que tenga tu tabla
}
