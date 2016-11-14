<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Fianza
                </div>
                <form action="<?=  base_url()?>conservacion/contratos/fianza_save" method="POST" enctype="multipart/form-data">
                    <div class="row panel-body ">
                        <div class="col-md-4">
                            <?php if($Gestion[0]['contrato_tipo_s']!='Salario Menor a 300' || $Gestion[0]['contrato_tipo_s']!='Salario Mayor a 600'){ ?>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <label class="form-label">Tipo de Fianza</label>
                                <div class="controls">
                                    <select class="tipo_contrato" style="width: 100%" name="jtfTipoFianza">
                                        <option>Seleccionar</option>
                                        <option value="ANTICIPO">ANTICIPO</option>
                                        <option value="CUMPLIMIENTO">CUMPLIMIENTO</option>
                                        <option value="VICIOS OCULTOS">VICIOS OCULTOS</option>
                                    </select>
                                </div>                                               
                            </div>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <label class="form-label">Tipo de garantía</label>
                                <div class="controls">
                                    <select class="tipo_contrato" style="width: 100%" name="jtfTipoGarantia">
                                        <option>Seleccionar</option>
                                        <option value="Fianza">Fianza</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Certificado">Certificado</option>
                                        <option value="Deposito en efectivo">Deposito en efectivo</option>
                                    </select>
                                </div>                                               
                            </div>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <input type="text" name="caratula_afianzadora" class="md-input" required="">
                                <label class="form-label">Afianzadora</label>
                                <div class="controls">
                                    
                                </div>                                               
                            </div>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <input type="text" name="caratula_num" class="md-input" required="">
                                <label class="form-label">Numero</label>
                                <div class="controls">
                                    
                                </div>                                               
                            </div>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <input type="text" name="caratula_importe" class="md-input" required="">
                                <label class="form-label">Importe</label>
                                <div class="controls">
                                    
                                </div>                                               
                            </div>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                            <input type="text" name="caratula_vigencia_inicio" class="md-input fecha" required="">
                                            <label class="form-label">Vigencia Inicio</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                            <input type="text" name="caratula_vigencia_fin" class="md-input fecha" required="">
                                            <label class="form-label">Vigencia Fin</label>
                                        </div>   
                                    </div>

                                </div>

                            </div>
                            <?php } ?>
                            <div class="md-form-group float-label" style="margin-top: -10px">
                                <label class="form-label">Seleccionar archivo</label>
                                <div class="controls">
                                    <input type="hidden" name="jtfContratoId" value="<?=$_GET['c']?>">
                                    <input name="csrf_token" type="hidden">
                                    <input type="file" class="md-input upload-archivo" name="jtfTipo" required="" value="Finanzas">
                                </div>                                               
                            </div>
                            <button type="submit" class="btn back-imss btn-cons" style="margin-top: 0px">Guardar</button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>   
    </div>
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>