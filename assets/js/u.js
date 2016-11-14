$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var id_quirofano_ = 0;
   var id_tmp    = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function consulta () {
      $.ajax({
         url: base_url+'configuracion/quirofano/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-quirofano tbody').html(data['quirofanos'])
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function quirofano () {
      $.ajax({
         url: base_url+'configuracion/quirofano/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $('input[name=csrf_token]').val(),
            'nombre'     : $('#quirofano').val()
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               alert_success();
               consulta(); 
               clear_form('registrar-form');
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

   function tab_modificar (id_quirofano) {
      id_quirofano_ = id_quirofano;
      $.ajax({
         url: base_url+'configuracion/quirofano/quirofano_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $.cookie('csrf_cookie'),
            'id_quirofano' : id_quirofano
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#quirofano-m').val(data['nombre']);
               id_tmp = data['id'];
               $('#modificar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-modificar').addClass('active');
               $(".tabEdit").removeClass('no-display')
               break;
            case '2':
               alert_error(data['msj']); break;
         }
      });
   }

   function eliminar (id_quirofano) {
      $.ajax({
         url: base_url+'configuracion/quirofano/eliminar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $('input[name=csrf_token]').val(),
            'id_quirofano' : id_quirofano
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

   function update () {
      $.ajax({
         url: base_url+'configuracion/quirofano/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'  : $('input[name=csrf_token]').val(),
            'nombre' : $('#quirofano-m').val(),
            'id_quirofano'   : id_tmp
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
      tab_modificar(id_quirofano_);
   });

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });

   $('#ver-tabla-quirofano').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-quirofano'));
      }
      else if (data == 'eliminar') {
         eliminar($(this).parents('tr').data('id-quirofano'));
      }
   });

   $('#registrar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         quirofano();
      }
      return false;
   });

   $('#tab-quirofano a').on('click',function(){
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
   
    var v = $('#registrar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         quirofano: {
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

   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'index': consulta(); break;
   }

});