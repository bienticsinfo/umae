<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-9 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Tipos de usuarios</span>
                    <a md-ink-ripple="" class="md-btn btn-add md-fab m-b green waves-effect pull-right">
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
                            <th>N°</th>
                            <th>Tipo de usuario</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['idTipo_Usuario']?>" class="<?=$value['rol_status']?>">
                            <td><?=$value['idTipo_Usuario']?></td>
                            <td><?=$value['tipo']?></td>
                            <td>
                                <i data-id="<?=$value['idTipo_Usuario']?>"  data-original-title="Modificar" class="tip fa fa-pencil pointer icono-accion"></i>&nbsp&nbsp
                                <i data-id="<?=$value['idTipo_Usuario']?>" data-original-title="Eliminar" class="tip fa fa-trash-o pointer icono-accion"></i>
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/configuracion/usuario_tipos.js')?>" type="text/javascript"></script>