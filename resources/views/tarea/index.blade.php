@extends('layouts.layout-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/fullcalendar/fullcalendar.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ mix('/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootbox/bootbox.js') }}"></script>


    <!-- Javascript -->
    <script>
        $(function () {
            var today = new Date();
            var y = today.getFullYear();
            var m = today.getMonth();
            var d = today.getDate();

            var eventList = {!! json_encode($eventList) !!};

            // Default view
            // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
            var defaultCalendar = new Calendar($('#fullcalendar-default-view')[0], {
                locale: 'es',
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week:'Semana',
                    day: 'Día',
                    list: 'Lista',
                },
                plugins: [
                    calendarPlugins.bootstrap,
                    calendarPlugins.dayGrid,
                    calendarPlugins.timeGrid,
                    calendarPlugins.interaction
                ],
                dir: $('html').attr('dir') || 'ltr',

                // Bootstrap styling
                themeSystem: 'bootstrap',
                bootstrapFontAwesome: {
                    close: ' ion ion-md-close',
                    prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
                    next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
                    prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
                    nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
                },

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                defaultDate: today,
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                weekNumbers: true, // Show week numbers
                nowIndicator: true, // Show "now" indicator
                firstDay: 1, // Set "Monday" as start of a week
                businessHours: {
                    startTime: '08:30',
                    endTime: '18:30',
                    daysOfWeek: [1, 2, 3, 4, 5],
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: eventList,
                views: {
                    dayGrid: {
                        eventLimit: 8
                    }
                },
                eventRender: function (info) {
                    console.log('eventRender ifo: ', info);
                    if(info.view.type === "dayGridMonth"){
                        info.el.firstChild.innerHTML = `<span id="event-${info.event.id}">
                        ${moment(info.event.start).format('HH:mm')} - 
                        ${moment(info.event.end).format('HH:mm')} 
                        <span style="font-weight: bold;float: right;">${info.event.extendedProps.horas}hh</span><br />
                        <b>${info.event.extendedProps.iniciativa}</b></span>`;
                    }else{
                        html_button= '<button type="button" class="btn btn-sm btn-outline-danger rounded-pill removebtn" style="position: absolute;bottom: 15px;right: 15px;" title="Eliminar tarea"><span class="ion ion-md-trash d-block"></span></button>';
                        $(info.el).append(html_button);
                        info.el.firstChild.innerHTML = `<span id="event-${info.event.id}">
                        ${moment(info.event.start).format('HH:mm')} - 
                        ${moment(info.event.end).format('HH:mm')}
                        <span style="font-weight: bold;float: right;">${info.event.extendedProps.horas}hh</span><br />
                        <b>${info.event.extendedProps.iniciativa}</b><br />
                        ${info.event.extendedProps.observaciones}</span>`;
                    }

                    $(info.el).find(".removebtn").click(function(e) {
                        e.preventDefault();
                        var eventData = {id: info.event.id}
                        info.event.remove();
                        console.log('eliminar: ', info.event.id);
                        bootbox.confirm({
                            message:   '¿Confirma que desea eliminar la tarea en <b>'+ info.event.extendedProps.iniciativa +'</b>?',
                            className: 'bootbox-sm',
                            callback: function(result) {
                                if(result)
                                {
                                    $.ajax({
                                        url: 'eliminar-tarea',
                                        data: eventData,
                                        type: 'POST',
                                        success: function(response) {
                                            if(response.status == 'success')
                                            {
                                                $('#fullcalendar-default-view-modal').modal('hide');
                                            }
                                        },
                                        error: function(e) {
                                            $("#message-error-tarea").html(e.responseJSON.message).show();
                                        }
                                    });
                                    
                                }else{
                                    defaultCalendar.addEvent(info.event);
                                }
                            },
                        });
                    });
                },
                select: function (selectionData) {
                    console.log('select selectionData: ', selectionData);
                    $('#fullcalendar-default-view-modal')
                    .on('shown.bs.modal', function() {
                        $("#sel-ticket").val("-1").change();
                        $("#txt-observaciones").val("");
                        $("#sel-ticket").trigger('focus');
                    })
                    .on('hidden.bs.modal', function() {
                        $(this).off('shown.bs.modal hidden.bs.modal submit');
                        $("#sel-ticket").val("-1").change();
                        $("#txt-observaciones").val("");
                        $("#message-error-tarea").html('').hide();
                        defaultCalendar.unselect();
                    })
                    .on('submit', function(e) {
                        e.preventDefault();

                        console.log('submit selectionData: ', selectionData);

                        //Si se selecciona el dia completo
                        if(selectionData.allDay)
                        {
                            console.log('allDay');
                            var timeStart = moment(selectionData.start).toDate();
                            var timeEnd = moment(selectionData.start).toDate();
                            timeStart.setHours(9);
                            timeStart.setMinutes(00);
                            timeEnd.setHours(18);
                            timeEnd.setMinutes(00);
                            var objStart = timeStart;
                            var objEnd = timeEnd;
                            var startStr = selectionData.startStr;
                            var endStr = selectionData.startStr;
                            
                        }else{
                            console.log('noooo allDay');
                            var objStart = selectionData.start;
                            var objEnd = selectionData.end;
                            var startStr = selectionData.startStr;
                            var endStr = selectionData.endStr;
                        }

                        var observaciones = $("#txt-observaciones").val();
                        var cod_ticket = $('#sel-ticket :selected').val();
                        var iniciativa = $('#sel-ticket :selected').text();
                        console.log('observaciones: ', observaciones);
                        console.log('cod_ticket: ', cod_ticket);
                        console.log('objStart: ', objStart);
                        console.log('objEnd: ', objEnd);

                        if (observaciones && cod_ticket !== '-1') {
                            var eventData = {
                                observaciones: observaciones,
                                iniciativa: iniciativa,
                                start: objStart,
                                end: objEnd,
                                startStr: startStr,
                                endStr: endStr,
                                className: null,
                                cod_ticket: cod_ticket,
                                dia: selectionData.allDay
                            }
                            console.log('eventData: ', eventData);
                            $.ajax({
                                url: 'registrar-tarea',
                                data: eventData,
                                type: 'POST',
                                success: function(response) {
                                    if(response.status == 'success')
                                    {
                                        eventData['id'] = response.id;
                                        eventData['horas'] = response.horas;
                                        console.log('eventData success: ', eventData);
                                        defaultCalendar.addEvent(eventData);
                                        $('#fullcalendar-default-view-modal').modal('hide');
                                    }
                                },
                                error: function(e) {
                                    $("#message-error-tarea").html(e.responseJSON.message).show();
                                }
                            });
                        }else{
                            $("#message-error-tarea").html('Debe ingresar iniciativa y observación.').show();
                        }
                    })
                    .modal('show');
                },
                eventClick: function(info) {
                    console.log('eventClick info.event: ', info.event);
                    $('#fullcalendar-default-view-modal')
                    .on('shown.bs.modal', function() {
                        $('#txt-observaciones').val(info.event.extendedProps.observaciones);
                        $("#sel-ticket").val(info.event.extendedProps.cod_ticket).change();
                        $("#sel-ticket").trigger('focus');
                        // $(".modal-tarea").append('<button type="button" class="btn btn-danger md-btn-flat">Eliminar</button>')

                    })
                    .on('hidden.bs.modal', function() {
                        $(this).off('shown.bs.modal hidden.bs.modal submit');
                        $("#sel-ticket").val("-1").change();
                        $("#txt-observaciones").val("");
                        $("#message-error-tarea").html('').hide();
                        defaultCalendar.unselect();
                    })
                    .on('submit', function(e) {
                        e.preventDefault();
                        console.log('submit info.event: ', info.event);
                        var observaciones = $("#txt-observaciones").val();
                        var cod_ticket = $('#sel-ticket :selected').val();
                        var iniciativa = $('#sel-ticket :selected').text();
                        console.log('observaciones: ', observaciones);
                        console.log('cod_ticket: ', cod_ticket);

                        if (observaciones && cod_ticket !== '-1') {
                            var eventData = {
                                observaciones: observaciones,
                                iniciativa: iniciativa,
                                start: info.event.start,
                                end: info.event.end,
                                className: null,
                                cod_ticket: cod_ticket,
                                id: info.event.id
                            }
                            
                            var event = defaultCalendar.getEventById(info.event.id);
                            event.remove();
                            
                            $.ajax({
                                url: 'actualizar-tarea',
                                data: eventData,
                                type: 'POST',
                                success: function(response) {
                                    if(response.status == 'success')
                                    {
                                        eventData['horas'] = response.horas;
                                        defaultCalendar.addEvent(eventData);
                                        $('#fullcalendar-default-view-modal').modal('hide');
                                    }
                                },
                                error: function(e) {
                                    console.log('exception: ', e);
                                    $("#message-error-tarea").html(e.responseJSON.message).show();
                                }
                            });
                        }else{
                            $("#message-error-tarea").html('Debe ingresar iniciativa y observación.').show();
                        }
                    })
                    .modal('show');
                },
                eventDrop: function(info) {
                    console.log('eventDrop info.event: ', info.event);
                    bootbox.confirm({
                        message:   '¿Confirma que desea mover la tarea en <b>' + info.event.extendedProps.iniciativa + '</b>?',
                        className: 'bootbox-sm',
                        callback: function(result) {
                            if (!result) {
                                info.revert();
                            }else{
                                var eventData = {
                                    observaciones: info.event.extendedProps.observaciones,
                                    iniciativa: info.event.extendedProps.iniciativa,
                                    start: info.event.start,
                                    end: info.event.end,
                                    className: null,
                                    cod_ticket: info.event.extendedProps.cod_ticket,
                                    id: info.event.id
                                }
                                $.ajax({
                                    url: 'actualizar-tarea',
                                    data: eventData,
                                    type: 'POST',
                                    success: function(response) {
                                        if(response.status == 'success')
                                        {
                                            $('#fullcalendar-default-view-modal').modal('hide');
                                        }
                                    },
                                    error: function(e) {
                                        $("#message-error-tarea").html(e.responseJSON.message).show();
                                    }
                                });
                            }
                        },
                    });
                },
                eventResize: function(info) {
                    console.log('eventResize info.event: ', info.event);
                    bootbox.confirm({
                        message:   '¿Confirma que desea guardar los cambios en <b>'+ info.event.extendedProps.iniciativa +'</b>?',
                        className: 'bootbox-sm',
                        callback: function(result) {
                            if (!result) {
                                info.revert();
                            }else{
                                var eventData = {
                                    observaciones: info.event.extendedProps.observaciones,
                                    iniciativa: info.event.extendedProps.iniciativa,
                                    start: info.event.start,
                                    end: info.event.end,
                                    className: null,
                                    cod_ticket: info.event.extendedProps.cod_ticket,
                                    id: info.event.id
                                }

                                $.ajax({
                                    url: 'actualizar-tarea',
                                    data: eventData,
                                    type: 'POST',
                                    success: function(response) {
                                        if(response.status == 'success')
                                        {
                                            info.event.setExtendedProp('horas', response.horas);
                                            $('#fullcalendar-default-view-modal').modal('hide');
                                        }
                                    },
                                    error: function(e) {
                                        $("#message-error-tarea").html(e.responseJSON.message).show();
                                    }
                                });
                            }
                        },
                    });
                }
            });
            
            defaultCalendar.render();
        });
    </script>
<!-- / Javascript -->
    
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light"></span> Tareas
    </h4>

    <hr class="container-m-nx border-light mt-0 mb-4">

    <!-- Event modal -->
    <form class="modal modal-top fade" id="fullcalendar-default-view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Iniciativa</label>
                        <select class="custom-select" id="sel-ticket">
                            <option value="-1" selected>[Seleccione]</option>
                            @if(sizeof($tickets)>0)
                                @foreach($tickets as $ticket)
                                    <option value="{{ $ticket->codigo }}">{{ $ticket->descripcion }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" id="txt-observaciones" placeholder="Observaciones"></textarea>
                    </div>
                    <div id="message-error-tarea" class="alert alert-dark-danger fade show" style="display: none;"></div>
                </div>
                <div class="modal-footer modal-tarea">
                    <button type="button" class="btn btn-default md-btn-flat" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary md-btn-flat">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    <!-- / Event modal -->

    <div class="card mb-4">
        <div class="card-body">
            <div id='fullcalendar-default-view'></div>
        </div>
    </div>

@endsection