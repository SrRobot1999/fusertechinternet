<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('cliente')->get();
        $clientes = \App\Models\Cliente::all(); // <-- Agrega esta línea
        return view('pagos.showpago', compact('pagos', 'clientes'));
    }

    public function show($id)
    {
        $pago = Pago::with('cliente')->findOrFail($id);
        return response()->json($pago);
    }

    // Esta función obtiene el monto del plan del cliente
    public function getMontoPorCliente($clienteId)
    {
        $cliente = \App\Models\Cliente::find($clienteId);
        if (!$cliente) {
            return response()->json(['success' => false]);
        }
        $servicio = $cliente->servicios()->with('plan')->first();
        if (!$servicio || !$servicio->plan) {
            return response()->json(['success' => false]);
        }
        return response()->json([
            'success' => true,
            'monto' => $servicio->plan->precio // Ajusta el nombre del campo si es diferente
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|string|max:255',
            'referencia' => 'nullable|string|max:255',
        ]);

        // Validar que el cliente tenga al menos un servicio
        $cliente = \App\Models\Cliente::find($request->cliente_id);
        if (!$cliente || $cliente->servicios()->count() == 0) {
            return back()->with('error', 'El cliente no cuenta con ningún servicio.')->withInput();
        }

        \App\Models\Pago::create($request->all());

        return redirect()->route('pagos')->with('success', 'Pago registrado correctamente.');
    }

    public function getSiguienteMes($clienteId)
    {
        // Busca el último pago del cliente
        $ultimoPago = Pago::where('cliente_id', $clienteId)
            ->orderBy('fecha_pago', 'desc')
            ->first();

        // Extrae el número de mes de la referencia, si existe
        $mes = 1;
        if ($ultimoPago && preg_match('/Mes (\d+)/', $ultimoPago->referencia, $matches)) {
            $mes = intval($matches[1]) + 1;
        }

        return response()->json(['mes' => $mes]);
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|string',
            'referencia' => 'nullable|string',
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos')->with('success', 'Pago actualizado correctamente');
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos')->with('success', 'Pago eliminado correctamente');
    }
}
