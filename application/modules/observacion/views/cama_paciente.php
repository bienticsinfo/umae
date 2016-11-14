<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
               <li><a href="#">Inicio</a></li>
               <li><a href="#"><?=$area['area_nombre']?></a></li>
               <li><a href="#">Visor de Camas</a></li>
               <li><a href="#">Cama asignado a paciente</a></li>
            </ol>    
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Detalles del Paciente</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 0px">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Paciente:</b> <?=$paciente[0]['triage_nombre']?></h5>
                                <h5><b>Hora Cero:</b> <?=$paciente[0]['triage_horacero_f']?> <?=$paciente[0]['triage_horacero_h']?></h5>
                                <h5><b>Hora Enfermeria:</b> <?=$paciente[0]['triage_fecha']?> <?=$info[0]['triage_hora']?></h5>
                                <h5><b>Hora Clasificación:</b> <?=$paciente[0]['triage_fecha_clasifica']?> <?=$paciente[0]['triage_hora_clasifica']?></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>Cama asignada:</b> <?=$info[0]['cama_nombre']?></h5>
                                <h5><b>Hora Entrada:</b> <?=$info[0]['observacion_fe']?> <?=$info[0]['observacion_he']?></h5>
                                <h5><b>Hora Asignación Cama:</b> <?=$info[0]['observacion_fac']?> <?=$info[0]['observacion_hac']?></h5>
                                <h5><b>Hora Salida:</b> <?=$info[0]['observacion_fs']?> <?=$info[0]['observacion_hs']?></h5>
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
                                    <a href="<?=  base_url()?>triage/generar_documento?t=<?=$paciente[0]['triage_id']?>" target="_blank">
                                        <i class="fa fa-file-pdf-o icono-accion"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Hoja Frontal</td>
                                <td>
                                    <a href="<?=  base_url()?>asistentesmedicas/generar_solicitud?t=<?=$paciente[0]['triage_id']?>" target="_blank">
                                        <i class="fa fa-file-pdf-o icono-accion"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php if($info[0]['triage_paciente_accidente_lugar']=='TRABAJO'){?>
                            <tr>
                                <td>ST-7</td>
                                <td>
                                    <a href="<?=  base_url()?>asistentesmedicas/st7?t=<?=$paciente[0]['triage_id']?>" target="_blank">
                                        <i class="fa fa-file-pdf-o icono-accion"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/observacion.js')?>" type="text/javascript"></script>