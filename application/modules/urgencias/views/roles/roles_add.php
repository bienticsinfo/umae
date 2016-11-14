<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-5 col-centered">
            <div class="panel panel-default">
                <div class="panel-heading back-imss">
                    Asignar Médicos a las Áreas
                </div>
                <div class="">
                    <form class="card-heading asignar-empleado-area">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Médico</label>
                                    <select class="select2 width100"    name="empleado_id[]" multiple="">
                                        <?php foreach ($Usuario as $value) {?>
                                        <option value="<?=$value['empleado_id']?>"><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <div class="">
                                        <br>
                                        <input name="csrf_token" type="hidden">
                                        <input name="area_id" type="hidden" value="<?=$_GET['area']?>">
                                        <button type="submit" class="btn btn-cons back-imss btn-add pull-right">Asignar</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
          </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/os/urgencias/camas.js" type="text/javascript"></script>
