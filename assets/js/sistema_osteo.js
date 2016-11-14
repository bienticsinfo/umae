$(document).ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var sistema_osteo = 0;
   var id_tmp       = 0;
   var time_request = 1000;
   var ajax_request;
   var argument_dialog = '';
   var materiales_s = [];

   // ------------------------------
   // - Funciones
   // ------------------------------

   function estilo_dialog () {
      $('.footable').footable();
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

   function consulta () {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#ver-tabla-sistemas').data('page-size',10);
               $('#ver-tabla-sistemas tbody').html(data.tr).trigger('footable_redraw'); 
               break;
            case '2': alert_error(data['msj']); break;
         }
      });

   }

   function categoriasSistemas() {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/categoriasSistemas',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1':
               $('#categoria').html(data.optionHTML);
               break;
            case '2':
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

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
                  var selected = $('#proveedor_encontrado').find('tr.b-green-l-i');
                  if (selected != undefined) {
                     $('#proveedor').val(selected.data('nombre')).data('id-proveedor',selected.data('id'));
                     $('#registrar-form').validate().element($('#proveedor'));
                     $('#proveedor-m').val(selected.data('nombre')).data('id-proveedor',selected.data('id'));
                     $('#modificar-form').validate().element($('#proveedor-m'));
                  }
               }
            }
         }
      });
      estilo_dialog();
   }

   function buscar_proveedor () {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/buscar_proveedor',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'busqueda'   : $('input[name=n_proveedor]').val()
         }
      })
      .done(function(data) {
         $('.loading').addClass('fa-search').removeClass('fa-spinner fa-spin');
         switch(data.action) {
            case '1':
               $('.footable tbody').html(data['tr']);
               $('.footable').trigger('footable_redraw');
               break;
            case '2':
               $('.footable tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function asignacion_materiales (argument) {
       bootbox.dialog({
         title: 'Lista de materiales VAC',
         message: 
         '<table class="footable table-sig table-hover table-condensed" data-page-size="5">'+
               '<thead>'+
                  '<tr>'+
                     '<th data-toggle="true">Nombre</th>'+
                     '<th class="text-center">Cantidad</th>'+
                     '<th class="text-center" data-sort-ignore="true">Acción</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody>'+
                  argument+
               '</tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="3">'+
                        '<div class="grid simple" style="margin-top: 10px;">'+
                           '<div class="pagination pagination-centered width-100"></div>'+
                        '</div>'+
                     '</td>'+
                  '</tr>'+
               '</tfoot>'+
            '</table>'
      });
      estilo_dialog();
   }

   function detalles_sistemas (argument) {
       bootbox.dialog({
         title: 'Detalles',
         message: 
         '<table class="footable table-sig table-hover table-condensed" data-page-size="5">'+
               '<thead>'+
                  '<tr>'+
                     '<th data-toggle="true">Nombre</th>'+
                     '<th>Cantidad</th>'+
                     '<th>Máxima</th>'+
                     '<th>Mínima</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody>'+
                  argument+
               '</tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="4">'+
                        '<div class="grid simple" style="margin-top: 10px;">'+
                           '<div class="pagination pagination-centered width-100"></div>'+
                        '</div>'+
                     '</td>'+
                  '</tr>'+
               '</tfoot>'+
            '</table>'
      });
      estilo_dialog();
   }

   function get_sis_materiales (id_sistema) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/get_sis_materiales',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_sistema' : id_sistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': detalles_sistemas(data['tr']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   }

   function getMaterialesVac (id_sistema) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/getSisMaterialesTotal',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_sistema' : id_sistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': asignacion_materiales(data['tr']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
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

   function sistema_update () {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/update',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'     : $('input[name=csrf_token]').val(),
            'nombre'         : $('#nombre-m').val(),
            'old_name'     : $('#nombre-m').data('old_name'),
            'categoria'      : $('#categoria-m').val(),
            'idProveedor'    : $('#proveedor-m').data('id-proveedor'),
            'materiales'     : materiales_s,
            'materiales_old' : materiales_s_old,
            'idSistema_Material' : id_tmp
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

   function sistema_insert () {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/insert',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'     : $('input[name=csrf_token]').val(),
            'nombre'         : $('#nombre').val(),
            'categoria' : $('#categoria').val(),
            'idProveedor'    : $('#proveedor').data('id-proveedor'),
            'materiales'     : materiales_s
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

   function tab_modificar (id_sistema) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/sistema_por_id',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_sistema' : id_sistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#nombre-m').val(data.nombre).data('old_name',data.nombre);
               $('#categoria-m').select2('destroy').html(data.optionCategorias).select2().select2('val',data.idCategoria);
               $('#proveedor-m').val(data.nombreProveedor).data('id-proveedor',data.idProveedor);
               $('#materiales-m').val(data.nombreMateriales);
               materiales_s = data.materiales;
               materiales_s_old = data.materiales;
               id_tmp = data.idSistema;
               $('.tab-modificar').removeClass('no-display');
               $('#modificar').tab('show');
               $('.tab-pane').removeClass('active');
               $('#tab-modificar').addClass('active');
               break;
            case '2':
               alert_error(data['msj']); break;
         }
      });
   }

   function asignarMaterial (idMaterial,idSistema) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/asignarMaterialSistema',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'     : $.cookie('csrf_cookie'),
            'idMaterial_Osteosintesis' : idMaterial,
            'idsistema_material' : idSistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               bootbox.hideAll();
               getMaterialesVac(idSistema);
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function removerMaterial (idMaterial,idSistema) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/removerMaterialSistema',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'     : $.cookie('csrf_cookie'),
            'idMaterial_Osteosintesis' : idMaterial,
            'idsistema_material' : idSistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               bootbox.hideAll();
               getMaterialesVac(idSistema);
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function cambiarEstado (idSistema,estado) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/cambiarEstado',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token'     : $.cookie('csrf_cookie'),
            'idSistema_Material' : idSistema,
            'status' : estado
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               alert_success(); consulta(); 
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function revisarEnUso (idSistema,action) {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/revisarEnUso',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token'     : $.cookie('csrf_cookie'),
            'idSistema_Material' : idSistema
         }
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               switch(action) {
                  case 'modificar': tab_modificar(idSistema); break;
                  case 'asignacion-materiales': getMaterialesVac(idSistema);
               }
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('.select2').on('change',function() {
      $('#registrar-form').validate().element($(this)); 
   });

   $('body').on('click', '.acciones',function(event) {
      var data = $(this).data('id-accion');
      if (data == 'modificar') {
         if ($(this).parents('tr').data('status') == '0') {
            revisarEnUso($(this).parents('tr').data('id-sistema'),data);
         }
         else {
            alert_error({msj:'Solo es posible asignar/mover materiales cuando el sistema esta inactivo'});
         }
      }
      else if (data == 'eliminar') {
         cambiarEstado($(this).parents('tr').data('id-sistema'),'0');
      }
      else if (data == 'activar') {
         cambiarEstado($(this).parents('tr').data('id-sistema'),'1');
      }
      else if (data == 'asignacion-materiales') {
         if ($(this).parents('tr').data('status') == '0') {
            revisarEnUso($(this).parents('tr').data('id-sistema'),data);
         }
         else {
            alert_error({msj:'Solo es posible asignar/mover materiales cuando el sistema esta inactivo'});
         }
      }
      else if(data == 'agregar-material') {
         var idMaterial = $(this).parents('tr').data('id-material');
         var idSistema = $(this).parents('tr').data('id-sistema');
         asignarMaterial(idMaterial,idSistema);
      }
      else if(data == 'quitar-material') {
         var idMaterial = $(this).parents('tr').data('id-material');
         var idSistema = $(this).parents('tr').data('id-sistema');
         removerMaterial(idMaterial,idSistema);
      }
   });

   $('#registrar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         sistema_insert();
      }
      return false;
   });

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         sistema_update();
      }
      return false;
   });

   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('modificar-form');
      tab_modificar(id_tmp);
   });

   $('input[name=proveedor], input[name=materiales]').on('focusin', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
   });

   $('input[name=proveedor], input[name=materiales]').on('focusout', function(event) {
      event.preventDefault();
      $(this).prop('disabled', false);
   });

   $('#ver-tabla-sistemas').on('click', '.detalles', function(event) {
      event.preventDefault();
      get_sis_materiales($(this).parent('tr').data('id-sistema'));
   });

   $('body').on('click','#total_materiales tr',function(){
      var tr = $(this);
      var id_material = tr.data('id-material');
      if (id_material != undefined) {
         if (tr.hasClass('b-green-l-i')) {
            tr.removeClass('b-green-l-i');
         }
         else {
            tr.addClass('b-green-l-i');
         }
      }  
   });

   $('body').on('click','#proveedor_encontrado tr',function(){
      var tr = $(this);
      var id_proveedor = tr.data('id');
      if (id_proveedor != undefined) {
         $('#proveedor_encontrado tr').removeClass('b-green-l-i');
         tr.addClass('b-green-l-i');
      }  
   });

   $('body').on('keyup', 'input[name=n_proveedor]', function(event) {
      event.preventDefault();
      clearTimeout(ajax_request);
      $('.loading').removeClass('fa-search').addClass('fa-spinner fa-spin');
      ajax_request = setTimeout(buscar_proveedor,time_request);
   });

   $('#buscar-materiales,#buscar-materiales-m').on('click', function() {
      $.ajax({
         url: base_url+'configuracion/sistema_osteo/get_materiales',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               bootbox.dialog({
                  title: 'Materiales',
                  message: 
                  '<div>'+
                     '<table data-page-size="5" id="total_materiales" class="footable table-sig table-hover table-condensed">'+
                        '<thead>'+
                           '<tr>'+
                              '<th>Nombre</th>'+
                           '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                           data.tr+  
                        '</tbody>'+
                        '<tfoot>'+
                           '<tr>'+
                              '<td colspan="1">'+
                                 '<div class="grid simple" style="margin-top: 10px;">'+
                                    '<div class="pagination pagination-centered width-100"></div>'+
                                 '</div>'+
                              '</td>'+
                           '</tr>'+
                        '</tfoot>'+
                     '</table>'+
                  '</div>',
                  buttons: {
                     success: {
                        label     : 'Aceptar',
                        className : 'btn btn-primary b-green-i',
                        callback  : function(result) {
                           materiales_s = [];
                           var texto = '';
                           $('#total_materiales tbody tr').each(function(index, val) {
                              if ($(this).hasClass('b-green-l-i')) {
                                 texto = texto + $.trim($(this).text())+' - ';
                                 materiales_s.push($(this).data('id-material'));
                              }
                           });
                           $('#materiales').val(texto);
                           $('#registrar-form').validate().element($('#materiales'));
                           $('#materiales-m').val(texto);
                           $('#modificar-form').validate().element($('#materiales'));
                        }
                     }
                  }
               });
               estilo_dialog();
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   });

   $('#buscar-proveedor,#buscar-proveedor-m').on('click', function() {
      dialog({
         'titulo'     : 'Proveedores',
         'buscar'     : 'Proveedor',
         'name_input' : 'n_proveedor',
         'id'         : 'proveedor_encontrado',
         'pre_tabla'  : 
            '<table class="footable table-sig table-hover table-condensed">'+
               '<thead>'+
                  '<tr>'+
                     '<th class="text-center">Nombre</th>'+
                     '<th>Correo</th>'+
                     '<th>Teléfono</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody></tbody>'+
            '</table>'
      });
      $('.footable').trigger('footable_redraw');
   });

   $('#tab-sistemas a').on('click',function(){
      var a = $(this);
      if (a.attr('id') != 'modificar') {
         clear_form('registrar-form');
         clear_form('modificar-form');
         $('.tab-modificar').addClass('no-display');
         if (a.attr('id') == 'consultar') {
            consulta();
         }
         else {
            categoriasSistemas();
         }
         a.tab('show');
         $('.tab-pane').removeClass('active');
         $('#tab-'+a.attr('id')).addClass('active');
      }
   });

   // ------------------------------
   // - init
   // ------------------------------

   var v_m = $('#modificar-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         nombre: { required: true },
         categoria: { required: true },
         proveedor: { required: true },
         materiales: { required: true}
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
         nombre: { required: true },
         categoria: { required: true },
         proveedor: { required: true },
         materiales: { required: true }
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