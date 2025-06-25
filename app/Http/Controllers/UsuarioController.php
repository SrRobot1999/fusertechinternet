<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->get();
        $roles = \App\Models\Rol::all();
        return view('usuarios.showusuario', compact('usuarios', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:8',
        ]);
    
        $data = $request->only(['nombre', 'email', 'rol_id']);

        // Solo actualiza la contraseña si el campo no está vacío
        if ($request->filled('password')) {
            $data['password'] = $request->password; // El mutador la encripta
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'rol_id' => 'required|exists:roles,id', // Añade validación para rol_id
        ]);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            // 'password' => $request->password,
            'password' => bcrypt($request->password),
            'rol_id' => $request->rol_id, // Añade el rol_id
        ]);

        return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente.');
    }
}
