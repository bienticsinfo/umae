$(document).ready(function (e){
    $('body #example_length ,.DTTT ').addClass('hidden');  
    $('#txtRol').select2();
    $("#txtTelefono").mask("(999) 999-9999");
    $('#registro-user').submit(function (e){
        
        e.preventDefault();
        if(isValidEmail($('#txtEmail').val())){
            if($('#txtContra').val()==$('#txtContraC').val()){
                $.ajax({
                    url: base_url+"conservacion/usuarios/insert_usuario",
                    type: 'POST',
                    dataType: 'json',
                    data:$(this).serialize(),
                    beforeSend:function (){
                        msj_success_noti('Espere por favor...');
                    },
                    success: function (data) {
                        if(data['accion']==1){
                            msj_success_noti('Registro guardado');
                            location.replace(base_url+'usuarios');
                        }else{
                            msj_error_noti('Error al guardar el registro');
                        }
                    },error: function (e) {
                        console.log(e);
                    }
                })
            }else{
                msj_error_noti('Las contraseñas escritas no coinciden')
            }

        }else{
            msj_error_noti('Formato de email no valido')
        }
    })
    var accion=$('input[name=txtAccion]').val();
    if(accion!=undefined){
        if(accion=='edit'){
            $('input[type=password]').removeAttr('required');
            $('input[name=txtUsuario]').prop('readonly',true);
        }else{
            $('#txtUsuario').blur(function (){
                if($(this).val()!=''){
                    $.ajax({
                        url: base_url+"conservacion/usuarios/check_user",
                        type: 'POST',
                        dataType: 'json',
                        data:{'user':$(this).val()},
                        beforeSend: function (xhr) {
                            msj_success_noti('Verificando disponibilidad de usuario...');
                        },success: function (data, textStatus, jqXHR) {
                            if(data['accion']==1){
                                msj_success_noti('Usuario disponible');
                                $('.btn-add').prop('disabled',false);
                            }else{
                                msj_error_noti('Usuario no disponible');
                                $('.btn-add').prop('disabled',true);
                            }
                        },error: function (e) {
                            console.log(e)
                        }
                    })
                }
            })
        }
    }
    $('.fa-trash').click(function (){
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
            $.ajax({
                url: base_url+"conservacion/usuarios/delete_user",
                type: 'POST',
                dataType: 'json',
                data:{'user':el},
                beforeSend: function (xhr) {
                    msj_success_noti('Espere por favor...');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']==1){
                        msj_success_noti('Usuario eliminado');
                        $('#'+el).remove();
                    }else{
                        msj_error_noti('Usuario no eliminado');
                    }
                },error: function (e) {
                    console.log(e)
                }
            })
        }
    })
    $('.bloq-user').click(function (){
        bloq('¿DESEAS BLOQUEAR ESTE USUARIO?','Bloqueando',$(this).attr('data-id'),$(this).attr('data-accion'))

    })
    $('.desbloq-user').click(function (){
        bloq('¿DESEAS DESBLOQUEAR ESTE USUARIO?','Desbloqueando',$(this).attr('data-id'),$(this).attr('data-accion'))

    })
    function bloq(msj,msj2,id,accion){
        if(confirm(msj)){
            $.ajax({
                url: base_url+"conservacion/usuarios/bloquer_user",
                type: 'POST',
                dataType: 'json',
                data:{'id':id,'accion':accion},
                beforeSend: function () {
                    msj_success_noti(msj2+' usuario..');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']==1){
                        location.reload();
                    }else{
                        msj_error_noti('Error al realizar la acción');
                    }
                },error: function (e) {
                    console.log(e)
                }
            })
        }
    }
})
