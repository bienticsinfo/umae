$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var time_request = 1000;
   var ajax_request;
   var id_tmp = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function update () {
      $.ajax({
         url: base_url+'configuracion/derechohabiente/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $('#derechohabiente-m-form input[name=csrf_token]').val(),
            'id_usuario' : id_tmp,
            'nss'        : $('#nss-m').val(),
            'nombre'     : $('#nombre-m').val(),
            'a_paterno'  : $('#paterno-m').val(),
            'a_materno'  : $('#materno-m').val()
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

   function consulta_filtrada (busqueda,tipo_busqueda) {
      $.ajax({
         url: base_url+'configuracion/derechohabiente/consulta_filtrada',
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
            case '1': $('#ver-tabla-derechohabiente tbody').html(data['tr']).trigger('footable_redraw'); break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function consulta (argument) {
      $.ajax({
         url: base_url+'configuracion/derechohabiente/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-derechohabiente tbody').html(data['derechohabientes'])
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function tab_modificar (id_usuario) {
      $.ajax({
         url: base_url+'configuracion/derechohabiente/derechohabiente_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_usuario' : id_usuario
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#nss-m').val(data['nss']);
               $('#nombre-m').val(data['nombre']);
               $('#paterno-m').val(data['apellido_materno']);
               $('#materno-m').val(data['apellido_paterno']);
               $('#modificar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-modificar').addClass('active');
               $('.pointer').removeClass('no-display')
               id_tmp = data['id'];
               break;
            case '2':
               alert_error(data['msj']); break;
         }
      });
   }

   function derechohabiente () {
      $.ajax({
         url: base_url+'configuracion/derechohabiente/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $('input[name=csrf_token]').val(),
            'nss'        : $('#nss').val(),
            'nombre'     : $('#nombre').val(),
            'a_paterno'  : $('#paterno').val(),
            'a_materno'  : $('#materno').val()
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

   function clear_form(id_form) {
      $('#'+id_form+' .controls').removeClass('error-control success-control');
      $('#'+id_form+' i:first-child').removeClass('fa-exclamation fa fa-check');
      $('#'+id_form+' .form-control').removeClass('valid');
      $('#'+id_form+' select').select2().select2('val','0');
      $('#'+id_form+' .select2-chosen').text('Seleccionar');
      $('#'+id_form+' .select2-search-choice').remove();
      $('#'+id_form+' input[type=text]').val('');
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('#derechohabiente-m-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('derechohabiente-m-form')
      tab_modificar(id_tmp);
   });

   $('#derechohabiente-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         derechohabiente();
      }
      return false;
   });

   $('#cancelar').on('click',function(){
      var id_form = $(this).parents('form').attr('id');
      clear_form(id_form);
   });

   $('#busqueda').on('click', function(event) {
      event.preventDefault();
      consulta_filtrada($('#filter').val(),$('#filtro').val());
   });

   $('#ver-tabla-derechohabiente').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-usuario'));
      }
   });

   $('#tab-derechohabiente a').on('click',function(){
      $(".tabEdit").addClass('no-display')
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         a.tab('show');
         $('.tab-pane').removeClass('active');
         $('#tab-'+a.attr('id')).addClass('active');
      }
   });

   // ------------------------------
   // - Init
   // ------------------------------

   var v = $('#derechohabiente-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         nss: {
            required: true
         },
         nombre: {
            required: true
         },
         paterno: {
            required: true
         },
         materno: {
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

   var v_m = $('#derechohabiente-m-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         nss: {
            required: true
         },
         nombre: {
            required: true
         },
         paterno: {
            required: true
         },
         materno: {
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