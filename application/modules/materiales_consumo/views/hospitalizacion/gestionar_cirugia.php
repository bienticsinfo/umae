<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                    <ul class="breadcrumb">
                        <li><a >Inicio</a></li>
                        <li><a  >Almacen</a></li>
                        <li><a  >Solicitudes de materiales de Osteosíntesis</a></li>
                    </ul>
                </div> 
                <div class="panel panel-default">
                    
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Solicitudes de materiales de Osteosíntesis</span>
                        <a href="<?=  base_url()?>materiales_consumo/hospitalizacion/programar_cirugia" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control " id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <table id="ver-tabla-cirugias" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-sort-ignore="false">Folio</th>
                                    <th data-hide="all">Médico</th>
                                    <th data-hide="phone" data-sort-ignore="false">Derechohabiente</th>
                                    <th >Diagnostico</th>
                                    <th data-hide="all">Fecha</th>
                                    <th>Status</th>
                                    <th data-sort-ignore="true">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($cirugias as $value) {?>
                                <tr id="<?=$value['solicitud']?>">
                                    <td><?=$value['solicitud_codigo_barras']?></td>
                                    <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                                    <td><?=$value['derechohabiente_nombre']?> <?=$value['derechohabiente_apat']?> <?=$value['derechohabiente_amat']?></td>
                                    <td><?=$value['solicitud_diagnostico']?></td>
                                    <td><?=$value['solicitud_fecha']?></td>
                                    <td>
                                        <?php if($value['solicitud_status']=='1'){?>
                                        <span class="label teal"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;En Proceso</span>
                                        <?php }else{?>
                                        <span class="label blue"><i class="fa fa-check"></i>&nbsp;&nbsp;Entregado</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="">
                                            <i class="fa fa-search ver-materiales icono-accion tip" data-id="<?=$value['solicitud']?>" data-original-title="Ver materiales"></i>
                                        </a>&nbsp;
                                        <?php if($_SESSION['sess']['idRol']=='5'){?>
                                        <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/entregarmateriales?s=<?=$value['solicitud']?>" target="_blank" class="entregar-materiales">
                                            <i class="fa fa-mail-forward icono-accion"></i>
                                        </a>&nbsp;
                                        <?php }?>
                                        <a href="<?=  base_url()?>materiales_consumo/Hospitalizacion/generarsolicitud?s=<?=$value['solicitud']?>" target="_blank">
                                            <i class="fa fa-file-text icono-accion tip" data-original-title="Ver Documento"></i>
                                        </a>&nbsp;
                                        <i class="fa fa-trash-o icono-accion del-cirugia-sol tip pointer" data-id="<?=$value['solicitud']?>" data-original-title="Eliminar"></i>
                                    </td>
                                </tr>
                            <?php }?>
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
<script src="<?= base_url('assets/js/os/material_consumo/programar_cirugia.js')?>" type="text/javascript"></script>