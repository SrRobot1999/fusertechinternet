<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReporteController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Filtros
    //     $estadoCliente = $request->input('estado_cliente');
    //     $estadoServicio = $request->input('estado_servicio');
    //     $mesPago = $request->input('mes_pago');

    //     $clientes = Cliente::when($estadoCliente, fn($q) => $q->where('estado', $estadoCliente))->get();
    //     $servicios = Servicio::when($estadoServicio, fn($q) => $q->where('estado', $estadoServicio))->get();
    //     $pagos = Pago::when($mesPago, fn($q) => $q->whereMonth('fecha_pago', $mesPago))->get();

    //     return view('reportes.index', compact('clientes', 'servicios', 'pagos'));
    // }


    public function index(Request $request)
    {
        // Filtros
        $estadoCliente = $request->input('estado_cliente');
        $estadoServicio = $request->input('estado_servicio');
        $mesPago = $request->input('mes_pago');

        // Mapear valores de estado a los valores de la base de datos
        $mapEstado = [
            'activo' => 1,
            'inactivo' => 0,
        ];

        $clientes = Cliente::when($estadoCliente !== null && $estadoCliente !== '', function ($q) use ($estadoCliente, $mapEstado) {
            if (isset($mapEstado[$estadoCliente])) {
                $q->where('estado', $mapEstado[$estadoCliente]);
            }
        })->get();

        $servicios = Servicio::when($estadoServicio !== null && $estadoServicio !== '', function ($q) use ($estadoServicio, $mapEstado) {
            if (isset($mapEstado[$estadoServicio])) {
                $q->where('estado', $mapEstado[$estadoServicio]);
            }
        })->get();

        $pagos = Pago::when($mesPago, fn($q) => $q->whereMonth('fecha_pago', $mesPago))->get();

        return view('reportes.index', compact('clientes', 'servicios', 'pagos'));
    }

    public function exportar(Request $request)
    {
        // Aplica los mismos filtros que en index
        $estadoCliente = $request->input('estado_cliente');
        $estadoServicio = $request->input('estado_servicio');
        $mesPago = $request->input('mes_pago');

        $clientes = Cliente::when($estadoCliente, fn($q) => $q->where('estado', $estadoCliente))->get();
        $servicios = Servicio::when($estadoServicio, fn($q) => $q->where('estado', $estadoServicio))->get();
        $pagos = Pago::when($mesPago, fn($q) => $q->whereMonth('fecha_pago', $mesPago))->get();

        $data = [
            'clientes' => $clientes,
            'servicios' => $servicios,
            'pagos' => $pagos,
        ];

        $pdf = PDF::loadView('reportes.pdf', $data);
        return $pdf->download('reporte.pdf');
    }
}
