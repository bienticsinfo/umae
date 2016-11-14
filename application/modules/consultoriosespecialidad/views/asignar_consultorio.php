<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ul class="breadcrumb">
            <li><a >Inicio</a></li>
            <li><a href="#" class="back-history1">Consultorios de Especialiadd</a></li>
            <li><a href="#">Asignar Consultorio</a></li>
        </ul>
        <div class="col-md-8 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default " style="margin-top: -40px">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Asignar Consultorio</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="solicitud-paciente">
                            <div class="row row-sm" style="margin-left: -40px">
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Hoja </label>
                                        <input class="md-input " name="asistentesmedicas_hoja" value="<?=$info[0]['asistentesmedicas_hoja']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Renglón </label>
                                        <input class="md-input " name="asistentesmedicas_renglon" value="<?=$info[0]['asistentesmedicas_renglon']?>">   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="triage_id" value="<?=$_GET['t']?>"> 
                                    <input type="hidden" name="asistentesmedicas_id" value="<?=$solicitud[0]['asistentesmedicas_id']?>">
                                    <button class="md-btn md-raised m-b btn-fw back-imss  waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Asignar</button>                     
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
<script src="<?= base_url('assets/js/os/asistentesmedicas/asistentesmedicas.js')?>" type="text/javascript"></script>