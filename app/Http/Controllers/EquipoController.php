<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function show()
    {
        // Obtener todos los equipos
        $equipos = Equipo::all(['tipo', 'marca', 'modelo', 'mac_address', 'stock']);

        // Retornar la vista con los datos
        return view('equipos.showequipo', compact('equipos'));
    }

    public function  edit($id)
    {
        // Obtener el equipo por ID
        $equipo = Equipo::findOrFail($id);

        // Retornar la vista de edición con el equipo
        return view('equipos.editequipo', compact('equipo'));
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        
        $request->validate([
            'tipo' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'mac_address' => 'required|string|unique:equipos,mac_address,'.$id,
            'stock' => 'required|integer'
        ]);

        $equipo->update($request->all());

        return redirect()->route('equipos.show')
            ->with('success', 'Equipo actualizado correctamente');
    }
    
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipos.show')
            ->with('success', 'Equipo eliminado correctamente');
    }
}