<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Central de Servicios</span>
                    <a href="<?=  base_url()?>centralservicio/programacion" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th >N.S.S</th>
                            <th data-hide="all">Derechohabiente</th>
                            <th class="text-center">N° de Programación</th>
                            <th class="text-center">Fecha de Programación</th>
                            <th data-hide="all">Destino</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <?php if($value['programacion_tratamiento']=='Tratamientos asignados'){?>
                        <tr id="<?=$value['derechohabiente_nss']?>">
                            <td><?=$value['derechohabiente_nss']?></td>
                            <td><?=$value['derechohabiente_nombre']?> <?=$value['derechohabiente_apat']?> <?=$value['derechohabiente_amat']?></td>
                            <td class="text-center"><?=$value['programacion_id']?> </td>
                            <td class="text-center"><?=$value['programacion_fecha']?></td>
                            <td> <?=$value['programacion_destino']?></td>
                            <td><?=$value['programacion_status']?></td>
                            <td class="text-center">                            
                                <a href="<?=  base_url()?>centralservicio/verterapias?p=<?=$value['programacion_id']?>">
                                    <i class="fa fa-medkit icono-accion tip" data-original-title="Ver terapias asignadas"></i>
                                </a>&nbsp;&nbsp;
                                <a href="<?=  base_url()?>centralservicio/fechasterapias?p=<?=$value['programacion_id']?>" target="_blank">
                                    <i class="fa fa-list icono-accion tip" data-original-title="Generar fechas de terapias" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
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
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>