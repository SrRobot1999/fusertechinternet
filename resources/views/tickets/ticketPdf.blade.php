<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket N° {{$id}}</title>
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
                    <p class="mb-0 p-0 title-encabezado">NRO TICKET: <strong>{{ $id }}</strong></p>
                </td>
            </tr>
            <tr>
                <td class="text-center"><span class="title-encabezado">RUC: 96532145789</span></td>
                <td class="text-right">
                    <span class="mb-0 p-0 title-encabezado">F.C: {{ $data->fecha_creacion }}</span>
                </td>
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

    <table cellspacing="10" cellpadding="0" class="mt-4" width="100%">
        <tbody>
            <tr>
                <td width="100%" class="title-body bg-print">CLIENTE</td>
            </tr>
            <tr>
                <td class="p-3"><span class="title-body">{{$data->cliente->nombre}}</span></td>
            </tr>
            <tr>
                <td class="title-body bg-print">USUARIO</td>
            </tr>
            <tr>
                <td class="p-3"><span class="title-body">{{$data->usuario->nombre}}</span></td>
            </tr>
            <tr>
                <td class="title-body bg-print">ASUNTO</td>
            </tr>
            <tr>
                <td class="p-3"><span class="title-body">{{$data->asunto}}</span></td>
            </tr>
            <tr>
                <td class="title-body bg-print">DESCRIPCIÓN</td>
            </tr>
            <tr>
                <td class="p-3"><span class="title-body">{{$data->descripcion}}</span></td>
            </tr>
        </tbody>
    </table>
</body>

</html>