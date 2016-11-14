<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: 20px">
            <ul class="breadcrumb">
                <li><a >Inicio</a></li>
                <li><a href="#" class="back-history3">Central de Servicios</a></li>
                <li><a href="#" class="back-history2">Tratamientos</a></li>
                <li><a href="#" class="back-history1">Terapias</a></li>
                <li><a href="#">Agregar Terapia</a></li>
            </ul>
        </div>
        <div class="col-md-6 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Agregar terapia</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="add-terapia">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Nombre de la terapia</label>
                                        <input type="text" class="md-input" name="terapia_nombre" required=""> 
                                    </div>
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Descripción</label>
                                        <textarea class="md-input" rows="4" name="terapia_descripcion"> </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="tratamiento_id" value="<?=$_GET['t']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden">
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