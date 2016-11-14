$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var id_tmp   = 0;
   var empleado = 0;
   var fecha_nacimiento = '';

   // ------------------------------
   // - Funciones
   // ------------------------------

   function consulta () {
      $.ajax({
         url: base_url+'configuracion/empleado/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-empleado tbody').html(data['empleados'])
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function consulta_filtrada (busqueda,tipo_busqueda) {
      $.ajax({
         url: base_url+'configuracion/empleado/consulta_filtrada',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'    : $.cookie('csrf_cookie'),
            'busqueda'      : busqueda,
            'tipo_busqueda' : tipo_busqueda
         }
      })
      .done(function(data) {
          switch(data['action']) {
            case '1': $('#ver-tabla-empleado tbody').html(data['tr']).trigger('footable_redraw'); break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function clear_form(id_form) {
      $('#'+id_form+' .controls').removeClass('error-control success-control');
      $('#'+id_form+' i:first-child').removeClass('fa-exclamation fa fa-check');
      $('#'+id_form+' .form-control').removeClass('valid');
      $('#'+id_form+' select').select2().select2('val','0');
      $('#'+id_form+' .select2-chosen').text('Seleccionar');
      $('#'+id_form+' .select2-search-choice').remove();
      $('#'+id_form+' input[type=text]').val('');
   }

   function insertEmpleado () {
      $.ajax({
         url: base_url+'configuracion/empleado/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'       : $('input[name=csrf_token]').val(),
            'matricula'        : $('#matricula').val(),
            'nombre'           : $('#nombre').val(),
            'apellido_paterno' : $('#a-paterno').val(),
            'apellido_materno' : $('#a-materno').val(),
            'fecha_nacimiento' : fecha_nacimiento,
            'sexo'             : $('#sexo').val(),
            'lugar_nacimiento' : $('#l-nacimiento').val(),
            'direccion'        : $('#direccion').val(),
            'telefono'         : $('#telefono').val(),
            'celular'          : $('#celular').val(),
            'email'            : $('#correo').val()
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               alert_success();
               consulta(); 
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }
    function getHorarios(){
        $.ajax({
            url: base_url+"",
            type: 'json',
            success:function (){
                
            },error: function (e) {
                console.log(e);
            }
        })
    }
   function update () {
      $.ajax({
         url: base_url+'configuracion/empleado/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'       : $('input[name=csrf_token]').val(),
            'matricula'        : $('#matricula-m').val(),
            'old_matricula'    : $('#matricula-m').data('old-matricula'),
            'nombre'           : $('#nombre-m').val(),
            'apellido_paterno' : $('#a-paterno-m').val(),
            'apellido_materno' : $('#a-materno-m').val(),
            'fecha_nacimiento' : fecha_nacimiento,
            'sexo'             : $('#sexo-m').val(),
            'lugar_nacimiento' : $('#l-nacimiento-m').val(),
            'direccion'        : $('#direccion-m').val(),
            'telefono'         : $('#telefono-m').val(),
            'celular'          : $('#celular-m').val(),
            'email'            : $('#correo-m').val(),
            'id_empleado'      : id_tmp
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               alert_success();
               consulta(); 
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               $(".tabEdit").addClass('no-display')
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function tab_modificar (id_empleado) {
      empleado = id_empleado;
      $.ajax({
         url: base_url+'configuracion/empleado/empleado_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'  : $.cookie('csrf_cookie'),
            'id_empleado' : id_empleado
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#fecha-nacimiento-m').datepicker({
                  format: 'yyyy/mm/dd',
                  startView: 2,
                  autoclose: true,
                  todayHighlight: true
               })
               .on('changeData', function(event) {
                  fecha_nacimiento = getFormattedDate($(this).datepicker('getDate'));   
               });
               $('#matricula-m').val(data['matricula']).data('old-matricula',data['matricula']);
               $('#nombre-m').val(data['nombre']);
               $('#a-paterno-m').val(data['a_paterno']);
               $('#a-materno-m').val(data['a_materno']);
               $('#fecha-nacimiento-m').datepicker('setValue',data['f_nacimiento']);
               fecha_nacimiento = data['f_nacimiento'];
               $('#l-nacimiento-m').select2().select2('val',data['l_nacimiento']);
               $('#sexo-m').select2().select2('val',data['sexo']);
               $('#direccion-m').val(data['direccion']);
               $('#telefono-m').val(data['telefono']);
               $('#celular-m').val(data['celular']);
               $('#correo-m').val(data['correo']);
               $('#modificar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-modificar').addClass('active');
               $(".tabEdit").removeClass('no-display')
               id_tmp = data['id'];
               break;
            case '2':
               alert_error(data['msj']); break;
         }
      });
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('modificar-form');
      tab_modificar(empleado);
   });

   $('#ver-tabla-empleado').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-usuario'));
      }
      else if (data == 'eliminar') {
         // eliminar($(this).parents('tr').data('id-usuario'));
      }
   });

   $('#tab-empleado a').on('click',function(){
       $(".tabEdit").addClass('no-display')
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         else {
            $('#fecha-nacimiento').datepicker({
               format: 'yyyy/mm/dd',
               startView: 2,
               autoclose: true,
               todayHighlight: true
            })
            .on('changeDate', function(event) {
               fecha_nacimiento = getFormattedDate($(this).datepicker('getDate'));  
            });
         }
         a.tab('show');
         $('.tab-pane').removeClass('active');
         $('#tab-'+a.attr('id')).addClass('active');
      }
   });

   $('#busqueda').on('click', function(event) {
      event.preventDefault();
      consulta_filtrada($('#filter').val(),$('#filtro').val());
   });

    $('#registrar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid()) {
         insertEmpleado();
      }
      return false;
   });

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid()) {
         update();
      }
      return false;
   });

   $('input[name=f_nacimiento]').on('change', function(event) {
      event.preventDefault();
      $('#registrar-form').validate().element($(this));
   });

   $('#sexo').on('change', function(event) {
      event.preventDefault();
      $('#registrar-form').validate().element($(this));
   });

   $('#sexo-m').on('change', function(event) {
      event.preventDefault();
      $('#modificar-form').validate().element($(this));
   });

   $('#l-nacimiento').on('change', function(event) {
      event.preventDefault();
      $('#registrar-form').validate().element($(this));
   });

   $('#l-nacimiento-m').on('change', function(event) {
      event.preventDefault();
      $('#modificar-form').validate().element($(this));
   });

   // ------------------------------
   // - Init
   // ------------------------------
   
   var v_m = $('#modificar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         matricula: {
            required: true
         },
         nombre: {
            required: true
         },
         a_paterno: {
            required: true
         },
         a_materno: {
            required: true
         },
         f_nacimiento: {
            required : true,
            date     : true
         },
         l_nacimiento: {
            required: true
         },
         sexo: {
            required: true
         },
         direccion: {
            required: true
         },
         telefono: {
            required: true
         },
         celular: {
            required: true
         },
         correo: {
            required: true,
            email: true
         }
      },
      errorPlacement: function (error, element) {
         var icon = $(element).parent('.input-with-icon').children('i');
         var parent = $(element).parent('.input-with-icon');
         icon.removeClass('fa fa-check').addClass('fa fa-exclamation').css('z-index',10);  
         parent.removeClass('success-control').addClass('error-control');

      },
      highlight: function (element) { 
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control');
      },
      success: function (label, element) {
         var icon = $(element).parent('.input-with-icon').children('i');
         var parent = $(element).parent('.input-with-icon');
         icon.removeClass("fa fa-exclamation").addClass('fa fa-check').css('z-index',10);
         parent.removeClass('error-control').addClass('success-control'); 
      },
      submitHandler: function (form) {
         form.reset();
         var id_form = v_m['currentForm']['id'];
         clear_form(id_form);
      }
   });

   var v = $('#registrar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         matricula: {
            required: true
         },
         nombre: {
            required: true
         },
         a_paterno: {
            required: true
         },
         a_materno: {
            required: true
         },
         f_nacimiento: {
            required : true,
            date     : true
         },
         l_nacimiento: {
            required: true
         },
         sexo: {
            required: true
         },
         direccion: {
            required: true
         },
         telefono: {
            required: true
         },
         celular: {
            required: true
         },
         correo: {
            required: true,
            email: true
         }
      },
      errorPlacement: function (error, element) {
         var icon = $(element).parent('.input-with-icon').children('i');
         var parent = $(element).parent('.input-with-icon');
         icon.removeClass('fa fa-check').addClass('fa fa-exclamation').css('z-index',10);  
         parent.removeClass('success-control').addClass('error-control');

      },
      highlight: function (element) { 
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control');
      },
      success: function (label, element) {
         var icon = $(element).parent('.input-with-icon').children('i');
         var parent = $(element).parent('.input-with-icon');
         icon.removeClass("fa fa-exclamation").addClass('fa fa-check').css('z-index',10);
         parent.removeClass('error-control').addClass('success-control'); 
      },
      submitHandler: function (form) {
         form.reset();
         var id_form = v['currentForm']['id'];
         clear_form(id_form);
      }
   });

   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'index':  break;
   }

});