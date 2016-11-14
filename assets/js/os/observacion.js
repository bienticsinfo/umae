$(document).ready(function (e){
    $('#input_search').focus()
    $('#input_search').keyup(function (e){
        var input=$(this);
        if($(this).val().length==11 && input.val()!=''){ 
            $.ajax({
                url: base_url+"observacion/obtener_paciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':input.val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) { 
                    console.log(data)
                    if(data.accion=='1' && input.val()!=''){
                        window.open(base_url+'observacion/asignar_cama?t='+input.val(),'_blank');
                    }else{
                        if(input.val()!=''){
                            msj_success_noti('EL N° PACIENTE NO SE ENCUENTRA REGISTRADO O NO SE ENCUENTRA EN ESTA ETAPA') 
                        }
                        
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
    $('body').on('click','.add-cama-paciente',function (e){
        var area_id=$(this).data('area');
        var triage=$(this).data('triage');
        if(confirm('¿ASIGNAR CAMA?')){
            $.ajax({
                url: base_url+"observacion/buscar_camas",
                type: 'POST',
                dataType: 'json',
                data: {'area_id':area_id,'csrf_token':csrf_token},
                beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    bootbox.dialog({
                        title: '<h5>ASIGNAR CAMA</h5>',
                        message:'<div class="row ">'+
                                    '<div class="col-sm-12">'+(data.option!='NO_RESULT' ? '<label>ASIGNAR CAMA</label><select id="select_cama" style="width:100%">'+data.option+'</select>' :' <center>NO HAY CAMAS DISPONIBLES PARA ESTA ÁREA</center>' )+
                                    '</div>'+
                                '</div>',
                        buttons: {
                            main: {
                                label: "Aceptar",
                                className: "btn-fw green-700",
                                callback:function(){
                                    var select_cama=$('#select_cama').val();
                                    if(select_cama!=undefined){
                                        $.ajax({
                                            url: base_url+"observacion/asignar_cama_paciente",
                                            type: 'POST',
                                            dataType: 'json',
                                            data:{
                                                'csrf_token':csrf_token,
                                                'observacion_cama':select_cama,
                                                'triage_id':triage
                                            },beforeSend: function (xhr) {
                                                msj_loading();
                                            },success: function (data, textStatus, jqXHR) {
                                                bootbox.hideAll();
                                                if(data.accion=='1'){
                                                    location.reload();
                                                }
                                            },error: function (jqXHR, textStatus, errorThrown) {
                                                bootbox.hideAll();
                                                msj_error_serve();
                                            }
                                        })
                                    }
                                }
                            }
                        }
                        ,onEscape : function() {}
                    });
                    setting_modal(25)

                    
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                    
                }
            })
                
        }
    })
    $('body').on('click','.alta-paciente',function (e){
        var triage_id=$(this).data('triage');
        var observacion_cama=$(this).data('cama');
        if(confirm('¿DAR DE ALTA PACIENTE?')){
            bootbox.dialog({
                title: '<h5>ALTA PACIENTE</h5>',
                message:'<div class="row ">'+
                            '<div class="col-sm-12">'+
                                '<input type="radio" name="observacion_alta_value" value="Alta a domicilio" id="domicilio"><label for="domicilio">Alta a domicilio</label><br>'+
                                '<input type="radio" name="observacion_alta_value" value="Alta e ingreso quirófano" id="quirofano"><label for="quirofano">Alta e ingreso quirófano</label><br>'+
                                '<input type="radio" name="observacion_alta_value" value="Alta e ingreso a hospitalización" id="hospitalizacion"><label for="hospitalizacion">Alta e ingreso a hospitalización</label> '+
                            '</div>'+
                        '</div>',
                buttons: {
                    main: {
                        label: "Aceptar",
                        className: "btn-fw green-700",
                        callback:function(){
                            var observacion_alta=$('body input[name=observacion_alta]').val();
                            $.ajax({
                                url: base_url+"observacion/alta_paciente",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    'observacion_alta':observacion_alta,
                                    'triage_id':triage_id,
                                    'observacion_cama':observacion_cama,
                                    'csrf_token':csrf_token
                                },beforeSend: function (xhr) {
                                    msj_loading()
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
                    }
                }
                ,onEscape : function() {}
            });
            setting_modal(25);
            $('body').on('click','input[name=observacion_alta_value]',function (e){
                $('input[name=observacion_alta]').val($(this).val())
            })
        };
    })
    function setting_modal(width){
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        if(width==undefined){
            $('.modal-dialog').css({
                'margin-top':'130px'
            })
        }else{
            $('.modal-dialog').css({
                'margin-top':'130px','width':width+'%'
            })
        }
        
        $('.modal-header').css('background','#02344A').css('padding','7px')
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    }
})