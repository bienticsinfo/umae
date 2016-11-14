$('document').ready(function(){
   
   // ------------------------------
   // - Funciones
   // ------------------------------

   // ------------------------------
   // - Variables
   // ------------------------------

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

   function asignado (argument) {
      $.ajax({
         url: base_url+'osteosintesis/ceye/ver_asignados',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-ceye tbody').html(data['tr']);
               $('#ver-tabla-ceye').trigger('footable_redraw');
               break;
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function devolucion (argument) {
      $.ajax({
         url: base_url+'osteosintesis/ceye/ver_devolucion',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               $('#ver-tabla-devolucion tbody').html(data['tr']);
               $('#ver-tabla-devolucion').trigger('footable_redraw');
               break;
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function entregado (argument) {
      $.ajax({
         url: base_url+'osteosintesis/ceye/ver_entregado',
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
               $('#ver-tabla-entregado').trigger('footable_redraw');
               break;
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function por_asignar (argument) {
      $.ajax({
         url: base_url+'osteosintesis/ceye/ver_por_asignar',
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
               $('#ver-tabla-por-asignar').trigger('footable_redraw');
               break;
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function detalles_sistemas (argument) {
       bootbox.dialog({
         title: 'Detalles',
         message: 
         '<table class="table-responsive width-100 footable" data-page-size="5">'+
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
         switch(data['action']) {
            case '1': detalles_sistemas(data['tr_html']); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   // ------------------------------
   // - Eventos
   // ------------------------------

   $('#ver-tabla-ceye, #ver-tabla-por-asignar, #reportar-consumo, #ver-tabla-entregado, #ver-tabla-devolucion').on('click','.detalles',function(event) {
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
      case 'por_asignar': por_asignar(); break;
      case 'entregado': entregado(); break;
      case 'devolucion': devolucion(); break;
   }

});