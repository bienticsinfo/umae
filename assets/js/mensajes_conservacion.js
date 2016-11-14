/*  * @felipe de jesus | iti_fjpp@hotmail.com */
    var msj_loading=function (msj){
           bootbox.dialog({
                    title: '<h6>&nbsp;&nbsp;&nbsp;Espere por favor...</h6>',
                    message:'<div class="row ">'+
                                '<div class="col-sm-12">'+
                                    '<h6 class="text-center" style="line-height:2"><i class="fa fa-spinner fa-spin fa-5x"></i></h6>'+
                                    '<h6 class="text-center" style="line-height:2">'+(msj==undefined ? '': msj)+'</h6>'+
                                '</div>'+
                            '</div>'
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
                    'width':'30%'
                })
                $('.modal-header').css('background','#02344A').css('padding','7px')
                $('.close').css({
                    'color'     : 'white',
                    'font-size' : 'x-large'
                });
    };
    var msj_beforeSend=function (){
        bootbox.dialog({
            title: 'Vive Pueblos Mágicos',
            message: '<center><i class="fa fa-spinner fa-spin fa-3x msjOk"></i><br>Espere por favor.</center>'
            ,onEscape : function() {}
        });
        //fa fa-times
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    }; 
    var isValidEmail=function (mail){
            return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
    }
    function ventana(){ 
        coordx= screen.width ? (screen.width-200)/2 : 0; 
        coordy= screen.height ? (screen.height-150)/2 : 0; 
        window.open(base_url+ 'config/mapa','miventana','width=800,height=600,top=30,right='+coordx+',left='+coordy);
    } ;
    var msj_error_noti=function (msj){
        Messenger().post({
            message: msj,
            type: 'error',
            showCloseButton: true
        }); 
    }
    var msj_error_serve=function (){
        Messenger().post({
            message: 'Error al procesar la petición al servidor',
            type: 'error',
            showCloseButton: true
        }); 
    }
    var  msj_success_noti=function (msj){
        Messenger().post({
            message: msj,
            showCloseButton: true
        }); 
    }
    var msj_ok=function (titulo,msj,redirec){
        bootbox.dialog({
            title: 'Vive Pueblos Mágicos | '+(titulo == undefined ? '' : titulo),
            message: '<center><i class="fa fa-check fa-4x msjOk"></i><br>'+(msj == undefined ? 'Acción realizado correctamente' : msj)+'</center>',
            closeButton: true,
            buttons: {
                success: {
                    label     : 'Aceptar',
                    className : 'green-msj btn btn-primary btn-cons',
                    callback  : function(result) {
                        if(redirec!=undefined){
                            location.replace(redirec);
                        }
                         
                    }
                } 
            },onEscape : function() {}
        });
        //fa fa-times
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    } 

    var msj_error=function (titulo,msj){
        bootbox.dialog({
            title: 'Vive Pueblos Mágicos | '+(titulo == undefined ? '' : titulo),
            message: '<center><i class="fa fa-times fa-4x msjOk"></i><br>'+(msj == undefined ? 'Error al realizar la acción' : msj)+'</center>',
            closeButton: true,
            buttons: {
                success: {
                    label     : 'Aceptar',
                    className : 'green-msj btn btn-primary btn-cons',
                    callback  : function(result) {
                        //location.replace(base_url)
                    }
                } 
            },onEscape : function() {}
        });
        //fa 
        $('body .modal-body').addClass('text_25');
        $('.modal-title').css({
            'color'      : 'white',
            'text-align' : 'left'
        });
        $('.close').css({
            'color'     : 'white',
            'font-size' : 'x-large'
        });
    }
    var title=function (titulo){
        document.title=(titulo ==undefined ? 'Vive Pueblos Mágicos' :titulo );
    } 
    var get_fecha=function (){
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
        var f=new Date(); 
        return diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
    }
    var fecha_yyyy_mm_dd=function (){        
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if(dd<10) {
            dd='0'+dd;
        } 
        if(mm<10) {
            mm='0'+mm;
        } 
        return yyyy+'/'+mm+'/'+dd;
    }    
    var fecha_dd_mm_yyyy=function (){
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if(dd<10) {
            dd='0'+dd;
        } 
        if(mm<10) {
            mm='0'+mm;
        } 
        return dd+'/'+mm+'/'+yyyy;
    }
    var hora_actual=function (e){
        var seconds = new Date().getSeconds();
        var minutes = new Date().getMinutes();
        var hours = new Date().getHours();
        return  (hours < 10 ? "0" : "") + hours  +':'+ (minutes < 10 ? "0" : "") + minutes;
    }
    $('body .tag-hora').val(hora_actual());
    $(".tag-tension-arterial").mask("999/99");
    $('.auto').autoNumeric('init');
    $('body .tag-fecha').val(fecha_dd_mm_yyyy())
    $('.input-fecha-actual').val(get_fecha())
    $('.tagsinput').tagsinput();
    $('.bootstrap-tagsinput').css('width','100%');
