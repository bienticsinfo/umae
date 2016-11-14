$(document).ready(function() { 

   function getNotificacionesAjax () {
      doPace = false;
      $.ajax({
         url: base_url + 'inicio/notificaciones/getNotificacionesAjax',
         dataType: 'json'
      })
      .done(function(data) {
         $('.cbp_tmtimeline').html(data);
      });
   }

   function setNotificaciones (notificaciones) {
      $('#notification-list .contain-list').html(notificaciones);
      $('#my-task-list').attr('data-content',$('#notification-list').html());
      var popover = $('#my-task-list').data('bs.popover');
      popover.setContent();
      popover.$tip.addClass(popover.options.placement);
   }

   function getAlertNotificaciones () {
      doPace = false;
      $.ajax({
         url: base_url + 'inicio/notificaciones/getAlertNotificacionesAjax',
         dataType: 'json'
      })
      .done(function(data) {
         switch(data.action){
            case '1':
               if (data.total != '0') {
                  $('.alert-not').text(data.total).removeClass('no-display');
                  getNotificacionesAjax();
               }
               else {
                  $('.alert-not').text('0').addClass('no-display');  
               }
               setNotificaciones(data.notificaciones);
               break;
         }
      });
   }

   $('.page-content').on('mouseenter','.mensaje-notificacion', function(event) {
      event.preventDefault();
      if ($(this).data('visto') == '0') {
         setVisto($(this).attr('id'));
      }
   });

   function waypoint () {
      $('.mensaje-notificacion').waypoint(function(e) {
         var elemento = $(this);
         if (elemento[0]['element']['dataset']['visto'] == '0') {
            setVisto(elemento[0]['element']['id']);
         }
      });
   }

   function setVisto (id) {
      doPace = false;
      $.ajax({
         url: base_url + 'inicio/notificaciones/setVistoNotificacion',
         type: 'POST',
         dataType: 'json',
         data: {
            csrf_token : $.cookie('csrf_cookie'),
            id : id
         }
      })
      .done(function(data) {
      })
   }

   setInterval(getAlertNotificaciones,10000);
   setInterval(getNotificacionesAjax,1000*60*10);

   waypoint();
         
   var pathArray = window.location.pathname.split('/');
   var path = pathArray.length - 1;
   switch(pathArray[path]) {
      case 'notificaciones':  break;
   }

});   