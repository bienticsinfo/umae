$(document).ready(function (){
    var accion=$('#jtf_accion').val();
    if(accion=='edit'){
        $('#empleado_usuario').attr('readonly',true);
        $('#empleado_contrasena,#empleado_contrasena_c').removeAttr('required');
    }
    $.ajax({
        url: base_url+"configuracion/usuario/get_select",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#idTipo_Usuario').html(data['option_ro']);
            $('#idEmpleado').html(data['option_em']);
            $('#equipo_id').html(data['option_eq']);
            $('#idTipo_Usuario').val($('#jtf_idTipo_Usuario').val()).select2();
            $('#equipo_id').val($('#jtf_idEquipo').val()).select2();
            $('#empleado_estado').val($('#jtf_empleado_estado').val()).select2();
            //$('#empleado_sexo').val('F').select2();
            $('#empleado_sexo').val($('#jtf_empleado_sexo').val()).select2();
        },error: function (jqXHR, textStatus, errorThrown) {
            
        }
    })
    $('#empleado_fecha_registro').val(fecha_yyyy_mm_dd());
    $('#new_user').blur(function (e){
        if($(this).val()!='' && accion!='edit'){
            $.ajax({
                url: base_url+"configuracion/usuario/check_user",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token':$('body input[name=csrf_token]').val(),
                    'user':$(this).val()
                },beforeSend: function (xhr) {
                    msj_success_noti('Verificando disponibilidad de usuario');
                    $('.btn-cambiar-usuario').attr('disabled',true)
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Usuario disponible')
                        $('.btn-cambiar-usuario').removeAttr('disabled')
                    }else{
                        msj_error_noti('Usuario no disponible')
                    }
                },error: function () {
                    msj_error_serve()
                }
            })
        }
    })
    $('#registrar-usuario').submit(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"configuracion/usuario/update_data_profile",
            dataType: 'json',
            type: 'POST',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...')
            },success: function (data, textStatus, jqXHR) {
                if(data['accion']=='1'){
                    msj_success_noti('Regitro guardado correctamente');
                    location.reload();
                }else{
                    msj_error_noti('Error al guardar el registro');
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.form-cambiar-user').submit(function (e){
        e.preventDefault()
        if(md5($('#empleado_contrasena_actual').val())==$('#empleado_contrasena').val()){
            $.ajax({
                url: base_url+"configuracion/usuario/update_user",
                dataType: 'json',
                type: 'POST',
                data:$(this).serialize(),
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Regitro guardado correctamente');
                        location.reload();
                    }else{
                        msj_error_noti('Error al guardar el registro');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }else{
            msj_error_noti('La contraseña actual es incorrecta');
        }
    })
    $('.form-cambiar-pass').submit(function (e){
        e.preventDefault()
        var pass_new=$('#empleado_contrasena_u').val();
        var pass_new_c=$('#empleado_contrasena_u_c').val();
        if(pass_new==pass_new_c){
            if(md5($('#empleado_contrasena_actual_p').val())==$('#empleado_contrasena').val()){
                $.ajax({
                    url: base_url+"configuracion/usuario/update_pass",
                    dataType: 'json',
                    type: 'POST',
                    data:$('.form-cambiar-pass').serialize(),
                    beforeSend: function (xhr) {
                        msj_success_noti('Guardando registro...')
                    },success: function (data, textStatus, jqXHR) {
                        if(data['accion']=='1'){
                            msj_success_noti('Regitro guardado correctamente');
                            location.reload();
                        }else{
                            msj_error_noti('Error al guardar el registro');
                        }
                    },error: function (jqXHR, textStatus, errorThrown) {
                        msj_error_serve()
                    }
                })
            }else{
                msj_error_noti('La contraseña actual es incorrecta');
            }
        }else{
            msj_error_noti('Las contraseñas escritas no coinciden');
        }
    })
    $('.informacion-perfil').submit(function (e){
        e.preventDefault()
        if($('#filename').val()!=''){
            $.ajax({
                url: base_url+"configuracion/usuario/update_perfil",
                dataType: 'json',
                type: 'POST',
                data:$(this).serialize(),
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Regitro guardado correctamente');
                        location.reload();
                    }else{
                        msj_error_noti('Error al guardar el registro');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }else{
            msj_error_noti('Seleccionar imagen de perfil')
        }
    })    
    $('.edit-perfil-image').click(function (e){
        coordx= screen.width ? (screen.width)/2 : 0; 
        coordy= screen.height ? (screen.height)/2 : 0; 
        window.open(base_url+ 'configuracion/usuario/miperfil_cambiar_image','CambiarPerfil','width=500,height=350,top=60,right='+coordx+',left='+coordy);  
    })
})