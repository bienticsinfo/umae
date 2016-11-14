<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Triage</a></li>
            </ol>    
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Solicitudes de Paciente TRIAGE</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(in_array('39', $_SESSION['IMSS_ROLES'])){?>
                            <a href="<?=  base_url()?>asistentesmedicas/realizarcorte" >
                                <button class="btn btn-primary" type="button">Realizar Corte</button>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <table class="table m-b-none table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="false" data-toggle="true">N°</th>
                            <th>Fecha</th>
                            <th data-hide="phone" style="width: 20%">Nombre</th>
                            <th>Puntaje</th>
                            <th data-hide="phone">Estado</th>
                            <th>Enviado a</th>
                            <th data-sort-ignore="true" class="text-center" style="width: 15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value) {?>
                        <?php 
                            if($value['triage_puntaje_total']>30){
                                $background='red';
                                $color='white';
                            }if($value['triage_puntaje_total']>=21 && $value['triage_puntaje_total']<=30){
                                $background='orange';
                                $color='white';
                            }if($value['triage_puntaje_total']>=11 && $value['triage_puntaje_total']<=20){
                                $background='amber';
                                $color='white';
                            }if($value['triage_puntaje_total']>=6 && $value['triage_puntaje_total']<=10){
                                $background='green';
                                $color='white';
                            }if($value['triage_puntaje_total']<=5){
                                $background='indigo';
                                $color='white';
                            }


                        ?>
                        
                        <tr id="<?=$value['triage_id']?>" class="<?=$value['triage_accion']?>">
                            <td><?=$value['triage_id']?></td>
                            <td><?=$value['triage_fecha']?> <?=$value['triage_hora']?></td>
                            <td><?=$value['triage_nombre']?> </td>
                            <td style="background: ;color: <?=$color?>;text-align: center;">
                                <?php if($value['triage_etapa']=='2'){?>
                                <span class="label <?=$background?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['triage_puntaje_total']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php }else{?>
                                <span class="label blue">No Clasificado</span>
                                <?php } ?>
                                
                            </td>
                            <td>
                                <?php if($value['asistentesmedicas_status']==''){?>
                                <span class="label light-blue">Datos sin Capturar</span>
                                <?php }else{?>
                                <span class="label green">Datos Capturados&nbsp;&nbsp;</span>
                                <?php }?>
                            </td>
                            <td><?=$value['asistentesmedicas_modulo']!='' ? $value['asistentesmedicas_modulo'] : 'NO ENVIADO'?></td>
                            <td class="">
                                <?php if($value['triage_paciente_accidente_lugar']=='TRABAJO'){?>
                                <a href="<?=  base_url()?>asistentesmedicas/st7?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o tip icono-accion" data-original-title="Generar Solicitud ST7"></i>
                                </a>&nbsp;
                                <?php }?>
                                <?php if($value['triage_solicitud_rx']=='Si' && $value['asistentesmedicas_status']=='Datos Capturados'){?>
                                <a href="<?=  base_url()?>asistentesmedicas/generar_solicitud_rx?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o tip icono-accion" data-original-title="Generar Solicitud RX"></i>
                                </a>&nbsp;
                                <?php }?>
                                <?php if($value['asistentesmedicas_status']==''){?>
                                <a href="<?=  base_url()?>asistentesmedicas/solicitud_paciente?t=<?=$value['triage_id']?>">
                                    <i class="fa fa-user icono-accion tip" data-original-title="Recabar información de paciente"></i>
                                </a>
                                <?php }else{?>
                                <a href="<?=  base_url()?>asistentesmedicas/generar_solicitud?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Solicitud"></i>
                                </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="7" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>