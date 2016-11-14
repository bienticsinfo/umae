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
                    <li><a class="active" href="<?=  base_url()?>materiales_consumo/almacen_osteo/sistema_material?id=<?=$_GET['si']?>">Gestión de materiales</a></li>
                    <li><a class="active">Gestión de materiales intermedios</a></li>
                </ul>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Gestión de materiales intermedios</span>
                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_material_intermedio?a=add&id=0&m=<?=$_GET['m']?>&si=<?=$_GET['si']?>" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                                <th data-hide="all">Material</th>
                                <th data-sort-ignore="true" >Nombre</th>
                                <th data-sort-ignore="true">Medida</th>
                                <th data-sort-ignore="true" style="width: 15%">Cantidad</th>
                                <th data-sort-ignore="true">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value):?>
                            <tr id="<?=$value['intermedia_id']?>" class="<?=$value['intermedia_status']?>">
                                <td><?=$value['material_nombre']?></td>
                                <td><?=$value['intermedia_nombre']?></td>
                                <td><?=$value['intermedia_medida']?></td>
                                <td>
                                    <?=$value['intermedia_cantidad']?>
                                </td>
                                <td>
                                    <i class="fa fa-plus-circle icono-accion tip add-cantidad-mi" data-id="<?=$value['intermedia_id']?>" data-cantidad="<?=$value['intermedia_cantidad']?>" data-m="<?=$_GET['m']?>" data-si="<?=$_GET['si']?>" data-original-title="Actualizar cantidad"></i>
                                    &nbsp;&nbsp;
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/codigosdebarrami?mi=<?=$value['intermedia_id']?>&m=<?=$_GET['m']?>&si=<?=$_GET['si']?>">
                                        <i class="fa fa-barcode icono-accion"></i>
                                    </a>&nbsp;&nbsp;
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/agregar_material_intermedio?a=edit&id=<?=$value['intermedia_id']?>&m=<?=$_GET['m']?>&si=<?=$_GET['si']?>">
                                        <i class="fa fa-pencil icono-accion"></i>
                                    </a>&nbsp;&nbsp;
                                    <i class="fa fa-trash-o icono-accion del_m_i pointer" data-id="<?=$value['intermedia_id']?>"></i>
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