<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: 20px">
            <ul class="breadcrumb">
                <li><a >Inicio</a></li>
                <li><a href="#" class="back-history1">Central de Servicios</a></li>
                <li><a href="#">Asignar tratamiento</a></li>
            </ul>
        </div>
        <div class="col-md-6 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Asignar tratamiento</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="programar-tratamiento">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Seleccionar tratamiento</label>
                                        <select class="md-input select2 " multiple="" id="programacion_tratamiento" name="programacion_tratamiento">
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="programacion_id" id="programacion_id" value="<?=$_GET['p']?>">
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>