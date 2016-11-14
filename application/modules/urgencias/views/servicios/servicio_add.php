<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading back-imss semi-bold">
                    Nuevo servicio
                </div>
                <div class="card-heading"> <br>
                    <form class="registro_servicios" class="card-heading">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: -20px">
                                <div class="md-form-group float-label">
                                    <label>Nombre</label>
                                    <input class="md-input" name="servicio_nombre" id="servicio_nombre" value="<?=$info[0]['servicio_nombre']?>" required="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                            <label >N° max médicos</label>
                                            <input type="text" name="servicio_max_medicos" value="<?=$info[0]['servicio_max_medicos']?>" class="md-input" required="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                            <label>N° min médicos</label>
                                            <input type="text" name="servicio_min_medicos" value="<?=$info[0]['servicio_min_medicos']?>" class="md-input" required="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <br>
                                        <input type="hidden" name="jtf_accion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="servicio_id" value="<?=$_GET['s']?>">
                                        <input name="csrf_token" type="hidden">
                                        <button type="submit" class="btn btn-cons back-imss btn-add pull-right">Guardar</button>
                                        
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
<?= modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/os/urgencias/servicios.js"></script>
