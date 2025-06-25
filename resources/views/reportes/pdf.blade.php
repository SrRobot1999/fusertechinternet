{{-- filepath: resources/views/reportes/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <link rel="stylesheet" href="{{ public_path('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom.css') }}">

    <style>
        .d-flex {
            display: flex !important;
        }
    </style>
</head>

<body>
    <table cellspacing="0" cellpadding="0" width="100%">
        <tbody>
            <tr>
                <td rowspan="4" width="20%"><img
                        src="{{ public_path('images/logofusertech.jpg') }}"
                        alt="" width="100%"></td>
                <td width="52%" class="text-center">
                    <span class="titleOrden">Ticket de servicio</span>
                </td>
                <td class="text-right">
                    <p class="mb-0 p-0 title-encabezado">FECHA: <span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></p>
                </td>
            </tr>
            <tr>
                <td class="text-center"><span class="title-encabezado">RUC: 96532145789</span></td>
            </tr>
            <tr>
                <td class="text-center">
                    <p class="mb-0 title-encabezado">AV. SANTA ELVIRA E URB. SAN ELÍAS, N°: MZ. B LOTE 8, LOS OLIVOS - LIMA - LIMA</p>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <p class="mb-0 title-encabezado">E-MAIL: consultas@fusertech.com - TEL.:
                        965478963</p>
                </td>
            </tr>
        </tbody>
    </table>
    @if(isset($tipo) && $tipo === 'clientes')

    <p class="title_report title-body">CLIENTES</h2>
    <table cellspacing="10" cellpadding="0" class="mt-4" width="100%">
        <thead>
            <tr>
                <td width="100%" class="title-body bg-print">ID</td>
                <td width="100%" class="title-body bg-print">NOMBRE</td>
                <td width="100%" class="title-body bg-print">DOCUEMENTO</td>
                <td width="100%" class="title-body bg-print">TELÉFONO</td>
                <td width="100%" class="title-body bg-print">DIRECCIÓN</td>
                <td width="100%" class="title-body bg-print">ZONA</td>
                <td width="100%" class="title-body bg-print">ESTADO</td>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td class="p-2">{{ $cliente->id }}</td>
                <td class="p-2">{{ $cliente->nombre }}</td>
                <td class="p-2">{{ $cliente->dni_ruc }}</td>
                <td class="p-2">{{ $cliente->telefono }}</td>
                <td class="p-2">{{ $cliente->direccion }}</td>
                <td class="p-2">{{ $cliente->zona->nombre ?? 'Sin zona' }}</td>
                <td class="p-2">{{ $cliente->estado ? 'Activo' : 'Inactivo' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @elseif(isset($tipo) && $tipo === 'servicios')
    <p class="title_report title-body">SERVICIOS</h2>
    <table cellspacing="10" cellpadding="0" class="mt-4" width="100%">
        <thead>
            <tr>
                <td width="100%" class="title-body bg-print">ID</td>
                <td width="100%" class="title-body bg-print">CLIENTE</td>
                <td width="100%" class="title-body bg-print">TIPO PLAN</td>
                <td width="100%" class="title-body bg-print">ESTADO</td>
                <td width="100%" class="title-body bg-print">F.INICIO</td>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $servicio)
            <tr>
                <td class="p-2">{{ $servicio->id }}</td>
                <td class="p-2">{{ $servicio->cliente->nombre ?? 'Sin cliente' }}</td>
                <td class="p-2">{{ $servicio->plan->nombre ?? 'Sin plan' }}</td>
                <td class="p-2">{{ $servicio->estado ? 'Activo' : 'Inactivo' }}</td>
                <td class="p-2">{{ $servicio->fecha_inicio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @elseif(isset($tipo) && $tipo === 'pagos')
    <p class="title_report title-body">PAGOS</h2>
    <table cellspacing="10" cellpadding="0" class="mt-4" width="100%">
        <thead>
            <tr>
                <td width="100%" class="title-body bg-print">ID</td>
                <td width="100%" class="title-body bg-print">CLIENTE</td>
                <td width="100%" class="title-body bg-print">F. PAGO</td>
                <td width="100%" class="title-body bg-print">MONTO</td>
                <td width="100%" class="title-body bg-print">REFERENCIA</td>
            </tr>
        </thead>
        <tbody>

            @foreach($pagos as $pago)
            <tr>
                <td class="p-2">{{ $pago->id }}</td>
                <td class="p-2">{{ $pago->cliente->nombre ?? 'Sin cliente' }}</td>
                <td class="p-2">{{ $pago->fecha_pago }}</td>
                <td class="p-2">S/. {{ $pago->monto }}</td>
                <td class="p-2">{{ $pago->referencia }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    @else
    <p>No hay datos para mostrar.</p>
    @endif
</body>

</html>