$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------

   // ------------------------------
   // - Funciones
   // ------------------------------

   function consulta () {
      $.ajax({
         url: base_url+'configuracion/proveedor/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#ver-tabla-proveedor tbody').html(data['proveedores'])
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function proveedor () {
      $.ajax({
         url: base_url+'configuracion/proveedor/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $('input[name=csrf_token]').val(),
            'nombre'     : $('#nombre').val(),
            'direccion'  : $('#direccion').val(),
            'correo'     : $('#correo').val(),
            'telefono'   : $('#telefono').val()
         }
      })
      .done(function(data) {
         switch(data.action) {
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

   function clear_form(id_form) {
      $('#'+id_form+' .controls').removeClass('error-control success-control');
      $('#'+id_form+' i:first-child').removeClass('fa-exclamation fa fa-check');
      $('#'+id_form+' .form-control').removeClass('valid');
      $('#'+id_form+' select').select2().select2('val','0');
      $('#'+id_form+' .select2-chosen').text('Seleccionar');
      $('#'+id_form+' .select2-search-choice').remove();
      $('#'+id_form+' input[type=text]').val('');
   }

   function tab_modificar (id_proveedor) {
      $.ajax({
         url: base_url+'configuracion/proveedor/proveedor_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $.cookie('csrf_cookie'),
            'id_proveedor' : id_proveedor
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#nombre-m').val(data['nombre']);
               $('#direccion-m').val(data['direccion']);
               $('#correo-m').val(data['correo']);
               $('#telefono-m').val(data['telefono']);
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

   function update () {
      $.ajax({
         url: base_url+'configuracion/proveedor/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $('input[name=csrf_token]').val(),
            'nombre'       : $('#nombre-m').val(),
            'direccion'    : $('#direccion-m').val(),
            'correo'       : $('#correo-m').val(),
            'telefono'     : $('#telefono-m').val(),
            'id_proveedor' : id_tmp
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success();
               consulta(); 
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               $(".tabEdit").removeClass('no-display')
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function eliminar (id_proveedor) {
      $.ajax({
         url: base_url+'configuracion/proveedor/eliminar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $.cookie('csrf_cookie'),
            'id_proveedor' : id_proveedor
         }
      })
      .done(function(data) {
         switch(data.action) {
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

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });

   $('#ver-tabla-proveedor').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-proveedor'));
      }
      else if (data == 'eliminar') {
         eliminar($(this).parents('tr').data('id-proveedor'));
      }
   });

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#registrar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         proveedor();
      }
      return false;
   });

   $('#tab-proveedor a').on('click',function(){
       $(".tabEdit").addClass('no-display')
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         else {
            // especialidades();
         }
         a.tab('show');
         $('.tab-pane').removeClass('active');
         $('#tab-'+a.attr('id')).addClass('active');
      }
   });

   // ------------------------------
   // - init
   // ------------------------------

   var v = $('#registrar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         nombre: {
            required: true
         },
         direccion: {
            required: true
         },
         correo: {
            required : true,
            email    : true
         },
         telefono: {
            required: true
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

   var v_m = $('#modificar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         nombre: {
            required: true
         },
         direccion: {
            required: true
         },
         correo: {
            required : true,
            email    : true
         },
         telefono: {
            required: true
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

   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'index':  break;
   }

});