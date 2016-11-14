<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history2">Áreas</a></li>
                    <li><a href="#" class="back-history1">Perfiles</a></li>
                    <li><a href="#" class="">Nuevo Perfil</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Nuevo Perfil</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="agregar-perfil-area">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Area</label>
                                        <select class="select2 width100" name="area_rol_nombre">
                                            <option value="34;Triage Médico">Triage Médico</option>
                                            <option value="35;Triage Enfermeria">Triage Enfermeria</option>
                                        </select>  
                                    </div>
                                </div>  

                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="empleado_fecha_registro" class="input-fecha-actual">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="area_id" value="<?=$_GET['area']?>">
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
<script src="<?= base_url('assets/js/os/urgencias/areas.js')?>" type="text/javascript"></script>