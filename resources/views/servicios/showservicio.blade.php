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
                <h4>Contratos de Servicios</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Nuevo servicio
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-servicios">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Plan</th>
                                <th>Zona</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                            <tr data-id="{{ $servicio->id }}">
                                <td>{{ $servicio->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $servicio->plan->nombre ?? 'Sin plan' }}</td>
                                <td>{{ $servicio->zona->nombre ?? 'Sin zona' }}</td>
                                <td>{{ \Carbon\Carbon::parse($servicio->fecha_inicio)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($servicio->fecha_fin)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge {{ $servicio->estado ? 'badge-success' : 'badge-danger' }}">
                                        {{ $servicio->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <!-- <td>{{ $servicio->estado == 1 ? 'Activo' : 'Inactivo' }}</td> -->
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button class="text-green-600 hover:text-green-800 text-xl btn-view" data-id="{{ $servicio->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 text-xl btn-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $servicio->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 text-xl btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $servicio->id }}">
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

<!-- Modal Ver Servicio -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Cliente</dt>
                    <dd class="col-sm-8" id="viewCliente"></dd>
                    <dt class="col-sm-4">Plan</dt>
                    <dd class="col-sm-8" id="viewPlan"></dd>
                    <dt class="col-sm-4">Zona</dt>
                    <dd class="col-sm-8" id="viewZona"></dd>
                    <dt class="col-sm-4">Fecha de Inicio</dt>
                    <dd class="col-sm-8" id="viewFechaInicio"></dd>
                    <dt class="col-sm-4">Fecha Fin</dt>
                    <dd class="col-sm-8" id="viewFechaFin"></dd>
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

<!-- Modal Editar Servicio -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control" name="cliente_id" id="editCliente">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" data-estado="{{ $cliente->estado }}">{{ $cliente->nombre }}</option>
                            <!-- <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option> -->
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Plan</label>
                        <select class="form-control" name="plan_id" id="editPlan">
                            @foreach($planes as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Zona</label>
                        <select class="form-control" name="zona_id" id="editZona">
                            @foreach($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="editFechaInicio">
                    </div>
                    <div class="form-group">
                        <label for="meses">Duración (meses):</label>
                        <select name="meses" id="meses" class="form-control" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
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

<!-- Modal Eliminar Servicio -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar Servicio?</h5>
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

<!-- Modal Crear Servicio -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('servicios.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label>Cliente</label>
                        <button type="button" class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#quickClienteModal">
                            <i class="fas fa-user-plus"></i> Nuevo cliente
                        </button>
                    </div>
                    <select class="form-control mb-3" name="cliente_id" id="createCliente" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" data-estado="{{ $cliente->estado }}">{{ $cliente->nombre }}</option>
                        <!-- <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option> -->
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label>Plan</label>
                        <select class="form-control" name="plan_id" required>
                            <option value="">Seleccione un plan</option>
                            @foreach($planes as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                            @endforeach
                        </select>
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
                        <label>Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="meses">Duración (meses):</label>
                        <select name="meses" id="meses" class="form-control" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
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

<!-- Modal Crear Cliente Rápido -->
<div class="modal fade" id="quickClienteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="quickClienteForm">
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
                    <button type="submit" class="btn btn-primary">Registrar Cliente</button>
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
    $("#table-servicios").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 5]
        }]
    });

    // Validar Cliente Inactivo al Crear Servicio
    $('#createForm').on('submit', function(e) {
        var clienteSelect = $('#createCliente option:selected');
        if (clienteSelect.data('estado') == 0) {
            // Eliminar cualquier toast anterior
            $('#toast-warning').remove();
            // Crear el toast de advertencia
            $('body').append(`
            <div id="toast-warning" class="fixed top-5 right-5 bg-yellow-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
                <i class="fas fa-exclamation-triangle mr-2"></i> El cliente se encuentra inactivo
            </div>
        `);
            setTimeout(() => {
                $('#toast-warning').addClass('opacity-0');
            }, 3000);
            e.preventDefault();
            return false;
        }
    });

    // Crear Servicio
    $('#quickClienteForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: "{{ route('clientes.quickStore') }}",
            method: "POST",
            data: form.serialize(),
            success: function(cliente) {
                // Agregar el nuevo cliente al select del modal de servicio
                $('#createCliente').append(
                    $('<option>', {
                        value: cliente.id,
                        text: cliente.nombre,
                        selected: true
                    })
                );
                $('#quickClienteModal').modal('hide');
                form[0].reset();
            },
            error: function(xhr) {
                alert('Error al registrar cliente: ' + (xhr.responseJSON?.message || 'Verifique los datos.'));
            }
        });
    });

    // Ver Servicio
    function openViewModal(servicioId) {
        fetch("{{ url('servicios') }}/" + servicioId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('viewCliente').textContent = data.cliente?.nombre ?? '';
                document.getElementById('viewPlan').textContent = data.plan?.nombre ?? '';
                document.getElementById('viewZona').textContent = data.zona?.nombre ?? '';
                document.getElementById('viewFechaInicio').textContent = data.fecha_inicio ?? '';
                document.getElementById('viewFechaFin').textContent = data.fecha_fin ?? '';
                document.getElementById('viewEstado').textContent = data.estado == 1 ? 'Activo' : 'Inactivo';
                $('#viewModal').modal('show');
            });
    }

    // Attach click event for view buttons
    document.querySelectorAll('#table-servicios .btn-view').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const servicioId = btn.getAttribute('data-id');
            openViewModal(servicioId);
        });
    });

    // Editar Servicio
    document.querySelectorAll('#table-servicios .btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const servicioId = btn.getAttribute('data-id');
            fetch("{{ url('servicios') }}/" + servicioId)
                .then(response => response.json())
                .then(data => {
                    // Cliente
                    const clienteSelect = document.getElementById('editCliente');
                    for (let i = 0; i < clienteSelect.options.length; i++) {
                        if (parseInt(clienteSelect.options[i].value) === data.cliente_id) {
                            clienteSelect.selectedIndex = i;
                            break;
                        }
                    }
                    // Plan
                    const planSelect = document.getElementById('editPlan');
                    for (let i = 0; i < planSelect.options.length; i++) {
                        if (parseInt(planSelect.options[i].value) === data.plan_id) {
                            planSelect.selectedIndex = i;
                            break;
                        }
                    }
                    // Zona
                    const zonaSelect = document.getElementById('editZona');
                    for (let i = 0; i < zonaSelect.options.length; i++) {
                        if (parseInt(zonaSelect.options[i].value) === data.zona_id) {
                            zonaSelect.selectedIndex = i;
                            break;
                        }
                    }
                    // Fecha de inicio
                    document.getElementById('editFechaInicio').value = data.fecha_inicio;
                    // Duración (meses)
                    if (data.fecha_inicio && data.fecha_fin) {
                        const start = new Date(data.fecha_inicio);
                        const end = new Date(data.fecha_fin);
                        let months = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
                        if (end.getDate() >= start.getDate()) months++;
                        document.getElementById('meses').value = months;
                    }
                    // Estado
                    document.getElementById('editEstado').value = data.estado ? '1' : '0';

                    // Actualizar la acción del formulario
                    const url = "{{ route('servicios.update', ':id') }}".replace(':id', servicioId);
                    document.getElementById('editForm').action = url;
                });
        });
    });

    // Eliminar Servicio
    function openDeleteModal(servicioId) {
        const url = "{{ route('servicios.destroy', ':id') }}".replace(':id', servicioId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }

    // Attach click event for delete buttons
    document.querySelectorAll('#table-servicios .btn-delete').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const servicioId = btn.getAttribute('data-id');
            openDeleteModal(servicioId);
        });
    });
</script>
@endpush