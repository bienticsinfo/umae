                </div>
            </div>
        </div>
        <audio id="player" src="<?=  base_url()?>assets/sound/sound.ogg"> </audio>
        <script>var base_url = "<?= base_url(); ?>"</script>
        <script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-load.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.config.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-nav.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-toggle.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-form.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-client.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-fileinput/js/fileinput.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-fileinput/js/fileinput_locale_es.js"></script>
        <script src="<?=  base_url()?>assets/libs/pace/pace.min.js" type="text/javascript"></script>
        
        
        <script src="<?=  base_url()?>assets/libs/underscore-min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/backbone-min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/demo.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger-theme-future.js" type="text/javascript"></script>	
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/location-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/theme-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/html5imageupload/html5imageupload.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-select2/select2.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
        <script src="<?=  base_url()?>assets/libs/footable/footable.all.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/js/bootbox.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/md5.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        <script src="<?=  base_url()?>assets/js/mensajes_conservacion.js" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/inicio_conservacion.js" type="text/javascript"></script> 
	<script type="text/javascript">
        var csrf_token = $.cookie('csrf_cookie');
        
        var doPace = true;
        var allowedTypesImgMateriales = "<?= $this->config->item('allowed_types')['materiales_img'] ?>";
        var redirect_solicitud_consumo = "<?= $this->config->item('nombre_documentos')['solicitud_consumo']['ruta'] ?>";
   	function expired_crf() {
	      bootbox.dialog({
	         message: '<div style="text-align: center; font-size: x-large;">La acción que ha solicitado no está permitida</div>',
	         title: '<i class="fa fa-times-circle fa-7x c-red-l-i"></i>',
	         closeButton: false,
	         buttons: {
	            success: {
	               label: 'Aceptar',
	               className: 'btn btn-primary b-red-l-i',
	               callback: function() {
	               	//window.location.replace(base_url+'login/index'); 
	               }
	            }
	         }
	      });
	      $('.modal-footer').css('text-align','center');
	      $('.modal-content').css('border-radius','0');
   	}
   	Pace.on('done', function(){
            $('.a-pace').removeClass('no-display');
        });
	$('.select2').select2();
	$(document).ajaxStart(function() {
            if ($.cookie('is_logged') == undefined) {
                //window.location.replace(base_url + 'login/index'); 
            }
//            if (doPace) {
//                Pace.restart(); 
//            }
//            doPace = true;
	});
        function getFormattedDate(date) {
            var year = date.getFullYear();
            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;
            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;
            return year + '/' + month + '/' + day;
        }
        $.fn.datepicker.defaults.language = 'es';
        
        function tip (selector) {
             $('body').tooltip({
                selector: selector
             });
        }
        $(document).ready(function() {
            $('.popovers').popover();
            tip('.tip');
     
        });
        function updateFootable (data,selector,pagination) {
            $(selector+' tbody').html(data);
            $(selector).data('page-size',pagination);
            $(selector).trigger('footable_initialize')
                .trigger('footable_redraw')
                .trigger('footable_resize');
        }
    </script>
    </body>
</html>