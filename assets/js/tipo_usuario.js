$(document).ready(function() {

   // ------------------------------
   // - Variables
   // ------------------------------
   
   var id_tmp = 0;
   var tipo_usuario = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function consulta (argument) {
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1':
               clear_form('tipo-usuario-form');
               $('.contain-pisos').addClass('no-display');
               $('#piso').rules('remove'); 
               $('#ver-tabla-tipo-usuario tbody').html(data['tiposUsuarios'])
                  .footable({
                     breakpoints: {
                        tablet: 768
                     }
                  })
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function tab_modificar (id_tipo) {
      tipo_usuario = id_tipo;
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/tipo_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_tipo' : id_tipo
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#tipo-usuario-m').val(data['tipo']);
               $('#departamento-m').select2('destroy');
               $('#departamento-m').html(data['option']);
               $('#departamento-m').select2();
               $("#departamento-m").select2().select2('val',data['id_departamento']);
               $(".pointer").removeClass('no-display');
               $('#modificar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-modificar').addClass('active');
               id_tmp = data['id'];
               if (data['tiene_piso']) {
                  setSelectPiso(data['tiene_piso'],data['pisos']);
               }
               else {
                  $('#piso-m').rules('remove');
               }
               break;
            case '2':
               alert_error(data['msj']); break;
         }
      });
   }

   function setSelectPiso (idPiso,pisos) {
      $('.contain-pisos').removeClass('no-display');
      $('#piso-m').select2('destroy').html(pisos).select2();
      $("#piso-m").select2().select2('val',idPiso);
      $('#piso-m').rules('add',{required : true});
   }

   function consulta_filtrada (busqueda,tipo_busqueda) {
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/consulta_filtrada',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'    : $.cookie('csrf_cookie'),
            'busqueda'      : busqueda,
            'tipo_busqueda' : tipo_busqueda
         }
      })
      .done(function(data) {
          switch(data.action) {
            case '1': $('#ver-tabla-derechohabiente tbody').html(data['tr']).trigger('footable_redraw'); break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function departamentos () {
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/departamentos',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#departamento').select2('destroy');
               $('#departamento').html(data['option']);
               $('#departamento').select2();
               $('#piso').select2('destroy');
               $('#piso').html(data['pisos']);
               $('#piso').select2();
               break;
            case '2':
               alert_error(data['msj']); break;
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

   function insert () {
      var data = {};
      if ($('.contain-pisos').hasClass('no-display')) {
         data = {
            'csrf_token'     : $('input[name=csrf_token]').val(),
            'tipo'           : $('#tipo-usuario').val(),
            'idDepartamento' : $('#departamento').val(),
            'tiene_piso' : 'no'
         };
      }
      else {
         data = {
            'csrf_token'     : $('input[name=csrf_token]').val(),
            'tipo'           : $('#tipo-usuario').val(),
            'idDepartamento' : $('#departamento').val(),
            'piso' : $('#piso').val(),
            'tiene_piso' : 'si'
         }
      }
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/insert',
         type: 'post',
         dataType: 'json',
         data: data
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success();
               consulta(); 
               clear_form('tipo-usuario-form');
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               $('.contain-pisos').addClass('no-display');
               $('#piso').rules('remove');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function update () {
      var data = {};
      if ($('.contain-pisos').hasClass('no-display')) {
         data = {
            'csrf_token'     : $('#tipo-usuario-m-form input[name=csrf_token]').val(),
            'id_tipo'        : id_tmp,
            'tipo'           : $('#tipo-usuario-m').val(),
            'idDepartamento' : $('#departamento-m').val(),
            'tiene_piso' : 'no'
         }
      }
      else {
         data = {
            'csrf_token'     : $('#tipo-usuario-m-form input[name=csrf_token]').val(),
            'id_tipo'        : id_tmp,
            'tipo'           : $('#tipo-usuario-m').val(),
            'idDepartamento' : $('#departamento-m').val(),
            'idPiso' : $('#piso-m').val(),
            'tiene_piso' : 'si'
         }
      }
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/update',
         type: 'post',
         dataType: 'json',
         data: data
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

   function eliminar (id_tipo) {
      $.ajax({
         url: base_url+'configuracion/tipo_de_usuario/eliminar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_tipo'    : id_tipo
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success();
               consulta(); 
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('.page-content').on('change','#departamento', function(event) {
      event.preventDefault();
      if($(this).val() == '1') {
         $('.contain-pisos').removeClass('no-display');
         $('#piso').rules('add', {
            required: true
         });
      }
      else {
         $('.contain-pisos').addClass('no-display');  
         $('#piso').rules('remove');
      }
   });

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('tipo-usuario-form');
      $('.contain-pisos').addClass('no-display');
      $('#piso').rules('remove');
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('tipo-usuario-m-form');
      tab_modificar(tipo_usuario);
   });

   $('#ver-tabla-tipo-usuario').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-usuario'));
      }
   });

   $('#busqueda').on('click', function(event) {
      event.preventDefault();
      consulta_filtrada($('#filter').val(),$('#filtro').val());
   });

   $('#tab-tipo-usuario a').on('click', function(event) {
       $(".tabEdit").addClass('no-display')
      event.preventDefault();
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         else {
            departamentos();
         }
         a.tab('show');
         $('.tab-pane').removeClass('active');
         $('#tab-'+a.attr('id')).addClass('active');
      }
   });

   $('#tipo-usuario-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         insert();
      }
      return false;
   });

   $('#tipo-usuario-m-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });

   $('.select2').on('change',function() {
      $('#tipo-usuario-form').validate().element($(this)); 
   });

   $('#ver-tabla-tipo-usuario').on('click', '.acciones', function(event) {
      event.preventDefault();
      if ($(this).data('id-accion') == 'eliminar') {
         eliminar($(this).parents('tr').data('id-usuario'));
      }
   });

   // ------------------------------
   // - Init
   // ------------------------------
   
   var v_m = $('#tipo-usuario-m-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         tipo_usuario: {
            required: true
         },
         departamento: {
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

   var v = $('#tipo-usuario-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         tipo_usuario: {
            required: true
         },
         departamento: {
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
      case 'index': consulta();  break;
   }

});