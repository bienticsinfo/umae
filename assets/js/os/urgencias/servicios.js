$(document).ready(function (){
    $('body #example_length ,.DTTT ').addClass('hidden');
    document.title='Urgencias | Servicios';
    $('.registro_servicios').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: base_url+"urgencias/insert_servicios",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_success_noti('Guardando...');
            },success: function (data, textStatus, jqXHR) {
                if (data.accion=='1'){
                    msj_success_noti('Datos guardados.');
                    setTimeout(function (e){
                        location.href=base_url+'urgencias/servicios';
                    },1000)
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                msj_error_serve();
            }
        })
    })
    $('.eliminar-servicio').click(function (e){
        e.preventDefault();
        var el=$(this).attr('data-id');
        if(confirm('¿DESEA ELIMINAR EL REGISTRO?')){
            $.ajax({
                url: base_url+"urgencias/eliminar",
                dataType: 'json',
                type: 'POST',
                data: {
                    'csrf_token':csrf_token,
                    'value':el
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
})
