{{-- filepath: resources/views/reportes/partials/servicios.blade.php --}}
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Cliente</th>
            <th>Tipo de Plan</th>
            <th>Estado</th>
            <th>Fecha Inicio</th>
        </tr>
    </thead>
    <tbody>
        @forelse($servicios as $servicio)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $servicio->cliente->nombre ?? 'Sin cliente' }}</td>
            <td>{{ $servicio->plan->nombre ?? 'Sin plan' }}</td>
            <td>{{ $servicio->estado ? 'Activo' : 'Inactivo' }}</td>
            <td>{{ $servicio->fecha_inicio }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No hay servicios para mostrar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div>
    {{ $servicios->withQueryString()->links() }}
</div>

