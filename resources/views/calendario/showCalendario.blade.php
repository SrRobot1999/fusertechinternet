@extends('layouts.app')

@push('styles_template')
<script src="{{ asset('bundles/fullcalendar/index.global.min.js') }}"></script>
@endpush
<script></script>
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Calendario de pagos</h4>
            </div>
            <div class="card-body">
                <div class="fc-overflow">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal event -->
<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventoModalLabel">Detalle del Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="eventoModalBody">
                <!-- Aquí se carga el contenido dinámico -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_template')
<script src="{{ asset('bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bundles/prism/prism.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var calendarEl = document.getElementById("calendar");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prevYear,prev,next,nextYear today",
                center: "title",
                right: "dayGridMonth,dayGridWeek,dayGridDay,listWeek",
            },
            initialDate: "2025-06-01",
            navLinks: false, // can click day/week names to navigate views
            editable: false,
            dayMaxEvents: true, // allow "more" link when too many events
            locale: "es",
            droppable: false,
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            events: [{
                    title: "Serapio Pulache",
                    start: "2025-06-13",
                    end: "2025-06-14",
                    backgroundColor: "#77bcd4",
                    description: "Pago pendiente",
                },
                {
                    title: "Brandy y sus amigos",
                    start: "2025-06-13",
                    end: "2025-06-14",
                    backgroundColor: "#11pcd4",
                    description: "Pago pendiente",
                }, {
                    title: "Juan Pérez",
                    start: "2025-06-07",
                    end: "2025-06-08",
                    backgroundColor: "#00bcd4",
                    description: "Pago pendiente",
                },
                {
                    title: "María López",
                    start: "2025-06-07",
                    end: "2025-06-08",
                    backgroundColor: "#fe9701",
                    description: "Pago pendiente",
                },
                {
                    title: "Carlos Sánchez",
                    start: "2025-06-27",
                    end: "2025-06-28",
                    backgroundColor: "#F3565D",
                    description: "Pago pendiente",
                },
                {
                    title: "Lucía Torres",
                    start: "2025-06-21",
                    end: "2025-06-22",
                    backgroundColor: "#1bbc9b",
                    description: "Pago pendiente",
                },
                {
                    title: "José Ramírez",
                    start: "2025-06-24",
                    end: "2025-06-25",
                    backgroundColor: "#DC35A9",
                    description: "Pago pendiente",
                },
                {
                    title: "Ana Gómez",
                    start: "2025-06-14",
                    end: "2025-06-15",
                    backgroundColor: "#fe9701",
                    description: "Pago pendiente",
                },
                {
                    title: "Luis García",
                    start: "2025-06-02",
                    end: "2025-06-03",
                    backgroundColor: "#00bcd4",
                    description: "Pago pendiente",
                },
                {
                    title: "Elena Díaz",
                    start: "2025-06-17",
                    end: "2025-06-18",
                    backgroundColor: "#9b59b6",
                    description: "Pago pendiente",
                },
                {
                    title: "Samuel Bereche",
                    start: "2025-06-11",
                    end: "2025-06-12",
                    backgroundColor: "#F3565D",
                    description: "Pago pendiente",
                },
                {
                    title: "Yuliana Alama",
                    start: "2025-06-04",
                    end: "2025-06-05",
                    backgroundColor: "#F3565D",
                    description: "Pago pendiente",
                },
            ],
            eventClick: function(info) {
                // Evita que se siga el enlace (si lo tiene)
                info.jsEvent.preventDefault();

                // Mostrar información en el modal
                document.getElementById('eventoModalLabel').innerText = info.event.title;
                document.getElementById('eventoModalBody').innerHTML = `
            <p><strong>Inicio:</strong> ${info.event.start.toLocaleString()}</p>
            <p><strong>Descripción:</strong> ${info.event.extendedProps.description || 'Sin descripción'}</p>
        `;

                // Mostrar modal con Bootstrap 5
                var modal = new bootstrap.Modal(document.getElementById('eventoModal'));
                modal.show();
            }
        });

        calendar.render();
    });
</script>
@endpush