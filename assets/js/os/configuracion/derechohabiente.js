$(document).ready(function (){
    $('.btn-add').click(function (){
        dialog_insert('add',{
            'derechohabiente_id':'',
            'derechohabiente_nss':'',
            'derechohabiente_nombre':'',
            'derechohabiente_apat':'',
            'derechohabiente_amat':''
        })
    });
    $('.edit-dh').click(function (e){
        e.preventDefault()
        $.ajax({
            url: base_url+"configuracion/derechohabiente/get_derechohabiente_id",
            dataType: 'json',
            type: 'POST',
            data:{
                'id':$(this).attr('data-id'),
                'csrf_token' : $.cookie('csrf_cookie')
            },beforeSend: function (xhr) {
                msj_success_noti('Obteniendo información');
            },success: function (data, textStatus, jqXHR) {
                $.each(data,function (i,e){
                    dialog_insert('edit',{
                        'derechohabiente_id'    :e.derechohabiente_id,
                        'derechohabiente_nss'   :e.derechohabiente_nss,
                        'derechohabiente_nombre':e.derechohabiente_nombre,
                        'derechohabiente_apat'  :e.derechohabiente_apat,
                        'derechohabiente_amat'  :e.derechohabiente_amat
                    })
                })
                //dialog_insert('edit')
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })//
    function dialog_insert(accion,data){
        bootbox.dialog({    
            title: "Agregar derechohabiente",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-6" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.derechohabiente_nss+'" id="derechohabiente_nss">'+
                                    '<label>NSS</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.derechohabiente_apat+'" id="derechohabiente_apat">'+
                                    '<label>Apellido Paterno</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.derechohabiente_nombre+'" id="derechohabiente_nombre">'+
                                    '<label>Nombre</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.derechohabiente_amat+'" id="derechohabiente_amat">'+
                                    '<label>Apellido Materno</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #derechohabiente_nss').val()!='' && $('body #derechohabiente_amat').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/derechohabiente/insert_derechohabiente",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'derechohabiente_id'    :data.derechohabiente_id,
                                    'derechohabiente_nss'   :$('body #derechohabiente_nss').val(),
                                    'derechohabiente_nombre':$('body #derechohabiente_nombre').val(),
                                    'derechohabiente_apat'  :$('body #derechohabiente_apat').val(),
                                    'derechohabiente_amat'  :$('body #derechohabiente_amat').val(),
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
    $('.del-dh').click(function (e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMIAR ESTE REGISTRO?')){
            $.ajax({
                url: base_url+"configuracion/derechohabiente/delete_derechohabiente",
                type: 'POST',
                dataType: 'json',
                data:{
                    'id':el,
                    'csrf_token' : $.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Registro eliminiado');
                        $('#'+el).remove();
                    }else{
                        msj_error_noti('Error al eliminar el registro')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
})