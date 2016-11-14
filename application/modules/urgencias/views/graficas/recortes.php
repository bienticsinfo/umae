<?= modules::run('menu/index'); ?> 
<div class="box-row">  
    <div class="box-cell"> 
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Urgencias</a></li>
                <li><a href="#" class="back-history1">Graficas</a></li>
                <li class="active">Cortes</li>
            </ol>
            
            <div class="col-md-12" style="margin-top: -10px">
                <div class="panel no-border">
                    <div class="panel-heading back-imss">
                        <span class="font-bold">
                            Recortes de la Fecha : <?=$info[0]['triage_fecha']?> <br>
                            Total: <?php echo $triage_rojo+$triage_naranja+$triage_amarillo+$triage_verde+$triage_azul;?> Documentos Clasificados</span>
                        
                    </div>
                     <div class="panel-body">
                        <div ui-jp="plot" ui-options="
                          [{label:'Reanimación (<?=$triage_rojo?>)', data: <?=$triage_rojo?>}, {label:'Emergencia (<?=$triage_naranja?>)', data: <?=$triage_naranja?>}, {label:'Urgencia (<?=$triage_amarillo?>)', data: <?=$triage_amarillo?>}, {label:'Urgencia Menor (<?=$triage_verde?>)', data: <?=$triage_verde?>}, {label:'Sin Urgencia (<?=$triage_azul?>)', data: <?=$triage_azul?>}],
                          {
                            series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                            colors: ['#E50914','#FF7028','#FDE910','#4CBB17','#0000FF'],
                            grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                            tooltip: true,
                            tooltipOpts: { content: '%s: %p.0%' }
                          }
                        " style="height:350px;width: 100%"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel no-border">
                    <div class="panel-body">
                        <table class="table m-b-none" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="false" data-toggle="true">N°</th>
                                    <th>Fecha</th>
                                    <th >Hora</th>
                                    <th data-hide="phone">Nombre</th>
                                    <th>Puntaje</th>
                                    <th data-hide="phone">Status</th>
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
                                        <?php if($value['triage_status']=='En proceso'){?>
                                        <span class="label light-blue">En Proceso</span>
                                        <?php }else{?>
                                        <span class="label green">Finalizado&nbsp;&nbsp;</span>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">

                                        <?php if(in_array('34', $_SESSION['IMSS_ROLES'])  && $value['triage_etapa']=='1'){?>
                                        <a href="<?=  base_url()?>triage/paso2?t=<?=$value['triage_id']?>">
                                            <i class="fa fa-stethoscope icono-accion tip" data-original-title="Evaluar Paciente"></i>
                                        </a>&nbsp;
                                        <?php } ?>
                                        <?php if($_SESSION['sess']['idRol']=='34' && $value['triage_etapa']=='2' && $background=='red' || $background=='orange'){?>
        <!--                                <a href="<?=  base_url()?>triage/paso3?t=<?=$value['triage_id']?>">
                                            <i class="fa fa-user-plus icono-accion tip " data-original-title="Referencia-Contrarreferencia"></i>
                                        </a>-->
                                        <?php }else{echo '';}?>

                                        <?php if( $value['triage_etapa']=='2'){?>
                                        <a href="<?=  base_url()?>triage/generar_documento?t=<?=$value['triage_id']?>" target="_blank">
                                            <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Documento"></i>
                                        </a>&nbsp;
                                        <?php } ?>
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