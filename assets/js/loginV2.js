$(document).ready(function (){
    $('.btn-no-login').click(function (){
        $('.row-login').removeClass('hide');
        $('.row-no-login').addClass('hide');
    })
    var show_hide_pass=0;
    $('.show-hide-pass').click(function (){
        show_hide_pass=show_hide_pass+1;
        if(show_hide_pass==1){
            $('#txtpassword').attr('type','text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }else{
            $('#txtpassword').attr('type','password');
            $(this).addClass('fa-eye').removeClass('fa-eye-slash');
            show_hide_pass=0;
        }
    })
    $('.tip').tooltip()
    $('.login-form').submit(function (e){
        var el=$(this);
        e.preventDefault();
        $.ajax({
            url: base_url+"login/loginV2",
            dataType: 'json',
            type: 'POST',
            data:{
                'csrf_token':   $.cookie('csrf_cookie'),
                'empleado_area':$('input[name=empleado_area]').val(),
                'empleado_matricula':$('input[name=empleado_matricula]').val()
            }
            ,beforeSend: function (xhr) {
                el.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin"></i> Espere por favor...').attr('disabled',true);
                el.find('input[type=text]').attr('readonly',true);
            },success:function (data){
                switch (data.ACCESS_LOGIN){
                    case 'AREA_NO_ENCONTRADA':
                        msj_error_noti('EL AREA ESCRITA NO EXISTE');
                        break;
                    case 'MATRICULA_NO_ENCONTRADA':
                        msj_error_noti('LA MATRICULA ESCRITA NO EXISTE');
                        break;
                    case 'ADMIN_NO_ENCONTRADA':
                        msj_error_noti('ACCESO DENEGADO');
                        break;
                    case '1':
                        location.href=base_url+'inicio';
                        break;    
                }
                el.find('button[type=submit]').html('Acceder').removeAttr('disabled');
                el.find('input[type=text]').removeAttr('readonly');
                
            },error: function (e) {
                console.log(e)
            }
        })
    })
    $.ajax({
        url: base_url+"login/ger_areas_acceso",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $( "input[name=empleado_area]" ).autocomplete({
              source: data
            });
        }
    })

})
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

