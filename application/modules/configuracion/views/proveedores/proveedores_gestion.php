<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading back-imss">
                    Gestión de Proveedores
                    <a href="<?=  base_url()?>configuracion/proveedor/agregar" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-plus" ></i>
                    </a>
                    <a href="<?=  base_url()?>configuracion/reportes/proveedores" target="_blank" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-cloud-download"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                            
                        </div>
                    </div>
                    <table class="table m-b-none table-hover table-condensed " ui-jp="footable" data-filter="#filter" data-page-size="15">
                        <thead>
                            <tr>
                                <th style="width:auto" >Tipo de Persona</th>
                                <th style="width:auto">N° Proveedor</th>
                                <th style="width: auto;">Nombre</th>
                                <th style="width: auto;">RFC</th>
                                <th style="width: auto;" data-hide="all">Código postal</th>
                                <th style="width: auto;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $g):?>
                            <tr id="<?=$g['prov_id']?>" <?=$g['prov_status']?>>
                                <td ><?=$g['prov_tipo']?></td>
                                <td><?=$g['prov_num']?></td>
                                <td >
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
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/conservacion/proveedores.js"></script>
