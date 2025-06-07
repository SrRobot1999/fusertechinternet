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
                <h4>Tickets Registrados</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Nuevo Ticket
                </button>
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
                            <tr data-id="{{ $ticket->id }}">
                                <td>{{ $ticket->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $ticket->usuario->nombre ?? 'Sin usuario' }}</td>
                                <td>{{ $ticket->asunto }}</td>
                                <td>{{ Str::limit($ticket->descripcion, 50) }}</td>
                                <td>
                                    @if($ticket->estado == 1)
                                    <span class="badge badge-success" style="background-color:#38a169;">Terminado</span>
                                    @else
                                    <span class="badge badge-warning" style="background-color:#f6ad55; color:#fff;">Pendiente</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($ticket->fecha_creacion)->format('d-m-Y') }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <div class="d-flex gap-3">
                                        <button onclick="openViewModal('{{ $ticket->id }}')" class="text-green-600 hover:text-green-800 text-xl">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 text-xl btn-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $ticket->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $ticket->id }}')" class="text-red-600 hover:text-red-800 text-xl btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $ticket->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <a class="text-gray-500 hover:text-gray-800 text-xl btn-print" href="/tickets/{{ $ticket->id }}">
                                            <i class="fa-solid fa-file-pdf text-gray-500"></i>
                                        </a>
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

<!-- Modal Crear Ticket -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createForm" method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control" name="cliente_id" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <select class="form-control" name="usuario_id" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asunto</label>
                        <input type="text" class="form-control" name="asunto" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" required>
                            <option value="1">Terminado</option>
                            <option value="0">Pendiente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Creación</label>
                        <input type="date" class="form-control" name="fecha_creacion" required>
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

<!-- Modal Ver Ticket -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Cliente</dt>
                    <dd class="col-sm-8" id="viewCliente"></dd>
                    <dt class="col-sm-4">Usuario</dt>
                    <dd class="col-sm-8" id="viewUsuario"></dd>
                    <dt class="col-sm-4">Asunto</dt>
                    <dd class="col-sm-8" id="viewAsunto"></dd>
                    <dt class="col-sm-4">Descripción</dt>
                    <dd class="col-sm-8" id="viewDescripcion"></dd>
                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8" id="viewEstado"></dd>
                    <dt class="col-sm-4">Fecha de Creación</dt>
                    <dd class="col-sm-8" id="viewFecha"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Ticket -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Ticket</h5>
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
                        <label>Usuario</label>
                        <select class="form-control" name="usuario_id" id="editUsuario">
                            @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asunto</label>
                        <input type="text" class="form-control" name="asunto" id="editAsunto" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion" id="editDescripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" id="editEstado">
                            <option value="1">Terminado</option>
                            <option value="0">Pendiente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Creación</label>
                        <input type="date" class="form-control" name="fecha_creacion" id="editFecha" required>
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

<!-- Modal Eliminar Ticket -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar Ticket?</h5>
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
    $("#table-tickets").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [6]
        }]
    });

    // Limpiar el formulario al abrir el modal
    $('#createModal').on('show.bs.modal', function() {
        $(this).find('form')[0].reset();
    });

    // Ver Ticket
    function openViewModal(ticketId) {
        fetch("{{ url('tickets') }}/" + ticketId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('viewCliente').textContent = data.cliente?.nombre ?? '';
                document.getElementById('viewUsuario').textContent = data.usuario?.nombre ?? '';
                document.getElementById('viewAsunto').textContent = data.asunto ?? '';
                document.getElementById('viewDescripcion').textContent = data.descripcion ?? '';
                document.getElementById('viewEstado').textContent = data.estado == 1 ? 'Terminado' : 'Pendiente';
                document.getElementById('viewFecha').textContent = data.fecha_creacion ?? '';
                $('#viewModal').modal('show');
            });
    }

    // Editar Ticket
    document.querySelectorAll('#table-tickets .btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            const ticketId = row.getAttribute('data-id');
            const clienteNombre = row.children[0].textContent.trim();
            const usuarioNombre = row.children[1].textContent.trim();
            const asunto = row.children[2].textContent.trim();
            const descripcion = row.children[3].textContent.trim();
            const estadoTexto = row.children[4].textContent.trim();
            const fecha = row.children[5].textContent.trim();

            // Seleccionar cliente
            const clienteSelect = document.getElementById('editCliente');
            for (let i = 0; i < clienteSelect.options.length; i++) {
                if (clienteSelect.options[i].text === clienteNombre) {
                    clienteSelect.selectedIndex = i;
                    break;
                }
            }
            // Seleccionar usuario
            const usuarioSelect = document.getElementById('editUsuario');
            for (let i = 0; i < usuarioSelect.options.length; i++) {
                if (usuarioSelect.options[i].text === usuarioNombre) {
                    usuarioSelect.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('editAsunto').value = asunto;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editEstado').value = (estadoTexto === 'Terminado') ? '1' : '0';
            document.getElementById('editFecha').value = fecha;

            // Actualizar la acción del formulario
            const url = "{{ route('tickets.update', ':id') }}".replace(':id', ticketId);
            document.getElementById('editForm').action = url;
        });
    });

    // Eliminar Ticket
    function openDeleteModal(ticketId) {
        const url = "{{ route('tickets.destroy', ':id') }}".replace(':id', ticketId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
</script>
@endpush