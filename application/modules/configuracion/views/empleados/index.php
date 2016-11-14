<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Gestión de empleados</span>
                    <a href="<?=  base_url()?>configuracion/empleados/agregar?a=add&u=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">
                    <thead>
                        <tr>
                            <th >Matrícula</th>
                            <th data-hide="phone">Nombre</th>
                            <th data-hide="phone">Apellidos</th>
                            <th data-hide="phone">Telefono</th>
                            <th data-sort-ignore="true">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['empleado_id']?>">
                            <td><?=$value['empleado_matricula']?></td>
                            <td><?=$value['empleado_nombre']?> </td>
                            <td><?=$value['empleado_apellidos']?></td>
                            <td><?=$value['empleado_tel']?></td>
                            <td>
                                <a href="<?=  base_url()?>configuracion/empleados/horarios?u=<?=$value['empleado_id']?>">
                                    <i class="fa fa-clock-o tip icono-accion" data-original-title="Asignar dias/horarios de estacionamiento"></i>
                                </a>
                                &nbsp&nbsp
                                <a href="<?=  base_url()?>configuracion/empleados/agregar?a=edit&u=<?=$value['empleado_id']?>">
                                    <i data-id="<?=$value['empleado_id']?>"  data-original-title="Modificar" class="tip acciones fa fa-pencil pointer icono-accion"></i>
                                </a>
                                &nbsp&nbsp
                                <i data-id-accion="eliminar"  data-id="<?=$value['empleado_id']?>" data-original-title="Eliminar" class="tip acciones fa fa-trash-o pointer icono-accion"></i>
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
<script src="<?= base_url('assets/js/os/configuracion/empleados.js')?>" type="text/javascript"></script>