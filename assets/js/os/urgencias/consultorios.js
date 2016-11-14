$(document).ready(function (e){
    var triage_paciente_accidente_lugar=$('input[name=triage_paciente_accidente_lugar]').val();
    if(triage_paciente_accidente_lugar=='TRABAJO'){
        $('.col-hojafrontal-info').removeClass('hide');
    }else{
        $('body .hojafrontal-info').removeAttr('required');
    }

    $('.hf_diagnosticos').keyup(function (e){
        $('.hf_diagnosticos_length').html($(this).val().length +' / 540');
    })
    $('.hf_interpretacion').keyup(function (e){
        $('.hf_interpretacion_length').html($(this).val().length +' / 250');
    })
    $('.hf_indicaciones').keyup(function (e){
        $('.hf_indicaciones_length').html($(this).val().length +' / 240');
    })
    $('.hf_exploracionfisica').keyup(function (e){
        $('.hf_exploracionfisica_length').html($(this).val().length +' / 345');
    })
    $('.hf_antecedentes').keyup(function (e){
        $('.hf_antecedentes_length').html($(this).val().length +' / 120');
    })
    $('.guardar-solicitud-hf').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"consultoriosespecialidad/hojaforntal_save",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    window.open(base_url+'consultoriosespecialidad/generarhojafrontal?t='+$('input[name=triage_id]').val(),'blank');
                    if(triage_paciente_accidente_lugar=='TRABAJO'){
                        window.open(base_url+'asistentesmedicas/st7?t='+$('input[name=triage_id]').val(), '_blank');
                    }
                    history.go(-1);
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                bootbox.hideAll();
                msj_error_serve()
            }
        })
    })
    $('.agregar-consultorio').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_consultorios",
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    history.go(-1);
                }
            },error: function (e) {
                bootbox.hideAll();
                console.log(e);
                msj_error_serve()
            }
        })
    })
    $('body').on('click','.disponibilidad-consultorio',function (e){
        var accion=$(this).data('accion');
        var id=$(this).data('id');
        if(confirm('¿DESEA REALIZAR LA ACCIÓN?')){
            $.ajax({
                url: base_url+"urgencias/disponibilidad_consultorio",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'id':id,
                    'accion':accion
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (e) {
                    msj_error_serve();
                    bootbox.hideAll();
                    console.log(e)
                }
            })
        }
    })
    $('body').on('click','.btn-llamar-paciente',function (e){
        e.preventDefault();
        var id=$(this).data('id');
        $.ajax({
            url: base_url+"consultoriosespecialidad/llamar_paciente",
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_token':csrf_token,
                'ce_asignado':id
            },beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    location.reload();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    });
    $('body').on('click','.salida-paciente-ce',function (e){
        e.preventDefault();
        var el=$(this);
        if(confirm('¿REPORTAR SALIDA DEL PACIENTE?')){
                $.ajax({
                url: base_url+"consultoriosespecialidad/reportar_salida",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'id':el.attr('data-id'),
                    'con':el.data('con')
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    bootbox.hideAll();
                }
            })
        }
    })    
    $('body').on('click','.table-solicitud-rx tbody tr',function (e){
        $(this).find('input[type=checkbox]').attr('checked',true);
        $(this).find('input[type=text]').attr('required',true);
    })
    $('.guardar-solicitud-rx').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"consultoriosespecialidad/guardar_solicitud_rx",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    window.open(base_url+'triage/generar_solicitud_rx?t='+$('body input[name=triage_id]').val(), '_blank');
                    
                    window.top.close();
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve()
                bootbox.hideAll();
            }
        })
    })
    $('body').on('click','.reenviar-otro-consultorio',function (e){
        var id=$(this).attr('data-id');
        var cons=$(this).data('consultorio');
        if(confirm('¿ENVIAR A OTRO CONSULTORIO?')){
            $.ajax({
                url: base_url+"triage/getConsultorios",
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                        bootbox.dialog({
                            title: '<h5>Destino</h5>',
                            message:'<div class="row ">'+
                                        '<div class="col-sm-12">'+
                                            '<label>Seleccionar Destino</label>'+
                                            '<select id="select_destino" style="width:100%">'+data.option+'</select>'+
                                        '</div>'+
                                    '</div>',
                            buttons: {
                                main: {
                                    label: "Aceptar",
                                    className: "btn-fw green-700",
                                    callback:function(){
                                        var select_destino=$('body #select_destino').val().split(';')
                                        $.ajax({
                                            url: base_url+"consultoriosespecialidad/cambiar_consultorio",
                                            type: 'POST',
                                            dataType: 'json',
                                            data: {
                                                'csrf_token':csrf_token,
                                                'triage_consultorio':select_destino[0],
                                                'triage_consultorio_nombre':select_destino[1],
                                                'triage_id':id
                                            },beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                             bootbox.hideAll();
                                             location.reload();
                                            },error: function (e) {
                                                 bootbox.hideAll();
                                                 console.log(e)
                                            }
                                        })
                                    }
                                }
                            }
                            ,onEscape : function() {}
                        });
                        //fa fa-times

                        $('body .modal-body').addClass('text_25');
                        $('.modal-title').css({
                            'color'      : 'white',
                            'text-align' : 'left'
                        });
                        $('.modal-dialog').css({
                            'margin-top':'130px',
                            'width':'25%'
                        })
                        $('.modal-header').css('background','#02344A').css('padding','7px')
                        $('.close').css({
                            'color'     : 'white',
                            'font-size' : 'x-large'
                        });
                        $("#select_destino option[value='"+cons+"']").remove();
                        console.log(cons)
                },error: function (e) {
                    bootbox.hideAll();
                    console.log(e)
                }
            });
        }
    })
    $('#filter_ce').focus();
    $('#filter_ce').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"consultoriosespecialidad/obtener_usuario",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.accion!='NO_RESULT' && input.val()!=''){
                       bootbox.confirm({
                            title: "<h5>DESEA AGREGAR ESTE PACIENTE A LA LISTA?</h5>",
                            message: "FOLIO:"+data.paciente+"<br>PACIENTE: "+data.nombre,
                            buttons: {
                                confirm: {
                                    label: 'Si',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: 'No',
                                    className: 'btn-primary'
                                }
                            },
                            callback: function (result) {
                                if(result==true){
                                    $.ajax({
                                    url: base_url+"consultoriosespecialidad/add_usuario_ce",
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'id':data.paciente,
                                        'csrf_token':csrf_token
                                    },beforeSend: function (xhr) {
                                        msj_loading();
                                    },success: function (data, textStatus, jqXHR) { 
                                        bootbox.hideAll()
                                        location.reload();
                                    },error: function (e) {
                                        msj_error_serve();
                                        console.log(e)
                                    }
                                })
                                }
                            }
                        });
                        $('body .modal-body').addClass('text_25');
                        $('.modal-title').css({
                            'color'      : 'white',
                            'text-align' : 'left'
                        });
                        $('.modal-dialog').css({
                            'margin-top':'130px',
                            'width':'30%'
                        })
                        $('.modal-header').css('background','#02344A').css('padding','7px')
                        $('.close').css({
                            'color'     : 'white',
                            'font-size' : 'x-large'
                        });
                    }if(data.accion=='NO_RESULT' && input.val()!=''){
                        msj_error_noti('EL PACIENTE AUN NO SE ENCUENTRA EN ESTA SECCIÓN')
                    }
                    input.val('');
                    e.preventDefault();
                },error: function (e) {
                    msj_error_serve();
                    console.log(e)
                }
            })
            
            
        }
    })
    $('input[name=asistentesmedicas_incapacidad_am]').click(function (e){
        if($(this).val()=='Si'){
            $('input[name=asistentesmedicas_incapacidad_fi]').attr('required',true).removeAttr('readonly');
            $('input[name=asistentesmedicas_incapacidad_da]').attr('required',true).removeAttr('readonly');
        }else{
            $('input[name=asistentesmedicas_incapacidad_fi]').removeAttr('required',true).attr('readonly',true);
            $('input[name=asistentesmedicas_incapacidad_da]').removeAttr('required',true).attr('readonly',true);
        }
    })
    $('body').on('click','.generar-hoja-clasificacion',function (e){
        window.open(base_url+'asistentesmedicas/generar_solicitud?t='+$(this).data('id'), '_blank');
    })
    /**/
    $('input[name=hf_intoxitacion][value="'+$('input[name=hf_intoxitacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_urgencia][value="'+$('input[name=hf_urgencia]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_especialidad][value="'+$('input[name=hf_especialidad]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_ab][value="'+$('input[name=hf_mecanismolesion_ab]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_td][value="'+$('input[name=hf_mecanismolesion_td]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_av][value="'+$('input[name=hf_mecanismolesion_av]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_maquinaria][value="'+$('input[name=hf_mecanismolesion_maquinaria]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_mecanismolesion_mordedura][value="'+$('input[name=hf_mecanismolesion_mordedura]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_quemadura_fd][value="'+$('input[name=hf_quemadura_fd]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_ce][value="'+$('input[name=hf_quemadura_ce]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_e][value="'+$('input[name=hf_quemadura_e]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_quemadura_q][value="'+$('input[name=hf_quemadura_q]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_trataminentos_curacion][value="'+$('input[name=hf_trataminentos_curacion]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_sutura][value="'+$('input[name=hf_trataminentos_sutura]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vendaje][value="'+$('input[name=hf_trataminentos_vendaje]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_ferula][value="'+$('input[name=hf_trataminentos_ferula]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_trataminentos_vacunas][value="'+$('input[name=hf_trataminentos_vacunas]').data('value')+'"]').prop("checked",true);
    $('input[name=hf_ministeriopublico][value="'+$('input[name=hf_ministeriopublico]').data('value')+'"]').prop("checked",true);
    
    $('input[name=hf_alta][value="'+$('input[name=hf_alta]').data('value')+'"]').prop("checked",true);
    
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_ie][value="'+$('input[name=asistentesmedicas_ss_ie]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_ss_in][value="'+$('input[name=asistentesmedicas_oc_hr]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_oc_hr][value="'+$('input[name=asistentesmedicas_ss_in]').data('value')+'"]').prop("checked",true);
    $('input[name=asistentesmedicas_incapacidad_am][value="'+$('input[name=asistentesmedicas_incapacidad_am]').data('value')+'"]').prop("checked",true);
    
})