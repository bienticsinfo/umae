$(document).ready(function(e){
    $('.agregar-area').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_area",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    location.href=base_url+'urgencias/areas';
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    if($('input[name=area_camas_radio]').val()=='No'){
        $('.area_camas-no').attr('checked',true)
    }
    $('.agregar-perfil-area').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_perfil_area",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado')
                    history.go(-1);
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })      
    })
    $('.agregar-perfil-area-medico').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_perfil_area_medico",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado')
                    history.go(-1);
                }if(data.accion=='2'){
                    msj_success_noti('El usuario ya se encuentra asignado a esta area')
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        }) 
    })
    $('.eliminar-usuario-area').on('click',function(e){
        var el =$(this).attr('data-id');
        var rol=$(this).attr('data-rol');
        var perfil=$(this).attr('data-perfil');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
            $.ajax({
                url: base_url+"urgencias/eliminar_usuario_area",
                type: 'POST',
                dataType: 'json',
                data:{
                    'id':el,
                    'rol':rol,
                    'perfil':perfil,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro Eliminado');
                        $('#'+el).remove()
                    }
                },error: function (e) {
                    msj_error_serve()
                    console.log(e)
                }
            })
        }
    })
})