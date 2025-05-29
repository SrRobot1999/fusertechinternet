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
