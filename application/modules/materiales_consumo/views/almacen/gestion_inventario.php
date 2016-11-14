<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a href="">Inicio</a></li>
                    <li><a href="#" >Almacen</a></li>
                    <li><a href="#" >Inventarios</a></li>
                    <li><a href="#" class="active">Gestión inventarios</a></li>
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Gestión de inventario</span>
                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_sistema?a=add&id=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                    <table id="ver-tabla-gestion-i" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                        <thead>
                            <tr>
                                <th data-toggle="true" >Sistema</th>
                                <th data-hide="phone">Proveedor</th>
                                <th data-hide="phone">Contrato</th>
                                <th data-sort-ignore="true" class="text-center">Material</th>
                                <th data-sort-ignore="true">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value):?>
                            <tr id="<?=$value['sistema_id']?>" class="<?=$value['sistema_status']?>">
                                <td><?=$value['sistema_nombre']?></td>
                                <td>
                                    <?php 
                                    if($value['prov_tipo']=='Personal fisica'){
                                        echo $value['prov_nombre'];
                                    }else{
                                        echo $value['prov_razon_social'];
                                    }
                                    
                                    ?>
                                
                                </td>
                                <td><?=$value['sistema_contrato']?></td>
                                <td class="text-center">
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/sistema_material?id=<?=$value['sistema_id']?>">
                                        <i class="fa fa-plus-circle icono-accion"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_sistema?a=edit&id=<?=$value['sistema_id']?>">
                                        <i class="fa fa-pencil icono-accion"></i>
                                    </a>&nbsp;&nbsp;
                                    <i class="fa fa-trash-o del-s icono-accion pointer" data-id="<?=$value['sistema_id']?>"></i>
                                </td>
                            </tr>
                            <?php endforeach;?>
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
<script src="<?= base_url('assets/js/os/material_consumo/gestion_inventario.js')?>" ></script>