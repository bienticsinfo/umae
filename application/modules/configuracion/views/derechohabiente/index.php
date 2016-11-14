<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Derechohabiente</span>
                        <a md-ink-ripple="" class="md-btn md-fab m-b green waves-effect btn-add pull-right">
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
                        <table id="ver-tabla-cirugias" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="15">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-sort-ignore="false">NSS</th>
                                    <th data-hide="phone" data-sort-ignore="false">Nombre</th>
                                    <th >Apellidos</th>
                                    <th data-sort-ignore="true">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['derechohabiente_id']?>" class="<?=$value['derechohabiente_status']?>">
                                    <td><?=$value['derechohabiente_nss']?></td>
                                    <td><?=$value['derechohabiente_nombre']?> </td>
                                    <td><?=$value['derechohabiente_apat']?> <?=$value['derechohabiente_amat']?></td>
                                    <td>
                                        <a href="">
                                            <i class="fa fa-pencil edit-dh icono-accion tip" data-id="<?=$value['derechohabiente_id']?>" data-original-title="Editar Drechohabiente"></i>
                                        </a>&nbsp;&nbsp;
                                        <i class="fa fa-trash-o icono-accion del-dh tip pointer" data-id="<?=$value['derechohabiente_id']?>" data-original-title="Eliminar"></i>
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
<script src="<?= base_url('assets/js/os/configuracion/derechohabiente.js')?>" type="text/javascript"></script>