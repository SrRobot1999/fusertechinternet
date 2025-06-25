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
                <h4>Usuarios Registrados</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioModal">
                    <i class="fas fa-plus"></i> Nuevo usuario
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-usuarios">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Fecha de Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                                <td>{{ \Carbon\Carbon::parse($usuario->created_at)->format('H:i d-m-Y') }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button class="text-blue-600 hover:text-blue-800 text-xl" data-toggle="modal" data-target="#editModal-{{ $usuario->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $usuario->id }}')" class="text-red-600 hover:text-red-800 text-xl">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal para editar - VERSIÓN CORREGIDA -->
                            <div class="modal fade" id="editModal-{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Usuario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rol</label>
                                                    <select name="rol_id" class="form-control" required>
                                                        <option value="">Seleccione un rol</option>
                                                        @foreach($roles as $rol)
                                                        <option value="{{ $rol->id }}"
                                                            {{ (old('rol_id', $usuario->rol_id) == $rol->id) ? 'selected' : '' }}>
                                                            {{ $rol->nombre }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contraseña (solo si deseas cambiarla)</label>
                                                    <input type="password" name="password" class="form-control" minlength="8">
                                                    <small class="form-text text-muted">Deja en blanco si no quieres cambiar la contraseña</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- ...modal crear nuevo usuario... -->
                            <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('usuarios.store') }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="nombre" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Correo Electrónico</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Contraseña</label>
                                                    <input type="password" class="form-control" name="password" required minlength="8">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rol_id" class="form-label">Rol</label>
                                                    <select class="form-control" name="rol_id" required>
                                                        <option value="">Seleccione un rol</option>
                                                        @foreach($roles as $rol)
                                                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- ...existing code... -->
                            <!-- Modal Eliminar -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div> -->
@endsection

@push('scripts_template')
<script src="{{ asset('bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/page/datatables.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>
<script>
    $("#table-usuarios").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [4]
        }],
        language: languageEs
    });
</script>
<script>
    function openDeleteModal(userId) {
        // Verificar que no es el usuario actual
        if (userId == "{{ auth()->id() }}") {
            alert('No puedes eliminarte a ti mismo');
            return;
        }

        const url = "{{ route('usuarios.destroy', ':id') }}".replace(':id', userId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
</script>
@endpush