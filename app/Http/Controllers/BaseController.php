<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        $bases = Base::withCount('zonas')->get();
        return view('bases.showbase', compact('bases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fecha_funcionamiento' => 'required|date',
            'altura' => 'required|numeric',
            // 'color' => 'required|string|max:255',
        ]);

        Base::create($request->all());

        return redirect()->route('bases')->with('success', 'Base registrada correctamente.');
    }

    public function show($id)
    {
        $base = Base::findOrFail($id);
        return response()->json($base);
    }

    public function update(Request $request, $id)
    {
        $base = Base::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'fecha_funcionamiento' => 'required|date',
            'altura' => 'required|numeric',
            // 'color' => 'required|string',
        ]);

        $base->update($request->all());

        return redirect()->route('bases')->with('success', 'Base actualizada correctamente.');
    }

    public function destroy($id)
    {
        $base = Base::findOrFail($id);
        $base->delete();
        return redirect()->route('bases')->with('success', 'Registro eliminado correctamente.');
    }
}
