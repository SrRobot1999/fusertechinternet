<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $data = DB::select("CALL sp_get_calendar_by_month($mesActual, $anioActual)");
        return view('calendario.showcalendario', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'asunto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|in:0,1',
            'fecha_creacion' => 'required|date',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets')->with('success', 'Ticket registrado correctamente.');
    }

    public function show($id)
    {
        $ticket = Ticket::with(['cliente', 'usuario'])->findOrFail($id);
        return response()->json($ticket);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'asunto' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets')->with('success', 'Ticket actualizado correctamente');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets')->with('success', 'Ticket eliminado correctamente');
    }
}
