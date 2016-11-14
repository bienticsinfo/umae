/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (){
    
    $("body").on('click','.fc-widget-content',function (){
        var fecha=$(this).attr('data-date');
        $("body .fc-widget-content").removeClass('fc-state-highlight');
        $(this).addClass('fc-state-highlight')
        $.ajax({
            url: base_url+"ensenanzas/asistencia/getUsersCalendar",
            dataType: 'json',
            type: 'POST',
            data: {
                'csrf_token':$.cookie('csrf_cookie'),
                'date'  : fecha
            },success: function (data) {
                $(".pointer").removeClass('active')
                $(".tab-pane").removeClass('active');
                $(".tabAsistencia").addClass('active');
                $(".tabAsistencia").removeClass('no-display');
                $("#tab-asistencias").addClass('active');
                console.log(fecha)
                switch (data['action']){
                    case '1':
                        $("#ver-tabla-asistencia tbody").html(data['tr'])
                            .trigger('footable_initialize')
                            .trigger('footable_redraw')
                            .trigger('footable_resize');
                        break;
                    case '2':
                        $('#ver-tabla-asistencia tbody').empty();
                        $('#ver-tabla-asistencia').trigger('footable_redraw');
                        alert_error(data['msj']);
                        break;
                }
            },error: function (e) {
                console.log(e)
            }
        })
    })
    $(".tabCalendario").click(function (){
        $(".pointer").removeClass('active')
        $(".tab-pane").removeClass('active');
        $(".tabCalendario").addClass('active');
        $(".tabAsistencia").addClass('no-display')
        $("#tab-calendario").addClass('active');
    });
})

