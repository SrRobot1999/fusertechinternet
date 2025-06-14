{{-- filepath: resources/views/reportes/partials/clientes.blade.php --}}
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>DNI/RUC</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Zona</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @forelse($clientes as $cliente)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->dni_ruc }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->direccion }}</td>
            <td>{{ $cliente->zona->nombre ?? 'Sin zona' }}</td>
            <td>{{ $cliente->estado ? 'Activo' : 'Inactivo' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No hay clientes para mostrar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div>
    {{ $clientes->withQueryString()->links() }}
</div>