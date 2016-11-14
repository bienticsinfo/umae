var total_salida=0
var total_sal_new=0;
$(document).ready(function (e){
    setInterval(function (e){
        $.ajax({
            url: base_url+"triage/listas/last_lista_paciente",
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(data.last_lista_paciente==''){
                    $('.last_lista_no').addClass('hide')
                }else{
                    $('.last_lista_no').removeClass('hide')
                }
                $('.consultoriosespecialidad_last_lista tbody tr').html(data.last_lista_paciente);
                if(data.result_listas_ce==null){
                    $('.table-pacientes-especialidad-no').removeClass('hide')
                    $('.table-pacientes-especialidad').addClass('hide');
                }else{
                    $('.table-pacientes-especialidad-no').addClass('hide')
                    $('.table-pacientes-especialidad').removeClass('hide');
                    $('.table-pacientes-especialidad tbody').html(data.result_listas_ce);
                }
                
                
            },error: function (e) {
                console.log(e);
            }
        })
    },1000);
   
});