$('document').ready(function() {

	// ------------------------------
   // - Variables
   // ------------------------------
   
   var quiro_disponible = 0;
   var hr_inicio        = 0;
   var hr_final         = 0;
   var id_quiro         = 0;
   var id_cirugia       = 0;
   var fecha_quiro = '';

   // ------------------------------
   // - Funciones
   // ------------------------------

   function reportar_consumo (argument) {
   	$.ajax({
   		url: base_url+'osteosintesis/quirofano/ver_reportar_consumo',
   		type: 'post',
   		dataType: 'json',
   		data: {
   			'csrf_token' : $.cookie('csrf_cookie'),
   		},
   	})
   	.done(function(data) {
   		switch(data['action']) {
   			case '1': 
   				$('#reportar-consumo tbody').html(data['tr']);
   				$('#reportar-consumo').trigger('footable_redraw');
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
   		url: base_url+'osteosintesis/quirofano/ver_por_asignar',
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
   				$('#ver-tabla-quirofano').trigger('footable_redraw');
   				break;
   			case '2': 
   				alert_error(data['msj']);
   				break;
   			case '3': expired_crf(); break;
   		}
   	});
   }

   function asignado (argument) {
   	$.ajax({
   		url: base_url+'osteosintesis/quirofano/ver_asignados',
   		type: 'post',
   		dataType: 'json',
   		data: {
   			'csrf_token' : $.cookie('csrf_cookie'),
   		},
   	})
   	.done(function(data) {
   		switch(data['action']) {
   			case '1': 
   				$('#ver-tabla-quirofano tbody').html(data['tr']);
   				$('#ver-tabla-quirofano').trigger('footable_redraw');
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

   function asignar_quirofano (argument) {
   	bootbox.dialog({
         title: 'Asignar quirófano',
         message: 
         '<div class="grid simple">'+
				'<form action="" method="post" accept-charset="utf-8">'+
					'<label class="form-label">Fecha</label>'+
					'<div class="input-group date" id="fecha">'+
                    '<input id="datepicker-input-quirofano" type="text" class="form-control" />'+
                    '<span class="input-group-addon">'+
                        '<span class="glyphicon glyphicon-calendar"></span>'+
                    '</span>'+
                '</div>'+
               '<label class="form-label">Hora inicio</label>'+
               '<input type="text" id="hora_inicio" class="time">'+
               '<label class="form-label">Hora final</label>'+
					'<input type="text" id="hora_final" class="time">'+
               '<label class="form-label">Quirófano</label>'+
            	'<select class="select2 width-100" name="" id="quiros"></select>'+
				'</form>'+
         '</div>',
         buttons: {
            success: {
               label     : 'Asignar',
               className : 'btn btn-primary b-green-i',
               callback  : function(result) {
                  hr_inicio, 
                  hr_final = 0;
                  $.ajax({
                     url: base_url+'osteosintesis/quirofano/por_asignar_insert',
                     type: 'post',
                     dataType: 'json',
                     data: {
                        'csrf_token' : $.cookie('csrf_cookie'),
                        'hr_inicio'  : $('#hora_inicio').val(),
                        'hr_final'   : $('#hora_final').val(),
                        'fecha'      : fecha_quiro,
                        'id_cirugia' : id_cirugia,
                        'id_quiro'   : $('#quiros').val()
                     },
                  })
                  .done(function(data) {
                     switch(data['action']) {
                        case '1': 
                           alert_success();
                           setTimeout(function(){ location.reload(); }, 3000);
                           break;
                        case '2': alert_error(data['msj']); break;
                        case '3': expired_crf(); break;
                     }
                  });
               }
            }
         }
      });

      $('#datepicker-input-quirofano').datepicker({
         format: 'yyyy/mm/dd',
         startView: 1,
         autoclose: true,
         todayHighlight: true
      })
      .on('changeDate', function(event) {
         fecha_quiro = getFormattedDate($(this).datepicker('getDate'));
         ver_fechas_quiro(fecha_quiro);
      });

      $('#hora_inicio, #hora_final').timepicker({
         'timeFormat': 'H:i' 
      }); 
   	$('.select2').select2();
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

   function ver_fechas_quiro (date) {
      $.ajax({
         url: base_url+'osteosintesis/quirofano/ver_fechas_quiro',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'fecha' : date,
            // 'hora_inicio' : $('#hora_inicio').data('date'),
            // 'hora_final' : $('#hora_final').data('date'),
            // 'id_cirugia' : $('#fecha').data('date'),
         },
      })
      .done(function(data) {
         switch(data['action']){
            case '1': 
               $("#quiros").select2("destroy");
               $('#quiros').html(data['html']);
               $("#quiros").select2({
                  placeholder : 'Seleccionar'
               });
               quiro_disponible = parseInt(data['dispo']);
               break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function ver_horarios (argument) {
      $.ajax({
         url: base_url+'osteosintesis/quirofano/ver_horarios',
         type: 'post',
         dataType: 'json',
         data: {
           'csrf_token' : $.cookie('csrf_cookie'),
           'hr_inicio' : hr_inicio,
           'hr_final' : hr_final
         },
      })
      .done(function(data) {
         switch(data['action']){
            case '1': break;
            case '2': alert_error(data['msj']); 
               $('#hora_inicio').data('DateTimePicker').clear();
               $('#hora_final').data('DateTimePicker').clear();
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function consumo (id) {
      $.ajax({
         url: base_url+'osteosintesis/quirofano/get_consumo',
         type: 'post',
         dataType: 'json',
         data: {
            'id_cirugia' : id,
            'csrf_token' : $.cookie('csrf_cookie')
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':
               bootbox.dialog({
                  title: 'Materiales de la cirugía',
                  message: '<table id="consumo_cirug" class="footable">'+
                        '<thead>'+
                           '</tr>'+
                              '<th data-sort-ignore="true" class="text-center" >Nombre</th>'+
                              '<th data-sort-ignore="true" >Cantidad</th>'+
                              '<th data-sort-ignore="true" >Consumo</th>'+
                           '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                           data['tr']+
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
                     '</table>',
                  buttons: {
                     success: {
                        label     : 'Reportar',
                        className : 'btn btn-primary b-green-i',
                        callback  : function(result) {
                           // var valid = true;
                           $('#consumo_cirug tbody tr').each(function(index, el) {
                              var val = $(this).find('input[name=consumo]').val();
                              
                              // if (valid) {
                              //    var checked = $(this).find('input[name=consumo]').length;
                              //    if (checked == 1) {
                              //       var id_m = $(this).find('.elementos_sis').data('id_m');
                              //       var cantidad = $(this).find('.elementos_sis').val();
                              //       if (element_id == 'material') {
                              //          elementos_mat.push([id_m,cantidad]);
                              //       } 
                              //       else{
                              //          elementos_instru.push([id_m,cantidad]);
                              //       }
                              //    }
                              // }
                           });
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
               $('#consumo_cirug').footable();
               break;    
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   // ------------------------------
   // - Eventos
   // ------------------------------
   
   // $('body').on('changeTime','#hora_inicio',function() {
   //    hr_inicio = $(this).val();
   //    if (hr_inicio != 0 && hr_final != 0 && quiro_disponible == 0) {
   //       ver_horarios();
   //    }
   // });

   // $('body').on('changeTime','#hora_final',function() {
   //    hora_final = $(this).val();
   //    if (hr_inicio != 0 && hr_final != 0 && quiro_disponible == 0) {
   //       ver_horarios();
   //    }
   // });

   // $('body').on('dp.hide','#hora_inicio',function (e) {
   //    hr_inicio = $(this).data('date');
   //    // $('#hora_final').data('DateTimePicker').setMinDate(e.date);
   //    if (hr_inicio != 0 && hr_final != 0 && quiro_disponible == 0) {
   //       ver_horarios();
   //    }
   // });

   // $('body').on('dp.hide','#hora_final',function (e) {
   //    hr_final = $(this).data('date');
   //    // $('#hora_inicio').data('DateTimePicker').setMaxDate(e.date);
   //    if (hr_inicio != 0 && hr_final != 0 && quiro_disponible == 0) {
   //       ver_horarios();
   //    }
   // });

   $('#reportar-consumo').on('click','.acciones',function(){
      consumo($(this).parents('tr').data('no-cirugia'));
   });

   // $('body').on('dp.hide','#fecha',function () {
   //    ver_fechas_quiro();
   // });

   $('#ver-tabla-por-asignar').on('click', '.acciones', function(event) {
   	event.preventDefault();
   	var accion = $(this).data('id-accion');
   	var id_quiro = $(this).parent('tr').data('no-cirugia');
      id_cirugia = $(this).parent('tr').data('no-cirugia');
   	switch(accion) {
   		case 'asignar': 
   			asignar_quirofano(id_quiro);
   			break;
   	}
   });

   $('#ver-tabla-quirofano, #ver-tabla-por-asignar, #reportar-consumo').on('click','.detalles',function(event) {
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
      case 'reportar_consumo': reportar_consumo(); break;
   }

});