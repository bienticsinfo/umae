var tratamientos=[];
var tratamientos_m=[];
var mensajes_old;
$(document).ready(function (){
    $('#programacion_tratamiento').change(function (){
        var select=$(this);
        if(select.val()!=null){
            if(select.val().length >tratamientos_m.length){
                var  nuevos=select.val();
                  for (var i = 0; i < nuevos.length; i++) {
                     if ($.inArray(nuevos[i],tratamientos_m) == -1) {
                        msj_terapias(nuevos[i])
                     }  
                  }
                  tratamientos_m = nuevos;
            }else{
                      var restantes = select.val();
                      for (var i = 0; i < tratamientos_m.length; i++) {
                         if ($.inArray(tratamientos_m[i],restantes) == -1) {
                            var buscar = tratamientos_m[i]+'_sis';
                            var values = $.grep(tratamientos, function (element) { return element[2] == buscar });
                            tratamientos = $.grep(tratamientos, function(value) {
                                return $.inArray(value, values) == -1;
                            });
                         }
                      }
                      tratamientos_m = restantes;
            }
        }else{
            tratamientos_m=[];
        }
    })
    function msj_terapias(trat){
        $.ajax({
            url: base_url+"centralservicio/get_terapias",
            dataType: 'json',
            type: 'POST',
            data:{
                'id':trat,
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
            title: "Seleccionar terapias",
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
                                        '<th>Seleccionar</th>'+
                                        '<th style="width:50%">Tratamiento</th>'+
                                        '<th style="width:50%">Terapia</th>'+
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
                                  var tratamiento=$(this).attr('data-tratamiento');
                                  var terapia=$(this).attr('data-terapia')
                                  tratamientos.push([tratamiento,terapia]);
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
    
    $('input[name=derechohabiente_nss]').blur(function (){
        if($(this).val()!=''){
            $.ajax({
                url: base_url+"centralservicio/get_derechohabiente",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token':$('body input[name=csrf_token]').val(),
                    'nss':$(this).val()
                },success: function (data, textStatus, jqXHR) {
                    if(data.length!=0){
                        $('input[name=derechohabiente_nombre]').val(data[0]['derechohabiente_nombre'])
                        $('input[name=derechohabiente_apat]').val(data[0]['derechohabiente_apat'])
                        $('input[name=derechohabiente_amat]').val(data[0]['derechohabiente_amat'])
                        $('input[name=derechohabiente_procedencia]').text(data[0]['derechohabiente_procedencia'])
                    }
                },error: function (jqXHR, textStatus, errorThrown) {

                }
            })
        }
    })
    $('.select_fecha').click(function (e){
        if($(this).val()=='Hoy'){
            $('.programacion_fecha').removeClass('fecha_calendar');
            $('.programacion_fecha').val(fecha_yyyy_mm_dd());
            
            $('.programacion_fecha').attr('readonly','readonly');
        }else{
            $('.programacion_fecha').addClass('fecha_calendar');
            $('.programacion_fecha').removeAttr('readonly');
        }
    });
    $('.programar').submit(function (e){
        var form=new FormData($(this)[0]);
        e.preventDefault()
        $.ajax({
            url: base_url+"centralservicio/insert_registro",
            type: 'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            mimeType: 'multipart/form-data',
            data:form,
            beforeSend: function (xhr) {
                msj_success_noti('Guardando registro...');
            },success: function (data, textStatus, jqXHR) { 
                if(data['accion']=='1'){
                    $('form')[0].reset();
                    location.href=base_url+'centralservicio/';
                }
                if(data['accion']=='3'){
                    msj_error_noti('El numero de programaciones por día ha llegado a su límite.')
                }
                if(data.accion=='4'){
                    msj_error_noti('El usaurio ya tiene una programación previa para esta fecha')
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
    $('.programar-diagnostico').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"centralservicio/agregar_diagnostico",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando Diagnóstico...')
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Diagnóstico guardado')
                    location.href=base_url+'centralservicio';
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.add-tratamiento').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"centralservicio/insert_tratamiento",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando tratamiento...')
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Tratamiento guardado')
                    location.href=base_url+'centralservicio/tratamientos';
                }
            },error: function (e) {
                msj_error_serve()
                console.log(e)
            }
        }) 
    })
    $('.add-terapia').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"centralservicio/insert_terapia",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando terapia...')
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Terapia guardado')
                    location.href=base_url+'centralservicio/terapias?t='+$('body input[name=tratamiento_id]').val();
                }
            },error: function (e) {
                msj_error_serve()
                console.log(e)
            }
        }) 
    })
    $('.btn-finalizar-tratamiento').click(function (){
        $.ajax({
            url: base_url+"centralservicio/finalizar_tratamiento",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token':$('body input[name=csrf_token]').val(),
                'id':$(this).attr('data-id')
            },beforeSend: function (xhr) {
                msj_success_noti('Guardando cambios...');
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Cambios Guardados');
                    setTimeout(function (){
                        location.reload();
                    },3000)
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    })
    $('.add_fecha_prog').keypress(function (event){   
        var el=$(this);
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if(el.val()!=''){
                $.ajax({
                    url: base_url+"centralservicio/agregar_fecha",
                    dataType: 'json',
                    type: 'POST',
                    data:{
                        'csrf_token':$('body input[name=csrf_token]').val(),
                        'fecha':el.val(),
                        'id':el.attr('data-id')
                    },beforeSend: function (xhr) {
                        msj_success_noti('Actualizando fecha...')
                    },success: function (data, textStatus, jqXHR) {
                        if(data.accion=='1'){
                            msj_success_noti('Fecha actualizada');
                            setTimeout(function (){
                                location.reload();
                            },1000)
                        }
                    },error: function (jqXHR, textStatus, errorThrown) {
                        msj_error_serve()
                    }
                })
            }else{
                msj_error_noti('Campo requerido.');
            }  
        }

    })
    $('.update_fecha_add').click(function (){
        var el=$(this);
        console.log(el.attr('data-fecha'))
    })
    $('.programacion_destino').on('change',function(e){
        if($(this).val()!='Tratamiento en casa'){
            $('.select-folletos').hide();
        }else{
            $('.select-folletos').show();
        }
    });
    $('.programar-tratamiento').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"centralservicio/agregar_tratamiento",
            type: 'POST',
            dataType: 'json',
            data:{
                'programacion_id':$('#programacion_id').val(),
                'csrf_token':$('body input[name=csrf_token]').val(),
                'tratamientos': tratamientos
            },beforeSend: function (xhr) {
                msj_success_noti('Guardando Tratamiento...')
            },success: function (data, textStatus, jqXHR) {
                if(data.accion=='1'){
                    msj_success_noti('Tratamiento asignado')
                    location.href=base_url+'centralservicio';
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
            }
        })
    });
    $.ajax({
        url: base_url+"centralservicio/get_tratamientos" ,
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#programacion_tratamiento').html(data['option']);
        },error: function (jqXHR, textStatus, errorThrown) {
            msj_error_serve()
        }
    })
    $('.btn-add-fecha-terapia').click(function (e){
        var fecha=$('.fecha-teparia').val();
        var terapia=$(this).attr('data-id');
        if(fecha!=''){
            $.ajax({
                url: base_url+"centralservicio/add_fecha_terapia",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token':$('body input[name=csrf_token]').val(),
                    'fecha':fecha,
                    'terapiafecha_hora_i':$('.terapiafecha_hora_i').val(),
                    'terapiafecha_hora_f':$('.terapiafecha_hora_f').val(),
                    'terapia':terapia
                },beforeSend: function (xhr) {
                    msj_success_noti('Guardando registro...');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            })
        }
    })
    $('.delete-fecha-teparia').click(function (){
        var el=$(this).attr('data-id');
        if(confirm('¿Desea eliminar este registro?')){
            $.ajax({
                url: base_url+"centralservicio/delete_fecha_terapia",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':$('body input[name=csrf_token]').val(),
                    'id':el
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando registro...');
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        msj_success_noti('Registro eliminado')
                        $('#'+el).remove();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                }
            })
        }
    })
    $.ajax({
        url: base_url+"centralservicio/get_notificaciones",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            mensajes_old=data.msj;
        },error: function (jqXHR, textStatus, errorThrown) {
            msj_error_serve();
        }
    })
    var playing = false;
    setInterval(function (){
        $.ajax({
            url: base_url+"centralservicio/get_notificaciones",
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(mensajes_old==data.msj){
                    $('.msj-total').html(data.msj)
                }else{
                    $('.msj-total').html(data.msj);                 
                    if(data.msj>mensajes_old){
                        $('#player').get(0).play();
                        //playing = true;
                        msj_success_noti('Nuevo mensaje enviado a este modulo');     
                    }
                    mensajes_old=data.msj;
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    },2000);
})
