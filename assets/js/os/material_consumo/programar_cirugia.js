var elementos_materiales=[];
var elements_m=[];
var derecho_hab=[];
$(document).ready(function (){
    $.ajax({
        url: base_url+"materiales_consumo/hospitalizacion/get_dh_mt",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#derechohabiente_id').html(data['option_dh']).select2();
            $('#empleado_id').html(data['option_mt']).select2();
            $('#sistema_id').html(data['option_si']).select2();
            $.each($('#derechohabiente_id option'),function (i,e){

                derecho_hab.push([$(this).text(),$(this).val()+'_id']);
            })
        },error: function (e) {
            msj_error_serve()
            console.log(e)
        }
    })
    $('#sistema_id').change(function (e){
        var select=$(this);
        if(select.val()!=null){
            if(select.val().length >elements_m.length){
                var  nuevos=select.val();
                  for (var i = 0; i < nuevos.length; i++) {
                     if ($.inArray(nuevos[i],elements_m) == -1) {
                        //sistemas_mq(nuevos[i],select.val());
                        msj_materiales(nuevos[i])
                     }  
                  }
                  elements_m = nuevos;
            }else{
                      var restantes = select.val();
                      for (var i = 0; i < elements_m.length; i++) {
                         if ($.inArray(elements_m[i],restantes) == -1) {
                            var buscar = elements_m[i]+'_sis';
                            var values = $.grep(elementos_materiales, function (element) { return element[2] == buscar });
                            elementos_materiales = $.grep(elementos_materiales, function(value) {
                                return $.inArray(value, values) == -1;
                            });
                         }
                      }
                      elements_m = restantes;
            }
        }else{
            elements_m=[];
        }
    })
    function msj_materiales(sistema){
        $.ajax({
            url: base_url+"materiales_consumo/hospitalizacion/get_materiales",
            dataType: 'json',
            type: 'POST',
            data:{
                'id':sistema,
                'csrf_token' : $.cookie('csrf_cookie')
            },success: function (data, textStatus, jqXHR) {
                console.log(data)
                dialog_selec(data['tr']);
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })

    }  
    function dialog_selec(data){
        bootbox.dialog({    
            title: "Agregar materiales",
            message: '<div class="">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="input-group m-b ">'+
                                    '<span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>'+
                                    '<input type="text" class="form-control filter" placeholder="Buscar...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                            '<table class="table m-b-none materiales" ui-jp="footable" data-filter=".filter" data-page-size="2">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th></th>'+
                                        '<th style="width:50%">Material</th>'+
                                        '<th style="width:15%">Existencia</th>'+
                                        '<th style="width:30%">Cantidad</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                data+
                                '</tbody>'+
                                '<tfoot class="hide-if-no-paging">'+
                                '<tr>'+
                                    '<td colspan="7" class="text-center">'+
                                        '<ul class="pagination"></ul>'+
                                    '</td>'+
                                '</tr>'+
                                '</tfoot>'+
                            '<table>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        $('table tbody tr').each(function(index, el) {
                              var checked = $(this).find('input:checked').length;
                              if (checked == 1) {
                                  var cantidad=$(this).find('input[type=text]').val();
                                  var cantidad_ex=$(this).find('input[type=text]').attr('data-existencia');
                                  var tipo=$(this).find('input[type=text]').attr('data-tipo');
                                  var id_sistema=$(this).find('input[type=text]').attr('data-s');
                                  var id_material=$(this).find('input[type=text]').attr('data-m');
                                  var id_material_in=$(this).find('input[type=text]').attr('data-m-i');
                                  elementos_materiales.push([cantidad,id_sistema,id_material,id_material_in,cantidad_ex,tipo]);
                              }
                        });
                        
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
        $('.modal-footer').css({
            'margin-top':'-50px'
        })
    }
    $('body').on('blur','.cantidad-agregar',function (e){
        var existencia=$(this).attr('data-existencia');
        var cantidad=$(this).val();
        if(parseInt(cantidad)>parseInt(existencia)){
            $(this).val('');
            msj_error_noti('La cantidad agregada debe ser menor o igual a la existente')
        }
    })
    $('body').on('click','.btn-add-meterial',function (){
        $(this).parent('tr');
        console.log($(this).parent('tr'))
        
    });
    $('.save-cirugia').click(function (){
        var derechohabiente_id=$('#derechohabiente_id').val();
        var empleado_id=$('#empleado_id').val();
        var solicitud_fecha=$('#solicitud_fecha').val();
        var solicitud_diagnostico=$('#solicitud_diagnostico').val();
        var materiales=elementos_materiales;
        var solicitud_fecha_emision=fecha_yyyy_mm_dd();
        if(solicitud_diagnostico!=''){
            $.ajax({
                url: base_url+"materiales_consumo/hospitalizacion/insert_solicitud",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token'                :$.cookie('csrf_cookie'),
                    'solicitud_fecha'           :solicitud_fecha,
                    'solicitud_fecha_emision'   :solicitud_fecha_emision,
                    'solicitud_diagnostico'     :solicitud_diagnostico,
                    'derechohabiente_id'        :derechohabiente_id,
                    'empleado_id'               :empleado_id,
                    'materiales'                :materiales
                },beforeSend: function (xhr) {
                    msj_success_noti('Guardando registro...');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        console.log(materiales)
                        msj_success_noti('Registro guardado correctamente');
                        location.href=base_url+'materiales_consumo/hospitalizacion/gestionar_cirugia';
                    }else{
                        msj_error_noti('Error al guardar el registro');
                    }
                },error: function (e) {
                    console.log(e);
                    msj_error_noti(e);
                }
            })  
        }else{
            msj_error_noti('Favar de completar todos los campos')
        }
    })
    $('.del_cirigia_sol').click(function (){
        msj_error_serve()
    })
    $('.del-cirugia-sol').click(function (e){
        var el =$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO Y TODOS LOS DATOS ASOCIADOS A ELLO?')){
            $.ajax({
                url: base_url+"materiales_consumo/hospitalizacion/delete_prog_cirugia",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token'                : $.cookie('csrf_cookie'),
                    'id':el
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminado registro');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']=='1'){
                        msj_success_noti('Registro eliminado correctamente');
                        $('#'+el).remove()
                    }else{
                        msj_error_noti('Error al eliminar el registro');
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    
    })
    $('.ver-materiales').click(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"materiales_consumo/hospitalizacion/ver_materiales",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token'                : $.cookie('csrf_cookie'),
                'id':$(this).attr('data-id')
            },beforeSend: function (xhr) {
                msj_success_noti('Obteniendo información')
            },success: function (data, textStatus, jqXHR) {
                dialog_materiales(data['tr']);
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
    function dialog_materiales(data){
        bootbox.dialog({    
            title: "Ver Materiales",
            message: '<div class="">'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="input-group m-b ">'+
                                    '<span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>'+
                                    '<input type="text" class="form-control filter" placeholder="Buscar...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-12">'+
                            '<table class="table m-b-none materiales" ui-jp="footable" data-filter=".filter" data-page-size="2">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th style="width:50%">Material</th>'+
                                        '<th style="width:25%">Cantidad</th>'+
                                        '<th style="width:25%">Editar</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                data+
                                '</tbody>'+
                                '<tfoot class="hide-if-no-paging">'+
                                '<tr>'+
                                    '<td colspan="7" class="text-center">'+
                                        '<ul class="pagination"></ul>'+
                                    '</td>'+
                                '</tr>'+
                                '</tfoot>'+
                            '<table>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "md-btn md-raised m-b btn-fw back-imss waves-effect",
                    callback: function() {
                        
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
        $('.modal-footer').css({
            'margin-top':'-40px'
        })
    }   
    $('.add-hb').click(function (){
        //console.log(derecho_hab)
        location.href=base_url+'configuracion/derechohabiente/index';
    })
    $('body').on('keypress','.edit_cantidad_mat',function (event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var input=$(this);
        if(keycode == '13'){
            if(input.val()!=''){
                if(parseInt(input.val())<input.attr('data-cantidad')&& parseInt(input.attr('data-cantidad'))>1){
                    $.ajax({
                        url: base_url+"materiales_consumo/hospitalizacion/editar_materiales",
                        dataType: 'json',
                        type: 'POST',
                        data:{
                           'cantidad_old'   :input.attr('data-cantidad'),
                           'cantidad_new'   :input.val(),
                           'solicitud'      :input.attr('data-sol'),
                           'tipo'           :input.attr('data-tipo'),
                           'material'       :input.attr('data-m'),
                           'material_in'    :input.attr('data-mi'),
                           'csrf_token'     :$.cookie('csrf_cookie')
                        },beforeSend: function (xhr) {
                            msj_success_noti('Guardando registro...')
                        },success: function (data, textStatus, jqXHR) {
                            if(data['accion']=='1'){
                                input.attr('readonly','readonly')
                                msj_success_noti('Registro guardado...')
                            }
                        },error: function (e) {
                            msj_error_serve();
                            console.log(e)
                        }
                    })
                }else{

                }  
            }else{
                msj_error_noti('Valor no válido')
            }

        }
    })
    $('.entregar-materiales').click(function (e){
        setTimeout(function (){
           location.reload(); 
        },30000)
        
    })
})