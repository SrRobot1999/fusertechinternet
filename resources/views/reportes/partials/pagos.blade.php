{{-- filepath: resources/views/reportes/partials/pagos.blade.php --}}
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Cliente</th>
            <th>Fecha de Pago</th>
            <th>Monto</th>
            <th>Referencia</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pagos as $pago)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pago->cliente->nombre ?? 'Sin cliente' }}</td>
            <td>{{ $pago->fecha_pago }}</td>
            <td>{{ $pago->monto }}</td>
            <td>{{ $pago->referencia }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No hay pagos para mostrar.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div>
    {{ $pagos->withQueryString()->links() }}
</div>
