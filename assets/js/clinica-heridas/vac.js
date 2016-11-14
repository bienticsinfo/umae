$('document').ready(function(){

   // ------------------------------
   // - Variables
   // ------------------------------
   
   var idTratamiendo = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------

   function info_detallada(arguments) {
      bootbox.dialog({
         title: arguments['titulo'],
         message: 
         '<div class="form-group">'+
            '<label class="form-label">Área</label>'+
            '<div class="controls">'+
               '<select id="area" name="area" class="select2">'+
                  '<option value="">Seleccionar</option>'+
                  '<option value="1">Área 1</option>'+
                  '<option value="2">Área 1</option>'+
                  '<option value="2">Área 1</option>'+
               '</select>'+
            '</div>'+
         '</div>'+
         '<div class="grid simple" style="margin:0;">'+
            '<div class="row">'+
               '<div class="col-md-8">'+
                  '<div style="margin:0; padding:0; height:156px;">'+
                     '<select name="elementos" id="elementos" multiple style="width:100%; height:100% !important; overflow:overlay;">'+
                        '<option value="1">Valor 1</option>'+
                        '<option value="2">Valor 2</option>'+
                        '<option value="3">Valor 3</option>'+
                        '<option value="4">Valor 4</option>'+
                        '<option value="5">Valor 5</option>'+
                     '</select>'+
                  '</div>'+
               '</div>'+
               '<div class="col-md-4" style="height:156px;">'+
                  '<div class="b-white width-100 height-100"></div>'+
               '</div>'+
            '</div>'+
         '</div>',
         buttons: {
            success: {
               label: 'Aceptar',
               className: "btn btn-primary b-green-i",
               callback: function () {
                  
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
      $('#'+arguments['id_busqueda']).select2();
      $('.select2-container').addClass('width-100');
   }

   function asignado (modal) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/ver_asignados',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-asignado tbody').html(data['tr']);
               break;
            case '2': 
               if (modal) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-asignado tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
         $('#ver-tabla-asignado').trigger('footable_redraw');
      });
   }

   function devolucion (modal) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/ver_devolucion',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-devolucion tbody').html(data['tr']);
               break;
            case '2': 
               if (modal) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-devolucion tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
         $('#ver-tabla-devolucion').trigger('footable_redraw');
      });
   }

   function entregado (modal) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/ver_entregado',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-entregado tbody').html(data['tr']);
               break;
            case '2': 
               if (modal) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-entregado tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
         $('#ver-tabla-entregado').trigger('footable_redraw');
      });
   }

   function por_entregar (modal) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/ver_por_asignar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-por-asignar tbody').html(data['tr']);
               break;
            case '2': 
               if (modal) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-por-asignar').trigger('footable_redraw');
               $('#ver-tabla-por-asignar tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function detalles_sistemas (argument) {
       bootbox.dialog({
         title: 'Detalles',
         message: 
         '<table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">'+
               '<thead>'+
                  '</tr>'+
                     '<th data-toggle="true">Nombre</th>'+
                     '<th>Cantidad</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody>'+
                  argument+
               '</tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="2">'+
                        '<div class="grid simple" style="margin-top: 10px;">'+
                           '<div class="pagination pagination-centered width-100"></div>'+
                        '</div>'+
                     '</td>'+
                  '</tr>'+
               '</tfoot>'+
            '</table>'
      });
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

   function get_sis (id_cirugia,tipo) {
      $.ajax({
         url: base_url+'materiales_consumo/hospitalizacion/sis_elementos',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_cirugia' : id_cirugia,
            'tipo'       : tipo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': detalles_sistemas(data['tr_html']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doAsignar (idTratamiendo) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doAsignar',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': por_asignar(false); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doEntregar (idTratamiendo) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doEntregado',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               alert_success(data['msj']);
               por_entregar(false); 
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doTotal () {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doTotal',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               entregado(false)
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doParcial () {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doParcial',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               entregado(false)
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doDevolucion (idTrata) {
      idTratamiendo = idTrata;
      bootbox.dialog({
         message: 'Por favor selecciona el tipo de consumo',
         title: 'Mensaje',
         buttons: {
            parcial: {
               label: 'Parcial',
               className: 'btn btn btn-primary b-green-i',
               callback: doParcial
            },
            total: {
               label: 'Total',
               className: 'btn btn btn-primary b-green-i',
               callback: doTotal
            }
         }
      });
      $('.modal-body .bootbox-body').css('font-size','larger');
      $('.modal-content').css('border-radius','0');
      $('.modal-header').addClass('b-green-b-i');
      $('.modal-title').css({
         'color': 'white',
         'text-align': 'left'
      });
      $('.close').css({
         'color'     : 'white',
         'font-size' : 'x-large'
      });
   }

   function enviarDevolver (idTratamiendo,cantidadTotal,cantidadDevolver,idMaterial) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/enviarDevolver',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo,
            'cantidad' : cantidadTotal,
            'cantidadDevolver' : cantidadDevolver,
            'idMaterial_Osteosintesis' : idMaterial
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               devolucion(false);
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function revisarMaterial (idTratamiendo,result) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/revisarMaterial',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo,
            'codigo_barra' : result
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': alert_success(data['msj']); $('.bootbox-prompt').find('input').val('');  break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doGetCodigo (idTratamiendo) {
      bootbox.prompt('Código: (Con espacios)', function(result) {                
         if (result !== null) {                                             
            if (result != '') {
               revisarMaterial(idTratamiendo,result);
               return false;
            }
            else {
               return false;
            }                             
         } 
      });
      $('.modal-body .bootbox-body').css('font-size','larger');
      $('.modal-content').css('border-radius','0');
      $('.modal-header').addClass('b-green-b-i');
      $('.modal-title').css({
         'color': 'white',
         'text-align': 'left'
      });
      $('.close').css({
         'color'     : 'white',
         'font-size' : 'x-large'
      });
   }

   function doDevolver (idTratamiendo,cantidadTotal,material,idMaterial) {
      bootbox.prompt('Por favor escribe la cantidad sobrante de '+material, function(result) {                
         if (result !== null) {                                             
            if (result != '') {
               enviarDevolver(idTratamiendo,cantidadTotal,result,idMaterial);
            }
            else {
               return false;
            }                             
         }
         bootbox.hideAll();
         getMaterialesDevolver(idTratamiendo);
      });
      // $('.modal-body .bootbox-body').css('font-size','larger');
      $('.modal-content').css('border-radius','0');
      $('.modal-header').addClass('b-green-b-i');
      $('.modal-title').css({
         'color': 'white',
         'text-align': 'left'
      });
      $('.close').css({
         'color'     : 'white',
         'font-size' : 'x-large'
      });
   }

   function doReajustar () {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doReajustar',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               por_entregar(false);
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doCancelarTratamiento () {
      $.ajax({
         url: base_url+'materiales_consumo/vac/doCancelar',
         type: 'POST',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : idTratamiendo
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               por_entregar(false);
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doCancelar (idTrata) {
      idTratamiendo = idTrata;
      bootbox.dialog({
         message: 'Los materiales no coinciden, ¿Qué desea hacer?',
         title: 'Mensaje',
         buttons: {
            rejaustar: {
               label: 'Reajustar',
               className: 'btn btn btn-primary b-green-i',
               callback: doReajustar
            },
            cancelar: {
               label: 'Cancelar tratamiento',
               className: 'btn btn btn-primary b-green-i',
               callback: doCancelarTratamiento
            }
         }
      });
      $('.modal-body .bootbox-body').css('font-size','larger');
      $('.modal-content').css('border-radius','0');
      $('.modal-header').addClass('b-green-b-i');
      $('.modal-title').css({
         'color': 'white',
         'text-align': 'left'
      });
      $('.close').css({
         'color'     : 'white',
         'font-size' : 'x-large'
      });
   }

   function getMaterialesDevolver (idTratamiento) {
      $.ajax({
         url: base_url+'materiales_consumo/vac/getSisMaterialesTotal',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idTratamiento' : idTratamiento
         },
      })
      .done(function(data) {
         switch(data.action) {
            case '1': materialesEnDevolucion(data['tr']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   }

   function materialesEnDevolucion (tbody) {
      bootbox.dialog({
         title: 'Lista de materiales VAC',
         message: 
         '<table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">'+
               '<thead>'+
                  '</tr>'+
                     '<th data-toggle="true">Nombre</th>'+
                     '<th class="text-center">Cantidad</th>'+
                     '<th class="text-center" data-sort-ignore="true">Sistema</th>'+
                     '<th data-sort-ignore="true">Devolver</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody>'+
                  tbody+
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
      $('.modal-content').css('border-radius','0');
      $('.modal-header').addClass('b-green-b-i');
      $('.modal-title').css({
         'color': 'white',
         'text-align': 'left'
      });
      $('.close').css({
         'color'     : 'white',
         'font-size' : 'x-large'
      });
      $('.footable').footable();
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('body').on('click', '.acciones', function(event) {
      event.preventDefault();
      var idTratamiendo = $(this).parents('tr').data('no-cirugia');
      var cantidadTotal = $(this).parents('tr').data('cantidad-total');
      var material = $(this).parents('tr').data('material');
      var idMaterial = $(this).parents('tr').data('id-material');
      switch($(this).data('id-accion')) {
         case 'devolver': doDevolver(idTratamiendo,cantidadTotal,material,idMaterial); break;
      }
   });

   $('#ver-tabla-devolucion').on('click', '.acciones', function(event) {
      event.preventDefault();
      var idTratamiendo = $(this).parents('tr').data('no-cirugia');
      // var cantidadTotal = $(this).parents('tr').data('cantidad-total');
      // var material = $(this).parents('tr').data('material');
      // var idMaterial = $(this).parents('tr').data('id-material');
      switch($(this).data('id-accion')) {
         // case 'devolver': doDevolver(idTratamiendo,cantidadTotal,material,idMaterial);
         case 'ver-materiales': getMaterialesDevolver(idTratamiendo); break;
      }
   });

   $('#ver-tabla-entregado').on('click', '.acciones', function(event) {
      event.preventDefault();
      var idTratamiendo = $(this).parents('tr').data('no-cirugia');
      switch($(this).data('id-accion')) {
         case 'devolucion': doDevolucion(idTratamiendo);
      }
   });

   $('#ver-tabla-por-asignar').on('click', '.acciones', function(event) {
      event.preventDefault();
      var idTratamiendo = $(this).parents('tr').data('no-cirugia');
      switch($(this).data('id-accion')) {
         case 'asignar': doEntregar(idTratamiendo); break;
         case 'cancelar': doCancelar(idTratamiendo); break;
         case 'codigo_barra': doGetCodigo(idTratamiendo); break;
      }
   });

   $('#ver-tabla-asignado, #ver-tabla-por-asignar, #reportar-consumo, #ver-tabla-entregado, #ver-tabla-devolucion').on('click','.detalles',function(event) {
      event.preventDefault();
      get_sis($(this).parent('tr').data('no-cirugia'),$(this).data('sis'));
   });

   // ------------------------------
   // - Init
   // ------------------------------
   
   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'asignado': asignado(); break;
      case 'por_entregar': por_entregar(true); break;
      case 'entregado': entregado(true); break;
      case 'devolucion': devolucion(true); break;
   }

});