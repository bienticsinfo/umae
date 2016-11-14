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
                    <span style="font-size: 15px;font-weight: 500">Procedimiento para la clasificación de pacientes</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b btn-llamar-paciente-rx green waves-effect pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <table class="table m-b-none" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="false" data-toggle="true">N°</th>
                            <th data-hide="phone">Nombre</th>
                            <th>Puntaje</th>
                            <th>Estado</th>
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
                        
                        <tr id="<?=$value['triage_id']?>" class="<?=$value['triage_accion']?>">
                            <td><?=$value['triage_id']?></td>
                            <td><?=$value['triage_nombre']?> </td>
                            <td style="background: ;color: <?=$color?>;text-align: center;">
                                <?php if($value['triage_etapa']=='2'){?>
                                <span class="label <?=$background?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['triage_puntaje_total']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php }else{?>
                                <span class="label blue">No Clasificado</span>
                                <?php } ?>
                                
                            </td>
                            <td><?=$value['rs_status']!='' ? $value['rs_status'] : 'EN ESPERA'?></td>
                            <td class="text-center">
                                <a href="<?=  base_url()?>asistentesmedicas/generar_solicitud_rx?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o tip icono-accion" data-original-title="Generar Solicitud RX"></i>
                                </a>&nbsp;
                                <?php if($value['rs_status']=='eee'){?>
                                <i class="fa fa-sign-in icono-accion tip acceso-area-rx-paciente pointer" data-id="<?=$value['rx_id']?>" data-accion="Ingreso" data-original-title="Ingreso paciente al area RX"></i>
                                <?php }if($value['rs_status']=='Ingresoeee'){?>
                                <i class="fa fa-sign-out icono-accion tip acceso-area-rx-paciente pointer" data-id="<?=$value['rx_id']?>" data-accion="Salida" data-original-title="Salida paciente del área de RX"></i>
                                <?php }?>
                                <?php if($value['rs_status']!='Salida al Consultorio de Especialidad'){?>
                                <i class="fa fa-sign-out icono-accion tip acceso-area-rx-paciente pointer" data-id="<?=$value['rx_id']?>" data-triage="<?=$value['triage_id']?>" data-accion="Salida al Consultorio de Especialidad" data-original-title="Salida al Consultorio de Especialidad"></i>
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
<script src="<?= base_url('assets/js/os/rx/rx.js')?>" type="text/javascript"></script>