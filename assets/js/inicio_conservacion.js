var notificaciones_old=0;
$(document).ready(function (){
    
    $('body #example_length ,.DTTT ').addClass('hidden');  
    $('#retrievingfilename').html5imageupload({
        onAfterProcessImage: function() {
                $('#filename').val($(this.element).data('name'));
                $('#check-img').val('Nueva');
        },
        onAfterCancel: function() {
                $('#filename').val('');
        }
    });
    $('.fecha-calendar,.fecha_calendar').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        todayHighlight: true
    });
    $('.dd-mm-yyyy').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
    $('.d-m-y').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('.clockpicker').clockpicker({
        placement: 'top',
        autoclose: true});
    $('#save').html5imageupload({
        onSave: function(data) {
                console.log(data);
        }

    });
    $('.upload-archivo').fileinput({
            language: 'es'
    });
    $('body .fileinput-upload').hide();

    $('body .fecha').html(fechaActual());
    function fechaActual(){
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
        var f=new Date(); 
        return diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
    }
    setInterval(function() {
        var seconds = new Date().getSeconds();
        $('.segundo').html((seconds < 10 ? "0" : "") + seconds);
    }, 1000);
    setInterval(function() {
        var minutes = new Date().getMinutes();
        $('.minuto').html((minutes < 10 ? "0" : "") + minutes);
    }, 1000);
    setInterval(function() {
        var hours = new Date().getHours();
        $('.hora').html((hours < 10 ? "0" : "") + hours);
    }, 1000);
    setInterval(function (e){
        
        var hora=new Date().getHours();
        var minuto=new Date().getMinutes();
        var horario=hora+':'+minuto;
        if(horario=='15:00'){
            realizar_corte_auto(horario);
        }if(horario=='21:00'){
            realizar_corte_auto(horario);
        }if(horario=='06:00'){
            realizar_corte_auto(horario);
        }
    },1000)
    
    function realizar_corte_auto(horario){
        $.ajax({
            url: base_url+"triage/corte_auto",
            beforeSend: function (xhr) {
                msj_loading('Realizando corte espere por favor...');
                console.log('Realizando Cortes')
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    console.log('Cortes realizados correctamente: '+horario)
                }
            },error: function (e) {
                bootbox.hideAll();
                msj_error_serve();
                console.log(e)
            }
        })
    }
    $.ajax({
        url: base_url+"inicio/notificaciones_total",
        success: function (data, textStatus, jqXHR) {
            $('.notificaciones-total').html(data.total);
            notificaciones_old=data.total;
        },error: function (e) {
            console.log(e)
        }
    })
//    setInterval(function (){
//        $.ajax({
//            url: base_url+"inicio/notificaciones_total",
//            success: function (data, textStatus, jqXHR) {
//                $('.notificaciones-total').html(data.total);
//                notificaciones_old=data.total;
//            },error: function (e) {
//                console.log(e)
//            }
//        })
//    },1000)
    $('body input[name=csrf_token]').val($.cookie('csrf_cookie'))
    $('.back-history1').on('click',function(e){
        history.go(-1);
    })
    $('.back-history2').on('click',function(e){
        history.go(-2);
    })
    $('.back-history3').on('click',function(e){
        history.go(-3);
    })
})