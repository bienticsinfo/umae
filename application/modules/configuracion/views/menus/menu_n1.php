<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Menu Nivel 1</span>
                        <a class="md-btn md-fab m-b green waves-effect btn-add-mn1 pull-right">
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
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>icono</th>
                                    <th>Status</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <?php 
                                if($value['menuN1_c_m']=='0'){
                                    $mn2_accion='disabled';
                                }else{
                                    $mn2_accion='';
                                }
                                
                                ?>
                                <tr id="<?=$value['menuN1_id']?>" >
                                    <td><?=$value['menuN1_menu']?> </td>
                                    <td><?=$value['menuN1_url']?></td>
                                    <td><?=$value['menuN1_icono']?></td>
                                    <td>
                                        <?php if($value['menuN1_status']=='1'){?>
                                        Activo
                                        <?php }else{?>
                                        Inactivo
                                        <?php }?>
                                    </td>
                                    <td class="text-center ">
                                        <a href="<?=  base_url()?>configuracion/menus/mn1_area?m=<?=$value['menuN1_id']?>">
                                            <button class="btn btn-xs indigo waves-effect color-white">Areas</button>
                                        </a>
                                        
                                        <a href="<?=  base_url()?>configuracion/menus/menuN2?m=<?=$value['menuN1_id']?>">
                                            <button <?=$mn2_accion?> class="btn btn-xs green waves-effect color-white">Menu N2</button>
                                        </a>
                                        <button  class="btn btn-xs blue waves-effect color-white btn-edit-mn1" data-id="<?=$value['menuN1_id']?>">Editar</button>
                                        <button class="btn btn-xs red waves-effect color-white btn-delete-mn1" data-id="<?=$value['menuN1_id']?>">Eliminar</button>
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
<script src="<?= base_url('assets/js/os/configuracion/menus.js')?>" type="text/javascript"></script>