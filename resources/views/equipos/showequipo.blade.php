@extends('layouts.app')
@section('content')

@push('styles_template')
<link rel="stylesheet" href="{{ asset('bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bundles/prism/prism.css') }}">
@endpush

<!-- Pruebas para el toast-->
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
    }, 3000); // Se oculta en 3 segundos el Toast
</script>

<!-- Tabla para listar los equipos -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Equipos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-profile">
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

<!-- Modal Editar -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-20 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h3 class="text-lg font-bold mb-4 text-center">Editar Equipo</h3>
        
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
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
                <input type="text" class="form-control" name="mac_address" id="editMac">
            </div>
            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-20 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h3 class="text-lg font-bold mb-4 text-center text-red-600">¿Eliminar Equipo?</h3>
        <p class="text-center mb-6 text-gray-600">Esta acción no se puede deshacer.</p>

        <div class="flex justify-center space-x-4 mt-6">
            <button type="button" onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </button>

            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts_template')
<!-- JS Libraries -->
<script src="{{ asset('bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>

<script>
    $("#table-profile").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 5] // Ajusta según las columnas que no deben ordenarse
        }]
    });

    // Variable global para almacenar el equipo actual
    let currentEquipoId = null;

    function openEditModal(equipoId) {
        currentEquipoId = equipoId;
        
        // Aquí deberías hacer una petición AJAX para obtener los datos del equipo
        fetch(`/equipos/${equipoId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editTipo').value = data.tipo;
                document.getElementById('editMarca').value = data.marca;
                document.getElementById('editModelo').value = data.modelo;
                document.getElementById('editMac').value = data.mac_address;
                document.getElementById('editStock').value = data.stock;                
                // Actualizar la acción del formulario
                document.getElementById('editForm').action = `/equipos/${equipoId}`;
                
                // Mostrar el modal
                document.getElementById('editModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal(equipoId) {
        currentEquipoId = equipoId;
        // Actualizar la acción del formulario
        document.getElementById('deleteForm').action = `/equipos/${equipoId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endpush