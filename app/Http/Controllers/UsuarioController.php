<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->get();
        return view('usuarios.showusuario', compact('usuarios'));
    }
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6', // Solo si deseas actualizarla
        ]);

        $data = $request->only(['nombre', 'email', 'rol_id']);

        // Si el campo de contraseña está presente y no vacío, lo incluye
        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        $usuario->update($data);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }
    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();

            return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el usuario.');
        }
    }
}
