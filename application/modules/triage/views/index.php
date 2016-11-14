<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Triage</a></li>
            </ol>    
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">
                        Procedimiento para la clasifrterticación de pacientes<br>
                        Clasificados: <?=  count($total_no_clas_f)?><br> 
                        No Clasificados: <?=  count($total_no_clas_p)?><br> 
                        Total: <?=  count($total_no_clas_f) + count($total_no_clas_p)?>
                    </span>
                    <?php if(in_array('35', $_SESSION['IMSS_ROLES'])){?>
                    <a href="<?=  base_url()?>triage/paso1?a=add&t=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                    <?php } ?>
                    <a href="<?=  base_url()?>triage/ver_cortes" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Ver Cortes">
                        <i class="fa fa-calendar-check-o"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row " >
                        
                        <div class="col-md-12">
                            <div  class="toogle-graficas" style="display: none;margin-top: -20px">
                            <?php ?>
                                <div ui-jp="plot" ui-options="
                                [{label:'Reanimación (<?=$triage_rojo?>)', data: <?=$triage_rojo?>}, {label:'Emergencia (<?=$triage_naranja?>)', data: <?=$triage_naranja?>}, {label:'Urgencia (<?=$triage_amarillo?>)', data: <?=$triage_amarillo?>}, {label:'Urgencia Menor (<?=$triage_verde?>)', data: <?=$triage_verde?>}, {label:'Sin Urgencia (<?=$triage_azul?>)', data: <?=$triage_azul?>}],
                                {
                                series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                                colors: ['#E50914','#FF7028','#FDE910','#4CBB17','#0000FF'],
                                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                                tooltip: true,
                                tooltipOpts: { content: '%s: %p.0%' }
                                }
                                " style="height:250px;width: 100%"></div>
                            <?php ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6" style="padding-left: 0px">
                            <div class="input-group ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group ">
                                <button class="btn btn-primary btn-toogle-graficas" style="margin-top: 0px">Ver Grafica</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php if(in_array('34', $_SESSION['IMSS_ROLES']) || in_array('35', $_SESSION['IMSS_ROLES'])){?>
                            <button class="btn btn-primary pull-right btn-corte">Realizar Corte</button>
                            <?php }?>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <table class="table m-b-none table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="false" data-toggle="true">N°</th>
                                    <th>Fecha</th>
                                    <th >Hora</th>
                                    <th data-hide="phone" style="width: 25%">Nombre</th>
                                    <th>Puntaje</th>
                                    <th data-hide="phone">Estado</th>
                                    <th data-sort-ignore="true" class="text-center">Acciones</th>
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

                                <tr id="<?=$value['triage_id']?>" >
                                    <td><?=$value['triage_id']?></td>
                                    <td><?=$value['triage_fecha']?></td>
                                    <td><?=$value['triage_hora']?></td>
                                    <td><?=$value['triage_nombre']?> </td>
                                    <td style="background: ;color: <?=$color?>;text-align: center;">
                                        <?php if($value['triage_etapa']=='2'){?>
                                        <span class="label <?=$background?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['triage_puntaje_total']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        <?php }else{?>
                                        <span class="label blue">No Clasificado</span>
                                        <?php } ?>

                                    </td>
                                    <td>
                                        <?php if($value['triage_status']=='En proceso' || $value['triage_status']=='En Captura'){?>
                                        <span class="label light-blue"><?=$value['triage_status']?></span>
                                        <?php }else{?>
                                        <span class="label green">Finalizado&nbsp;&nbsp;</span>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">

                                        <?php if(in_array('34', $_SESSION['IMSS_ROLES'])  && $value['triage_status']=='En proceso'){?>
                                        <a href="<?=  base_url()?>triage/paso2?t=<?=$value['triage_id']?>">
                                            <i class="fa fa-stethoscope icono-accion tip" data-original-title="Evaluar Paciente"></i>
                                        </a>&nbsp;

                                        <?php } ?>
                                        <?php if(in_array('34', $_SESSION['IMSS_ROLES'])  && $value['triage_status']=='Finalizado' && $value['triage_solicitud_rx']==''){?>
                                            <?php if($background=='amber' || $background=='green' || $background=='indigo'){?>
                                        <a href="<?=  base_url()?>triage/solicitar_rx?t=<?=$value['triage_id']?>" class="solicitar-estidios-rx" data-id="<?=$value['triage_id']?>">
                                            <i class="fa fa-medkit pointer  icono-accion tip" data-original-title="Solicitar RX"></i>&nbsp;
                                        </a>
                                         <?php }?>
                                        <?php } ?>     
                                        <?php if($value['triage_solicitud_rx']=='Si'){?>
                                        <a href="<?=  base_url()?>asistentesmedicas/generar_solicitud_rx?t=<?=$value['triage_id']?>" target="_blank">
                                            <i class="fa fa-file-pdf-o tip icono-accion" data-original-title="Generar Solicitud RX"></i>
                                        </a>&nbsp;
                                        <?php }?>
                                        <?php if( $value['triage_etapa']=='2'){?>
                                        <a href="<?=  base_url()?>triage/generar_documento?t=<?=$value['triage_id']?>" target="_blank">
                                            <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Documento"></i>
                                        </a>&nbsp;
                                        <?php } ?>
                                        <?php if(in_array('35', $_SESSION['IMSS_ROLES']) && $value['triage_status']=='En Captura'){?>
                                        <a href="<?=  base_url()?>triage/paso1?t=<?=$value['triage_id']?>&a=edit" >
                                            <i class="fa fa-pencil icono-accion tip" data-original-title="Capturar Información"></i>
                                        </a>&nbsp;
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
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/triage/triage_actualizar.js')?>" type="text/javascript"></script>