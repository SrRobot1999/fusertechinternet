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
        return view('pagos.showpago', compact('pagos'));
    }
}
