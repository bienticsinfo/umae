<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  No adeudo SAT
                </div>
                <form action="<?=  base_url()?>conservacion/contratos/noadeudosat_save" method="POST" enctype="multipart/form-data">
                    <div class="row panel-body">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-top: -10px">
                                <label class="form-label">Seleccionar archivo</label>
                                <div class="controls">
                                    <input type="hidden" name="jtfContratoId" value="<?=$_GET['c']?>">
                                    <input name="csrf_token" type="hidden">
                                    <input type="file" class="md-input upload-archivo" name="jtfTipo" required="" value="Finanzas">
                                </div>                                               
                            </div> 
                        </div> 
                    </div>   
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" class="btn back-imss btn-cons">Guardar</button>
                            </center>
                            <br><br>
                        </div>
                    </div>  
                </form>

            </div>                 
        </div>    
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>