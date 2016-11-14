<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>UMAE</title>
        <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="<?=  base_url()?>assets/libs/assets/animate.css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/material-design-icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-fileinput/css/fileinput.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/location-sel.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="<?=  base_url()?>assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/libs/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/html5imageupload/demo.html5imageupload.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <link href="<?=  base_url()?>assets/styles/font.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/app.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/styles/style.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/img/imss.png" rel="icon" type="image/png">

    </head>
    <body>
    <div class="app">
        <div class=" bg-big">
            <div class="box-row" style="width: 90%;margin: auto;margin-top: 50px">
                <div class="box-cell">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default ">
                                
                                <div class="panel-body b-b b-light">
                                    <div class="row">
                                        <div class="col-md-12 last_lista_no">
                                            <table class="table m-b-none consultoriosespecialidad_last_lista">
                                                <tbody>
                                                    <tr class=""></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?=  base_url()?>assets/img/ser-imss.jpg" style="width: 100%">
                                        </div>
                                        <div class="col-md-6">
                                            <h1 class="text-center table-pacientes-especialidad-no hide" style="margin-top: calc(25%)">NO HAY LISTA DE PACIENTES </h1>
                                            <table class="table m-b-none table-hover table-pacientes-especialidad" style="margin-top: 0px" ui-jp="footable" data-limit-navigation="4" data-filter="#filter" data-page-size="10">
                                                <tbody></tbody>
                                                <tfoot class="hide-if-no-paging">
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <ul class="pagination"></ul>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>                          
                                </div>

                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>var base_url = "<?= base_url(); ?>"</script>
        <script src="https://code.jquery.com/jquery-2.1.4.js" type="text/javascript"></script>
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
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.10/backbone-min.js"></script>
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
        <script src="<?=  base_url()?>assets/js/bootbox.min.js"></script>
        <script src="<?=  base_url()?>assets/libs/md5.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        <script src="<?=  base_url()?>assets/js/mensajes_conservacion.js" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/inicio_conservacion.js" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/os/urgencias/listas_ce.js" type="text/javascript"></script> 
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
            setTimeout(function() {
                $('.footable').footable({
                    breakpoints: {
                        tablet: 768
                    },
                    pageNavigationSize: 2
                });
            }, 1000);
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
