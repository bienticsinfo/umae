<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Médicos Asignados a la Áreas</span>
                    <a href="<?=  base_url()?>urgencias/roles_add?area=<?=$_GET['area']?>" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                            <th data-sort-initial="true" data-toggle="true">Area</th>
                            <th >Matrícula</th>
                            <th data-hide="phone">Nombre</th>
                            <th data-hide="phone">Apellidos</th>
                            <th data-hide="phone">Telefono</th>
                            <th data-sort-ignore="true">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['area_medico_id']?>">
                            <td><?=$value['area_nombre']?></td>
                            <td><?=$value['empleado_matricula']?></td>
                            <td><?=$value['empleado_nombre']?> </td>
                            <td><?=$value['empleado_apellidos']?></td>
                            <td><?=$value['empleado_tel']?></td>
                            <td>
                                <i class="fa fa-trash-o icono-accion eliminar-rol-area pointer" data-id="<?=$value['area_medico_id']?>"></i>
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
<script src="<?= base_url('assets/js/os/urgencias/camas.js')?>" type="text/javascript"></script>