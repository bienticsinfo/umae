<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#" class="back-history1">Observación</a></li>
                
                <li><a href="#">Visor de Camas</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">VISOR DE CAMAS</span>
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table m-b-none table-filtros table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Cama</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value):?>
                                    <tr>
                                        <td><?=$value['cama_nombre']?> </td>
                                        <td>
                                            <?php if($value['cama_status']=='Disponible'){?>
                                            <span class="label teal">Disponible</span>
                                            <?php }?>
                                            <?php if($value['cama_status']=='Ocupado'){?>
                                            <span class="label amber">Ocupado</span>
                                            <?php }?>
                                            <?php if($value['cama_status']=='En Mantenimiento' || $value['cama_status']=='En Limpieza'){?>
                                            <span class="label blue"><?=$value['cama_status']?></span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($value['cama_status']=='Ocupado'){?>
                                            <a href="<?=  base_url()?>observacion/cama_paciente?cama=<?=$value['cama_id']?>" target="_blank">
                                                <i class="fa fa-user icono-accion tip" data-original-title="Ver datos del Paciente"></i>
                                            </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
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