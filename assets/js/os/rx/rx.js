total_pacientes_new=0;
total_pacientes_old=0;
$(document).ready(function (){
    $('body').on('click','.btn-llamar-paciente-rx',function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"rx/llamar_paciente_rx",
            dataType: 'json',
            beforeSend: function (xhr) {
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
    })
    $('body').on('click','.acceso-area-rx-paciente',function (e){
        var rx_id=$(this).data('id');
        var rx_accion=$(this).data('accion');
        var rx_traige=$(this).data('triage');
        if(confirm('¿Salida al Consultorio de Especialidad?')){
            $.ajax({
                url: base_url+"rx/acceso_paciente",
                type: 'POST',
                dataType: 'json',
                data: {
                    'rx_id':rx_id,
                    'rx_accion':rx_accion,
                    'triage':rx_traige,
                    'csrf_token':csrf_token
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    bootbox.hideAll();
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve()
                    bootbox.hideAll();
                }
            })
        }
    })
    $.ajax({
        url: base_url+"rx/actualizar_lista_via_ce",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            total_pacientes_old=data.total;
        }
    })
    setInterval(function (e){
        $.ajax({
            url: base_url+"rx/actualizar_lista_via_ce",
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(total_pacientes_old!=data.total){
                    location.reload();
                }
                total_pacientes_old=data.total;
            }
        })
    },1000)
})