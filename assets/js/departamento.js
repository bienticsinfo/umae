$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var departamento = 0;
   var id_tmp       = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function consulta () {
      $.ajax({
         url: base_url+'configuracion/departamento/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': $('#ver-tabla-departamento tbody').html(data['tr']).trigger('footable_redraw'); 
        break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function consulta_filtrada (busqueda,tipo_busqueda) {
      $.ajax({
         url: base_url+'configuracion/departamento/consulta_filtrada',
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
            case '1': $('#ver-tabla-departamento tbody').html(data['tr']).trigger('footable_redraw'); break;
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

   function especialidades () {
      $.ajax({
         url: base_url+'configuracion/departamento/especialidades',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#especialidad').select2('destroy');
               $('#especialidad').html(data['option']);
               $('#especialidad').select2();
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function departamento () {
      $.ajax({
         url: base_url+'configuracion/departamento/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'     : $('input[name=csrf_token]').val(),
            'nombre'         : $('#departamento').val(),
            'idEspecialidad' : $('#especialidad').val()
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

   function tab_modificar (id_departamento) {
      departamento = id_departamento;
      $.ajax({
         url: base_url+'configuracion/departamento/departamento_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'      : $.cookie('csrf_cookie'),
            'id_departamento' : id_departamento
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#especialidad-m').select2('destroy');
               $('#especialidad-m').html(data['option']);
               $('#especialidad-m').select2();
               $('#especialidad-m').select2().select2('val',data['id_especialidad']);
               $('#departamento-m').val(data['departamento']);
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
         url: base_url+'configuracion/departamento/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'      : $('input[name=csrf_token]').val(),
            'nombre'          : $('#departamento-m').val(),
            'idEspecialidad'  : $('#especialidad-m').val(),
            'id_departamento' : id_tmp
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

   function eliminar (id_departamento) {
      $.ajax({
         url: base_url+'configuracion/departamento/eliminar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'      : $.cookie('csrf_cookie'),
            'id_departamento' : id_departamento
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

   $('#ver-tabla-departamento').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-departamento'));
      }
      else if (data == 'eliminar') {
         eliminar($(this).parents('tr').data('id-departamento'));
      }
   });

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('modificar-form');
      tab_modificar(departamento);
   });

   $('#tab-departamento a').on('click',function(){
       $(".tabEdit").addClass('no-display')
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         else {
            especialidades();
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
      if ($(this).valid() == true) {
         departamento();
      }
      return false;
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
         departamento: {
            required: true
         },
         especialidad: {
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
         departamento: {
            required: true
         },
         especialidad: {
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
      case 'index': consulta(); break;
   }

});