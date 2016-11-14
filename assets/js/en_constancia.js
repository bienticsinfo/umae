    $(document).ready(function (){
        document.title='SIGUMAE | Constancias';
        getConstancia();      
        $('#jtfFecha').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd',
            todayHighlight: true
        });
        function insert(){
            $.ajax({
                url: base_url+"ensenanzas/constancia/insertConstancia",
                type: 'POST',
                dataType: 'json',
                data: {
                    'csrf_token':   $.cookie('csrf_cookie'),
                    'nombre'    :   $("#jtfNombre").val(),
                    'fecha'     :   $("#jtfFecha").val(),
                    'lugar'     :   $("#jtfLugar").val(),
                    'id'        :   $("#jtfId").val(),
                    'accion'    :   $("#jtfAccion").val()
                },
                success: function (data) {
                    switch (data['accion']){
                        case '1':
                            alert_success();
                            $("#registrar-form")[0].reset();
                            tabConsultar();
                            break;
                        case '2':
                            alert_success({'msj':data['msj']});
                            break;
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            }) 
        }
        $("#registrar-form").submit(function (e){
            e.preventDefault();
            if($("#registrar-form").valid()==true){
                insert();
                //alert($('#jtfAccion').val())
            }
        })
        $("body").on('click','.generarEmail',function (){
            $.ajax({
                url: base_url+"ensenanzas/constancia/EnviarEmail",
                dataType: 'json',
                type: 'POST',
                data:{
                    'csrf_token':   $.cookie('csrf_cookie'),
                    'idC'       :   $(this).attr('data-constancia'),
                    'idU'       :   $(this).attr('data-user'),
                    'email'     :   $(this).attr('data-email')
                },success: function (data) {
                    console.log($(this).attr('data-user'));
                    console.log($(this).attr('data-constancia'));
                    switch (data['accion']){
                        case '1':
                            alert_success(data['msj'])
                            break;
                        case '2':
                            alert_error(data['msj'])
                            break;
                    }
                },error: function (e) {
                    console.log(e)
                }
            })
        })   
        $('body').on('click','.btnAccionAsistencia',function(){
            var id=$(this).attr('data-id');
            $.ajax({
                url: base_url+"ensenanzas/constancia/registraUserCons",
                type: 'POST',
                dataType: 'json',
                data: {
                    'csrf_token':   $.cookie('csrf_cookie'),
                    'idConsta'  :   $('body #idConstanciaG').val(),
                    'idUser'    :   id
                },success: function (data) {
                    switch (data['accion']){
                        case '1':
                            $('body #'+id+'-Pdf').show();
                            $('body #'+id+'-Email').show();
                            $('body #'+id+'-Asistencia').hide();
                            break;
                        case '2':
                            break;
                    }
                },error: function (e) {
                
                }
            })
            
        });
        $("body").on('click','.infoConstania',function (){
            
            detallesConstancia({
                'id'        :$(this).attr('data-id'),
                'titulo'    :'Generar ',
                'html'      :  
                    '<table id="example" class="footable table-sig table-hover table-condensed" data-filter="#filtroConstancias">'+
                    '<thead>'+
                        '<tr>'+
                            '<th>Nombre</th>'+
                            '<th>A Parterno</th>'+
                            '<th>A Materno</th>'+
                            '<th>Acciones</td>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody></tbody>'+
                    '<tfoot>'+
                       '<tr>'+
                          '<td colspan="7">'+
                             '<div class="grid simple" style="margin-top: 25px;">'+
                                '<div class="pagination pagination-centered width-100"></div>'+
                             '</div>'+
                          '</td>'+
                       '</tr>'+
                    '</tfoot>'+
                '</table>'
            });
            $.ajax({
                url: base_url+"ensenanzas/constancia/getUsersAll",
                dataType: 'json',
                type: 'POST',
                data:{
                  'csrf_token'  :   $.cookie('csrf_cookie'),
                  'idC'         :   $(this).attr('data-id')
                }, success: function (data) {
                    $("#example").attr('data-page-size','5');
                    $("#example").footable();
                    $("#example tbody").html(data['tr']).trigger('flootable').trigger('footable_initialize').trigger('footable_redraw').trigger('footable_resize');
                },error: function (e) {
                    console.log(e)
                }
            })
        })
        $("body").on('click','.accionesS',function (){
            
            subirInfo({
                'titulo'    :'Seleccionar archivo',
                'html'      :        
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<div class="controls">'+
                                    '<form id="formSubir" enctype="multipart/form-data">'+
                                    '<input type="hidden" class="form-control" value="'+$(this).attr('data-infoS')+'" name="idUser" id="idUser">'+
                                    '<input type="file" name="jtfArchivo" class="form-control" id="jtfArchivo">'+
                                    '</form>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>' 
            })
        })
        function subirInfo(arguments) {
            bootbox.dialog({
                title: arguments['titulo'],
                message: arguments['html'],
                buttons: {
                    success: {
                        label     : 'Subir archivo',
                        className : 'btn btn-primary b-green-i',
                        callback  : function(result) {
                            var formData = new FormData($("#formSubir")[0]);
                            $.ajax({
                                url: base_url+'ensenanzas/constancia/subirInfo',
                                 type: 'POST',
                                 data: formData,
                                 cache: false,
                                 contentType: false,
                                 processData: false,
                                 dataType: 'json',
                                success: function(data){
                                    getConstancia();
                                    if(data==1){
                                        alert_success();
                                        
                                    }else{
                                        alert_error('Error al subir el archivo')
                                    }
                                },error: function (e) {
                                    console.log(e)
                                }
                            });
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
        function detallesConstancia(arguments) {
            bootbox.dialog({
                title: arguments['titulo'],
                message: 
                     '<div class="m-r-10 input-prepend inside search-form no-boarder">'+
                        '<span class="add-on" style="padding-left:-4px;">'+
                           '<i class="fa fa-search loading" style="font-size:large;color:black;margin-left: 0;"></i></span>'+
                           '<input name="jftBuscar" id="filtroConstancias" type="text" class="no-boarder " placeholder="Buscar" style="width:250px;">'+
                           '<input type="hidden" id="idConstanciaG" value="'+arguments['id']+'">'+
                    '</div>'+
                    '<div id="">'+
                        arguments['html']+
                    '</div>',
                buttons: {
                    success: {
                        label     : 'Aceptar',
                        className : 'btn btn-primary b-green-i'
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
        
        $("#cancelar").click(function (){
            $("#registrar-form")[0].reset();
            $("#registrar").text('Registrar');
            tabConsultar();
        })
        //Tab
        function tabRegistrar(){
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabRegistrar").addClass('active');
            $(".tabModificar").addClass('no-display');
            $("#tab-consultar").hide();
            $("#tab-registrar").show();
            clear_form();
        }
        function tabConsultar(){
            clear_form();
            $(".tabModificar").addClass('no-display');
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabConsultar").addClass('active');
            $("#tab-registrar").hide();
            $("#tab-consultar").show();
            getConstancia();
        }        
        $("#registrar").click(function (){
            tabRegistrar();
        });
        $("#consultar").click(function (){
            $("#registrar-form")[0].reset();
            tabConsultar();
        });
        $('#registrar-form').validate({
            errorElement: 'span', 
            errorClass: 'error', 
            focusInvalid: false, 
            ignore: "",
            rules: {
                jtfNombre: {required: true},
                jtfFecha: {required: true},
                jtfLugar: {required: true}
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
                var id_form = ['currentForm']['id'];
                clear_form(id_form);
              }             
        });
        //Acciones Edit Eliminar
        $("body").on('click','.accionesE',function (){
            EliminarInfo($(this).attr('data-infoE'),"ensenanzas/constancia/deleteConstancia",function (){getConstancia()});
        });
        $("body").on('click','.accionesM',function (){
            $(".tabModificar").removeClass('no-display');
            var ele=$(this);
            $(".pointer").removeClass('active');
            $(".tab-pane").removeClass('active');
            $(".tabModificar").addClass('active');
            $("#tab-consultar").hide();
            $("#tab-registrar").show();
            $("#jtfAccion").val('Modificar');
            $("#jtfId").val(ele.attr('data-infoM'));
            //tabRegistrar();
            $.ajax({
                url: base_url+"ensenanzas/constancia/getConstanciaById",
                dataType: 'json',
                type: 'POST',
                data: {
                    'csrf_token':   $.cookie('csrf_cookie'),
                    'id'        :   $("#jtfId").val()
                },success:function (data){    
                    console.log(ele.attr('data-infoM'));
                    $("#jtfNombre").val(data['nombreC']);
                    $("#jtfFecha").val(data['fechaC']);
                    $("#jtfLugar").val(data['lugarC']);
                    console.log(data);
                },error:function (e){
                    console.log(e);
                }
            })
        })

    })//Fin lectura del documento 

    function getConstancia(){
        $.ajax({
            url: base_url+"ensenanzas/constancia/getConstancias",
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
                        //getConstancia();
                        alert_error(data['msj']);
                        break;
                }
            },
            error: function (e) {
                console.log(e)
            }
        })
    }
    function clear_form(id_form){
      $("#registrar-form")[0].reset();
      $('.iconMsj').removeClass('fa fa-check');
      $(".controls").removeClass('error-control success-control');
      
    }

   
