$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var material_osteo = 0;
   var id_tmp       = 0;
   var wImgMat = 0;
   var hImgMat = 0;
   var xImgMat = 0;
   var x2ImgMat = 0;
   var yImgMat = 0;
   var y2ImgMat = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function resetMedidasCrop () {
      wImgMat = 0;
      hImgMat = 0;
      xImgMat = 0;
      x2ImgMat = 0;
      yImgMat = 0;
      y2ImgMat = 0;
   }

   function consulta (argument) {
      $.ajax({
         url: base_url+'configuracion/material_osteo/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#ver-tabla-material').data('page-size',10);
               $('#ver-tabla-material tbody').html(data['materiales'])
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize'); 
               clear_form('registrar-form');
               clear_form('modificar-form');
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function clear_form(id_form) {
      $('#'+id_form+' .file-caption').removeClass('border-error border-success');
      $('#'+id_form+' .controls').removeClass('error-control success-control');
      $('#'+id_form+' i:first-child').removeClass('fa-exclamation fa fa-check');
      $('#'+id_form+' .form-control').removeClass('valid');
      $('#'+id_form+' select').select2().select2('val','0');
      $('#'+id_form+' .select2-chosen').text('Seleccionar');
      $('#'+id_form+' .select2-search-choice').remove();
      $('#'+id_form+' input[type=text]').val('');
      $('.file-upload').fileinput('clear');
      $('.file-upload').fileinput('reset');
   }

   function material_osteo_ci () {
      var formDataMateriales = new FormData();
      $.each($('#imagen')[0].files, function(i, file) {
         formDataMateriales.append('file', file);
      });
      formDataMateriales.append('wImgMat', $('.file-preview-frame img').width());
      formDataMateriales.append('hImgMat', $('.file-preview-frame img').height());
      formDataMateriales.append('xImgMat', xImgMat);
      formDataMateriales.append('x2ImgMat', x2ImgMat);
      formDataMateriales.append('yImgMat', yImgMat);
      formDataMateriales.append('y2ImgMat', y2ImgMat);
      formDataMateriales.append('nombre', $('#nombre').val());
      formDataMateriales.append('cantidad_maxima', $('#maxima').val());
      formDataMateriales.append('cantidad_minima', $('#minima').val());
      formDataMateriales.append('clave', $('#clave').val());
      formDataMateriales.append('descripcion', $('#descripcion').val());
      $.ajax({
         url: base_url+'configuracion/material_osteo/insert',
         type: 'POST',
         dataType: 'json',
         data: formDataMateriales,
         cache: false,
         contentType: false,
         processData: false
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success();
               consulta(); 
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               $('.file-upload').fileinput('reset');
               $('.file-upload').fileinput('clear');
               resetMedidasCrop();
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function tab_modificar (id_material) {
      material_osteo = id_material;
      $.ajax({
         url: base_url+'configuracion/material_osteo/material_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idMaterial_Osteosintesis' : id_material
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#nombre-m').val(data['nombre']).data('old_name',data['nombre']);
               $('#maxima-m').val(data['cantidad_maxima']);
               $('#minima-m').val(data['cantidad_minima']);
               $('#clave-m').val(data['clave']).data('old_clave',data['clave']);
               $('#descripcion-m').val(data['descripcion']);
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
      var formDataMateriales = new FormData();
      $.each($('#imagen-m')[0].files, function(i, file) {
         formDataMateriales.append('file', file);
      });
      formDataMateriales.append('wImgMat', $('.file-preview-frame img').width());
      formDataMateriales.append('hImgMat', $('.file-preview-frame img').height());
      formDataMateriales.append('xImgMat', xImgMat);
      formDataMateriales.append('x2ImgMat', x2ImgMat);
      formDataMateriales.append('yImgMat', yImgMat);
      formDataMateriales.append('y2ImgMat', y2ImgMat);
      formDataMateriales.append('nombre', $('#nombre-m').val());
      formDataMateriales.append('old_name', $('#nombre-m').data('old_name'));
      formDataMateriales.append('cantidad_maxima', $('#maxima-m').val());
      formDataMateriales.append('cantidad_minima', $('#minima-m').val());
      formDataMateriales.append('id_material', id_tmp);
      formDataMateriales.append('clave', $('#clave-m').val());
      formDataMateriales.append('old_clave', $('#clave-m').data('old_clave'));
      formDataMateriales.append('descripcion', $('#descripcion-m').val());
      $.ajax({
         url: base_url+'configuracion/material_osteo/update',
         type: 'POST',
         dataType: 'json',
         data: formDataMateriales,
         cache: false,
         contentType: false,
         processData: false
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success();
               consulta(); 
               $('#consultar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-consultar').addClass('active');
               $('.file-upload').fileinput('reset');
               $('.file-upload').fileinput('clear');
               $(".tabEdit").addClass('no-display')
               resetMedidasCrop();
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function get_sis (id_cirugia,tipo) {
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/sis_elementos',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_cirugia' : id_cirugia,
            'tipo'       : tipo
         },
      })
      .done(function(data) {
         switch(data.action) {
            case '1': detalles_sistemas(data['tr_html']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function cambiarEstado (id_material,estado) {
      $.ajax({
         url: base_url+'configuracion/material_osteo/cambiarEstado',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'  : $.cookie('csrf_cookie'),
            'id_material' : id_material,
            'status' : estado
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

   function showCoords (c) {
      wImgMat = c.w;
      hImgMat = c.h;
      xImgMat = c.x;
      x2ImgMat = c.x2;
      yImgMat = c.y;
      y2ImgMat = c.y2;
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('modificar-form');
      tab_modificar(material_osteo);
   });

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#ver-tabla-sistemas').on('click','.detalles',function(event) {
      event.preventDefault();
      // get_sis($(this).parent('tr').data('no-cirugia'),$(this).data('sis'));
   });

   $('#tab-materiales a').on('click',function(){
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

   $('#registrar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         material_osteo_ci();
      }
      return false;
   });

   $('#ver-tabla-material').on('click', '.acciones', function(event) {
      event.preventDefault();
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         tab_modificar($(this).parents('tr').data('id-material'));
         $('.contain-img-material').attr('src',base_url + 'assets/img/materiales/' + $(this).parents('tr').data('imagen'));
      }
      else if (data == 'eliminar') {
         cambiarEstado($(this).parents('tr').data('id-material'),'0');
      }
      else if (data == 'activar') {
         cambiarEstado($(this).parents('tr').data('id-material'),'1');
      }
   });

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });

   $('#imagen').on('fileimageloaded', function(event, file, previewId, index, reader) {
      $('.file-preview-image').Jcrop({
         bgColor : 'transparent',
         onChange: showCoords,
         onSelect: showCoords,
         aspectRatio: 1
      });
      $('#registrar-form').validate().element($('#imagen'));
   });

   $('#imagen-m').on('fileimageloaded', function(event, file, previewId, index, reader) {
      $('.file-preview-image').Jcrop({
         bgColor : 'transparent',
         onChange: showCoords,
         onSelect: showCoords,
         aspectRatio: 1
      });
      $('#modificar-form').validate().element($('#imagen-m'));
   });

   $('body').on('click', '.fileinput-remove-button, .fileinput-remove', function(event) {
      event.preventDefault();
      $('#registrar-form').validate().element($('#imagen'));
      $('#modificar-form').validate().element($('#imagen-m'));
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
         nombre: { required: true },
         maxima: {
            required: true,
            digits: true,
            min: 1
         },
         minima: {
            required: true,
            digits: true,
            min: 1
         },
         clave : { required: true },
         descripcion : { required : true }
         // imagen : {
         //    required : true
         // }
      },
      errorPlacement: function (error, element) {
         if (element.attr('type') == 'file') {
            if ($('.file-preview').parent('.file-input').hasClass('file-input-new')) {
               element.parents('.input-group').find('i.fa').removeClass('fa-check color-success').addClass('fa-exclamation color-error').css('z-index',10);  
            }
         }
         else {
            var icon = $(element).parent('.input-with-icon').children('i');
            var parent = $(element).parent('.input-with-icon');
            icon.removeClass('fa fa-check').addClass('fa fa-exclamation').css('z-index',10);  
            parent.removeClass('success-control').addClass('error-control');
         }
      },
      highlight: function (element) { 
         if ($(element).attr('type') == 'file') {
            $(element).parents('.input-group').find('.form-control').removeClass('border-success').addClass('border-error');
         }
         else {
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control');
         }
      },
      success: function (label, element) {
         if ($(element).attr('type') == 'file') {
            $(element).parents('.input-group').find('.form-control').removeClass('border-error').addClass('border-success');
            // $(element).parents('.input-group').find('i.fa').removeClass('fa-exclamation color-error').addClass('fa-check color-success')
            $(element).parents('.input-group').find('i.fa').removeClass('fa-exclamation color-error');
         }
         else {
            var icon = $(element).parent('.input-with-icon').children('i');
            var parent = $(element).parent('.input-with-icon');
            icon.removeClass("fa fa-exclamation").addClass('fa fa-check').css('z-index',10);
            parent.removeClass('error-control').addClass('success-control'); 
         }
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
         maxima: {
            required: true
         },
         minima: {
            required: true
         },
         clave : { required: true },
         descripcion : { required : true }
         // imagen : {
         //    required : true
         // }
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
      case 'index': break;
   }

   $(".file-upload").fileinput({
      language: 'es',
      allowedFileExtensions: ['jpg','png','bmp'],
      maxFileSize: 8000
   });

});