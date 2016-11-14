<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding col-md-5 col-centered">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history2">Areas</a></li>
                    <li><a href="#" class="back-history1">Camas</a></li>
                    <li><a href="#" class="">Derechohabiente</a></li>
                </ul>
            </div>
            <div class="">
            <div class="panel panel-default">
                <div class="panel-heading back-imss">
                    Asignar Derechohabiente a: <?=$info[0]['cama_nombre']?>
                </div>
                <div class="">
                    <form class="card-heading asignar-cama">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form-group float-label">
                                    <label>Derechohabiente</label>
                                    <select class="select2 width100"   id="derechohabiente_id"  data-id="<?=$info[0]['cama_dh']?>" name="derechohabiente_id"></select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Fecha de Entrada</label>
                                            <input type="text" name="cama_dh_fecha_entrada" value="<?=$asignacion[0]['cama_dh_fecha_entrada']?>" class="form-control fecha-calendar">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hora de Entrada</label>
                                            <input type="text" name="cama_dh_hora_entrada"  value="<?=$asignacion[0]['cama_dh_hora_entrada']?>" class="form-control clockpicker" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-salida">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Fecha Salida</label>
                                            <input type="text" name="cama_dh_fecha_salida" value="<?=$asignacion[0]['cama_dh_fecha_salida']?>" class="form-control fecha-calendar">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hora de Salida</label>
                                            <input type="text" name="cama_dh_hora_salida" value="<?=$asignacion[0]['cama_dh_hora_salida']?>" class="form-control clockpicker" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <br>
                                        <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="cama_id" value="<?=$_GET['c']?>">
                                        <input name="csrf_token" type="hidden">
                                        <input type="hidden" name="cama_dh" value="<?=$info[0]['cama_dh']?>">
                                        <input type="hidden" name="cama_dh_id" value="<?=$asignacion[0]['cama_dh_id']?>">
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
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/os/urgencias/camas.js" type="text/javascript"></script>
