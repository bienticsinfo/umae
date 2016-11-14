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
                    <div class="row row-no-login hide">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <div class="controls text-center">
                                    <br><br>
                                    <h4>Usuario y/o Contraseña incorrectos</h4><br>
                                    <button type="button" style="width:80%;" class="btn btn-info btn-no-login btn-cons back-imss" id="btnAccesar">Accesar</button>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="form" class="login-form row-login">
                        <div class="md-form-group float-label">
                            <input type="text" name="username" class="md-input" id="txtusername" required>
                            <label>Usuario</label>
                        </div>
                        <div class="md-form-group float-label">
                            <input type="password" name="password"  class="md-input" id="txtpassword" required>
                            
                            <label>Matricula</label>
                            <i class="fa fa-eye show-hide-pass tip icono-accion pointer" data-original-title="Mostrar / Ocultar Contraseña" style="margin-top:17px;cursor: pointer;top: 5px;right: 0px;position: absolute;z-index: 1000000"></i>
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
        <script src="<?=  base_url()?>assets/scripts/ui-load.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.config.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-jp.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-nav.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-toggle.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-form.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-waves.js"></script>
        <script src="<?=  base_url()?>assets/scripts/ui-client.js"></script>
        <script src="<?=  base_url()?>assets/js/jquery.cookie.js"></script>
        
        <script src="<?=  base_url()?>assets/js/login.js"></script>
    </body>
</html>
