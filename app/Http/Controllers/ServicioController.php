<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::with(['cliente', 'plan', 'zona'])->get();
        return view('servicios.showservicio', compact('servicios'));
    }
}
