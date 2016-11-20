<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
               <li><a href="#">Inicio</a></li>
                <li><a href="#"><?=$_SESSION['UMAE_AREA']?></a></li>
            </ol>    
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><?=$info['area_nombre']?></span>
                    <a href="<?=  base_url()?>observacion/reportes" target="_blank" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Reportes">
                        <i class="fa fa-line-chart fa-2x"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="" >
                    <div class="row">
                        <div class="col-md-12" style="">
                            <div class="input-group ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="input_search" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 20px">
                            <table class="table m-b-none table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Ingreso</th>
                                        <th>Salida</th>
                                        <th>Paciente</th>
                                        <th>Cama</th>
                                        <th>Alta</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($GestionV2 as $value) {?>
                                    <tr>
                                        <td><?=$value['observacion_fl']?> <?=$value['observacion_hl']?></td>
                                        <td><?=$value['observacion_fs']!='' ? $value['observacion_fs']:' No Especificado' ?> <?=$value['observacion_hs']?></td>
                                        <td><?=$value['triage_nombre']?></td>
                                        <td><?=$value['observacion_cama_nombre']!=''? $value['observacion_cama_nombre'] :'No Asignado'?></td>
                                        <td><?=$value['observacion_alta']!=''? $value['observacion_alta'] :'PENDIENTE'?></td>
                                        <td>
                                            <?php if($value['observacion_cama_nombre']==''){?>
                                            <i class="fa fa-bed icono-accion tip pointer add-cama-paciente" data-triage="<?=$value['triage_id']?>" data-area="<?=$value['observacion_area']?>" data-original-title="Asignar Cama"></i>&nbsp;
                                            <?php }if($value['observacion_alta']==''){?>
                                            <i class="fa fa-share-square-o icono-accion tip pointer alta-paciente" data-triage="<?=$value['triage_id']?>" data-cama="<?=$value['observacion_cama']?>" data-original-title="Alta Paciente"></i>
                                            <?php }?>
                                            
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="observacion_alta">
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/observacion.js')?>" type="text/javascript"></script>