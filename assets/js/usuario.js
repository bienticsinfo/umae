$('document').ready(function() {
   
   // ------------------------------
   // - Variables
   // ------------------------------
   
   var time_request = 1000;
   var argument_dialog = '';
   var ajax_request;
   var id_tmp = 0;
   var usuario = 0;

   // ------------------------------
   // - Funciones
   // ------------------------------
   $.ajax({
        url: base_url+"configuracion/usuario/get_select",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#idTipo_Usuario').html(data['option_ro']);
            $('#idEmpleado').html(data['option_em']);
            $('#idEquipo').html(data['option_eq']);
            $('#idTipo_Usuario').val($('#jtf_idTipo_Usuario').val()).select2();
            $('#idEmpleado').val($('#jtf_IdEmpleado').val()).select2();
            $('#idEquipo').val($('#jtf_idEquipo').val()).select2();
        },error: function (jqXHR, textStatus, errorThrown) {
            
        }
   })
   var accion=$('#jtf_accion').val();
   if(accion=='edit'){
       $('#usuario').attr('readonly',true)
       $('.msj-pass').html('Sin modificar');
       $('#contrasena,#r-contrasena').removeAttr('required')
   }
   function consulta (argument) {
      $.ajax({
         url: base_url+'configuracion/usuario/consulta',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action) {
            case '1': 
               $('#ver-tabla-usuario tbody').html(data['usuarios'])
                  .footable({
                     breakpoints: {
                        tablet: 768
                     }
                  })
                  .trigger('footable_initialize')
                  .trigger('footable_redraw')
                  .trigger('footable_resize');
               break;
            case '2': 
                alert_error(data['msj']);
                break;
         }
      });
   }

   $('#registrar-user').submit(function(event) {
        event.preventDefault();
        if($('#contrasena').val()==$('#r-contrasena').val()){
            $.ajax({
                url: base_url+'configuracion/usuario/insert',
                type: 'POST',
                dataType: 'json',
                data:$('#registrar-user').serialize(),
                success: function (data, textStatus, jqXHR) { 
                    switch(data['accion']) {
                        case '1': 
                            msj_success_noti('Registro guardado correctamente')
                            location.href=base_url+'configuracion/usuario/index';
                            break;
                        case '2': 
                            msj_error_noti(data['msj']);
                            break;
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR)
                }
            })       
        }else{
            msj_error_noti('Lac contraseñas escritas no coinciden')
        }
    });
   $('body').on('click','.acciones',function (){
       var el=$(this).attr('data-id');
        if($(this).attr('data-id-accion')=='modificar'){
            location.href=base_url+'configuracion/usuario/agregar?a=edit&u='+$(this).attr('data-id');
        }else{
            if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
                $.ajax({
                    url: base_url+'configuracion/usuario/eliminar',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'csrf_token' : $('body input[name=csrf_token]').val(),
                        'id_usuario' : el
                    },beforeSend: function (xhr) {
                        msj_success_noti('Eliminando registro...');
                    },success: function (data, textStatus, jqXHR) {
                         switch(data['accion']) {
                            case '1': 
                                msj_success_noti('Registro eliminado...'); 
                                $('#'+el).remove();
                               break;
                            case '2': msj_error_noti(data['msj']); break;
                         }
                    },error: function (e) {
                        msj_error_noti('Error'+e);
                        console.log(e)
                    }
                })  
            }
        }
   })
   $('#cancelar').on('click', function(event) {
      event.preventDefault();
      clear_form('registrar-form');
   });

   $('#cancelar-m').on('click', function(event) {
      event.preventDefault();
      clear_form('modificar-form');
      tab_modificar(usuario);
   });

   $('#modificar-form').on('submit', function(event) {
      event.preventDefault();
      if ($(this).valid() == true) {
         update();
      }
      return false;
   });


   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'index': break;
   }

});