<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>UMAE</title>
        <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/assets/animate.css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/assets/font-awesome/css/font-awesome.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/styles/material-design-icons.css" type="text/css" />
        <link href="<?=  base_url()?>assets/img/imss.png" rel="icon" type="image/png">
        <link rel="stylesheet" href="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/styles/font.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="<?=  base_url()?>assets/styles/style.css" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?=  base_url()?>assets/libs/jquery-notifications/css/location-sel.css" rel="stylesheet" type="text/css" media="screen"/>
    </head>
    <body >
        <div class="app">
            <div class="center-block w-xxl w-auto-xs p-v-md">
                <div class="navbar">
                    <div class=" m-t-lg text-center">
                        <img src="<?=  base_url()?>assets/img/imss.png" style="width: 30%">
                    </div>
                </div>
                <div class="p-lg panel md-whiteframe-z1 text-color m">
                    
                    <form name="form" class="login-form row-login">
                        <div class="md-form-group float-label">
                            <input type="text" name="empleado_area" class="md-input" id="txtusername">
                            <label>Area</label>
                        </div>
                        <div class="md-form-group float-label">
                            <input type="text" name="empleado_matricula" autocomplete="off"  class="md-input" required>
                            <label>Matricula</label>
                        </div>      
                        <div class="m-b-md">        
                            <label class="md-check">
                                <input type="checkbox" checked=""><i class="indigo "></i> Recordarme
                            </label>
                        </div>
                        <button md-ink-ripple type="submit" class="md-btn md-raised pink btn-block p-h-md back-imss">Accesar</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
        <script>var base_url='<?=  base_url()?>';</script>
        <script src="<?=  base_url()?>assets/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery/waves/dist/waves.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.10/backbone-min.js"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/demo.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/messenger-theme-future.js" type="text/javascript"></script>	
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/location-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/libs/jquery-notifications/js/demo/theme-sel.js" type="text/javascript" ></script>
        <script src="<?=  base_url()?>assets/scripts/ui-load.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.config.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-nav.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-toggle.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-form.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-client.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?=  base_url()?>assets/js/loginV2.js"></script>
    </body>
</html>
