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

    public function quickStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'dni_ruc' => 'required|string|unique:clientes,dni_ruc',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'zona_id' => 'required|exists:zonas,id',
            'estado' => 'required|boolean'
        ]);

        $cliente = \App\Models\Cliente::create($request->all());
        return response()->json($cliente);
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

        $cliente = \App\Models\Cliente::findOrFail($id);
        $cliente->update($request->all());

        // Si el cliente se puso inactivo, poner sus servicios en inactivo
        if ($request->estado == 0) {
            \App\Models\Servicio::where('cliente_id', $cliente->id)
                ->update(['estado' => 0]);
        } else if ($request->estado == 1) {
            // Si el cliente se puso activo, poner sus servicios en activo
            \App\Models\Servicio::where('cliente_id', $cliente->id)
                ->update(['estado' => 1]);
        }

        return redirect()->route('clientes')
            ->with('success', 'Cliente actualizado correctamente');
    }

    // public function destroy($id)
    // {
    //     $cliente = Cliente::findOrFail($id);
    //     $cliente->delete();

    //     return redirect()->route('clientes')
    //         ->with('success', 'Cliente eliminado correctamente');
    // }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // Error de restricción de clave foránea
                return redirect()->route('clientes')->with('error', 'No se puede eliminar un cliente que tenga pagos');
            }
            throw $e;
        }
    }
}
