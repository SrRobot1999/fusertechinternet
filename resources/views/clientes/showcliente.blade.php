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

<!-- Tabla para listar los clientes -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Clientes</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Nuevo cliente
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-general" id="table-clientes">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>DNI / RUC</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Zona</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr data-id="{{ $cliente->id }}">
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->dni_ruc }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>{{ $cliente->zona->nombre ?? 'Sin zona' }}</td>
                                <td>
                                    <span class="badge {{ $cliente->estado ? 'badge-success' : 'badge-danger' }}">
                                        {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button onclick="openViewModal()" class="text-green-600 hover:text-green-800 text-xl">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 text-xl btn-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $cliente->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $cliente->id }}')" class="text-red-600 hover:text-red-800 text-xl btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $cliente->id }}">
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

<!-- Modal Eliminar Cliente -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
                <button type="button" class="close text-white" onclick="closeDeleteModal()" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el cliente "<span id="clienteNombre"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editNombre" required>
                    </div>
                    <div class="form-group">
                        <label>DNI / RUC</label>
                        <input type="text" class="form-control" name="dni_ruc" id="editDniRuc" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="editTelefono">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="editDireccion">
                    </div>
                    <div class="form-group">
                        <label>Zona</label>
                        <select class="form-control" name="zona_id" id="editZona">
                            <option value="">Sin zona</option>
                            @foreach($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" id="editEstado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
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

<!-- Modal Ver Cliente -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Nombre</dt>
                    <dd class="col-sm-8" id="viewNombre"></dd>

                    <dt class="col-sm-4">DNI / RUC</dt>
                    <dd class="col-sm-8" id="viewDniRuc"></dd>

                    <dt class="col-sm-4">Teléfono</dt>
                    <dd class="col-sm-8" id="viewTelefono"></dd>

                    <dt class="col-sm-4">Dirección</dt>
                    <dd class="col-sm-8" id="viewDireccion"></dd>

                    <dt class="col-sm-4">Zona</dt>
                    <dd class="col-sm-8" id="viewZona"></dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8" id="viewEstado"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Cliente -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('clientes.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Cliente</h5>
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
                        <label>DNI / RUC</label>
                        <input type="text" class="form-control" name="dni_ruc" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label>Zona</label>
                        <select class="form-control" name="zona_id" required>
                            <option value="">Seleccione una zona</option>
                            @foreach($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
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
@endsection

@push('scripts_template')
<script src="{{ asset('bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/page/datatables.js') }}"></script>
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>
<script>
    

    // Usa la función route de Laravel para asegurar la URL correcta
    function openDeleteModal(clienteId) {
        // Buscar la fila del cliente por su ID
        const row = document.querySelector(`tr[data-id="${clienteId}"]`);
        const nombreCliente = row.children[0].textContent.trim();

        // Mostrar el nombre del cliente en el modal
        document.getElementById('clienteNombre').textContent = nombreCliente;

        // Usar la ruta generada por Blade para evitar problemas de rutas absolutas
        const url = "{{ route('clientes.destroy', ':id') }}".replace(':id', clienteId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
    // Cerrar el modal de eliminación
    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }
</script>

<script>
    // Abrir modal de editar y cargar datos del cliente
    document.querySelectorAll('#table-clientes .btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            const nombre = row.children[0].textContent.trim();
            const dni_ruc = row.children[1].textContent.trim();
            const telefono = row.children[2].textContent.trim();
            const direccion = row.children[3].textContent.trim();
            const zonaNombre = row.children[4].textContent.trim();
            const estadoTexto = row.children[5].textContent.trim();
            const clienteId = row.getAttribute('data-id') || '';

            document.getElementById('editNombre').value = nombre;
            document.getElementById('editDniRuc').value = dni_ruc;
            document.getElementById('editTelefono').value = telefono;
            document.getElementById('editDireccion').value = direccion;

            // Seleccionar zona por nombre
            const zonaSelect = document.getElementById('editZona');
            for (let i = 0; i < zonaSelect.options.length; i++) {
                if (zonaSelect.options[i].text === zonaNombre) {
                    zonaSelect.selectedIndex = i;
                    break;
                }
            }

            // Seleccionar estado
            document.getElementById('editEstado').value = (estadoTexto === 'Activo') ? '1' : '0';

            // Usar la ruta generada por Blade para evitar problemas de rutas absolutas
            const url = "{{ route('clientes.update', ':id') }}".replace(':id', clienteId);
            document.getElementById('editForm').action = url;
        });
    });
</script>
@endpush

@push('scripts_template')
<script>
    function openViewModal() {
        // Detectar el botón que disparó el evento
        document.querySelectorAll('#table-clientes .fa-eye').forEach(function(btn) {
            btn.parentElement.onclick = null;
        });

        document.querySelectorAll('#table-clientes .fa-eye').forEach(function(btn) {
            btn.parentElement.onclick = function() {
                const row = btn.closest('tr');
                document.getElementById('viewNombre').textContent = row.children[0].textContent.trim();
                document.getElementById('viewDniRuc').textContent = row.children[1].textContent.trim();
                document.getElementById('viewTelefono').textContent = row.children[2].textContent.trim();
                document.getElementById('viewDireccion').textContent = row.children[3].textContent.trim();
                document.getElementById('viewZona').textContent = row.children[4].textContent.trim();
                document.getElementById('viewEstado').textContent = row.children[5].textContent.trim();
                $('#viewModal').modal('show');
            }
        });
    }
    // Inicializar los eventos al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#table-clientes .fa-eye').forEach(function(btn) {
            btn.parentElement.onclick = function() {
                const row = btn.closest('tr');
                document.getElementById('viewNombre').textContent = row.children[0].textContent.trim();
                document.getElementById('viewDniRuc').textContent = row.children[1].textContent.trim();
                document.getElementById('viewTelefono').textContent = row.children[2].textContent.trim();
                document.getElementById('viewDireccion').textContent = row.children[3].textContent.trim();
                document.getElementById('viewZona').textContent = row.children[4].textContent.trim();
                document.getElementById('viewEstado').textContent = row.children[5].textContent.trim();
                $('#viewModal').modal('show');
            }
        });
    });
</script>
@endpush