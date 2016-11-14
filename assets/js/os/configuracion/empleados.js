$(document).ready(function (){
    $.ajax({
        url: base_url+"configuracion/usuario/get_select",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#empleado_estado').val($('#jtf_empleado_estado').val()).select2();
            $('#empleado_sexo').val($('#jtf_empleado_sexo').val()).select2();
        },error: function (jqXHR, textStatus, errorThrown) {
            
        }
    })
    $('#empleado_fecha_registro').val(fecha_yyyy_mm_dd());
    $('#registrar-usuario').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"configuracion/empleados/insert_empleado",
            dataType: 'json',
            type: 'POST',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...')
            },success: function (data, textStatus, jqXHR) {
                if(data['accion']=='1'){
                    msj_success_noti('Regitro guardado correctamente');
                    location.href=base_url+'configuracion/empleados';
                }else{
                    msj_error_noti('Error al guardar el registro');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.btn-add-horario').click(function (e){
        $('.col-add-horario').removeClass('hide').addClass('col-centered');
        $('.col-gestion-horarios').addClass('hide');
    })
    $('.btn-cancelar').click(function (e){
        $('.col-add-horario').addClass('hide');
        $('.col-gestion-horarios').removeClass('hide').addClass('col-centered')
    })
    $('.registrar-horario').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"configuracion/empleados/insert_horario",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Registro guardado correctamente');
                    setTimeout(function (){
                        location.reload();
                    },1000)
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.del-horario').click(function (e){
        var el=$(this).attr('data-id');
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"configuracion/empleados/delete_horario",
                dataType: 'json',
                type: 'POST',
                data:{'id':el,'csrf_token' : $.cookie('csrf_cookie'),},
                beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro')
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado')
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
})