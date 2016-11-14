  $('document').ready(function() {

   // ------------------------------
   // - Variables
   // ------------------------------
   
   var cantMaxMaterial = '';
   var cantMinMaterial = '';
   var idSistemaDetalles = '';

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

   function ver_a_revision (mensaje) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/ver_a_revision',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-a-revision tbody').html(data['tr']);
               $('#ver-tabla-a-revision').trigger('footable_redraw');
               break;
            case '2': 
               if (mensaje) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-a-revision tbody').empty();
               $('#ver-tabla-a-revision').trigger('footable_redraw');
               break;
            case '3': expired_crf(); break;
         }
      });
   }

    function detalles_material (data) {
      bootbox.dialog({
         title: 'Detalles materiales',
         message: 
         '<table id="'+data['id_tabla']+'" class="width-100 footable" data-page-size="5">'+
               '<thead>'+
                  data['thead']+
               '</thead>'+
               '<tbody>'+
                  data['tbody']+
               '</tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="5">'+
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

   function detalles_material_nuevo (data) {
      bootbox.dialog({
         size : 'large',
         className: 'test',
         title: 'Detalles materiales',
         message: 
         '<table id="'+data['id_tabla']+'" class="width-100 footable" data-page-size="5">'+
               '<thead>'+
                  data['thead']+
               '</thead>'+
               '<tbody>'+
                  data['tbody']+
               '</tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="6">'+
                        '<div class="grid simple" style="margin-top: 10px;">'+
                           '<div class="pagination pagination-centered width-100"></div>'+
                        '</div>'+
                     '</td>'+
                  '</tr>'+
               '</tfoot>'+
            '</table>',
         buttons: {
            success: {
               label     : 'Aceptar',
               className : 'btn btn-primary b-green-i',
               callback  : function(result) {
                  var idMaterial = $('#id-tabla-nuevo').find('tbody tr').data('id-mat-osteo');
                  var cantidad = $('#id-tabla-nuevo').find('tbody tr input').val();
                  if (cantidad != '') {
                     updateMateriales({
                        idMaterial : idMaterial,
                        cantidad: cantidad
                     });
                     return false;
                  };
               }
            }
         }
      });
      estilo_dialog();
   }

   function updateMateriales (info) {
      $.ajax({
         url: base_url + 'clinica_heridas/almacen_osteo/updateMateriales',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            idMaterial_Osteosintesis : info['idMaterial'],
            cantidad : info['cantidad'],
            cantMaxMaterial : cantMaxMaterial,
            cantMinMaterial: cantMinMaterial 
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#id-tabla-nuevo').parents('.bootbox').modal('hide');
               $('#id-tabla-detalles').parents('.bootbox').modal('hide');
               ver_detalles_material(idSistemaDetalles);
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   }

   function detalles_sistemas (argument) {
       bootbox.dialog({
         title: 'Detalles',
         message: 
         '<table class="width-100 footable" data-page-size="5">'+
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
      estilo_dialog();
   }

   function get_sis_archivo (id_cirugia) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/detalles_archivo',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_cirugia' : id_cirugia
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': detalles_sistemas(data['tr']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   }

   function get_sis (id_cirugia,tipo) {
      $.ajax({
         url: base_url+'clinica_heridas/hospitalizacion/sis_elementos',
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

   function agregar_entrega (id_cirugia) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/get_id_usuario',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':  
               bootbox.dialog({
                  title: 'Agregar entrega',
                  message: 
                     '<div class="grid simple" style="margin:0;">'+
                        '<div class="grid-body no-border b-gray width-100">'+
                           '<form action="" id="agregar-entrega">'+
                              '<div class="form-group" style="margin-top:20px;">'+
                                 '<label class="form-label">Entrega:</label>'+
                                 '<div class="controls input-with-icon right input-group" style="width:64%;">'+
                                    '<i class="exclamation-4"></i>'+
                                    '<input data-id-entrega="'+data['id_usuario']+'" id="usuario-entrega" value="'+data['nombre']+'" type="text" class="form-control">'+
                                 '</div>'+
                              '</div>'+
                              '<div class="form-group" style="margin-top:20px;">'+
                                 '<label class="form-label">Recibe</label>'+
                                 '<div class="controls input-with-icon right input-group" style="width:64%;">'+
                                    '<i class="exclamation-3"></i>'+
                                    '<input id="usuario-ceye" type="text" class="form-control">'+
                                    '<span class="buscar-empleado input-group-addon primary pointer b-green-i bor-green-i">'+   
                                       '<span class="arrow arrow-m c-green-i b-green-i"></span>'+
                                       '<i class="fa fa-plus-square fa-white"></i>'+
                                    '</span>'+
                                 '</div>'+
                              '</div>'+
                           '</form>'+
                        '</div>'+
                     '</div>',
                  buttons: {
                     success: {
                        label: 'Aceptar',
                        className: "btn btn-primary b-green-i",
                        callback: function () {
                           $.ajax({
                              url: base_url+'clinica_heridas/almacen_osteo/por_entregar_ci',
                              type: 'post',
                              dataType: 'json',
                              data: {
                                 'csrf_token' : $.cookie('csrf_cookie'),
                                 'idCirugia'  : id_cirugia,
                                 'entrega'    : $('#usuario-entrega').data('id-entrega'),
                                 'recibe'     : $('#usuario-ceye').data('id-recibe')
                              }
                           })
                           .done(function(data) {
                              switch(data['action']) {
                                 case '1': ver_por_entregar(false); break;
                                 case '2': alert_error(data['msj']); break;
                                 case '3': expired_crf(); break;
                              }
                           });
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
   }

   function continuar (id_cirugia,funcion_ci) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/'+funcion_ci,
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia'  : id_cirugia
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               switch(funcion_ci) {
                  case 'a_revision': ver_a_revision(false); break;
                  case 'enviarPorEntregar': ver_sin_existencia(false); break;
               }
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      });
   }

   function detener (id_cirugia,funcion_ci) {
       $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/'+funcion_ci,
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia'  : id_cirugia
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               switch(funcion_ci) {
                  case 'cancelar_a_revision': 
                     ver_a_revision(false);
                     alert_success(data['msj']);
                     break;
               }
               break;
            case '2': alert_error(data['msj']); break;
            case '3': alert_error(data['msj']); break;
         }
      });
   }

   function ver_por_entregar (mensaje) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/ver_por_entregar',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-por-entregar tbody').html(data['tr']);
               $('#ver-tabla-por-entregar').trigger('footable_redraw');
               break;
            case '2': 
               if (mensaje) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-por-entregar tbody').empty();
               $('#ver-tabla-por-entregar').trigger('footable_redraw');
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function ver_sin_existencia (mensaje) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/ver_sin_existencia',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-sin-existencia tbody').html(data['tr']);
               $('#ver-tabla-sin-existencia').trigger('footable_redraw');
               break;
            case '2': 
               if (mensaje) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-sin-existencia tbody').empty();
               $('#ver-tabla-sin-existencia').trigger('footable_redraw');
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function ver_archivo (mensaje) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/ver_archivo',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-archivo tbody').html(data['tr']);
               $('#ver-tabla-archivo').trigger('footable_redraw');
               break;
            case '2': 
               if (mensaje) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-archivo tbody').empty();
               $('#ver-tabla-archivo').trigger('footable_redraw');
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function gestion_procesos (mensaje) {
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/ver_gestion_procesos',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-gestion-i tbody').html(data['tr']);
               $('#ver-tabla-gestion-i').trigger('footable_redraw');
               break;
            case '2': 
               if (mensaje) {
                  alert_error(data['msj']);
               }
               $('#ver-tabla-gestion-i tbody').empty();
               $('#ver-tabla-gestion-i').trigger('footable_redraw');
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function ver_detalles_material (id_sistema) {
      idSistemaDetalles = id_sistema;
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/detalles_material_g',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'      : $.cookie('csrf_cookie'),
            'id_sis_material' : id_sistema
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':
               detalles_material({
                  thead : 
                     '</tr>'+
                        '<th data-toggle="true" class="text-center">Material</th>'+
                        '<th>Cantidad actual</th>'+
                        '<th>Máxima</th>'+
                        '<th>Mínima</th>'+
                        '<th data-sort-ignore="true" class="text-center">Agregar</th>'+
                     '</tr>',
                  tbody : data['tr'],
                  id_tabla : 'id-tabla-detalles'
               });
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   function material_nuevo (datos) {
      cantMaxMaterial = datos['cantMax'];
      cantMinMaterial = datos['cantMin'];
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/consultar_materiales',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'   : $.cookie('csrf_cookie'),
            'id_material'  : datos['idMatOsteo'],
            'id_proveedor' : datos['idProveedor']
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':
               detalles_material_nuevo({
                  thead : 
                     '<tr>'+
                        '<th data-toggle="true" class="text-center">Sistema</th>'+
                        '<th>Material</th>'+
                        '<th>Proveedor</th>'+
                        '<th>Contrato</th>'+
                        '<th>Cantidad</th>'+
                        '<th data-sort-ignore="true" class="text-center">Nuevo</th>'+
                     '</tr>',
                  tbody : data['tr'],
                  id_tabla : 'id-tabla-nuevo'
               });
               break;
            case '2': alert_error(data['msj']); break;
         }
      });
   }

   // ------------------------------
   // - Eventos
   // ------------------------------
   
   $('body').on('click', '#id-tabla-detalles .acciones', function(event) {
      event.preventDefault();
      // material_nuevo($(this).parents('tr').data('id-mat-osteo'),$(this).parents('tr').data('id-proveedor'));
      material_nuevo({
         idMatOsteo : $(this).parents('tr').data('id-mat-osteo'),
         idProveedor : $(this).parents('tr').data('id-proveedor'),
         cantMax : $(this).parents('tr').data('max'),
         cantMin : $(this).parents('tr').data('min')
      });
   });

   $('#ver-tabla-gestion-i').on('click', '.detalles', function(event) {
      event.preventDefault();
      ver_detalles_material($(this).parent('tr').data('id-sistema'));
   });

   $('body').on('click', '#empleados-ceye td', function(event) {
      event.preventDefault();
      $('#empleados-ceye').find('tr').removeClass('b-green-l-i')
      $(this).parent('tr:not(.no-bg)').addClass('b-green-l-i');
   });

   $('body').on('click', '.buscar-empleado', function(event) {
      event.preventDefault();
      $.ajax({
         url: base_url+'clinica_heridas/almacen_osteo/empleado_ceye',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               bootbox.dialog({
                  title: 'Recibe:',
                  message: 
                     '<div>'+
                        '<table id="empleados-ceye" class="footable width-100" data-page-size="10">'+
                           '<thead>'+
                              '<tr>'+
                                 '<th class="text-center" data-toggle="true">Matrícula</th>'+
                                 '<th>Nombre</th>'+
                                 '<th>Paterno</th>'+
                                 '<th>Departamento</th>'+
                              '</tr>'+
                           '</thead>'+
                           '<tbody>'+data['tr']+'</tbody>'+
                           '<tfoot>'+
                              '<tr class="no-bg">'+
                                 '<td colspan="4">'+
                                    '<div class="grid simple" style="margin-top: 25px;">'+
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
                           $('#empleados-ceye tbody tr').each(function(index, el) {
                              var tr = $(this);
                              if (tr.hasClass('b-green-l-i')) {
                                 $('#usuario-ceye').val(tr.data('nombre')).data('id-recibe',tr.data('id-usuario'));
                                 return false;
                              }
                           });
                        }
                     }
                  }
               });
               estilo_dialog();
               // $('.modal-header').addClass('b-green-b-i');
               // $('.modal-title').css({
               //    'color'      : 'white',
               //    'text-align' : 'left'
               // });
               // $('.close').css({
               //    'color'     : 'white',
               //    'font-size' : 'x-large'
               // });
               // $('.footable').trigger('footable_redraw');
               break;
            case '2': break;
         }
      });
   });

   $('body').on('focusin','#usuario-ceye, #usuario-entrega', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
   });

   $('body').on('focusout','#usuario-ceye, #usuario-entrega', function(event) {
      event.preventDefault();
      $(this).prop('disabled', false);
   });

   $('#ver-tabla-archivo').on('click', '.detalles', function(event) {
      event.preventDefault();
      get_sis_archivo($(this).parent('tr').data('no-cirugia'),$(this).data('sis'));
   });

   $('#ver-tabla-gestion-i').on('click', '.detalles', function(event) {
      event.preventDefault();
      
   });

   $('#ver-tabla-a-revision, #ver-tabla-por-entregar, #ver-tabla-sin-existencia').on('click','.detalles',function(event) {
      event.preventDefault();
      get_sis($(this).parent('tr').data('no-cirugia'),$(this).data('sis'));
   });

   $('#ver-tabla-a-revision').on('click', '.acciones', function(event) {
      event.preventDefault();
      var accion = $(this).data('id-accion');
      var id = $(this).parents('tr').data('no-cirugia');
      switch(accion) {
         case 'continuar' : continuar(id,'a_revision'); break;
         case 'detener'   : detener(id,'cancelar_a_revision'); break;
      }
   });

   $('#ver-tabla-sin-existencia').on('click', '.acciones', function(event) {
      event.preventDefault();
      var accion = $(this).data('id-accion');
      var id = $(this).parents('tr').data('no-cirugia');
      switch(accion) {
         case 'continuar' : continuar(id,'enviarPorEntregar'); break;
      }
   });

   $('#ver-tabla-por-entregar').on('click', '.acciones', function(event) {
      event.preventDefault();
      var accion = $(this).data('id-accion');
      var id = $(this).parents('tr').data('no-cirugia');
      switch(accion) {
         case 'continuar' : agregar_entrega(id); break;
         case 'detener'   : detener(id,'cancelar_por_entregar'); break;
      }
   });

   // ------------------------------
   // - Init
   // ------------------------------

   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'revision'           : ver_a_revision(true); break;
      case 'sin_existencia'     : ver_sin_existencia(true); break;
      case 'por_entregar'       : ver_por_entregar(true); break;
      case 'archivo'            : ver_archivo(true); break;
      case 'gestion_inventario' : gestion_procesos(true); break;
   }

});
