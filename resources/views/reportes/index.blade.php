@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Reportes</h4>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label>Estado Cliente</label>
                <select name="estado_cliente" class="form-control">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Estado Servicio</label>
                <select name="estado_servicio" class="form-control">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Mes de Pago</label>
                <input type="month" name="mes_pago" class="form-control">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
        </form>
        <div class="mb-3">
            <a href="{{ route('reportes.exportar', 'pdf') }}" class="btn btn-danger">Exportar PDF</a>
            <a href="{{ route('reportes.exportar', 'excel') }}" class="btn btn-success">Exportar Excel</a>
        </div>
        <h5>Clientes</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $c)
                <tr>
                    <td>{{ $c->nombre }}</td>                    
                    <td>{{ $c->telefono }}</td>
                    <td>{{ $c->direccion }}</td>                    
                    <td>{{ $c->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Servicios</h5>
        <table class="table table-bordered">
            <thead><tr><th>Nombre</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Estado</th></tr></thead>
            <tbody>
                @foreach($servicios as $s)
                <tr>
                    <td>{{ $s->cliente->nombre ?? '' }}</td>
                    <td>{{ $s->fecha_inicio }}</td>
                    <td>{{ $s->fecha_fin }}</td>
                    <td>{{ $s->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Pagos</h5>
        <table class="table table-bordered">
            <thead><tr><th>Cliente</th><th>Monto</th><th>Fecha</th></tr></thead>
            <tbody>
                @foreach($pagos as $p)
                <tr>
                    <td>{{ $p->cliente->nombre ?? '' }}</td>
                    <td>S/. {{ $p->monto }}</td> 
                    <td>{{ $p->fecha_pago }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

