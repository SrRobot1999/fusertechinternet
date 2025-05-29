<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Plan;
use App\Models\Zona;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::with(['cliente', 'plan', 'zona'])->get();
        $clientes = Cliente::all();
        $planes = Plan::all();
        $zonas = Zona::all();
        return view('servicios.showservicio', compact('servicios', 'clientes', 'planes', 'zonas'));
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_id' => 'required|exists:planes,id',
            'zona_id' => 'required|exists:zonas,id',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|boolean'
        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios')->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('servicios')->with('success', 'Servicio eliminado correctamente');
    }

    public function show($id)
    {
        $servicio = Servicio::with(['cliente', 'plan', 'zona'])->findOrFail($id);
        return response()->json($servicio);
    }
}