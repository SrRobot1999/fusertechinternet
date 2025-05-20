@extends('layouts.app')

@push('styles_template')
<link rel="stylesheet" href="{{ asset('bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/prism/prism.css') }}">
@endpush

@section('content')

@if (session('success'))
<div id="toast-success" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
</div>
@endif

@if (session('error'))
<div id="toast-error" class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
    <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
</div>
@endif

<script>
    setTimeout(() => {
        document.getElementById('toast-success')?.classList.add('opacity-0');
        document.getElementById('toast-error')?.classList.add('opacity-0');
    }, 3000);
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tickets Registrados</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-tickets">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Asunto</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $ticket->usuario->name ?? 'Sin usuario' }}</td>
                                <td>{{ $ticket->asunto }}</td>
                                <td>{{ Str::limit($ticket->descripcion, 50) }}</td>
                                <td>{{ $ticket->estado == 1 ? 'Terminado' : 'Pendiente'}}</td>
                                <td>{{ $ticket->fecha_creacion }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button class="text-blue-600 hover:text-blue-800 text-xl" data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal()" class="text-red-600 hover:text-red-800 text-xl">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_template')
<script src="{{ asset('bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>

<script>
    $("#table-tickets").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [6]
        }]
    });
</script>
@endpush
