<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">

        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a  >Almacen</a></li>
                    <li><a  >Inventarios</a></li>
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/gestion_inventario" >Gestión inventarios</a></li>
                    <li><a class="active">Gestión de materiales</a></li>
                </ul>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Gestión de materiales</span>
                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_material?a=add&id=0&m=<?=$_GET['id']?>" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                                <th data-toggle="true" >Proveedor</th>
                                <th data-hide="all">Material</th>
                                 <th data-sort-ignore="true" >Cantidad</th>
                                <th data-sort-ignore="true" >Clave</th>
                                <th data-sort-ignore="true" class="text-center">Materia Intermedio</th>
                                <th data-sort-ignore="true">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value):?>
                            <tr id="<?=$value['material_id']?>" class="<?=$value['material_status']?>">
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
                                <td><?=$value['material_nombre']?></td>
                                <td >
                                    <?php if($value['material_intermedio']=='Si'){?>  
                                    No Aplica
                                    <?php }else{?>
                                    <?=$value['material_cantidad']?>
                                    <?php }?>
                                </td>
                                <td><?=$value['material_clave']?></td>
                                <td class="text-center">
                                    <?php if($value['material_intermedio']=='Si'){?>  
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/material_intermedio?m=<?=$value['material_id']?>&si=<?=$_GET['id']?>">
                                        <i class="fa fa-plus-circle icono-accion tip" data-original-title="Agregar materiales intermedios"></i>
                                    </a>
                                    <?php }else{?>
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/codigosdebarram?m=<?=$value['material_id']?>&id=<?=$_GET['id']?>">
                                        <i class="fa fa-barcode icono-accion tip" data-original-title="Códigos de barras"></i>
                                    </a>&nbsp;
                                    <i class="fa fa-plus-circle icono-accion tip add-cantidad-material" data-id="<?=$value['material_id']?>" data-cantidad="<?=$value['material_cantidad']?>" data-si="<?=$_GET['id']?>" data-original-title="Actualizar cantidad"></i>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_material?a=edit&id=<?=$value['material_id']?>&m=<?=$_GET['id']?>">
                                        <i class="fa fa-pencil icono-accion"></i>
                                    </a>&nbsp;&nbsp;
                                    <i class="fa fa-trash-o icono-accion pointer del_m" data-id="<?=$value['material_id']?>"></i>
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