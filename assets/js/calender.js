/* Webarch Admin Dashboard 
-----------------------------------------------------------------*/	
	$(document).ready(function() {
            $('#external-events div.external-event').each(function() {
                var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                };

                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                });
            });
            $('#calendar').fullCalendar({
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                    }

                }
            });
            $('.fc-header').hide();
            var currentDate = $('#calendar').fullCalendar('getDate');
            
            $("body .fc-day-header").addClass('text-center')
            $("body .fc-widget-content .fc-day-number").addClass('text-center')


            $('#calender-current-day').html(obtenerDia($.fullCalendar.formatDate(currentDate, "dddd")));
            $('#calender-current-date').html(obtenerMes($.fullCalendar.formatDate(currentDate, "MMM"))+' '+$.fullCalendar.formatDate(currentDate, "yyyy"));
            $('#calender-prev').click(function(){
                $("body .fc-day-header").addClass('text-center')
                $("body .fc-widget-content .fc-day-number").addClass('text-center')
                    $('#calendar').fullCalendar( 'prev' );
                    currentDate = $('#calendar').fullCalendar('getDate');		
                    $('#calender-current-day').html(obtenerDia($.fullCalendar.formatDate(currentDate, "dddd")));
                    $('#calender-current-date').html(obtenerMes($.fullCalendar.formatDate(currentDate, "MMM"))+' '+$.fullCalendar.formatDate(currentDate, "yyyy"));
            });
            $('#calender-next').click(function(){
                $("body .fc-day-header").addClass('text-center')
                $("body .fc-widget-content .fc-day-number").addClass('text-center')
                $('#calendar').fullCalendar( 'next' );
                
                currentDate = $('#calendar').fullCalendar('getDate');		
                $('#calender-current-day').html(obtenerDia($.fullCalendar.formatDate(currentDate, "dddd")));
                $('#calender-current-date').html(obtenerMes($.fullCalendar.formatDate(currentDate, "MMM"))+' '+$.fullCalendar.formatDate(currentDate, "yyyy"));
            });
            function obtenerMes(mes){
                if(mes=='Jan'){
                    return 'Enero';
                }else if(mes=='Feb'){
                    return 'Febrero';
                }else if(mes=='Mar'){
                    return 'Marzo';
                }else if(mes=='Apr'){
                    return 'Abril';
                }else if(mes=='May'){
                    return 'Mayo';
                }else if(mes=='Jun'){
                    return 'Junio';
                }else if(mes=='Jul'){
                    return 'Julio';
                }else if(mes=='Aug'){
                    return 'Agosto';
                }else if(mes=='Sep'){
                    return 'Septiembre';
                }else if(mes=='Oct'){
                    return 'Octubre';
                }else if(mes=='Nov'){
                    return 'Noviembre';
                }else if(mes=='Dec'){
                    return 'Diciembre';
                }else{
                    return mes;
                }
            }
            function obtenerDia(day){
                if(day=='Monday'){
                    return 'Lunes';
                }else if(day=='Tuesday'){
                    return 'Martes';
                }else if(day=='Wednesday'){
                    return 'Miércoles';
                }else if(day=='Thursday'){
                    return 'Jueves';
                }else if(day=='Friday'){
                    return 'Viernes';
                }else if(day=='Saturday'){
                    return 'Sábado';
                }else if(day=='Sunday'){
                    return 'Domingo';
                }else{
                    return day;
                }
            }
        });
        