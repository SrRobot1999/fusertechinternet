{{-- filepath: resources/views/reportes/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        th, td { border: 1px solid #000; padding: 4px; text-align: left;}
        th { background: #eee; }
    </style>
</head>
<body>
    @if(isset($tipo) && $tipo === 'clientes')
        <h2>Clientes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI/RUC</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Zona</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->dni_ruc }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ $cliente->zona->nombre ?? 'Sin zona' }}</td>
                        <td>{{ $cliente->estado ? 'Activo' : 'Inactivo' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($tipo) && $tipo === 'servicios')
        <h2>Servicios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo de Plan</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ $servicio->cliente->nombre ?? 'Sin cliente' }}</td>
                        <td>{{ $servicio->plan->nombre ?? 'Sin plan' }}</td>
                        <td>{{ $servicio->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td>{{ $servicio->fecha_inicio }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($tipo) && $tipo === 'pagos')
        <h2>Pagos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha Pago</th>
                    <th>Monto</th>
                    <th>Referencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->cliente->nombre ?? 'Sin cliente' }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                        <td>{{ $pago->monto }}</td>
                        <td>{{ $pago->referencia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay datos para mostrar.</p>
    @endif
</body>
</html>