<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $estadoCliente = $request->input('estado_cliente');
        $estadoServicio = $request->input('estado_servicio');
        $mesPago = $request->input('mes_pago');
        $nombreCliente = $request->input('nombre_cliente');

        $mapEstado = [
            'activo' => 1,
            'inactivo' => 0,
        ];

        $clientes = Cliente::when($estadoCliente !== null && $estadoCliente !== '', function ($q) use ($estadoCliente, $mapEstado) {
            if (isset($mapEstado[$estadoCliente])) {
                $q->where('estado', $mapEstado[$estadoCliente]);
            }
        })
            ->when($nombreCliente, function ($q) use ($nombreCliente) {
                $q->where('nombre', 'like', "%$nombreCliente%");
            })
            ->with('zona')
            ->paginate(10);

        $servicios = Servicio::with('cliente')
            ->when($estadoServicio !== null && $estadoServicio !== '', function ($q) use ($estadoServicio, $mapEstado) {
                if (isset($mapEstado[$estadoServicio])) {
                    $q->where('estado', $mapEstado[$estadoServicio]);
                }
            })
            ->paginate(10);

        $pagos = Pago::with('cliente')
            ->when($mesPago, fn($q) => $q->whereMonth('fecha_pago', $mesPago))
            ->paginate(10);

        return view('reportes.index', compact('clientes', 'servicios', 'pagos'));
    }

    public function exportar(Request $request)
    {
        $tipo = $request->input('tipo');
        $estadoCliente = $request->input('estado_cliente');
        $estadoServicio = $request->input('estado_servicio');
        $mesPago = $request->input('mes_pago');
        $nombreCliente = $request->input('nombre_cliente');

        $mapEstado = [
            'activo' => 1,
            'inactivo' => 0,
        ];

        $data = ['tipo' => $tipo];

        if ($tipo === 'clientes') {
            $clientes = Cliente::when($estadoCliente !== null && $estadoCliente !== '', function ($q) use ($estadoCliente, $mapEstado) {
                if (isset($mapEstado[$estadoCliente])) {
                    $q->where('estado', $mapEstado[$estadoCliente]);
                }
            })
                ->when($nombreCliente, function ($q) use ($nombreCliente) {
                    $q->where('nombre', 'like', "%$nombreCliente%");
                })
                ->with('zona')
                ->get();
            $data['clientes'] = $clientes;
        } elseif ($tipo === 'servicios') {
            $servicios = Servicio::with(['cliente', 'plan'])
                ->when($estadoServicio !== null && $estadoServicio !== '', function ($q) use ($estadoServicio, $mapEstado) {
                    if (isset($mapEstado[$estadoServicio])) {
                        $q->where('estado', $mapEstado[$estadoServicio]);
                    }
                })
                ->get();
            $data['servicios'] = $servicios;
        } elseif ($tipo === 'pagos') {
            $pagos = Pago::with('cliente')
                ->when($mesPago, fn($q) => $q->whereMonth('fecha_pago', $mesPago))
                ->get();
            $data['pagos'] = $pagos;
        }

        $pdf = PDF::loadView('reportes.pdf', $data);
        return $pdf->stream('reporte.pdf');
    }
}
