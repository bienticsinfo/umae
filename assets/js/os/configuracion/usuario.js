$(document).ready(function (){
    var accion=$('#jtf_accion').val();
    if(accion=='edit'){
        $('#empleado_usuario').attr('readonly',true);
        $('#empleado_contrasena,#empleado_contrasena_c').removeAttr('required');
    }
    console.log(location)
    $.ajax({
        url: base_url+"configuracion/usuario/get_select",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#idTipo_Usuario,#empleado_subrol').html(data['option_ro']);
            $('#idEmpleado').html(data['option_em']);
            $('#idEquipo').html(data['option_eq']);
            $('#idEquipo').val($('#jtf_idEquipo').val()).select2();
            $('#empleado_estado').val($('#jtf_empleado_estado').val()).select2();
            //$('#empleado_sexo').val('F').select2();
            var val=$('input[name=roles_asignados]').val().split(',');
            $('#idTipo_Usuario').select2('val',val).select2();
        },error: function (jqXHR, textStatus, errorThrown) {
            
        }
    })
    $('#empleado_fecha_registro').val(fecha_yyyy_mm_dd());
    $('#empleado_usuario').blur(function (e){
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
                    $('.btn-save').attr('disabled',true)
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Usuario disponible')
                        $('.btn-save').removeAttr('disabled')
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
        if($('#empleado_contrasena').val()==$('#empleado_contrasena_c').val()){
            $.ajax({
                url: base_url+"configuracion/usuario/insert",
                dataType: 'json',
                type: 'POST',
                data:$(this).serialize(),
                beforeSend: function (xhr) {
                    msj_success_noti('Guardando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Regitro guardado correctamente');
                        location.href=base_url+'configuracion/usuario';
                    }else{
                        msj_error_noti('Error al guardar el registro');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }else{
            msj_error_noti('Las contraseñas escritas no coinciden');
        }
    })
})