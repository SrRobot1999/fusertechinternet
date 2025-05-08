<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    //Indica la tabla personalizada
    protected $table = 'usuarios';

    //Si tu clave primaria no es "id", especifícalo
    // protected $primaryKey = 'id_usuario';

    //Si no tienes created_at y updated_at
    public $timestamps = false;

    // Campos que se pueden rellenar
    protected $fillable = ['email', 'password', 'nombre'];

    // Campos que deben estar ocultos
    protected $hidden = ['password'];

    // Mutador para encriptar automáticamente la contraseña
    public function setPasswordAttribute($value)
    {
        // Solo encripta si la contraseña no está ya encriptada
        if (!Hash::needsRehash($value)) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }

    // Relación con el modelo Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
