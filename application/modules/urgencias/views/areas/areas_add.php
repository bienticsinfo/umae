<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered">
            <?php if($_GET['a']=='add'){
             $accion='Nueva Área';   
            }else{
                $accion='Editar Área';
            }
            ?>
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Áreas</a></li>
                    <li><a href="#"><?=$accion?></a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><?=$accion?></span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="agregar-area">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Área</label>
                                        <input class="md-input" name="area_nombre" required="" value="<?=$info[0]['area_nombre']?>">   
                                    </div>
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Cuenta con Camas</label><br>
                                        <label class="md-check">
                                            <input type="radio" name="area_camas" value="Si" class="has-value" checked=""><i class="indigo"></i>Si
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="area_camas" value="No" class="has-value area_camas-no"><i class="indigo"></i>NO
                                        </label>
                                    </div>
                                </div>  

                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="area_registro" class="input-fecha-actual">
                                    <input type="hidden" name="area_camas_radio" value="<?=$info[0]['area_camas']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="area_id" value="<?=$_GET['ar']?>">
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