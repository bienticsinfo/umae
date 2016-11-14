$(document).ready(function (){
    $('.btn-add').click(function (){
        add_rol('add',{
            'tipo_rol':'',
            'idTipo_Usuario':'0'
        })
    })
    $('.fa-pencil').click(function (){
        $.ajax({
            url: base_url+"configuracion/tipo_de_usuario/get_data",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token' : $.cookie('csrf_cookie'),
                'idTipo_Usuario':$(this).attr('data-id')
            },success: function (data, textStatus, jqXHR) {
                add_rol('edit',{
                    'tipo_rol':data[0]['tipo'],
                    'idTipo_Usuario':data[0]['idTipo_Usuario']
                })
            },error: function (jqXHR, textStatus, errorThrown) {
                
            }
        })
    })
    $('.fa-trash-o').click(function (){
        var el =$(this).attr('data-id')
        if(confirm('AL ELIMINAR ESTE REGISTRO SE ELIMINARA TODOS LOS DATOS ASOCIADOS A ELLO, ¿DESEA CONTINUAR?')){
            $.ajax({
                url: base_url+"configuracion/tipo_de_usuario/delete_rol",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token' : $.cookie('csrf_cookie'),
                    'idTipo_Usuario':el
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro')  
                },success: function (data, textStatus, jqXHR) {
                    msj_success_noti('Registro eliminado');
                    $('#'+el).remove();
                },error: function (jqXHR, textStatus, errorThrown) {

                }
            })
        }
    })
    function add_rol(accion,data){
        bootbox.dialog({    
            title: "Agregar rol",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.tipo_rol+'" id="tipo_rol">'+
                                    '<label>Rol</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #tipo_rol').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/tipo_de_usuario/add_rol",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'idTipo_Usuario':data.idTipo_Usuario,
                                    'tipo_rol'   :$('body #tipo_rol').val(),
                                    'accion':accion,
                                    'csrf_token' : $.cookie('csrf_cookie')
                                },beforeSend: function (xhr) {
                                    msj_success_noti('Guardando registro...');
                                },success: function (data, textStatus, jqXHR) {
                                    if(data['accion']=='1'){
                                        msj_success_noti('Registro guardado.');
                                        location.reload();
                                    }else{
                                        msj_error_noti('Error al guardar el registro');
                                    }
                                },error:function (){
                                    msj_error_serve()
                                }
                            })        
                        }else{
                            msj_error_noti('Todos los campos son requeridos')
                        }

                    }
                }
            }
        });
        $('.table').footable();
        $('.modal-dialog').css('width','25%');
        $('.modal-header').addClass('b-green-b-i');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });

    }
})
