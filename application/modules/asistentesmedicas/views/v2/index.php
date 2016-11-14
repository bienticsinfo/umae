<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Triage</a></li>
            </ol>    
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Solicitudes de Paciente TRIAGE</span>
                    <a href="<?=  base_url()?>asistentesmedicas/reportes" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Reportes">
                        <i class="fa fa-pie-chart fa-2x" style="    margin-top: 10px;margin-left: 5px;"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="input_search_am" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>