{{-- filepath: resources/views/reportes/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Reportes</h4>
    </div>
    <div class="card-body">
        {{-- Filtros avanzados --}}
        <form method="GET" class="row g-3 mb-4">
            <!-- <div class="col-md-3">
                <label>Nombre Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" value="{{ request('nombre_cliente') }}">
            </div> -->
            <div class="col-md-3">
                <label>Estado Cliente</label>
                <select name="estado_cliente" class="form-control">
                    <option value="">Todos</option>
                    <option value="activo" {{ request('estado_cliente')=='activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado_cliente')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Estado Servicio</label>
                <select name="estado_servicio" class="form-control">
                    <option value="">Todos</option>
                    <option value="activo" {{ request('estado_servicio')=='activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado_servicio')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Mes de Pago</label>
                <input type="month" name="mes_pago" class="form-control" value="{{ request('mes_pago') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
        </form>

        {{-- Botón único de exportar PDF --}}
        <div class="mb-3">
            <a id="exportarPDF" href="#" class="btn btn-danger" title="Exportar PDF" target="_blank">
                <i class="fas fa-file-pdf"></i>
            </a>
        </div>

        {{-- Pestañas Bootstrap --}}
        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="servicios-tab" data-toggle="tab" href="#servicios" role="tab">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pagos-tab" data-toggle="tab" href="#pagos" role="tab">Pagos</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="clientes" role="tabpanel">
                @include('reportes.partials.clientes', ['clientes' => $clientes])
            </div>
            <div class="tab-pane fade" id="servicios" role="tabpanel">
                @include('reportes.partials.servicios', ['servicios' => $servicios])
            </div>
            <div class="tab-pane fade" id="pagos" role="tabpanel">
                @include('reportes.partials.pagos', ['pagos' => $pagos])
            </div>
        </div>
    </div>
</div>

{{-- Script para cambiar la URL del botón según la pestaña activa --}}
@push('scripts')
<script>
    function getExportUrl(tipo) {
        const params = new URLSearchParams(window.location.search);
        params.set('tipo', tipo);
        return "{{ route('reportes.exportar') }}?" + params.toString();
    }

    function updateExportButton() {
        // Detecta la pestaña activa de forma robusta
        let tipo = 'clientes';
        const activeTab = $('#reportTabs .nav-link.active').attr('id');
        if (activeTab === 'servicios-tab') tipo = 'servicios';
        if (activeTab === 'pagos-tab') tipo = 'pagos';
        $('#exportarPDF').attr('href', getExportUrl(tipo));
    }

    $(document).ready(function() {
        updateExportButton();
        // Bootstrap 4 y 5: escucha ambos eventos
        $('#reportTabs a[data-toggle="tab"], #reportTabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            updateExportButton();
        });

        // Previene acción si el href es "#"
        $('#exportarPDF').on('click', function(e) {
            if ($(this).attr('href') === '#') {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection
