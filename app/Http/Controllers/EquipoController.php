<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function show()
    {
        $equipos = Equipo::all(['id', 'tipo', 'marca', 'modelo', 'mac_address', 'stock']);
        return view('equipos.showequipo', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'mac_address' => 'required|string|unique:equipos,mac_address',
            'stock' => 'required|integer'
        ]);

        \App\Models\Equipo::create($request->all());

        return redirect()->route('equipos')
            ->with('success', 'Equipo registrado correctamente');
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);

        $request->validate([
            'tipo' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'mac_address' => 'required|string|unique:equipos,mac_address,' . $id,
            'stock' => 'required|integer'
        ]);

        $equipo->update($request->all());

        return redirect()->route('equipos')
            ->with('success', 'Equipo actualizado correctamente');
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipos')
            ->with('success', 'Equipo eliminado correctamente');
    }
}
