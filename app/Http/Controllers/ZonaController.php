<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class ZonaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'base_id' => 'required|exists:bases,id',
        ]);

        Zona::create($request->all());

        return redirect()->route('bases')->with('success', 'Zona creada correctamente');
    }
}
