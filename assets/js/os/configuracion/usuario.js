$(document).ready(function (){
    $('select[name=empleado_sexo]').select2('val',$('select[name=empleado_sexo]').data('value')).select2();
    $('select[name=empleado_estado]').select2('val',$('select[name=empleado_estado]').data('value')).select2();
    $('select[name=empleado_turno]').select2('val',$('select[name=empleado_turno]').data('value')).select2();
    $('select[name=rol_id]').select2('val',$('select[name=rol_id]').data('value')).select2();
    $('#registrar-usuario').submit(function (e){
        e.preventDefault()
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
    })
    if($('input[name=jtf_accion]').val()=='edit'){
        $('input[name=empleado_matricula]').attr('disabled',true);
    }
    $('input[name=empleado_matricula]').blur(function (e){
        if($(this).val()!=''){
            $.ajax({
                url: base_url+"configuracion/usuario/check_matricula",
                type: 'POST',
                dataType: 'json',
                data: {
                    'empleado_matricula':$(this).val(),
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_success_noti('Verificando Matricula')
                },success: function (data, textStatus, jqXHR) {
                    if(data.ACCION=='EXISTE'){
                        msj_error_noti('LA MATRICULA ESCRITA YA ESTA ASIGNADA A OTRO USUARIO')
                        $('button[type=submit]').attr('disabled',true);
                    }if(data.ACCION=='NO_EXISTE'){
                        msj_success_noti('MATRICULA DISPONIBLE')
                        $('button[type=submit]').removeAttr('disabled');
                    }
                }
            })
        }
    })
})