$(document).ready(function (){
    $('.btn-add-equipo').click(function (){
        dialog_insert('add',{
            'equipo_id':'0',
            'equipo_ip':''
        })
        //$('body #equipo_ip').mask('999.999.999.999'); 
    });
    $('.btn-edit-equipo').click(function (){
        $.ajax({
            url: base_url+"configuracion/equipos/get_equipo",
            dataType: 'json',
            type: 'POST',
            data:{
                'id':$(this).attr('data-id'),
                'csrf_token' : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                console.log(data)
                dialog_insert('edit',{
                    'equipo_id':data[0]['equipo_id'],
                    'equipo_ip':data[0]['equipo_ip']
                })  
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    });
    function dialog_insert(accion,data){
        
        bootbox.dialog({    
            title: "Agregar equipo",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.equipo_ip+'" id="equipo_ip">'+
                                    '<label>Dirección IP (192.168.86.1)</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #equipo_ip').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/equipos/insert_equipos",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'equipo_id'    :data.equipo_id,
                                    'equipo_ip'   :$('body #equipo_ip').val(),
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
    $('.fa-trash-o').click(function (){
        var el=$(this).attr('data-id');
        if(confirm('¿Desea eliminar este registro?')){
            $.ajax({
                url: base_url+"configuracion/equipos/delete_equipo",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':el,
                    'csrf_token' : $.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
})