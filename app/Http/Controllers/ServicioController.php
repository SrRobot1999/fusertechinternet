<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Plan;
use App\Models\Zona;
use Carbon\Carbon;

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

    // public function show($id)
    // {
    //     $servicio = Servicio::with(['cliente', 'plan', 'zona'])->findOrFail($id);
    //     return response()->json($servicio);
    // }

    public function show($id)
    {
        $servicio = Servicio::with(['cliente', 'plan', 'zona'])->findOrFail($id);

        // Calcula la duración en meses
        $fecha_inicio = \Carbon\Carbon::parse($servicio->fecha_inicio);
        $fecha_fin = \Carbon\Carbon::parse($servicio->fecha_fin);
        $meses = $fecha_inicio->diffInMonths($fecha_fin);

        return response()->json([
            'id' => $servicio->id,
            'cliente_id' => $servicio->cliente_id,
            'plan_id' => $servicio->plan_id,
            'zona_id' => $servicio->zona_id,
            'fecha_inicio' => $servicio->fecha_inicio, // formato Y-m-d
            'fecha_fin' => $servicio->fecha_fin,       // formato Y-m-d
            'meses' => $meses,
            'estado' => $servicio->estado,
            'cliente' => $servicio->cliente,
            'plan' => $servicio->plan,
            'zona' => $servicio->zona,
        ]);
    }

    public function store(Request $request)
    {
        $cliente = Cliente::find($request->cliente_id);
        if (!$cliente || $cliente->estado != 1) {
            return back()->with('error', 'El cliente se encuentra inactivo')->withInput();
        }

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_id' => 'required|exists:planes,id',
            'zona_id' => 'required|exists:zonas,id',
            'fecha_inicio' => 'required|date',
            'meses' => 'required|integer|min:1|max:12',
            'estado' => 'required|boolean'
        ]);

        $fecha_inicio = $request->input('fecha_inicio');
        $meses = (int) $request->input('meses'); // <-- convierte a entero
        $fecha_fin = \Carbon\Carbon::parse($fecha_inicio)->addMonths($meses);

        Servicio::create([
            'cliente_id' => $request->cliente_id,
            'plan_id' => $request->plan_id,
            'zona_id' => $request->zona_id,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'estado' => $request->estado
        ]);

        return redirect()->route('servicios')->with('success', 'Servicio registrado correctamente');
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_id' => 'required|exists:planes,id',
            'zona_id' => 'required|exists:zonas,id',
            'fecha_inicio' => 'required|date',
            'meses' => 'required|integer|min:1|max:12',
            'estado' => 'required|boolean'
        ]);

        $fecha_inicio = $request->input('fecha_inicio');
        $meses = (int) $request->input('meses'); // <-- convierte a entero
        $fecha_fin = \Carbon\Carbon::parse($fecha_inicio)->addMonths($meses);

        $servicio->update([
            'cliente_id' => $request->cliente_id,
            'plan_id' => $request->plan_id,
            'zona_id' => $request->zona_id,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'estado' => $request->estado
        ]);

        $cliente = Cliente::find($request->cliente_id);
        if ($cliente) {
            $cliente->estado = $request->estado;
            $cliente->save();
        }

        return redirect()->route('servicios')->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('servicios')->with('success', 'Servicio eliminado correctamente');
    }
}
