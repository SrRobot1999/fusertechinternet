<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use App\Models\User;

class PerfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user = User::with('rol')->find($user->id); // Cargamos la relación rol

        return view('perfil.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Opcional: evitar que un usuario se borre a sí mismo si no quieres permitirlo
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio perfil.');
        }

        $user->delete();

        return redirect()->route('login')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
