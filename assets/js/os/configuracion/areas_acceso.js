$(document).ready(function (){
    $('.btn-add').click(function (){
        add_rol('add',{
            'areas_acceso_nombre':'',
            'areas_acces_id':'0'
        })
    })
    $('.fa-pencil').click(function (){
        $.ajax({
            url: base_url+"configuracion/areas_acceso/get_data",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token' : $.cookie('csrf_cookie'),
                'areas_acceso_id':$(this).attr('data-id')
            },success: function (data, textStatus, jqXHR) {
                add_rol('edit',{
                    'areas_acceso_nombre':data[0]['areas_acceso_nombre'],
                    'areas_acceso_id':data[0]['areas_acceso_id']
                })
            },error: function (jqXHR, textStatus, errorThrown) {
                
            }
        })
    })
    $('.fa-trash-o').click(function (){
        var el =$(this).attr('data-id')
        if(confirm('AL ELIMINAR ESTE REGISTRO SE ELIMINARA TODOS LOS DATOS ASOCIADOS A ELLO, ¿DESEA CONTINUAR?')){
            $.ajax({
                url: base_url+"configuracion/areas_acceso/delete_area",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token' : $.cookie('csrf_cookie'),
                    'areas_acces_id':el
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
            title: "Agregar area de acceso",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.areas_acceso_nombre+'" id="areas_acceso_nombre">'+
                                    '<label>Area</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #areas_acceso_nombre').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/areas_acceso/add_area",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'areas_acces_id':data.areas_acces_id,
                                    'areas_acceso_nombre'   :$('body #areas_acceso_nombre').val(),
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
