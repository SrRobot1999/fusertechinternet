{{-- filepath: resources/views/reportes/pdf.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Reportes</h4>
    </div>
    <div class="card-body">
        <h5>Clientes</h5>
        <table class="table table-bordered" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $c)
                <tr>
                    <td>{{ $c->nombre }}</td>
                    <td>{{ $c->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Servicios</h5>
        <table class="table table-bordered" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $s)
                <tr>
                    <td>{{ $s->nombre }}</td>
                    <td>{{ $s->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Pagos</h5>
        <table class="table table-bordered" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $p)
                <tr>
                    <td>{{ $p->cliente->nombre ?? '' }}</td>
                    <td>{{ $p->monto }}</td>
                    <td>{{ $p->fecha_pago }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection