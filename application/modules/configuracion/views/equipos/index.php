<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-11 col-centered ">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Gestión de equipos</span>
                        <a  class="md-btn md-fab m-b green waves-effect btn-add-equipo pull-right">
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control"  id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <table id="ver-tabla-equipos" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">   
                            <thead>
                               <tr>
                                    <th>N°</th>
                                    <th>Dirección IP</th>
                                    <th >Acciones</th>
                               </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['equipo_id']?>">
                                    <td><?=$value['equipo_id']?></td>
                                    <td><?=$value['equipo_ip']?></td>
                                    <td>
                                        <i class="fa fa-pencil icono-accion btn-edit-equipo pointer" data-id="<?=$value['equipo_id']?>"></i>&nbsp;&nbsp;
                                        <i class="fa fa-trash-o icono-accion pointer" data-id="<?=$value['equipo_id']?>"></i>
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
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/configuracion/equipos.js')?>" type="text/javascript"></script>