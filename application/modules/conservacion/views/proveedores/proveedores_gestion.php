<?=  Modules::run('config/getHeadAdmin')?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Gestión de Proveedores
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <a href="<?=  base_url()?>conservacion/reportes/proveedores" target="_blank">
                                <i class="fa fa-cloud-download pull-right fa-2x pointer tip text-imss"  style="margin-top: 3px!important" data-original-title="Exportar a EXCEL"></i>
                            </a>
                        </div>
                        <div class="col-md-2">
                            
                            <a href="<?=  base_url()?>conservacion/proveedores/agregar">
                                <button class="btn btn-cons pull-right back-imss">Agregar Proveedor</button>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table m-b-none " ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th style="width:auto">Tipo de Persona</th>
                            <th style="width:auto">N° Proveedor</th>
                            <th style="width: auto;">Nombre</th>
                            <th style="width: auto;">RFC</th>
                            <th style="width: auto;">Código postal</th>
                            <th style="width: auto;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $g):?>
                        <tr id="<?=$g['prov_id']?>" <?=$g['prov_status']?>>
                            <td class="v-align-middle"><?=$g['prov_tipo']?></td>
                            <td class="v-align-middle"><?=$g['prov_num']?></td>
                            <td class="v-align-middle">
                                <?php 
                                if($g['prov_tipo']=='Personal fisica'){
                                    echo $g['prov_nombre'];
                                }else{
                                    echo $g['prov_razon_social'];
                                }
                                ?>
                            </td>
                            <td class="v-align-middle"><?=$g['prov_rfc']?></td>
                            <td class="v-align-middle"><?=$g['prov_codigo_postal']?></td>
                            <td class="v-align-middle text-center">
                                <i class="fa fa-trash-o tip pointer" data-id="<?=$g['prov_id']?>" data-original-title="Eliminar proveedor"></i>
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
<?=  Modules::run('config/getFooterAdmin')?>
<script src="<?=  base_url()?>assets/js/conservacion/proveedores.js"></script>
