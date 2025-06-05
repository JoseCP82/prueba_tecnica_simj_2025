@extends('layouts.admin')

@section('content')
<div class="row">
    <!-- Eventos externos -->
    <div class="col-md-3">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Eventos Arrastrables</h4>
                </div>
                <div class="card-body">
                    <div id="external-events">
                        <div class="external-event bg-success">Evento 1</div>
                        <div class="external-event bg-warning">Evento 2</div>
                        <div class="external-event bg-info">Evento 3</div>
                        <div class="external-event bg-primary">Evento 4</div>
                        <div class="external-event bg-danger">Evento 5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendario -->
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-body p-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<!-- Calendario -->
<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-body p-0">
            <div id="calendar"></div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Aquí va el JS que te pasé antes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>

<script>
    $(function() {
        // Inicializar eventos externos como elementos arrastrables
        function ini_events(ele) {
            ele.each(function() {
                var eventObject = {
                    title: $.trim($(this).text())
                };

                // Almacenar objeto de evento en el DOM
                $(this).data('eventObject', eventObject);

                // Hacerlo arrastrable con jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true,
                    revertDuration: 0
                });
            });
        }

        ini_events($('#external-events div.external-event'));

        // Inicializar calendario
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var calendar = new Calendar(calendarEl, {
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            editable: true,
            droppable: true, // permite soltar eventos externos

            drop: function(info) {
                // Eliminar el evento original si la opción está activada
                if ($('#drop-remove').is(':checked')) {
                    $(info.draggedEl).remove();
                }
            }
        });

        calendar.render();
    });
</script>

<style>
    #calendar {
        min-height: 600px;
        padding: 10px;
    }

    .external-event {
        padding: 10px;
        margin-bottom: 10px;
        cursor: move;
    }
</style>
@endsection