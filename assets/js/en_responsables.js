/* 
 * @felipe de jesus
 */
    $(document).ready(function (){
        document.title='SIGUMAE | Responsables';
        getResponsables()
        
        function Insert(){
            $.ajax({
                url: base_url+"ensenanzas/configuracion/insertRespo",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':$.cookie('csrf_cookie'),
                    'jtfNombre'         :   $("#jtfNombre").val(),
                    'jtfApat'           :   $("#jtfApat").val(),
                    'jtfInstitucion'    :   $("#jtfInstitucion").val(),
                    'jtfAmat'           :   $("#jtfAmat").val(),
                    'idResponsable'     :   $("#jtfIdUser").val(),
                    'jtfAccion'         :   $("#jtfAccion").val()
                },
                success: function (data) {
                    switch (data['action']){
                        case '1':
                            alert_success();
                            $("#registrar-form")[0].reset();
                            tabConsultar()
                            break;
                        case '2':
                            alert_error(data['msj']);
                            break;
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
        $("#registrar-form").on('submit',function (e){
            e.preventDefault();
            if($(this).valid()==true){
                Insert();
            }
        });
        $("#registrar").click(function (){
            tabRegistrar()
        })
        $("#consultar").click(function (){
            tabConsultar();
        }) ;
        function tabRegistrar(){
            clear_form()
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabRegistrar").addClass('active');
            $(".tabModificar").addClass('no-display');
            $("#tab-consultar").hide();
            $("#tab-registrar").show();
        }
        function tabConsultar(){
            clear_form();
            $(".tabModificar").addClass('no-display');
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabConsultar").addClass('active');
            $("#tab-registrar").hide();
            $("#tab-consultar").show();
            getResponsables();

        }
        function clear_form(){
            $("#registrar-form")[0].reset();
            $('.iconMsj').removeClass('fa fa-check');
            $(".controls").removeClass('error-control success-control');
        }
        $("#registrar-form").validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules:{
                    jtfNombre:{required:true},
                    jtfApat:{required:true},
                    jtfAmat:{required:true},
                    jtfInstitucion:{required:true}
                },errorPlacement: function (error, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('fa fa-check').addClass('fa fa-exclamation').css('z-index',10);  
                    parent.removeClass('success-control').addClass('error-control');

                },submitHandler: function(form) {
                        clear_form('registrar-form');
                },highlight: function (element) { 
                    var parent = $(element).parent();
                    parent.removeClass('success-control').addClass('error-control');
                },success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("fa fa-exclamation").addClass('fa fa-check').css('z-index',10);
                    parent.removeClass('error-control').addClass('success-control'); 
                },
            });
        $("#cancelar").click(function (){
            $("#registrar-form")[0].reset();
            clear_form();
            tabConsultar();
        })
        $('body').on('click','.accionesE',function(){
            EliminarInfo($(this).attr('data-infoE'),'ensenanzas/configuracion/deleteResponsable',function (){getResponsables()()});
        })
        $("body").on('click','.accionesM',function (){
            $(".tabModificar").removeClass('no-display');
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabModificar").addClass('active');
            $("#tab-consultar").hide();
            $("#tab-registrar").show();
             var id=$(this).attr('data-infoM');
            $("#jtfAccion").val('Modificar');
            $("#jtfIdUser").val(id);
            
            $.ajax({
                url: base_url+"ensenanzas/configuracion/getResById",
                dataType: 'json',
                type: 'POST',
                data: {
                    'id':id,
                    'csrf_token' : $.cookie('csrf_cookie')
                },success:function (data){
                    $("#jtfNombre").val(data['nombreUsuario']);
                    $("#jtfApat").val(data['apatUsuario']);
                    $("#jtfAmat").val(data['amatUsuario']);
                    $("#jtfInstitucion").val(data['insOrigenRes'])
                },error: function (e) {
                    console.log(e)
                }
            })
        }) 
    })
    function getResponsables(){
        $.ajax({
            url: base_url+'ensenanzas/configuracion/getResponsables',
            dataType: 'json',
            success: function (data) {
                switch (data['action']){
                    case '1':
                            $('#ver-tabla-usuario tbody').html(data['tr'])                            
                            .trigger('footable_initialize')
                            .trigger('footable_redraw')
                            .trigger('footable_resize');
                        break;
                    case '2':
                        alert_error(data['msj']);
                        break;
                }
            },error: function (e) {
                console.log(e);
            } 
        })
    }


