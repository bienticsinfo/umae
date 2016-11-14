<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#" class="back-history1">Observación</a></li>
                
                <li><a href="#">Asignar Cama</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">ASIGNACIÓN DE CAMA</span>
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table m-b-none table-filtros table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
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
                                    <tr>
                                        <td><?=$info['observacion_fe']?> <?=$info['observacion_he']?></td>
                                        <td><?=$info['observacion_fs']!='' ? $info['observacion_fs']:' No Especificado' ?> <?=$info['observacion_hs']?></td>
                                        <td><?=$info['triage_nombre']?></td>
                                        <td><?=$Cama!=''? $Cama['cama_nombre'] :'No Asignado'?></td>
                                        <td><?=$info['observacion_alta']!=''? $info['observacion_alta'] :'PENDIENTE'?></td>
                                        <td>
                                            <?php if($info['observacion_cama']==''){?>
                                            <i class="fa fa-bed icono-accion tip pointer add-cama-paciente" data-triage="<?=$info['triage_id']?>" data-area="<?=$info['area_id']?>" data-original-title="Asignar Cama"></i>&nbsp;
                                            <?php }if($info['observacion_alta']==''){?>
                                            <i class="fa fa-share-square-o icono-accion tip pointer alta-paciente" data-triage="<?=$info['triage_id']?>" data-cama="<?=$info['observacion_cama']?>" data-original-title="Alta Paciente"></i>
                                            <?php }?>
                                            
                                        </td>
                                    </tr>
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/observacion.js')?>" type="text/javascript"></script>