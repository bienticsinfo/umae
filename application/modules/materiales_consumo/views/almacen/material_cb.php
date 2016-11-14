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
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/sistema_material?id=<?=$_GET['id']?>">Gestión de materiales</a></li>
                    <li class="active"><a >Código de barras</a></li>
                </ul>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Código de barras</span>
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
                                <th data-sort-ignore="true" >Material Intermedio</th>
                                <th data-sort-ignore="true">Código de barras</th>
                                <th data-sort-ignore="true">Status</th>
                                <th data-sort-ignore="true" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value):?>
                            <tr id="<?=$value['intemediocd_id']?>" >
                                <td><?=$value['material_nombre']?></td>
                                <td><?=$value['intermediocd_sm']?><?=$value['intemediocd_id']?></td>
                                <td><?=$value['intemediocd_status']?></td>
                                <td class="text-center">
                                    <a href="<?=  base_url()?>materiales_consumo/almacen_osteo/generarcodigo?cb=<?=$value['intemediocd_id']?>" target="_blank">
                                        <i class="fa fa-barcode icono-accion"></i>
                                    </a>
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