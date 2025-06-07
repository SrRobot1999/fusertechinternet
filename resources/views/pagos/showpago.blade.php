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
                <h4>Pagos Registrados</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Nuevo Pago
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-pagos">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Fecha de Pago</th>
                                <th>Método de Pago</th>
                                <th>Referencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                            <tr data-id="{{ $pago->id }}">
                                <td>{{ $pago->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>S/. {{ number_format($pago->monto, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d-m-Y') }}</td>
                                <td>{{ $pago->metodo_pago }}</td>
                                <td>{{ $pago->referencia }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button onclick="openViewModal('{{ $pago->id }}')" class="text-green-600 hover:text-green-800 text-xl">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 text-xl btn-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $pago->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $pago->id }}')" class="text-red-600 hover:text-red-800 text-xl btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $pago->id }}">
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

<!-- Modal Crear Pago -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('pagos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control" name="cliente_id" id="createCliente" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Monto</label>
                        <input type="number" step="0.01" class="form-control" name="monto" id="createMonto" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Pago</label>
                        <input type="date" class="form-control" name="fecha_pago" required>
                    </div>
                    <div class="form-group">
                        <label>Método de Pago</label>
                        <input type="text" class="form-control" name="metodo_pago" required>
                    </div>
                    <div class="form-group">
                        <label>Referencia</label>
                        <input type="text" class="form-control" name="referencia" id="createReferencia">
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

<!-- Modal Ver Pago -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Cliente</dt>
                    <dd class="col-sm-8" id="viewCliente"></dd>
                    <dt class="col-sm-4">Monto</dt>
                    <dd class="col-sm-8" id="viewMonto"></dd>
                    <dt class="col-sm-4">Fecha de Pago</dt>
                    <dd class="col-sm-8" id="viewFechaPago"></dd>
                    <dt class="col-sm-4">Método de Pago</dt>
                    <dd class="col-sm-8" id="viewMetodoPago"></dd>
                    <dt class="col-sm-4">Referencia</dt>
                    <dd class="col-sm-8" id="viewReferencia"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Pago -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control" name="cliente_id" id="editCliente">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Monto</label>
                        <input type="number" step="0.01" class="form-control" name="monto" id="editMonto">
                    </div>
                    <div class="form-group">
                        <label>Fecha de Pago</label>
                        <input type="date" class="form-control" name="fecha_pago" id="editFechaPago">
                    </div>
                    <div class="form-group">
                        <label>Método de Pago</label>
                        <input type="text" class="form-control" name="metodo_pago" id="editMetodoPago">
                    </div>
                    <div class="form-group">
                        <label>Referencia</label>
                        <input type="text" class="form-control" name="referencia" id="editReferencia">
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

<!-- Modal Eliminar Pago -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar Pago?</h5>
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
    $("#table-pagos").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 5]
        }]
    });

    // Ver Pago
    function openViewModal(pagoId) {
        fetch("{{ url('pagos') }}/" + pagoId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('viewCliente').textContent = data.cliente?.nombre ?? '';
                document.getElementById('viewMonto').textContent = 'S/. ' + parseFloat(data.monto).toFixed(2);
                document.getElementById('viewFechaPago').textContent = data.fecha_pago ?? '';
                document.getElementById('viewMetodoPago').textContent = data.metodo_pago ?? '';
                document.getElementById('viewReferencia').textContent = data.referencia ?? '';
                $('#viewModal').modal('show');
            });
    }

    // Editar Pago
    document.querySelectorAll('#table-pagos .btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            const pagoId = row.getAttribute('data-id');
            const clienteNombre = row.children[0].textContent.trim();
            const monto = row.children[1].textContent.replace('S/.', '').trim();
            const fechaPago = row.children[2].textContent.trim();
            const metodoPago = row.children[3].textContent.trim();
            const referencia = row.children[4].textContent.trim();

            // Seleccionar cliente
            const clienteSelect = document.getElementById('editCliente');
            for (let i = 0; i < clienteSelect.options.length; i++) {
                if (clienteSelect.options[i].text === clienteNombre) {
                    clienteSelect.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('editMonto').value = monto;
            document.getElementById('editFechaPago').value = fechaPago;
            document.getElementById('editMetodoPago').value = metodoPago;
            document.getElementById('editReferencia').value = referencia;

            // Actualizar la acción del formulario
            const url = "{{ route('pagos.update', ':id') }}".replace(':id', pagoId);
            document.getElementById('editForm').action = url;
        });
    });

    // Eliminar Pago
    function openDeleteModal(pagoId) {
        const url = "{{ route('pagos.destroy', ':id') }}".replace(':id', pagoId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }

    // Al cambiar el cliente, obtener el monto del plan
    // $('#createCliente').on('change', function() {
    //     var clienteId = $(this).val();
    //     if (!clienteId) {
    //         $('#createMonto').val('');
    //         return;
    //     }
    //     $.get("{{ url('pagos/get-monto') }}/" + clienteId, function(response) {
    //         if (response.success) {
    //             $('#createMonto').val(response.monto);
    //         } else {
    //             $('#createMonto').val('');
    //         }
    //     });
    // });
    
    // MODIFICACIÓN: Se agregó la petición para autocompletar el campo referencia con "Mes X"
    $('#createCliente').on('change', function() {
        var clienteId = $(this).val();
        if (!clienteId) {
            $('#createMonto').val('');
            $('#createReferencia').val(''); // Limpiar referencia si no hay cliente
            return;
        }
        // Obtener monto
        $.get("{{ url('pagos/get-monto') }}/" + clienteId, function(response) {
            if (response.success) {
                $('#createMonto').val(response.monto);
            } else {
                $('#createMonto').val('');
            }
        });
        // Obtener siguiente mes para la referencia
        $.get("{{ url('pagos/siguiente-mes') }}/" + clienteId, function(response) {
            if (response.mes) {
                $('#createReferencia').val('Mes ' + response.mes);
            } else {
                $('#createReferencia').val('');
            }
        });
    });
    
    // Validar que el cliente tenga servicio antes de enviar el formulario
    $('#createForm').on('submit', function(e) {
        var clienteId = $('#createCliente').val();
        var monto = $('#createMonto').val();
        if (!monto || monto == 0) {
            // Eliminar cualquier toast anterior
            $('#toast-warning').remove();
            // Crear el toast de advertencia
            $('body').append(`
            <div id="toast-warning" class="fixed top-5 right-5 bg-yellow-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
                <i class="fas fa-exclamation-triangle mr-2"></i> El cliente no cuenta con ningún servicio.
            </div>
        `);
            setTimeout(() => {
                $('#toast-warning').addClass('opacity-0');
            }, 3000);
            e.preventDefault();
            return false;
        }
    });

    // Crear Pago
    document.getElementById('createModal').addEventListener('show.bs.modal', function() {
        document.getElementById('createForm').reset();
        document.getElementById('createForm').action = "{{ route('pagos.store') }}";
    });
</script>
@endpush