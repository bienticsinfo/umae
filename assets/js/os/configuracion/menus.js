var roles;
$(document).ready(function (){
    $.ajax({
        url: base_url+"configuracion/menus/get_areas_acceso",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('body #tipo_usuarios_mn1').html(data['option']);
            roles=data['option'];
        },error: function (jqXHR, textStatus, errorThrown) {
            msj_error_serve();
        }
    })
    $('body #tipo_usuarios_mn1').select2();
    $('.btn-add-mn1').click(function (){
        mn1('add',{
            'mn1_id':0,
            'mn1_menu_1':'',
            'mn1_url'   :'',
            'mn1_icono' :'',
            'mn1_c_m'   :''
        })
        $('body #menuN1_status').select2();
        $('body #mn1_c_m').select2()
    })
    $('.btn-edit-mn1').click(function (){
        $.ajax({
            url: base_url+"configuracion/menus/get_menuN1",
            dataType: 'json',
            type: 'POST',
            data:{
             'csrf_token' : $.cookie('csrf_cookie'),
             'id':$(this).attr('data-id')
            },success: function (data, textStatus, jqXHR) {
                console.log(data)
                mn1('edit',{
                    'mn1_id':data[0]['menuN1_id'],
                    'mn1_menu_1':data[0]['menuN1_menu'],
                    'mn1_url'   :data[0]['menuN1_url'],
                    'mn1_icono' :data[0]['menuN1_icono'],
                    'mn1_c_m'   :data[0]['menuN1_c_m']
                })
                $('body #mn1_c_m').val(data[0]['menuN1_c_m']).select2()
                $('body #menuN1_status').val(data[0]['menuN1_status']).select2()
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    function mn1(accion,data){
        bootbox.dialog({    
            title: "Menu Nivel 1",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-6" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.mn1_menu_1+'" id="mn1_menu_1">'+
                                    '<label>Nombre del Menu</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.mn1_url+'" id="mn1_url">'+
                                    '<label>Url</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="menuN1_status">'+
                                        '<option value="1">Mostrar</option>'+
                                        '<option value="0">Ocultar</option>'+
                                    '</select>'+
                                    '<label>Status</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.mn1_icono+'" id="mn1_icono">'+
                                    '<label>Icono</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="mn1_c_m">'+
                                        '<option value="1">Si</option>'+
                                        '<option value="0">No</option>'+
                                    '</select>'+
                                    '<label>Nivel 2</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #mn1_menu_1').val()!='' && $('body #mn1_url').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/menus/insert_menuN1",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'mn1_id':data.mn1_id,
                                    'mn1_menu_1'   :$('body #mn1_menu_1').val(),
                                    'mn1_url':$('body #mn1_url').val(),
                                    'mn1_icono'  :$('body #mn1_icono').val(),
                                    'mn1_c_m'  :$('body #mn1_c_m').val(),
                                    'menuN1_status':$('body #menuN1_status').val(),
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
    $('.btn-add-mn1-rol').click(function (){
        
        var id_mn1=$(this).attr('data-id');
        bootbox.dialog({    
            title: "Agregar rol",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-12" >'+
                                '<div class="md-form-group">'+
                                    '<select class="width100 select2 md-input" id="tipo_usuarios_mn1">'+roles+'</select>'+
                                    '<label>Seleccionar rol</label>'+
                                '</div>'+
                            '</div>'+

                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        $.ajax({
                            url: base_url+"configuracion/menus/insert_mn1_rol",
                            dataType: 'json',
                            type: 'POST',
                            data:{
                                'menuN1_id':id_mn1,
                                'areas_acceso_id':$('body #tipo_usuarios_mn1').val(),
                                'csrf_token' : $.cookie('csrf_cookie')
                            },beforeSend: function (xhr) {
                                msj_success_noti('Guardando registro...');
                            },success: function (data, textStatus, jqXHR) {
                                switch (data['accion']){
                                    case '1':
                                        msj_success_noti('Registro guardado');
                                        location.reload();
                                        break;
                                    case '2':
                                        msj_error_noti('Error al guardar el registro')
                                        break;
                                    case '3':
                                        msj_error_noti(data['msj'])
                                        break;
                                }
                                
                            },error: function (jqXHR, textStatus, errorThrown) {
                                msj_error_serve()
                            }
                        })

                    }
                }
            }
        });
        $('.table').footable();
        $('body #tipo_usuarios_mn1').select2();
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
    })
    $('.del-mn1-rol').click(function (){
        var menuN1_id=$(this).attr('data-m');
        var areas_acceso_id= $(this).attr('data-r');
        
        if(confirm('¿Desea eliminar este registro?')){
            $.ajax({
                url: base_url+"configuracion/menus/delete_mn1_rol",
                dataType: 'json',
                type: 'POST',
                data:{
                    'menuN1_id'           :menuN1_id,
                    'areas_acceso_id' :areas_acceso_id,
                    'csrf_token'    : $.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        location.reload();
                    }
                },error: function (e) {
                    console.log(e)
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-add-mn2').click(function (){
        mn2('add',{
            'menuN2_id'     :0,
            'menuN2_menu'   :'',
            'menuN2_url'    :'',
            'menuN2_c_m'    :'',
            'menuN2_icono'  :'',
            'menuN2_status' :'',
            'menuN1_id'     :$(this).attr('data-id')
        })
        $('body #menuN2_c_m').select2();
    })
    $('.btn-edit-mn2').click(function (){
        $.ajax({
            url: base_url+"configuracion/menus/get_menuN2",
            dataType: 'json',
            type: 'POST',
            data:{
                'id'            :$(this).attr('data-id'),
                'csrf_token'    : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                mn2('edit',{
                    'menuN2_id'     :data[0]['menuN2_id'],
                    'menuN2_menu'   :data[0]['menuN2_menu'],
                    'menuN2_url'    :data[0]['menuN2_url'],
                    'menuN2_c_m'    :data[0]['menuN2_c_m'],
                    'menuN2_icono'  :data[0]['menuN2_icono'],
                    'menuN1_id'     :data[0]['menuN1_id']
                })
                $('body #menuN2_status').val(data[0]['menuN2_status']).select2();
                $('body #menuN2_c_m').val(data[0]['menuN2_c_m']).select2();
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    function mn2(accion,data){
        bootbox.dialog({    
            title: "Menu Nivel 2",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-6" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN2_menu+'" id="menuN2_menu">'+
                                    '<label>Nombre del Menu</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN2_url+'" id="menuN2_url">'+
                                    '<label>Url</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="menuN2_status">'+
                                        '<option value="1">Mostrar</option>'+
                                        '<option value="0">Ocultar</option>'+
                                    '</select>'+
                                    '<label>Status</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN2_icono+'" id="menuN2_icono">'+
                                    '<label>Icono</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="menuN2_c_m">'+
                                        '<option value="1">Si</option>'+
                                        '<option value="0">No</option>'+
                                    '</select>'+
                                    '<label>Nivel 3</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #menuN2_menu').val()!='' && $('body #menuN2_url').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/menus/insert_menuN2",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'menuN2_id'     :data.menuN2_id,
                                    'menuN2_menu'   :$('body #menuN2_menu').val(),
                                    'menuN2_url'    :$('body #menuN2_url').val(),
                                    'menuN2_icono'  :$('body #menuN2_icono').val(),
                                    'menuN2_c_m'    :$('body #menuN2_c_m').val(),
                                    'menuN2_status' :$('body #menuN2_status').val(),
                                    'menuN1_id'     :data.menuN1_id,
                                    'accion'        :accion,
                                    'csrf_token'    :$.cookie('csrf_cookie')
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
    $('.btn-add-mn3').click(function (){
        mn3('add',{
            'menuN3_id'     :0,
            'menuN3_menu'   :'',
            'menuN3_url'    :'',
            'menuN3_icono'  :'',
            'menuN3_status' :'',
            'menuN2_id'     :$(this).attr('data-id')
        })
        $('body #menuN3_c_m').select2();
    })
    $('.btn-edit-mn3').click(function (){
        $.ajax({
            url: base_url+"configuracion/menus/get_menuN3",
            dataType: 'json',
            type: 'POST',
            data:{
                'id'            :$(this).attr('data-id'),
                'csrf_token'    : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                mn3('edit',{
                    'menuN3_id'     :data[0]['menuN3_id'],
                    'menuN3_menu'   :data[0]['menuN3_menu'],
                    'menuN3_url'    :data[0]['menuN3_url'],
                    'menuN3_icono'  :data[0]['menuN3_icono'],
                    'menuN2_id'     :data[0]['menuN2_id']
                })
                $('body #menuN3_status').val(data[0]['menuN3_status']).select2();
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })    
    function mn3(accion,data){
        bootbox.dialog({    
            title: "Menu Nivel 3",
            message: '<div class="">'+
                        '<div class="row" style="padding-left:10px;padding-right:10px">'+
                            '<div class="col-md-6" >'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_menu+'" id="menuN3_menu">'+
                                    '<label>Nombre del Menu</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_url+'" id="menuN3_url">'+
                                    '<label>Url</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                '<div class="md-form-group">'+
                                    '<input class="md-input" value="'+data.menuN3_icono+'" id="menuN3_icono">'+
                                    '<label>Icono</label>'+
                                '</div>'+
                                '<div class="md-form-group">'+
                                    '<select class="md-input select2" id="menuN3_status">'+
                                        '<option value="1">Mostrar</option>'+
                                        '<option value="0">Ocultar</option>'+
                                    '</select>'+
                                    '<label>Status</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        if($('body #menuN3_menu').val()!='' && $('body #menuN3_url').val()!=''){
                            $.ajax({
                                url: base_url+"configuracion/menus/insert_menuN3",
                                dataType: 'json',
                                type: 'POST',
                                data:{
                                    'menuN3_id'     :data.menuN3_id,
                                    'menuN3_menu'   :$('body #menuN3_menu').val(),
                                    'menuN3_url'    :$('body #menuN3_url').val(),
                                    'menuN3_icono'  :$('body #menuN3_icono').val(),
                                    'menuN3_status' :$('body #menuN3_status').val(),
                                    'menuN2_id'     :data.menuN2_id,
                                    'accion'        :accion,
                                    'csrf_token'    :$.cookie('csrf_cookie')
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
    $('.btn-delete-mn3').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro?')){
            $.ajax({
                url: base_url+"configuracion/menus/delete_mn3",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-delete-mn2').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro y todos lo datos asociados a el?')){
            $.ajax({
                url: base_url+"configuracion/menus/delete_mn2",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
    $('.btn-delete-mn1').click(function (){
        var el=$(this).attr('data-id')
        if(confirm('¿Desea elimiar este registro y todos lo datos asociados a el?')){
            $.ajax({
                url: base_url+"configuracion/menus/delete_mn1",
                dataType: 'json',
                type: 'POST',
                data:{
                    'id':$(this).attr('data-id'),
                    'csrf_token'    :$.cookie('csrf_cookie')
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...')
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        $('#'+el).remove();
                        msj_success_noti('Registro eliminado')
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    }) 
})