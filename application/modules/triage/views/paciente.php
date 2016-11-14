<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-7 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history2">Triage</a></li>
                    <li><a href="#" class="back-history1">Reportes</a></li>
                    <li><a href="#"><?=$info[0]['triage_nombre']?></a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Detalles del Paciente</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 0px">
                        <div class="row">
                            <div class="col-md-7">
                                <h5><b>Paciente:</b> <?=$info[0]['triage_nombre']?></h5>
                                <h5><b>Hora Cero:</b> <?=$info[0]['triage_horacero_f']?> <?=$info[0]['triage_horacero_h']?></h5>
                                <h5><b>Hora Enfermeria:</b> <?=$info[0]['triage_fecha']?> <?=$info[0]['triage_hora']?></h5>
                                <h5><b>Hora Clasificación:</b> <?=$info[0]['triage_fecha_clasifica']?> <?=$info[0]['triage_hora_clasifica']?></h5>
                            </div>
                            <div class="col-md-5">
                                <div class="alert alert-info">
                                    <h5 class="text-right"> Tiempo Transcurrido</h5>
                                    <h4 class="text-right" style="margin-bottom: 20px">
                                        <?php 
                                            date_default_timezone_set('America/Mexico_City');
                                            $hora_cero=new DateTime(str_replace('/', '-', $info[0]['triage_horacero_f']).' '.$info[0]['triage_horacero_h']);
                                            $hora_clas=new DateTime(str_replace('/', '-', $info[0]['triage_fecha_clasifica']).' '. $info[0]['triage_hora_clasifica']);
                                            $diff=$hora_cero->diff($hora_clas);
                                            echo $diff->h .' Horas '.$diff->i. ' Minutos';
                                            
                                        ?>
                                    </h4>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Documentos</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hoja de Clasificación</td>
                                <td>
                                    <a href="<?=  base_url()?>triage/generar_documento?t=<?=$_GET['id']?>" target="_blank">
                                        <i class="fa fa-file-pdf-o icono-accion"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>