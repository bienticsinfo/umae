<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered">
            <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Consultorios</a></li>
                    <li><a href="#">Agregar Consultorio</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Agregar Consultorio</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="agregar-consultorio">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Nombre del Consultorio</label>
                                        <input class="md-input" name="consultorio_nombre" required="" value="<?=$info[0]['consultorio_nombre']?>">   
                                    </div>
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Especialidad</label>
                                        <div class="radio">
                                            <label class="ui-checks">
                                                <input type="radio" name="consultorio_especialidad" value="Si"  class="has-value"><i></i>Si
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label class="ui-checks">
                                                <input type="radio" name="consultorio_especialidad" value="No" checked="" class="has-value"><i></i>No
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>  

                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="consultorio_id" value="<?=$_GET['c']?>">
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
<script src="<?= base_url('assets/js/os/urgencias/consultorios.js')?>" type="text/javascript"></script>