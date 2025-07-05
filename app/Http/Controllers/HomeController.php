<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $fechaActual = Carbon::now();
        $contratosActivos = DB::table('servicios')
            ->where('estado', 1)
            ->count();

        $clientesActivos = DB::table('clientes')
            ->where('estado', 1)
            ->count();

        $ticketsActivos = DB::table('tickets')
            ->where('estado', 0)
            ->count();

        $montoMesActual = DB::table('pagos')
            ->whereMonth('fecha_pago', $fechaActual->month)
            ->whereYear('fecha_pago', $fechaActual->year)
            ->sum('monto');

        return view('home', compact('contratosActivos', 'clientesActivos', 'ticketsActivos', 'montoMesActual'));
    }

    public function pagosPorMes()
    {
        Carbon::setLocale('es');

        $pagos = DB::table('pagos')
            ->select(DB::raw('MONTH(fecha_pago) as mes'), DB::raw('SUM(monto) as total'))
            ->whereYear('fecha_pago', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(fecha_pago)'))
            ->orderBy('mes')
            ->get();

        $data = [];
        foreach ($pagos as $pago) {
            $nombreMes = Carbon::create()->month($pago->mes)->translatedFormat('F');
            $data[] = [
                'mes' => ucfirst($nombreMes),
                'total' => $pago->total,
            ];
        }

        return response()->json($data);
    }

    public function chartZonas()
    {
        $zonas = DB::table('zonas')
            ->select('id', 'nombre')
            ->get();

        $data = [];
        foreach ($zonas as $zona) {
            $count = DB::table('clientes')
                ->where('zona_id', $zona->id)
                ->count();
            $data[] = [
                'zona' => $zona->nombre,
                'cantidad' => $count,
            ];
        }

        return response()->json($data);
    }

    public function chartPlanes()
    {
        $planes = DB::table('planes')->select('id', 'nombre')->get();

        $data = [];
        foreach ($planes as $plan) {
            $cantidad = DB::table('servicios')->where('plan_id', $plan->id)->count();
            $data[] = [
                'plan' => $plan->nombre,
                'cantidad' => $cantidad,
            ];
        }

        return response()->json($data);
    }

    public function chartPagosTrimestrales()
    {
        Carbon::setLocale('es');

        $fechaInicio = Carbon::now()->copy()->subMonths(2)->startOfMonth();
        $fechaFin = Carbon::now()->endOfMonth();

        $pagos = DB::table('pagos')
            ->select(DB::raw('MONTH(fecha_pago) as mes'), DB::raw('SUM(monto) as total'))
            ->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('MONTH(fecha_pago)'))
            ->orderBy('mes')
            ->get();

        $data = [];
        foreach ($pagos as $pago) {
            $nombreMes = Carbon::create()->month($pago->mes)->translatedFormat('F');
            $data[] = [
                'mes' => ucfirst($nombreMes),
                'total' => $pago->total,
            ];
        }

        return response()->json($data);
    }
}
