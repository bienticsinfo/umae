<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Consultorios de Especialidad & Filtro</a></li>
            </ol>    
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Consultorios de Especialidad & Filtro</span>
                    <a  href="#"  md-ink-ripple="" class="md-btn md-fab m-b hidden btn-llamar-paciente green waves-effect pull-right" data-id="<?=$info_c[0]['empleado_area']?>">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a href="<?=  base_url()?>consultoriosespecialidad/reportes" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Reportes">
                        <i class="fa fa-calendar-check-o"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter_ce" placeholder="Buscar paciente">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <table class="table m-b-none" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="false" data-toggle="true">N°</th>
                            <th data-hide="phone">Nombre</th>
                            <th data-hide="phone">Estado</th>
                            <th>Enviado de</th>
                            <th>Alta</th>
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
                            <td class="<?=$background?> generar-hoja-clasificacion pointer" data-id="<?=$value['triage_id']?>"  style="color: <?=$color?>;">
                                <?=$value['triage_nombre']?> 
                            </td>
                            <td>
                                <?=$value['ce_status']?>
                            </td>
                            <td><?=$value['ce_via']?></td>
                            <td><?=$value['ce_hf']==''? 'Sin Especificar' : $value['ce_hf'] ?></td>
                            <td class="text-center">
                                <a href="<?=  base_url()?>consultoriosespecialidad/formato_4306_lechuga?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Formato de 4.30.6 (lechuga)"></i>
                                </a>&nbsp;
                                <?php if($value['ce_hf']==''){?>
                                <a href="<?=  base_url()?>consultoriosespecialidad/hojafrontal?t=<?=$value['triage_id']?>" >
                                    <i class="fa fa-pencil-square-o icono-accion tip" data-original-title="Requisitar Información"></i>
                                </a>&nbsp;
                                <?php }else{?>
                                <a href="<?=  base_url()?>consultoriosespecialidad/generarhojafrontal?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Hoja Frontal"></i>
                                </a>&nbsp;
                                <a href="<?=  base_url()?>consultoriosespecialidad/hojafrontal?t=<?=$value['triage_id']?>&accion=edit" >
                                    <i class="fa fa-pencil-square-o icono-accion tip" data-original-title="Requisitar Información"></i>
                                </a>&nbsp;
                                <?php }?>
                                <a href="<?=  base_url()?>consultoriosespecialidad/solicitar_rx?t=<?=$value['triage_id']?>" target="_blank">
                                    <i class="fa fa-stethoscope icono-accion tip pointer" data-original-title="Solictar RX" ></i>
                                </a>&nbsp;
                                <i class="fa fa-share icono-accion tip reenviar-otro-consultorio pointer" data-consultorio="<?=$value['triage_consultorio']?>;<?=$value['triage_consultorio_nombre']?>" data-id="<?=$value['triage_id']?>" data-original-title="Reenviar a Otro Consultorio"></i>&nbsp;
                                
                                <?php ?>
                                
                                <?php if($value['ce_hf']!=''){?>
                                <i class="fa fa-sign-out tip salida-paciente-ce pointer icono-accion" data-con="<?=$info_c[0]['empleado_area']?>"  data-id="<?=$value['triage_id']?>" data-original-title="Reportar Salida del Paciente"></i>
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
<script src="<?= base_url('assets/js/os/urgencias/consultorios.js')?>" type="text/javascript"></script>