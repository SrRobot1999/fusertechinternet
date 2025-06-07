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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Bases Registradas</h4>
                <div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i> Nueva Base
                    </button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#createZonaModal">
                        <i class="fas fa-map-marker-alt"></i> Nueva Zona
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-bases">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Fecha de Inicio</th>
                                <th>Altura</th>
                                <th>Color</th>
                                <!-- <th>Creado</th> -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bases as $base)
                            <tr data-id="{{ $base->id }}">
                                <!-- <td>{{ $base->id }}</td> -->
                                <td>{{ $base->nombre }}</td>
                                <td>{{ $base->direccion }}</td>
                                <td>{{ \Carbon\Carbon::parse($base->fecha_funcionamiento)->format('d-m-Y') }}</td>
                                <td>{{ $base->altura }}</td>
                                <td>{{ $base->color }}</td>
                                <!-- <td>{{ \Carbon\Carbon::parse($base->created_at)->format('H:i d-m-Y') }}</td> -->
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button onclick="openViewModal('{{ $base->id }}')" class="text-green-600 hover:text-green-800 text-xl">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 text-xl btn-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $base->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $base->id }}')" class="text-red-600 hover:text-red-800 text-xl btn-delete" data-id="{{ $base->id }}">
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

<!-- Modal Crear Zona -->
<div class="modal fade" id="createZonaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createZonaForm" method="POST" action="{{ route('zonas.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nueva Zona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Base</label>
                        <select class="form-control" name="base_id" required>
                            <option value="">Seleccione una base</option>
                            @foreach($bases as $base)
                                <option value="{{ $base->id }}">{{ $base->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar Zona</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Ver Base -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de la Base</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Nombre</dt>
                    <dd class="col-sm-8" id="viewNombre"></dd>
                    <dt class="col-sm-4">Dirección</dt>
                    <dd class="col-sm-8" id="viewDireccion"></dd>
                    <dt class="col-sm-4">Fecha de Inicio</dt>
                    <dd class="col-sm-8" id="viewFecha"></dd>
                    <dt class="col-sm-4">Altura</dt>
                    <dd class="col-sm-8" id="viewAltura"></dd>
                    <dt class="col-sm-4">Color</dt>
                    <dd class="col-sm-8" id="viewColor"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Base -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('bases.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nueva Base</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_funcionamiento" required>
                    </div>
                    <div class="form-group">
                        <label>Altura</label>
                        <input type="number" step="0.01" class="form-control" name="altura" required>
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" class="form-control" name="color" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Base -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Base</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editNombreInput" required>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="editDireccionInput" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_funcionamiento" id="editFechaInput" required>
                    </div>
                    <div class="form-group">
                        <label>Altura</label>
                        <input type="number" step="0.01" class="form-control" name="altura" id="editAlturaInput" required>
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" class="form-control" name="color" id="editColorInput" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar Base -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar Base?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </form>
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
            "targets": [2, 5]
        }]
    });

    // Script para limpiar el formulario al abrir el modal
    $('#createModal').on('show.bs.modal', function() {
        $(this).find('form')[0].reset();
    });

    // Ver Base
    function openViewModal(baseId) {
        fetch("{{ url('bases') }}/" + baseId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('viewNombre').textContent = data.nombre ?? '';
                document.getElementById('viewDireccion').textContent = data.direccion ?? '';
                document.getElementById('viewFecha').textContent = data.fecha_funcionamiento ?? '';
                document.getElementById('viewAltura').textContent = data.altura ?? '';
                document.getElementById('viewColor').textContent = data.color ?? '';
                $('#viewModal').modal('show');
            });
    }

    // Editar Base
    document.querySelectorAll('#table-bases .btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            const baseId = row.getAttribute('data-id');
            document.getElementById('editNombreInput').value = row.children[0].textContent.trim();
            document.getElementById('editDireccionInput').value = row.children[1].textContent.trim();

            // Cambiar el formato de la fecha a Y-m-d para el input de tipo date
            const fechaInicio = row.children[2].textContent.trim();
            const [day, month, year] = fechaInicio.split('-');
            document.getElementById('editFechaInput').value = `${year}-${month}-${day}`;

            document.getElementById('editAlturaInput').value = row.children[3].textContent.trim();
            document.getElementById('editColorInput').value = row.children[4].textContent.trim();
            // Actualizar la acción del formulario
            const url = "{{ route('bases.update', ':id') }}".replace(':id', baseId);
            document.getElementById('editForm').action = url;
        });
    });
    // Eliminar Base
    function openDeleteModal(baseId) {
        const url = "{{ route('bases.destroy', ':id') }}".replace(':id', baseId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
</script>
@endpush