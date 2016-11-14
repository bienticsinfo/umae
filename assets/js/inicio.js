$(document).ready(function (){ 
    user_info();
}); 
function  user_info(){
    $.ajax({
        url: base_url+"inicio/obtenerUserT",
        dataType: 'json'
    }).done(function(data){
       //$("#rs_user").html(data['dat']);
        switch (data['action']){
            case '1':
                $('#ver-tabla-quirofano tbody').html(data['tr']);
   		$('#ver-tabla-quirofano').trigger('footable_redraw');
                break;
            case '2':alert_error(data['msj']);
                break;
        }
    }).fail(function(e){
        console.log(e);
    })
}
