/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $(document).ready(function (){
        document.title='SIGUMAE | Horarios';
        var argument_dialog = '';
        getHorarios();

        $("#consultar").click(function (){
            tabConsultar();
        });
        $("#registrar").click(function (){
            tabRegistrar();
        });
        $("#registrar-form").submit(function (e){
            e.preventDefault();
            if($(this).valid()==true){
                insertHorario();
            }
        });
        $("body").on('click','.accionesM',function (){
            var element=$(this);
            $(".pointer").removeClass('active');
            $(".tabEdit").addClass('active');
            $(".tab-pane").hide()
            $("#tab-edit").show();
            $("#jftEditHorar").val(element.attr('data-id-accion'));
            $("#jftEditHorarId").val(element.attr('data-infoM'));
        });
        $("body").on('click','.accionesE',function (){
            argument_dialog=$(this).attr('data-infoE');
            dialogEliminar({'id':$(this).attr('data-infoE')});
        })
        $("#edit-form").on('submit',function (e){
            e.preventDefault();
            updateHorario();
            
        })
        $("#registrar-form").validate({
            errorElement: 'span', 
            errorClass: 'error', 
            focusInvalid: false, 
            ignore: "",
            rules: {
                jtfHorarios:{required:true}
            },errorPlacement: function (error, element) {
                var icon = $(element).parent('.input-with-icon').children('i');
                var parent = $(element).parent('.input-with-icon');
                icon.removeClass('fa fa-check').addClass('fa fa-exclamation').css('z-index', 10);
                parent.removeClass('success-control').addClass('error-control');
            },highlight: function (element) { 
                var parent = $(element).parent();
                parent.removeClass('success-control').addClass('error-control');
            },success: function (label, element) {
                var icon = $(element).parent('.input-with-icon').children('i');
                var parent = $(element).parent('.input-with-icon');
                icon.removeClass("fa fa-exclamation").addClass('fa fa-check').css('z-index',10);
                parent.removeClass('error-control').addClass('success-control'); 
            },submitHandler: function (form) {
                form.reset();
                clear_form();
              }
        });
        $("#cancelar").click(function (){
            clear_form();
        });
        function dialogEliminar(arguments) {
            bootbox.dialog({
             title: '<i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar Registro',
             message: 
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<center>'+
                        '<h3> ¿Deseas eliminar este registro?</h3>'+
                    '</center>'+
                '</div>'+
            '</div>',
             buttons: {
                main: {
                    label: "Calcelar",
                    className: "btn btn-default ",
                    callback: function() {
                    }
                },success: {
                   label     : 'Aceptar',
                   className : 'btn btn-primary b-green-i',
                   callback  : function(result) {
                        $.ajax({
                                url: base_url+"ensenanzas/configuracion/deleteConfig",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    'id'            :argument_dialog,
                                    'csrf_token'    :   $('input[name=csrf_token]').val()
                                },success: function (data) {
                                    switch (data['accion']){
                                        case '1':
                                            getHorarios();
                                            tabConsultar();
                                            break;
                                        case '2':
                                            alert_error(data['msj'])
                                            break;
                                    }
                                    console.log(data['accion']);
                                },
                                error: function (e) {
                                    console.log(e)
                                }
                        })
                   }
                } 

             }
          });
            $('.modal-header').addClass('b-green-b-i');
            $('.modal-title').css({
                'color'      : 'white',
                'text-align' : 'left'
            });
            $('.close').css({
                'color'     : 'white',
                'font-size' : 'x-large'
            });
        }             
    });
    //Funciones =============================
    function getHorarios(){
        $.ajax({
            url: base_url+"ensenanzas/configuracion/getHorarios",
            dataType: 'json',
            success: function (data) {
                switch (data['accion']){
                    case '1':
                        $("#ver-tabla-contancia tbody").html(data['tr'])                            
                            .trigger('footable_initialize')
                            .trigger('footable_redraw')
                            .trigger('footable_resize');
                        break;
                    case '2':
                        alert_error(data['msj'])
                        break;
                }
            },error: function (e) {
                console.log(e)
            }
        })
    }
    function insertHorario(){
        $.ajax({
            url: base_url+"ensenanzas/configuracion/insertHorarios",
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_token'    :   $('input[name=csrf_token]').val(),
                'jtfHorarios'   :   $("#jtfHorarios").val()
            },success:function (data){
                switch (data['accion']){
                    case '1':
                        alert_success();
                        tabConsultar();
                        getHorarios();
                        break;
                    case '2':
                        alert_error(data['msj']);
                        break;
                }
            },error:function (e){
                
            }
        })
    }
    function updateHorario(){
        $.ajax({
            url: base_url+"ensenanzas/configuracion/updateHorario",
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_token'    :   $('input[name=csrf_token]').val(),
                'jtfHorarios'   :   $("#jftEditHorar").val(),
                'jftEditHorarId':   $("#jftEditHorarId").val()
            },success:function (data){
                switch (data['accion']){
                    case '1':
                        alert_success();
                        tabConsultar();
                        getHorarios();
                        break;
                    case '2':
                        alert_error(data['msj']);
                        break;
                }
            },error:function (e){
                
            }
        })
    }    
    function tabConsultar(){
        $(".pointer").removeClass('active');
        $('.tabConsultar').addClass('active');
        $("#tab-consultar").show();
        $("#tab-edit").hide();
        $("#tab-registrar").hide();
    }
    function tabRegistrar(){
        $(".pointer").removeClass('active');
        $('.tabRegistrar').addClass('active');
        $("#tab-consultar").hide();
        $("#tab-edit").hide();
        $("#tab-registrar").show();
    }
    function clear_form(){
      $('.iconMsj').removeClass('fa fa-check');
      $(".controls").removeClass('error-control success-control');
      $('input').val('');
    }


