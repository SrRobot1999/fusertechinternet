<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cambia esto si necesitas una lógica de autorización específica.
        // Por ejemplo, si solo los administradores pueden crear clientes.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'dni_ruc' => 'required|string|max:20|unique:clientes,dni_ruc',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'zona_id' => 'required|integer|exists:zonas,id',
            'estado' => 'required|string|in:activo,inactivo',
        ];
    }
}