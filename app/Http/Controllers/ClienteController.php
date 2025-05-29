<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function show()
    {
        $clientes = Cliente::with('zona')->get();
        $zonas = \App\Models\Zona::all();
        return view('clientes.showcliente', compact('clientes', 'zonas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'dni_ruc' => 'required|string|unique:clientes,dni_ruc',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'zona_id' => 'required|exists:zonas,id',
            'estado' => 'required|boolean'
        ]);

        \App\Models\Cliente::create($request->all());

        return redirect()->route('clientes')
            ->with('success', 'Cliente registrado correctamente');
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'dni_ruc' => 'required|string|unique:clientes,dni_ruc,' . $id,
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'zona_id' => 'required|exists:zonas,id',
            'estado' => 'required|boolean'
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes')
            ->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
