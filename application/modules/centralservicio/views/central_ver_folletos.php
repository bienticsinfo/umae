<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: 20px">
            <ul class="breadcrumb">
                <li><a >Inicio</a></li>
                <li><a href="#" class="back-history1">Central de Servicios</a></li>
                <li><a href="#">Folletos Asignados</a></li>
            </ul>
        </div>
        <div class="col-md-5 col-centered">
        <div class="box-inner padding">
            
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;">Folletos Asignados</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <?php foreach ($folletos as $value) {?>
                        <div class="row">
                            <div class="col-sm-10">
                                <h5><?=  explode(';', $value['pro_folleto'])[1]?></h5>
                            </div>    
                            <div class="col-sm-2">
                                <a href="<?=  base_url()?>assets/folletos/<?=  explode(';', $value['pro_folleto'])[0]?>" target="_blank">
                                    <i class="fa fa-file-pdf-o icono-accion tip"></i>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>