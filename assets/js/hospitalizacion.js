   var elementos_instru = [];
   var elementos_mat = [];
   var elements_m = [];
   var elements_i = [];
$('document').ready(function(){

   // ------------------------------
   // - Variables
   // ------------------------------

   var time_request = 1000;
   var ajax_request;
   var argument_dialog = '';
   var elementos_selected = 0; 
   var editarCirugia = false;
   var idCirugia = '';
   var idTipo_CirugiaOld = '';
   var infoCirugia = '';
   var redrawDerecho = false;

   // ------------------------------
   // - Funciones
   // ------------------------------
   
   function ajax(tipo,url,sync,datos,datatype){
      return $.ajax({
         type     : tipo,
         url      : url,
         async    : sync,
         data     : datos,
         dataType : datatype
      });
   }

   function ver_cirugias(arguments) {
      var obj = {'csrf_token' : $.cookie('csrf_cookie')};
      var resultado = ajax('post',base_url+'osteosintesis/hospitalizacion/ver_cirugia',true,obj,'json');
      resultado.success(function(data){
         switch(data['action']) {
            case '1':
               // $('#ver-tabla-cirugias tbody').html(data['cirugias']).trigger('footable_redraw');
               $('#ver-tabla-cirugias tbody').html(data['cirugias']);
               break;
            case '2':
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function elementos_cirugia() {
      var obj = {'csrf_token' : $.cookie('csrf_cookie')};
      var resultado = ajax('post',base_url+'osteosintesis/hospitalizacion/elementos_cirugia',true,obj,'json');
      resultado.success(function(data){
         switch(data['action']) {
            case '1':
               $('#tipo-cirugia').html(data['cirugias']);
               break;
            case '2':
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function medico_tratante(arguments) {
      var obj = {
         'buscar'  : $('input[name=matricula]').val(),
         'csrf_token' : $.cookie('csrf_cookie')
      };
      var resultado = ajax('post',base_url+'osteosintesis/hospitalizacion/medico_tratante',true,obj,'json');
      resultado.success(function(data){
         $('.loading').addClass('fa-search').removeClass('fa-spinner fa-spin');
         switch(data['action']) {
            case '1':
               $('.table-responsive tbody').html(data['html_tbody']).trigger('footable_redraw');
               break;
            case '2':
               $('.table-responsive tbody').empty();
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function derechohabiente() {
      var obj = {
         'nss'        : $('input[name=nss]').val(),
         'csrf_token' : $.cookie('csrf_cookie')
      };
      var resultado = ajax('post',base_url+'osteosintesis/hospitalizacion/derechohabiente',true,obj,'json');
      resultado.success(function(data){
         $('.loading').addClass('fa-search').removeClass('fa-spinner fa-spin');
         switch(data['action']) {
            case '1':
               $('.footable tbody').html(data['html_tbody'])
               if (redrawDerecho) {
                  $('.footable').data('page-size',5);
                  $('.footable').trigger('footable_initialize')
                     .trigger('footable_redraw')
                     .trigger('footable_resize');
               }
               else{
                  $('.footable').footable();
                  redrawDerecho = true;
               }
               break;
            case '2':
               $('.table-responsive tbody').empty();
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
                  switch(argument_dialog){
                     case 'derechohabiente':
                        var selected = $('#dh_encontrado').find('tr.b-green-l-i');
                        if (selected != undefined) {
                           $('#derechohabiente').val(selected.data('nombre')).data('id-derechohabiente',selected.data('id-derecho'));
                           $('#p-cirugia-form').validate().element($('#derechohabiente'));
                        }
                        break;
                     case 'medico_tratante':
                        var selected = $('#medic_encontrado').find('tr.b-green-l-i');
                        if (selected != undefined) {
                           $('#medico-tratante').val(selected.data('nombre')).data('matricula',selected.data('matricula'));
                           $('#p-cirugia-form').validate().element($('#medico-tratante'));
                        }
                        break;
                  }
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

   function cambiar_tab(data) {
      elementos_cirugia();
      $('#'+data['accion']+'-a').tab('show').addClass('active');
      if (data['accion'] == 'estado') {
         $.ajax({
            url: base_url+'osteosintesis/hospitalizacion/estados_cirugia',
            type: 'post',
            dataType: 'json',
            data: {
               'csrf_token' : $.cookie('csrf_cookie'),
               'id_cirugia' : data['id_cirugia']
            }
         })
         .done(function(data) {
            switch(data['action']){
               case '1': 
                  $('#estados-cirugia').html(data['msj']);
                  break;
               case '2': 
                  alert_error(data['msj']);
                  break;
               case '3': expired_crf(); break;
            }
         })
      }
      else if (data['accion'] == 'modificar') {
         getInfoCirugía(data);
      }
   }

   function getInfoCirugía (data) {
      infoCirugia = data;
      editarCirugia = true;
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/ver_cirugia_editar',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_cirugia' : data['id_cirugia']
         }
      })
      .done(function(data) {
         switch(data['action']){
            case '1': 
               idCirugia = data['cirugia']['idCirugia'];
               $('#derechohabiente').val(data['cirugia']['nombreCompletoDerHabiente']);
               $('#derechohabiente').data('id-derechohabiente',data['cirugia']['idDerechohabiente']);
               $('#medico-tratante').val(data['cirugia']['nombreCompletoEmpleado']);
               $('#tipo-cirugia').select2().select2('val',data['cirugia']['idTipo_Cirugia']);
               idTipo_CirugiaOld = data['cirugia']['idTipo_Cirugia'];
               var materiales = [];
               elementos_mat = [];
               elementos_instru = [];
               sis_materiales = [];
               sis_instrumentales = [];
               for (var i = 0; i < data['cirugia']['sistemasMatElementos'].length; i++) {
                  materiales.push(data['cirugia']['sistemasMatElementos'][i]['idSistema']);
                  elementos_mat.push([
                     data['cirugia']['sistemasMatElementos'][i]['idMaterial_Osteosintesis'],
                     data['cirugia']['sistemasMatElementos'][i]['cantidad'],
                     data['cirugia']['sistemasMatElementos'][i]['idSistema']+'_sis'
                  ]);
                  sis_materiales.push(data['cirugia']['sistemasMatElementos'][i]['idSistema']);
               }
               get_sistemas_m(data['cirugia']['idTipo_Cirugia'],materiales,'materiales');
               var instrumentales = [];
               for (var i = 0; i < data['cirugia']['sistemasInstruElementos'].length; i++) {
                  instrumentales.push(data['cirugia']['sistemasInstruElementos'][i]['idSistema']);
                  elementos_instru.push([
                     data['cirugia']['sistemasInstruElementos'][i]['idInstrumental_Quirurgico'],
                     data['cirugia']['sistemasInstruElementos'][i]['cantidad'],
                     data['cirugia']['sistemasInstruElementos'][i]['idSistema']+'_sis'
                  ]);
                  sis_instrumentales.push(data['cirugia']['sistemasInstruElementos'][i]['idSistema']);
               }
               get_sistemas_m(data['cirugia']['idTipo_Cirugia'],instrumentales,'instrumentales');
               break;
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function insert_cirugia(arguments) {
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/insert_cirugia',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token'         : $.cookie('csrf_cookie'),
            'id_Tipocirugia'     : $('#tipo-cirugia').val(),
            'id_derechohabiente' : $('#derechohabiente').data('id-derechohabiente'),
            'sis_materiales'     : $('#material').val(),
            'sis_instrumentales' : $('#i-quirurgico').val(),
            'elementos_mat'      : elementos_mat,
            'elementos_instru'   : elementos_instru
         },
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': 
               alert_success();
               break;
            case '2':
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function editar_cirugia() {
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/editar_cirugia',
         type: 'post',
         dataType: 'json',
         data: {
            'idCirugia'         : idCirugia,
            'csrf_token'         : $.cookie('csrf_cookie'),
            'idTipo_Cirugia'     : $('#tipo-cirugia').val(),
            'idDerechohabiente' : $('#derechohabiente').data('id-derechohabiente'),
            'sis_materiales'     : $('#material').val(),
            'sis_instrumentales' : $('#i-quirurgico').val(),
            'elementos_mat'      : elementos_mat,
            'elementos_instru'   : elementos_instru,
            'idTipo_CirugiaOld' : idTipo_CirugiaOld
         },
      })
      .done(function(data) {
         editarCirugia = false;
         switch(data['action']) {
            case '1': 
               alert_success();
               $('#estados-cirugia').empty();
               $('#modificar-a').addClass('no-display');
               $('#estado-a').addClass('no-display');
               ver_cirugias();
               $('#ver-a').tab('show');
               break;
            case '2':
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function sistemas_mq (id,element_id) {
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/get_materiales_sis',
         type: 'post',
         dataType: 'json',
         data: {
            'id_sis'     : id,
            'csrf_token' : $.cookie('csrf_cookie'),
            'tabla'      : element_id
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':
               bootbox.dialog({
                  title: 'Materiales',
                  message: '<table id="mat_sistema" class="footable" data-page-size="10">'+
                        '<thead>'+
                           '<tr>'+
                              '<th data-sort-ignore="true" class="text-center">Selección</th>'+
                              '<th data-sort-ignore="true" class="text-center" >Nombre</th>'+
                              '<th data-sort-ignore="true" >Disponibles</th>'+
                              '<th data-sort-ignore="true" >Cantidad</th>'+
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
                        label     : 'Seleccionar',
                        className : 'btn btn-primary b-green-i',
                        callback  : function(result) {
                           var valid = true;
                           $('#mat_sistema tbody tr').each(function(index, el) {
                              if (valid) {
                                 var checked = $(this).find('input:checked').length;
                                 if (checked == 1) {
                                    var id_m = $(this).find('.elementos_sis').data('id_m');
                                    var cantidad = $(this).find('.elementos_sis').val();
                                    if (element_id == 'material') {
                                       elementos_mat.push([id_m,cantidad,id+'_sis']);
                                    } 
                                    else{
                                       elementos_instru.push([id_m,cantidad,id+'_sis']);
                                    }
                                 }
                              }
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
               $('.footable').footable();
               break;    
            case '2': 
               alert_error(data['msj']);
               break;
            case '3': expired_crf(); break;
         }
      });
   }

   function get_sistemas_m (id_cirugia,selectionArray,select) {
      $.ajax({
         url: base_url+'osteosintesis/hospitalizacion/sistemas',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'id_cirugia': id_cirugia
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1':
               if (selectionArray != undefined && select == 'materiales') {
                  $('#material').html(data['html_material']).select2(); 
                  $("#material").val(selectionArray).select2();
                  elements_m = $("#material").val();
               }
               else if (selectionArray != undefined && select == 'instrumentales') {
                  $('#i-quirurgico').html(data['html_instru']).select2();
                  $("#i-quirurgico").val(selectionArray).select2();
                  elements_i = $('#i-quirurgico').val();
               }
               else if (selectionArray == undefined) {
                  $('#material').html(data['html_material']).select2(); 
                  $('#i-quirurgico').html(data['html_instru']).select2();
                  $('#p-cirugia-form').validate().element($('#material'));
                  $('#p-cirugia-form').validate().element($('#i-quirurgico'));
                  elementos_mat = []; elements_m = [];
                  elementos_instru = []; elements_i = [];
               }
               break;
            case '2': alert_error(data['msj']); break;
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

   function comprobar_cantidad (element) {
      var total = element.parents('tr').find('.total').data('total');
      var cantidad = element.val();
      if (parseInt(cantidad) > parseInt(total)) {
         element.attr({
            placeholder: 'Insuficientes materiales'
         });
         element.val('');
         return false;
      }
      return true;
   }

   function eliminarCirugia (cirugia) {
      $.ajax({
         url: base_url + 'osteosintesis/hospitalizacion/eliminarCirugia',
         type: 'post',
         dataType: 'json',
         data: {
            'csrf_token' : $.cookie('csrf_cookie'),
            'idCirugia' : cirugia['id_cirugia']
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': ver_cirugias(); break;
            case '2': alert_error(data['msj']); break;
            case '3': expired_crf(); break;
         }
      })
   }

   function doEsperar () {
      doAccion('esperar')
   }

   function doCambiar () {
      doAccion('cambiar')
   }

   function doAccion (accion) {
      $.ajax({
         url: base_url + 'osteosintesis/hospitalizacion/doAccion',
         type: 'POST',
         dataType: 'json',
         data: {
            csrf_token : $.cookie('csrf_cookie'),
            accion: accion,
            idCirugia : idCirugia
         }
      })
      .done(function(data) {
         switch(data['action']) {
            case '1': ver_cirugias(); break;
            case '2': alert_error(data['msj']); break;
            case 'esperar': alert_success('Se ha enviado una notificación al almacén') ;
         }
      });
   }

   function modalAccion (data) {
      idCirugia = data['id_cirugia'];
      bootbox.dialog({
         message: 'La cirugía está en estado de sin existencia de materiales ¿Qué desea hacer?',
         title: 'Mensaje',
         buttons: {
            esperar: {
               label: 'Esperar a proveedor',
               className: 'btn btn btn-primary b-green-i',
               callback: doEsperar
            },
            cambiarMateriales: {
               label: 'Cambiar materiales',
               className: 'btn btn btn-primary b-green-i',
               callback: doCambiar
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

   // ------------------------------
   // - Eventos
   // ------------------------------
   
   $('input[name=derechohabiente], input[name=medico_tratante]').on('focusin', function(event) {
      event.preventDefault();
      $(this).prop('disabled', true);
   });

   $('input[name=derechohabiente], input[name=medico_tratante]').on('focusout', function(event) {
      event.preventDefault();
      $(this).prop('disabled', false);
   });

   $('#derechohabiente').on('click', function(event) {
      $('#buscar-dh').click();
   });

   $('#medico-tratante').on('click', function(event) {
      event.preventDefault();
      $('#buscar-medico').click();
   });

   $('#ver-a').on('click',function(){
      $('#estados-cirugia').empty();
      $('#modificar-a').addClass('no-display');
      $('#estado-a').addClass('no-display');
      ver_cirugias();
      // window.location.replace(base_url + 'osteosintesis/hospitalizacion/gestionar_cirugia');
   });

   $('body').on('change','.elementos_sis',function(event) {
      event.preventDefault();
      // comprobar_cantidad($(this))
   });

   $('#ver-tabla-cirugias').on('click','.detalles',function(event) {
      event.preventDefault();
      get_sis($(this).parent('tr').data('no-cirugia'),$(this).data('sis'));
   });

   $('#tipo-cirugia').on('change', function(event) {
      event.preventDefault();
      if ($(this).val() != '') {
         get_sistemas_m($(this).val());
      }
      else {
         $('#material, #i-quirurgico').select2('val','All');
         $('#p-cirugia-form').validate().element($('#material'));
         $('#p-cirugia-form').validate().element($('#i-quirurgico'));
      }
   });
   
   $('#material, #i-quirurgico').on('change', function(event) {
      event.preventDefault();
      var select = $(this);
      if (select.val() != null) {
         switch(select.attr('id')) {
            case 'material':
               if (select.val().length > elements_m.length) {
                  var nuevos = select.val();
                  for (var i = 0; i < nuevos.length; i++) {
                     if ($.inArray(nuevos[i],elements_m) == -1) {
                        sistemas_mq(nuevos[i],select.attr('id'));
                     }  
                  }
                  elements_m = nuevos;
               } 
               else{
                  var restantes = select.val();
                  for (var i = 0; i < elements_m.length; i++) {
                     if ($.inArray(elements_m[i],restantes) == -1) {
                        var buscar = elements_m[i]+'_sis';
                        var values = $.grep(elementos_mat, function (element) { return element[2] == buscar });
                        elementos_mat = $.grep(elementos_mat, function(value) {
                            return $.inArray(value, values) == -1;
                        });
                     }
                  }
                  elements_m = restantes;
               }
               break;
            case 'i-quirurgico': 
                if (select.val().length > elements_i.length) {
                  var nuevos = select.val();
                  for (var i = 0; i < nuevos.length; i++) {
                     if ($.inArray(nuevos[i],elements_i) == -1) {
                        sistemas_mq(nuevos[i],select.attr('id'));
                     }  
                  }
                  elements_i = nuevos;
               } 
               else{
                  var restantes = select.val();
                  for (var i = 0; i < elements_i.length; i++) {
                     if ($.inArray(elements_i[i],restantes) == -1) {
                        var buscar = elements_i[i]+'_sis';
                        var values = $.grep(elementos_instru, function (element) { return element[2] == buscar });
                        elementos_instru = $.grep(elementos_instru, function(value) {
                            return $.inArray(value, values) == -1;
                        });
                     }
                  }
                  elements_i = restantes;
               }
               break;
         }
      } 
      else {
         switch(select.attr('id')) {
            case 'material': elementos_mat = []; elements_m = []; break;
            case 'i-quirurgico': elementos_instru = []; elements_i = []; break;
         }
      }
   });

   $('body').on('click','#medic_encontrado tr',function(){
      var tr = $(this);
      var nss = tr.data('matricula');
      if (nss != undefined) {
         $('#medic_encontrado tr').removeClass('b-green-l-i');
         tr.addClass('b-green-l-i');
      }  
   });

   $('body').on('click','#dh_encontrado tr',function(){
      var tr = $(this);
      var nss = tr.data('nss');
      if (nss != undefined) {
         $('#dh_encontrado tr').removeClass('b-green-l-i');
         tr.addClass('b-green-l-i');
      }  
   });

   $('body').on('keyup','input[name=matricula]',function(){
      clearTimeout(ajax_request);
      $('.loading').removeClass('fa-search').addClass('fa-spinner fa-spin');
      ajax_request = setTimeout(medico_tratante,time_request);
   });

   $('body').on('keyup','input[name=nss]',function(){
      clearTimeout(ajax_request);
      $('.loading').removeClass('fa-search').addClass('fa-spinner fa-spin');
      ajax_request = setTimeout(derechohabiente,time_request);
   });

   $('#ver-tabla-cirugias').on('click','.acciones',function(){
      var data = {
         'accion'     : $(this).data('id-accion'),
         'id_cirugia' : $(this).parents('tr').data('no-cirugia')
      };
      if (data['accion'] == 'modificar' || data['accion'] == 'estado') {
         $('#'+data['accion']+'-a').removeClass('no-display');
         cambiar_tab(data);
      } 
      else if(data['accion'] == 'eliminar') {
         bootbox.confirm({ 
             size: 'small',
             message: 'La cirugía programada se dará de baja ¿Desea continuar?', 
             callback: function(result){ 
               if (result) {
                  eliminarCirugia(data);
               }
            }
         }) 
      }
      else if(data['accion'] == 'accion-esperar') {
         modalAccion(data);
      }
   });

   $('#gestion-cirugia a').on('click',function (e) {
      e.preventDefault();
      if ($(this).attr('href') == '#ver') {
         $(this).tab('show');
      }
   });

   $('#buscar-dh').on('click',function(){
      argument_dialog = 'derechohabiente';
      dialog({
         'titulo'     : 'Derechohabiente',
         'buscar'     : '',
         'name_input' : 'nss',
         'id'         : 'dh_encontrado',
         'pre_tabla'  : 
            '<table class="footable table-sig table-hover table-condensed" data-page-size="5">'+
               '<thead>'+
                  '<tr>'+
                     '<th data-toggle="true" >NSS</th>'+
                     '<th>Nombre</th>'+
                     '<th>Paterno</th>'+
                     '<th>Materno</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody></tbody>'+
               '<tfoot>'+
                  '<tr>'+
                     '<td colspan="4">'+
                        '<div class="grid simple" style="margin-top: 25px;">'+
                           '<div class="pagination pagination-centered width-100"></div>'+
                        '</div>'+
                     '</td>'+
                  '</tr>'+
               '</tfoot>'+
            '</table>'
      });
      $('.table-responsive').trigger('footable_redraw');
   });

    $('#buscar-medico').on('click',function(){
      argument_dialog = 'medico_tratante';
      dialog({
         'titulo'     : 'Médico tratante',
         'buscar'     : 'Matrícula',
         'name_input' : 'matricula',
         'id'        : 'medic_encontrado',
         'pre_tabla'  :
            '<table class="table-responsive width-100">'+
               '<thead>'+
                  '<tr>'+
                     '<th>Matrícula</th>'+
                     '<th>Nombre</th>'+
                     '<th>Paterno</th>'+
                     '<th>Materno</th>'+
                  '</tr>'+
               '</thead>'+
               '<tbody></tbody>'+
            '</table>'
      });
      $('.table-responsive').trigger('footable_redraw');
   });

   $('#cancelar').on('click',function(){
      var id_form = $(this).parents('form').attr('id');
      clear_form(id_form);
      elementos_mat = []; elements_m = [];
      elementos_instru = []; elements_i = [];
      elementos_cirugia();
      getInfoCirugía(infoCirugia);
   });

   $('#p-cirugia-form').on('submit',function(e){
      e.preventDefault();
      var form = $(this);
      if (form.valid() == true) {
         if (editarCirugia) {
            editar_cirugia();
         } 
         else {
            insert_cirugia();
         } 
      }
   });

   var v = $('#p-cirugia-form').validate({
      errorElement: 'span', 
      errorClass: 'error', 
      focusInvalid: false, 
      ignore: "",
      rules: {
         derechohabiente: {
            required: true
         },
         medico_tratante: {
            required: true
         },
         tipo_cirugia: {
            required: true
         },
         material: {
            required: true
         },
         i_quirurgico: {
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

   $('.select2',"#p-cirugia-form").on('change',function(){
      $('#p-cirugia-form').validate().element($(this)); 
   });

   // ------------------------------
   // - Init
   // ------------------------------

   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'programar_cirugia': elementos_cirugia(); break;
      case 'gestionar_cirugia':  break;
   }
   
});