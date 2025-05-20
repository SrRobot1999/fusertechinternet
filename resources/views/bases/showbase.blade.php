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
                <h4>Bases Registradas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-bases">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Fecha de Inicio</th>
                                <th>Altura</th>
                                <th>Color</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bases as $base)
                            <tr>
                                <td>{{ $base->id }}</td>
                                <td>{{ $base->nombre }}</td>
                                <td>{{ $base->direccion }}</td>
                                <td>{{ $base->fecha_funcionamiento }}</td>
                                <td>{{ $base->altura }}</td>
                                <td>{{ $base->color }}</td>
                                <td>{{ $base->created_at }}</td>
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
    $("#table-bases").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [8]
        }]
    });
</script>
@endpush
