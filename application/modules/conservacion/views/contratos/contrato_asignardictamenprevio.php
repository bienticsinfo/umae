<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Asignar dictamen
                </div>
                <div class="row panel-body ">
                    <div class="col-md-12">

                        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1hellowWorld">
                                <form action="<?=  base_url()?>conservacion/contratos/agregardictamen" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <input type="hidden" name="jtfContratoId" value="<?=$Gestion[0]['contrato_id']?>">
                                                <input type="text" class="md-input" name="jtfNum" required="">
                                                <input name="csrf_token" type="hidden">
                                                <label class="form-label">N° Dictamen</label>
                                                <div class="controls">
                                                    
                                                </div>                                               
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <input type="text" class="md-input fecha" name="jtfFecha" required="">
                                                <label class="form-label">Fecha Dictamen</label>
                                                <div class="controls">
                                                    
                                                </div>                                               
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <input type="text" class="md-input" name="jtfImporte" required="">
                                                <label class="form-label">Importe</label>
                                                <div class="controls">
                                                    
                                                </div>                                               
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <input type="text" class="md-input" name="jtfPartida" required="">
                                                <label class="form-label">Partidad Presupuestal</label>
                                                <div class="controls">
                                                    
                                                </div>                                               
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Seleccionar doc</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfDictamen">
                                                </div>                                               
                                            </div> 
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">N° Contrato</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_numero_tmp']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Area Solicitante</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_area_solicitante']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Tipo de Contrato</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_tipo']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Fecha Inicio/Fin</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_fecha_inicio']?> - <?=$Gestion[0]['contrato_fecha_fin']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Monto Total</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_monto_total']?></div>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Unidad udimensional total</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_unidad_udi']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Proveedor</label>
                                                <div class="controls"><?=$Gestion[0]['prov_nombre']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Hospital/s de procedencia</label>
                                                <div class="controls"><?=$Gestion[0]['hospital_nombre']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Especialidad</label>
                                                <div class="controls"><?=$Gestion[0]['especialidad_nombre']?></div>
                                            </div>
                                            <div class="md-form-group float-label">
                                                <label class="form-label semi-bold">Descripción del trabajo a realizar</label>
                                                <div class="controls"><?=$Gestion[0]['contrato_descripcion']?></div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <button type="submit" class="btn back-imss btn-cons">Agregar Dictamen Previo</button>
                                            </center>
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
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>