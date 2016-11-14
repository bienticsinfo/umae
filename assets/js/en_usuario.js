$(document).ready(function (){
    document.title='SIGUMAE | Usuarios';
    var argument_dialog = '';
    getUsers();
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 
    hoy = mm+'/'+dd+'/'+yyyy;

    $('body').on('keydown','#CredencialAdd,#CredencialReponer',function (e){
        $(this).val(($(this).val() + '').replace(/[^0-9]/g, ''));
    });
    function Insert(){
        
        $.ajax({
            url: base_url+"ensenanzas/usuario/insertUsuario",
            type: 'POST',
            dataType: 'json',
            data:{
                'csrf_token':$.cookie('csrf_cookie'),
                'jtfNombre'         :   $("#jtfNombre").val(),
                'jtfApat'           :   $("#jtfApat").val(),
                'jtfAmat'           :   $("#jtfAmat").val(),
                'jtfMatricula'      :   $("#jtfMatricula").val(),
                'jtfEmail'          :   $("#jtfEmail").val(),
                'jtfDias'           :   $("#jtfDias").val(),
                'jtfHoraE'          :   $("#jtfHoraE").val(),
                'jtfHoraS'          :   $("#jtfHoraS").val(),
                'jtfIdResponsable'  :   $("#jtfIdResponsable").val(),
                'idUsuario'         :   $("#jtfIdUser").val(),
                'jtfAccion'         :   $("#jtfAccion").val(),
                'tipoResidente'     :   $("#jtfTipoRotante").val(),
                'jtfEspecialidad'   :   $("#jtfEspecialidad").val(),
                'jtfAnio'           :   $("#jtfAnio").val(),
                'jtfGrado'          :   $("#jtfGrado").val(),
                'jtfLugarSede'      :   $("#jtfLugarSede").val(),
                'jtfServicioR'      :   $("#jtfServicioR").val(),
                'jtfFechaInicio'    :   $("#jtfFechaInicio").val(),
                'jtfFechaFin'       :   $("#jtfFechaFin").val(),
                'jtfHospital'       :   $("#jtfHospital").val(),
                'jtfFechaRegistro'  :   hoy,
            },
            success: function (data) {
                $("#jtfAccion").val('Agregar');
                $("#jtfIdUser").val();
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
    $('#jtfFechaInicio,#jtfFechaFin').datepicker({
			autoclose: true,
			todayHighlight: true
    });
    $('#Sede').click(function (){
        if($(this).is(':checked')){
            $("#jtfTipoRotante").val('Sede');
            $(".inputSede").show();
            $(".inputRontantes").hide();
        }
    })
    $('#Rotantes').click(function (){
        if($(this).is(':checked')){
            $("#jtfTipoRotante").val('Rotante');
            $(".inputRontantes").show();
            $(".inputSede").hide();
        }
    }) ;
    $('body').on('click','.downloadPdf',function (){
        //alert()
    })
    function clear_form(){
        $("#registrar-form")[0].reset();
        $('.iconMsj').removeClass('fa fa-check');
        $(".controls").removeClass('error-control success-control');
    }
    $('input[name=jftResponsable]').on('focusin', function(event) {
        event.preventDefault();
        $(this).prop('disabled', false);
    });
    $("#registrar-form").on('submit',function (e){
        e.preventDefault();
        if($(this).valid()==true){
            Insert();
        }
    });
    $("#registrar-form").validate({
            errorElement: 'span', 
            errorClass: 'error', 
            focusInvalid: false, 
            ignore: "",
            rules:{
                jtfNombre:{required:true},
                jtfApat:{required:true},
                jtfAmat:{required:true},
                jtfMatricula:{required:true},
                jtfHorario:{required:true},
                jtfResponsable:{required:true}
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
    //Buscar responsable
    $('.buscar-responsable,input[name=jtfResponsable]').on('click',function (){
        argument_dialog='responsable';
        dialog({
            'titulo'        :   'Responsables',
            'buscar'        :   'usuario',
            'name_input'    :   'b_usuario',
            'id'            :   'usuario_econtrado',
            'pre_tabla'     :               
                '<table class="footable width-100">'+
                    '<thead>'+
                        '<tr>'+
                            '<th>Num°</th>'+
                            '<th>Nombre</th>'+
                            '<th>A Parterno</th>'+
                            '<th>A Materno</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody></tbody>'+
                '</table>'
        });
        $('.footable').trigger('footable_redraw');
    });
    $('body').on('keyup', 'input[name="b_usuario"]', function(event) {
        event.preventDefault();
        //clearTimeout(ajax_request);
        $('.loading').removeClass('fa-search').addClass('fa-spinner fa-spin');
        buscarResponsable();
        //ajax_request=setTimeout(buscarResponsable,time_request)
      
    });
    $('body').on('click','#usuario_econtrado tr',function(){
        $('body').find('#usuario_econtrado tr').removeClass('b-green-l-i');
        var tr = $(this);
        var id = tr.data('id');
        if (id != undefined) {
            tr.addClass('b-green-l-i');
        }  
    });
    $('body').on('click','.buscar-horarios,input[name=jtfHorario]',function (){
        dialogHorario({
            'titulo':   'Horarios',
            'html'  :           
            '<div class="row">'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label class="form-label">Hora de entrada</label>'+
                        '<div class="controls">'+
                            '<select id="horarioEntrada" class="form-control" style="width:100%">'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label class="form-label">Hora de salida</label>'+
                        '<div class="controls">'+
                            '<select id="horarioSalida" class="form-control">'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Lunes" type="checkbox" name="dias[]" value="Lunes">'+
                          '<label for="Lunes">L</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Martes" type="checkbox" name="dias[]" value="Martes">'+
                          '<label for="Martes">M</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Miercoles" type="checkbox" name="dias[]" value="Miercoles">'+
                          '<label for="Miercoles">M</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Jueves" type="checkbox" name="dias[]" value="Jueves">'+
                          '<label for="Jueves">J</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Viernes" type="checkbox" name="dias[]" value="Viernes">'+
                          '<label for="Viernes">V</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Sabado" type="checkbox" name="dias[]" value="Sabado">'+
                          '<label for="Sabado">S</label>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row-fluid" style="float:left">'+
                        '<div class="checkbox check-default">'+
                          '<input id="Domingo" type="checkbox" name="dias[]" value="Domingo">'+
                          '<label for="Domingo">D</label>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'
        });
        getHorarios('horarioEntrada');
        getHorarios('horarioSalida');
    })
    $('body').on('click','.accionesA',function(){
        if($(this).attr('data-creadencial')=='No Asignado'){
            dialogReponer({
                'titulo'            :   'Asignar - Reponer',
                'credencial'        :   '',
                'accionAdd'         :   '',
                'accionReponer'     :   'hidden',
                'idUser'            :   $(this).attr('data-infoA'),
                'disabled'          :   ''
        });
        }else{
            dialogReponer({
                'titulo'            :   'Asignar - Reponer',
                'credencial'        :   $(this).attr('data-creadencial'),
                'accionAdd'         :   '',
                'accionReponer'     :   '',
                'idUser'            :   $(this).attr('data-infoA'),
                'disabled'          :   'disabled'
            });
       }
   });
    function buscarResponsable(){
        $.ajax({
            url: base_url+"ensenanzas/usuario/getUsers",
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_token' : $.cookie('csrf_cookie'),
                'busqueda'   : $('input[name=b_usuario]').val()
            },success: function (data) {
               $('.loading').addClass('fa-search').removeClass('fa-spinner fa-spin'); 
                switch (data['action']){
                    case '1':
                        $('.footable tbody').html(data['tr']).trigger('footable_redraw');
                        break;
                    case '2':
                        $('.footable tbody').empty();   
                        break;
                }
            },
            error: function (e) {
                console.log(e);
            }
        })
    }
   $('input[name=jtfHorario], input[name=jtfResponsable]').on('focusin', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
   });

   $('input[name=jtfHorario], input[name=jtfResponsable]').on('focusout', function(event) {
      event.preventDefault();
      $(this).prop('disabled', false);
   });
    $('body').on('click','.accionesE',function(){
        EliminarInfo($(this).attr('data-infoE'),'ensenanzas/usuario/eliminarUser',function (){getUsers()});
    })
    $("body").on('click','.infoMas',function (){
        $.ajax({
            url: base_url+"ensenanzas/usuario/getUserById",
            dataType: 'json',
            type: 'POST',
            data: {
                'csrf_token' : $.cookie('csrf_cookie'),
                'id': $(this).attr('data-info')
            },success:function (data){
                dialogoInfo('Horarios',
                '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-label"><b>Entrada:</b>'+data['horaEntrada']+'</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                        '<div class="form-group">'+
                            '<label class="form-label"><b>Salida:</b> '+data['horaSalida']+'</label>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<label class="form-label"><b>Dias: </b>'+data['dias']+'</label>'+
                        '</div>'+
                    '</div>'+
                    '</di>')
            },error: function (e) {
                console.log(e)
            }
        })
    })
    $("#registrar").click(function (){
        tabRegistrar()
    })
    $("#consultar").click(function (){
        tabConsultar();
    }) ;
    function tabRegistrar(){
            clear_form();
            $("#jtfFechaRegistro").val(hoy);
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
        getUsers();
    }
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
            url: base_url+"ensenanzas/usuario/getUserById",
            dataType: 'json',
            type: 'POST',
            data: {
                'id':id,
                'csrf_token' : $.cookie('csrf_cookie')
            },success:function (data){
                if(data['tipoResidente']=='Sede'){
                    $("#Rotantes").attr('checked',false);
                    $("#Sede").attr('checked',true)
                    $("#jtfTipoRotante").val('Sede');
                    $(".inputSede").show();
                    $(".inputRontantes").hide();

                }else{
                    $("#Rotantes").attr('checked',true);
                    $("#Sede").attr('checked',false)
                    $("#jtfTipoRotante").val('Rotante');
                    $(".inputRontantes").show();
                    $(".inputSede").hide();
                }
                
                $("#jtfNombre").val(data['nombreUsuario']);
                $("#jtfApat").val(data['apatUsuario']);
                $("#jtfAmat").val(data['amatUsuario']);
                $("#jtfEmail").val(data['email']);
                $("#jtfMatricula").val(data['matriculaUsuario']);
                
                $("#jtfHorario").val("Entrada: " +data['horaEntrada']+", Salida: "+data['horaSalida']+ ", Dias: "+data['dias']);
                $("#jtfDias").val(data['dias']);
                $("#jtfHoraE").val(data['horaEntrada']);
                $("#jtfHoraS").val(data['horaSalida']);
                $("#jtfIdResponsable").val(data['idResponsable']);
                $("#jtfResponsable").val(data['jtfResponsable']);
                $("#jtfTipoRotante").val(data['tipoResidente']);
                $("#jtfEspecialidad").val(data['especialidad']);
                $("#jtfAnio").val(data['anio']);
                $("#jtfGrado").val(data['grado']);
                $("#jtfLugarSede").val(data['lugarSede']);
                $("#jtfServicioR").val(data['servicioRotacion']);
                $("#jtfFechaInicio").val(data['frInicio']);
                $("#jtfFechaFin").val(data['frFin']);
                $("#jtfHospital").val('hospital');
                $("#jtfFechaRegistro").val(data['fechaRegistro']);
            },error: function (e) {
                console.log(e)
            }
        })
    }) 
    $("#cancelar").click(function (){
        $("#registrar-form")[0].reset();
        clear_form();
        tabConsultar();
        
    })
    function dialog(arguments) {
        bootbox.dialog({
         title: arguments['titulo'],
         message: 
         '<div class="m-r-10 input-prepend inside search-form no-boarder">'+
            '<span class="add-on" style="padding-left:4px;">'+
               '<i class="fa fa-search loading" style="font-size:large;color:black;margin-left: 0;"></i></span>'+
               '<input name="'+arguments['name_input']+'" type="text" class="no-boarder " placeholder="'+arguments['buscar']+'" style="width:250px;">'+
         '</div>'+
         '<div id="'+arguments['id']+'">'+
            arguments['pre_tabla']+
         '</div>',
         buttons: {
            success: {
               label     : 'Aceptar',
               className : 'btn btn-primary b-green-i',
               callback  : function(result) {
                  switch(argument_dialog){
                     case 'responsable':
                        var selected = $('#usuario_econtrado').find('tr.b-green-l-i');
                        if (selected != undefined) {
                           $('#jtfResponsable').val(selected.data('nombre'));
                           //$('#jtfIdResponsable').val(selected.data('data-id'));
                           $('#jtfIdResponsable').val(selected.data('id'));
                           //$('#jtfIdResponsable').val(selected.data('idEmpleado'));
                        }
                        break;
                  }
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
    function dialogReponer(arguments) {
  
        bootbox.dialog({
         title: arguments['titulo'],
         message: 
        '<div class="row">'+
            '<div class="col-md-6" '+arguments['accionAdd']+'>'+
                '<div class="form-group">'+
                    '<label class="form-label ">Ingresar Credencial</label>'+
                    '<div class="controls">'+
                        '<input type="hidden" class="form-control" id="CredencialId" value="'+arguments['idUser']+'">'+
                        '<input type="text " '+arguments['disabled']+' value="'+arguments['credencial']+'"  class="form-control" id="CredencialAdd">'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-6 " '+arguments['accionReponer']+'>'+
                '<div class="form-group">'+
                    '<label class="form-label">Reposición</label>'+
                    '<div class="controls">'+
                        '<input type="text" class="form-control" id="CredencialReponer">'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>',
         buttons: {
            main: {
                label: "Cancelar",
                className: "btn btn-info"
            },success: {
               label     : 'Aceptar',
               className : 'btn btn-primary b-green-i',
               callback  : function(result) {
                   $.ajax({
                        url: base_url+"ensenanzas/usuario/editCreadencial",
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            'csrf_token':$.cookie('csrf_cookie'),
                            'CredencialAdd'         :   $("body #CredencialAdd").val(),
                            'CredencialReponer'     :   $("body #CredencialReponer").val(),
                            'idUsuario'             :   $("body #CredencialId").val()
                        },success: function (data) {
                            console.log(data)
                                switch (data['accion']){
                                    case '1':
                                        alert_success();
                                        getUsers()
                                        break;
                                    case '2':
                                        alert_error(data['msj']);
                                        break;
                                }
                        },error: function (e) {

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
    
    function dialogHorario(arguments) {
        bootbox.dialog({
         title: arguments['titulo'],
         message: arguments['html'],
         buttons: {
             success: {
               label     : 'Aceptar',
               className : 'btn btn-primary b-green-i',
               callback  : function(result) {
                var checkboxValues = "";
                $('input[name="dias[]"]:checked').each(function() {
                        checkboxValues += $(this).val() + ",";
                });
                //eliminamos la última coma.
                checkboxValues = checkboxValues.substring(0, checkboxValues.length-1);
                var horaE=$("#horarioEntrada").val();
                var horaS=$("#horarioSalida").val();
                $("#jtfHorario").val("Entrada: " +horaE+", Salida: "+horaS+ ", Dias: "+checkboxValues);
                $("#jtfDias").val(checkboxValues);
                $("#jtfHoraE").val(horaE);
                $("#jtfHoraS").val(horaS);
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
})
    function getHorarios(select){
        
        $.ajax({
            url: base_url+"ensenanzas/usuario/getHorarios",
            dataType: 'json',
            success:function (data){
                $("#"+select).html(data['option']);
            },error: function (e) {
                console.log(e);
            }
        })
    }
    function getUsers(){
        $.ajax({
            url: base_url+'ensenanzas/usuario/getUsersAll',
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

