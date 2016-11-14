<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
               <li><a href="#">Inicio</a></li>
                <li><a href="#"><?=$info['area_nombre']?></a></li>
            </ol>    
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$info['area_nombre']?></span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12" style="padding-left: 0px">
                            <div class="input-group ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="input_search" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/observacion.js')?>" type="text/javascript"></script>