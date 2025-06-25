@extends('layouts.app')
@section('content')

@push('styles_template')
<link rel="stylesheet" href="{{ asset('bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/prism/prism.css') }}">
@endpush

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
                <h4>Equipos</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Nuevo equipo
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-general" id="table-profile">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>MAC</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->tipo }}</td>
                                <td>{{ $equipo->marca }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>{{ $equipo->mac_address }}</td>
                                <td>{{ $equipo->stock }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button onclick="openViewModal()" class="text-green-600 hover:text-green-800 text-xl">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button
                                            class="text-blue-600 hover:text-blue-800 text-xl"
                                            data-toggle="modal"
                                            data-target="#editModal"
                                            data-id="{{ $equipo->id }}"
                                            data-tipo="{{ $equipo->tipo }}"
                                            data-marca="{{ $equipo->marca }}"
                                            data-modelo="{{ $equipo->modelo }}"
                                            data-mac="{{ $equipo->mac_address }}"
                                            data-stock="{{ $equipo->stock }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-800 text-xl"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                            data-id="{{ $equipo->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar equipos-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" class="form-control" name="tipo" id="editTipo">
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input type="text" class="form-control" name="marca" id="editMarca">
                    </div>
                    <div class="form-group">
                        <label>Modelo</label>
                        <input type="text" class="form-control" name="modelo" id="editModelo">
                    </div>
                    <div class="form-group">
                        <label>MAC Address</label>
                        <input type="text" class="form-control" name="mac_address" id="editMac">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" id="editStock">
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

<!-- Modal Eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar Equipo?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>¿Estás seguro de eliminar el equipo "<span id="equipoNombre"></span>"?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Ver Equipo -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Tipo</dt>
                    <dd class="col-sm-8" id="viewTipo"></dd>
                    <dt class="col-sm-4">Marca</dt>
                    <dd class="col-sm-8" id="viewMarca"></dd>
                    <dt class="col-sm-4">Modelo</dt>
                    <dd class="col-sm-8" id="viewModelo"></dd>
                    <dt class="col-sm-4">MAC Address</dt>
                    <dd class="col-sm-8" id="viewMac"></dd>
                    <dt class="col-sm-4">Stock</dt>
                    <dd class="col-sm-8" id="viewStock"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Equipo -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('equipos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" class="form-control" name="tipo" required>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input type="text" class="form-control" name="marca" required>
                    </div>
                    <div class="form-group">
                        <label>Modelo</label>
                        <input type="text" class="form-control" name="modelo" required>
                    </div>
                    <div class="form-group">
                        <label>MAC Address</label>
                        <input type="text" class="form-control" name="mac_address" required>
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts_template')
<script src="{{ asset('bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/page/datatables.js') }}"></script>
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>
<script>
    $(document).ready(function() {
        
        // Rellenar el formulario de editar
        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');
            const tipo = button.data('tipo');
            const marca = button.data('marca');
            const modelo = button.data('modelo');
            const mac = button.data('mac');
            const stock = button.data('stock');

            const updateUrl = '{{ route("equipos.update", "__id__") }}'.replace('__id__', id);
            $('#editForm').attr('action', updateUrl);
            $('#editTipo').val(tipo);
            $('#editMarca').val(marca);
            $('#editModelo').val(modelo);
            $('#editMac').val(mac);
            $('#editStock').val(stock);
        });

        // Establecer acción del form de eliminar
        $('#deleteModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');
            const deleteUrl = '{{ route("equipos.destroy", "__id__") }}'.replace('__id__', id);
            $('#deleteForm').attr('action', deleteUrl);
            // Obtener los datos del equipo de la fila de la tabla
            const row = $(button).closest('tr');
            const tipo = row.find('td').eq(0).text();
            const marca = row.find('td').eq(1).text();
            const modelo = row.find('td').eq(2).text();
            // Mostrar el nombre del equipo en el modal
            const nombreEquipo = `${tipo} ${marca} ${modelo}`;
            $('#equipoNombre').text(nombreEquipo);
        });

        // Prevenir doble submit y refresco accidental
        $('#deleteForm').on('submit', function(e) {
            $('#confirmDeleteBtn').prop('disabled', true);
        });
    });
</script>
@endpush

@push('scripts_template')
<script>
    // Función para abrir el modal de ver y rellenar los datos
    function openViewModal(equipo = null) {
        // Si se llama desde el botón, obtener datos del botón
        if (!equipo) {
            // Buscar el botón que disparó el evento
            const button = event.currentTarget;
            const row = $(button).closest('tr');
            $('#viewTipo').text(row.find('td').eq(0).text());
            $('#viewMarca').text(row.find('td').eq(1).text());
            $('#viewModelo').text(row.find('td').eq(2).text());
            $('#viewMac').text(row.find('td').eq(3).text());
            $('#viewStock').text(row.find('td').eq(4).text());
        } else {
            // Si se pasa un objeto equipo, usar sus propiedades
            $('#viewTipo').text(equipo.tipo);
            $('#viewMarca').text(equipo.marca);
            $('#viewModelo').text(equipo.modelo);
            $('#viewMac').text(equipo.mac_address);
            $('#viewStock').text(equipo.stock);
        }
        $('#viewModal').modal('show');
    }
</script>
@endpush

@endsection