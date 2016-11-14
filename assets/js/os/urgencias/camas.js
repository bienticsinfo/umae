$(document).ready(function (e){
    $('.agregar-cama').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_cama",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    location.href=base_url+'urgencias/camas?area='+$('input[name=area_id]').val();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $.ajax({
        url: base_url+"urgencias/get_derechohabiente",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#derechohabiente_id').html(data.option)
            $('#derechohabiente_id').val($('#derechohabiente_id').attr('data-id')).select2()
        }
    })
    if($('input[name=cama_dh]').val()!='0'){
        $('#derechohabiente_id').attr('disabled',true);
        $('input[name=cama_dh_fecha_entrada],input[name=cama_dh_hora_entrada]').attr('disabled',true);
    }else{
        $('.form-salida').hide();
        $('input[name=cama_dh_fecha_salida],input[name=cama_dh_hora_salida]').attr('disabled',true);
    }
    $('.asignar-cama').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/asignar_cama",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Asignando derechohabiente...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    ///location.reload();
                    history.go(-1);
                    msj_success_noti('Derechohabiente Asignado');
                }if(data.accion=='2'){
                    history.go(-1);
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.dar-mantenimiento').on('click',function(e){
        var el=$(this).attr('data-id');
        var accion=$(this).attr('data-accion');
        var msj;
        if(accion=='Disponible'){
            msj='¿DESEA FINALIZAR EL MANTENIMIENTO DE ESTA CAMA?';
        }else{
            msj='¿DESEA MANDAR A MANTENIMIENTO ESTA CAMA?';
        }
        if(confirm(msj)){
           $.ajax({
                url: base_url+"urgencias/dar_mantenimiento",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'accion':accion,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando cambios');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
           })
        }
    })
    $('.asignar-empleado-area').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/asignar_empleado_area",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    history.go(-1);
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.eliminar-cama').on('click',function (e){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTA CAMA?')){
            $.ajax({
                url: base_url+"urgencias/eliminar_cama",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
    $('.eliminar-area').on('click',function (e){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTA ÁREA?')){
            $.ajax({
                url: base_url+"urgencias/eliminar_area",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
    $('.eliminar-rol-area').on('click',function(e){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTA REGISTRO?')){
            $.ajax({
                url: base_url+"urgencias/eliminar_area_rol",
                type: 'POST',
                dataType: 'json',
                data:{'id':el,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
})