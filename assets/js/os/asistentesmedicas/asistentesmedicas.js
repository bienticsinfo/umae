$(document).ready(function (e){
    $('select[name=triage_paciente_sexo]').val($('select[name=triage_paciente_sexo]').data('value'));
    $('select[name=triage_paciente_estadocivil]').val($('select[name=triage_paciente_estadocivil]').data('value'));
    $('select[name=triage_paciente_accidente_lugar]').val($('select[name=triage_paciente_accidente_lugar]').data('value'));
    $('.solicitud-paciente').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"asistentesmedicas/guardar_solicitud",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    msj_success_noti('Registro Guardado')
                    window.open(base_url+'asistentesmedicas/generar_solicitud?t='+$('input[name=triage_id]').val(), '_blank');
                    if($('select[name=triage_paciente_accidente_lugar]').val()=='TRABAJO'){
                        window.open(base_url+'asistentesmedicas/st7?t='+$('input[name=triage_id]').val(), '_blank');
                    }//window.open(base_url+'asistentesmedicas/st7?t='+$('input[name=triage_id]').val(), '_blank');
                    if($('input[name=triage_solicitud_rx]').val()=='Si'){
                        window.open(base_url+'asistentesmedicas/generar_solicitud_rx?t='+$('input[name=triage_id]').val(), '_blank');
                    }
                    setTimeout(function (e){
                        window.top.close();
                    },1000)
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
                bootbox.hideAll();
            }
        })
    })
    $('select[name=triage_paciente_accidente_lugar]').change(function (e){
        if($(this).val()=='TRABAJO'){
            //$('.lugar_no_trabajo').addClass('hide');
            //$('.lugar_trabajo').removeClass('hide');
        }else{
            //$('.lugar_no_trabajo').removeClass('hide');
            //$('.lugar_trabajo').addClass('hide');
        }
    })
    $('input[name=triage_paciente_dir_cp]').blur(function (e){
        if($(this).val()!=''){
            $.ajax({
                url: base_url+"asistentesmedicas/get_data_cp",
                type: 'POST',
                dataType: 'json',
                data:{
                    'cp':$(this).val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) {
//                    var colonia=data.result_cp.Colonia.split(';');
//                    $("input[name=triage_paciente_dir_colonia]").autocomplete({
//                        source: colonia
//                    });
                    $('select[name=triage_paciente_dir_colonia]').html('');
                    
                    $('input[name=triage_paciente_dir_municipio]').val(data.result_cp.Municipio);
                    $('input[name=triage_paciente_dir_estado]').val(data.result_cp.Estado);
                },error: function (e) {
                    console.log(e);
                }
            })
        }   
    })
    $('input[name=triage_paciente_accidente_cp]').blur(function (e){
        if($(this).val()!=''){
            $.ajax({
                url: base_url+"asistentesmedicas/get_data_cp",
                type: 'POST',
                dataType: 'json',
                data:{
                    'cp':$(this).val(),
                    'csrf_token':csrf_token
                },success: function (data, textStatus, jqXHR) {
//                    var colonia=data.result_cp.Colonia.split(';');
//                    $("input[name=triage_paciente_accidente_colonia]").autocomplete({
//                        source: colonia
//                    });
                    $('input[name=triage_paciente_accidente_municipio]').val(data.result_cp.Municipio);
                    $('input[name=triage_paciente_accidente_estado]').val(data.result_cp.Estado);
                },error: function (e) {
                    console.log(e);
                }
            })
        }
    })
})