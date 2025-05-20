<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    //segun Chat GPT la funcion debe llemarse index por que show es para mostrar un solo registro
    public function show()
    {
        $clientes = Cliente::with('zona')->get();
        return view('clientes.showcliente', compact('clientes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
