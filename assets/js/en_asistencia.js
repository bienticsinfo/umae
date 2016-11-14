/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $(document).ready(function (){
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if(dd<10) {
            dd='0'+dd
        } 
        if(mm<10) {
            mm='0'+mm
        } 
        hoy = mm+'/'+dd+'/'+yyyy;
        setInterval(function (){
            var tiempo = new Date();
            var hora = tiempo.getHours();
            var minuto = tiempo.getMinutes();
            var segundo = tiempo.getSeconds(); 
            var horarios=hora+":"+minuto+":"+segundo;
            $("#HoraActual").val(horarios);
        },1000);
        document.title='SIGUMAE | Asistencias';
        getAsistencias();
        $('body').on('click','#ver-tabla-asistencia tr',function(){
            $("#filter").val($(this).attr('data-matricula'));
            $("#jtfId").val($(this).attr('id'));
            $("#jtfHoraEntrada").val($(this).attr('data-e'))
            $('body').find('#ver-tabla-asistencia tr').removeClass('b-green-l-i');
            if($(this).attr('id')!=undefined){
                $(this).addClass('b-green-l-i');
                 
            }
        });
        //Horarios
        $("body").on('click','.horaEntrada',function (){
            if($("#jtfId").val()==''){
                alert_error('Debes seleccionar un registro')
            }else{
                $.ajax({
                    url: base_url+"ensenanzas/asistencia/updateAistencia",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'csrf_token':$.cookie('csrf_cookie'),
                        'id'        :$("#jtfId").val(),
                        'tipo'      :'Entrada',
                        'hora'      :$("#HoraActual").val(),
                        'horas'     :$("#jtfHoraEntrada").val(),
                        'fecha'     :hoy
                    },success: function (data) {
                        $("#jtfId").val('');
                        $("#jtfHoraEntrada").val('');
                        getAsistencias()
                        alert_success('Hora de entrada registrada');
                    },error: function (e) {

                    } 
                })  
            }
        })
        $("body").on('click','.horaSalida',function (){
            if($("#jtfId").val()==''){
                alert_error('Debes seleccionar un registro')
            }else{
                $.ajax({
                    url: base_url+"ensenanzas/asistencia/updateAistencia",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'csrf_token':$.cookie('csrf_cookie'),
                        'id'        :$("#jtfId").val(),
                        'tipo'      :'Salida',
                        'hora'      :$("#HoraActual").val(),
                        'horas'     :$("#jtfHoraEntrada").val(),
                        'fecha'     :hoy
                    },success: function (data) {
                        $("#jtfId").val('');
                        $("#jtfHoraEntrada").val('');
                        getAsistencias()
                        alert_success('Hora de salida registrada');
                    },error: function (e) {

                    }
                }) 
            }
        })
    });

    var getAsistencias=function (){
        $.ajax({
            url: base_url+"ensenanzas/asistencia/getUsersAll",
            dataType: 'json',
            success: function (data) {
                switch (data['action']){
                    case '1':
                        $("#ver-tabla-asistencia tbody").html(data['tr'])
                            .trigger('footable_initialize')
                            .trigger('footable_redraw')
                            .trigger('footable_resize');
                        break;
                    case '2':
                        alert_error(data['msj'])
                        break;
                }
            },error: function (error) {
                console.log(error);
            }
        })
    }


