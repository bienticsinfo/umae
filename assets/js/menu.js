$('document').ready(function(){
	
	// ------------------------------
   // - Variables
   // ------------------------------

	var m_menu = $('#main-menu');
   var backgrounds = {
      1 : 'backgroundContainer.jpg',
      2 : 'linea.jpg'
   }

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

   function info_usuario() {
   	var resultado = ajax('post',base_url+'menu/info_usuario',true,{'csrf_token':$.cookie('csrf_cookie')},'json');
   	resultado.success(function(data){
   		switch(data['action']){
   			case '1':
   				$('.ap-paterno').text(data['apellido_p']);
   				$('.nom-usuario').text(data['nombre']);
   				break;
   			case '2':
               
   				// alert_error(data['msj']);
   				break;
   		}
   	});
   }

   function background() {
      setInterval(function() {
         var number = 1 + Math.floor(Math.random()*length_obj(backgrounds));
         $('.content').css({
            'background-image'  : 'url("'+base_url+'assets/img/backgrounds/'+backgrounds[number]+'")',
            'background-repeat' : 'no-repeat',
            'background-size'   : 'contain'
         });
      },2000);
   }

   function length_obj(obj) {
      var l = 0;
      $.each(obj, function(i,elem) {
         l++;
      });
      return l;
   }

	// ------------------------------
   // - Eventos
   // ------------------------------

   $('.chat-toggler').on('click', '.notification-messages', function(event) {
      event.preventDefault();
      var url = $(this).data('url');
      if (url) {
         window.location.replace(url);
      };
   });

	// ------------------------------
   // - Init
   // ------------------------------

   info_usuario();
   //background();
	m_menu.find('.scroll-x').css('display','none');

});