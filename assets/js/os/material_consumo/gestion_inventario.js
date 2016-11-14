$(document).ready(function (){
    var accion=$('#jtf_accion').val();
    $('#jtf_fecha').val(get_fecha());
    if(accion=='edit'){
        if($('#jtf_material_intermedio').val()=='No'){
            $('.material_cantidad').removeClass('hidden')
            $('.material_cantidad_input').attr('type','text');
            $('.material_cantidad_input').attr('readonly','readonly')
            $('.mi_n').prop('checked','checked')
        }
        $('#intermedia_cantidad').attr('readonly','readonly')
    }
    $('input[name=new_cantidad]').keyup(function (){
        if($(this).val()!=''){
            if(!isNaN($(this).val())){
                if(parseInt($(this).val())>0){
                    $('.inter_'+$(this).attr('data-id')).attr('data-new-cantidad',$(this).val())
                }else{
                    //$(this).val('');
                    msj_error_noti('La cantidad debe ser mayor 0')
                    
                }
            }else{
                $(this).val('');
                
            }

        }
    })
    $('.add-cantidad-material').click(function (){
        var material_id=$(this).attr('data-id');
        var sistema_id=$(this).attr('data-si');
        var cantidad_actual=$(this).attr('data-cantidad');
        bootbox.dialog({    
            title: "Actualizar cantidad",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" id="material_cantidad_update">'+
                                    '<label>Nueva cantidad</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        var material_cantidad_update=$('body #material_cantidad_update').val()
                        if(!isNaN(material_cantidad_update)){
                            if(parseInt(material_cantidad_update)>0){
                                $.ajax({
                                    url: base_url+"materiales_consumo/almacen_osteo/update_cantidad_m",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        'csrf_token':$('body input[name=csrf_token]').val(),
                                        'material_id':material_id,
                                        'cantidad_old':cantidad_actual,
                                        'cantidad_new':material_cantidad_update,
                                        'sistema_id':sistema_id,
                                        'jtf_fecha':get_fecha()
                                    },beforeSend: function (xhr) {
                                        msj_success_noti('Actualizando cantidad...')
                                    },success: function (data, textStatus, jqXHR) {
                                        if(data['accion']=='1'){
                                            msj_success_noti('Cantidad actualizada');
                                            location.reload();
                                        }else{
                                            msj_error_noti('Error al actualizar la cantidad');
                                        }
                                    },error: function (jqXHR, textStatus, errorThrown) {
                                        msj_error_serve()
                                    }
                                })
                            }else{

                                msj_error_noti('La cantidad debe ser mayor 0');

                            }
                        }else{
                            msj_error_noti('Cantidad incorrecta');
                        }


                    }
                }
            }
        });
        $('.modal-dialog').css('width','25%');
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
    })
    $('.add-cantidad-mi').click(function (){
        var material_id=$(this).attr('data-m');
        var sistema_id=$(this).attr('data-si');
        var material_inter_id=$(this).attr('data-id');
        var cantidad_actual=$(this).attr('data-cantidad');
        bootbox.dialog({    
            title: "Actualizar cantidad",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" id="mi_cantidad_update">'+
                                    '<label>Nueva cantidad</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        var material_cantidad_update=$('body #mi_cantidad_update').val()
                        if(!isNaN(material_cantidad_update)){
                            if(parseInt(material_cantidad_update)>0){
                                $.ajax({
                                    url: base_url+"materiales_consumo/almacen_osteo/update_cantidad_mi",
                                    type: 'POST',
                                    dataType: 'json',
                                    data:{
                                        'csrf_token':$('body input[name=csrf_token]').val(),
                                        'material_id':material_id,
                                        'cantidad_old':cantidad_actual,
                                        'cantidad_new':material_cantidad_update,
                                        'sistema_id':sistema_id,
                                        'material_inter_id':material_inter_id,
                                        'jtf_fecha':get_fecha()
                                    },beforeSend: function (xhr) {
                                        msj_success_noti('Actualizando cantidad...')
                                    },success: function (data, textStatus, jqXHR) {
                                        if(data['accion']=='1'){
                                            msj_success_noti('Cantidad actualizada');
                                            location.reload();
                                        }else{
                                            msj_error_noti('Error al actualizar la cantidad');
                                        }
                                    },error: function (jqXHR, textStatus, errorThrown) {
                                        msj_error_serve()
                                    }
                                })
                            }else{

                                msj_error_noti('La cantidad debe ser mayor 0');

                            }
                        }else{
                            msj_error_noti('Cantidad incorrecta');
                        }


                    }
                }
            }
        });
        $('.modal-dialog').css('width','25%');
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
    })
    $.ajax({
        url: base_url+"materiales_consumo/almacen_osteo/get_proveedores",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#prov_id').html(data['option']);
            $('#prov_id').val($('#jtf_prov_id').val()).select2();
        },error: function (e) {
            msj_error_noti(e)
        }
    })
    $('#registrar-sistema').submit(function (e){
        e.preventDefault() 
        $.ajax({
            url: base_url+"materiales_consumo/almacen_osteo/insert_sistema",
            dataType: 'json',
            type: 'POST',
            data:$('#registrar-sistema').serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando...');
            },success: function (data, textStatus, jqXHR) {
                if(data['accion']=='1'){
                    msj_success_noti('Registro guardado');
                    location.href=base_url+'materiales_consumo/almacen_osteo/gestion_inventario';
                }else{
                    msj_success_noti('Error al guardar el registro');
                }
            },error: function (e) {
                console.log(e)
                msj_error_noti(e);
            }
        })
    })
    $('.material-i').click(function (){
//        if($(this).val()=='No'){
//            $('.material_cantidad').removeClass('hidden')
//            $('.material_cantidad_input').attr('type','text')
//        }else{
//            $('.material_cantidad_input').attr('type','hidden')
//            $('.material_cantidad').addClass('hidden')
//        }
    })
    $('#registrar-sistema-material').submit(function (e){
        e.preventDefault() ;
        var fd = new FormData($('#registrar-sistema-material'));
        $.ajax({
            url: base_url+"materiales_consumo/almacen_osteo/insert_material",
            dataType: 'json',
            type: 'POST',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando...');
            },success: function (data, textStatus, jqXHR) {
                if(data['accion']=='1'){
                    msj_success_noti('Registro guardado');
                    location.href=base_url+'materiales_consumo/almacen_osteo/sistema_material?id='+data['id'];
                }else{
                    msj_success_noti('Error al guardar el registro');
                }
            },error: function (e) {
                console.log(e)
                msj_error_noti(e);
            }
        })
    })
    $('.del-s').click(function (){
        delete_data('delete_sistema',$(this).attr('data-id'));
    })
    $('.del_m_i').click(function (e){
        delete_data('delete_material_intermedio',$(this).attr('data-id'));
    })
    $('.del_m').click(function (e){
        delete_data('delete_material',$(this).attr('data-id'));
    })
    function delete_data(url,el){
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO Y TODOS LOS DATOS ASOCIADOS A ELLO.?')){
            $.ajax({
                url: base_url+"materiales_consumo/almacen_osteo/"+url,
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':$('body input[name=csrf_token]').val(),
                    'id':el
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...');
                },success: function (data, textStatus, jqXHR) {
                    console.log(data)
                    if(data['accion']=='1'){
                        msj_success_noti('Registro eliminado');
                        $('#'+el).remove();
                    }else{
                        msj_error_noti('Error al eliminar el registro');
                    }
                },error:function (e){
                    console.log(e)
                    msj_error_noti('Error al procesar  el el servidor:'+e);
                }
            })
        }  
    }
})