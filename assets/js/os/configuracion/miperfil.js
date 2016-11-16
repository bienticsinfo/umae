$(document).ready(function (){
    $('select[name=empleado_sexo]').select2('val',$('select[name=empleado_sexo]').data('value')).select2();
    $('select[name=empleado_estado]').select2('val',$('select[name=empleado_estado]').data('value')).select2();
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