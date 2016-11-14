<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Contratos
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
                            <a href="<?=  base_url()?>conservacion/reportes/contratos" target="_blank">
                                <i class="fa fa-cloud-download pull-right fa-2x pointer tip text-imss"  style="margin-top: 3px!important" data-original-title="Exportar a EXCEL"></i>
                            </a>
                        </div>
                        <div class="col-md-2">
                            
                            <a href="<?=  base_url()?>conservacion/contratos/agregar">
                                <button class="btn btn-cons pull-right back-imss">Agregar Contrato</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                <table class="table m-b-none " ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th style="width:auto">N° Contrato</th>
                            <th style="width:auto">Area Solicitante</th>
                            <th style="width:auto">Contrato de</th>
                            <th style="width:auto">Persona</th>
                            <th style="width: auto;">Etapa</th>
                            <th style="width: auto;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $g):?>
                        <tr id="<?=$g['contrato_id']?>">
                            <td class="v-align-middle"><?=$g['contrato_numero_tmp']?></td>
                            <td class="v-align-middle"><?=$g['contrato_area_solicitante']?></td>
                            <td class="v-align-middle"><?=$g['contrato_tipo_s']?></td>
                            <td class="v-align-middle"><?=$g['prov_tipo']?></td>
                            <td class="v-align-middle"><?=$g['contrato_status']?></td>
                            <td class="text-center">
                                <?php if($g['contrato_status']=='Asignar Dictamen Previo'){ ?>
                                <a href="<?=  base_url()?>conservacion/contratos/asignardictamenprevio?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip " data-original-title="Asignar Dictamen Previo">Asignar Dictamen Previo</button>
                                </a>
                                <?php }if($g['contrato_status']=='Asignar N° PREI'){ ?>
                                <a href="<?=  base_url()?>conservacion/contratos/asignarprei?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Asignar N° PREI">Asignar N° PREI</button>
                                </a>
                                <?php }if($g['contrato_status']=='Caratulas'){?>

                                <?php }if($g['contrato_c_f']=='' && $g['contrato_status']=='Caratulas'){ ?>
                                <a href="<?=  base_url()?>conservacion/contratos/generarcaratula?c=<?=$g['contrato_id']?>" target="_blanck">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Generar Caratula">C</button>
                                </a>
                                <a href="<?=  base_url()?>conservacion/contratos/fianza?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" style="opacity: 0.6" data-original-title="Fianza">F</button>
                                </a>
                                <button type="button" class="btn btn-primary btn-xs btn-mini tip" disabled="" data-original-title="No adeudo IMSS">I</button>
                                <button type="button" class="btn btn-primary btn-xs btn-mini tip " disabled="" data-original-title="No adeudo SAT">S</button>
                                <?php } if($g['contrato_c_i']=='' && $g['contrato_c_f']!='' && $g['contrato_status']=='Caratulas'){ ?>
                                <a href="<?=  base_url()?>contratos/generarcaratula?c=<?=$g['contrato_id']?>" target="_blanck">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Generar Caratula">C</button>
                                </a>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip " data-original-title="Fianza">F</button>
                                <a href="<?=  base_url()?>conservacion/contratos/noadeudoimss?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" style="opacity: 0.6" data-original-title="No adeudo IMSS">I</button>
                                </a>
                                <button type="button" class="btn btn-primary btn-xs btn-mini tip" disabled="" data-original-title="No adeudo SAT">S</button>
                                <?php }if($g['contrato_c_s']=='' && $g['contrato_c_i']!='' && $g['contrato_c_f']!='' && $g['contrato_status']=='Caratulas'){ ?>
                                <a href="<?=  base_url()?>conservacion/contratos/generarcaratula?c=<?=$g['contrato_id']?>" target="_blanck">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Generar Caratula">C</button>
                                </a>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip " data-original-title="Fianza">F</button>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip " data-original-title="No adeudo IMSS">I</button>
                                <a href="<?=  base_url()?>conservacion/contratos/noadeudosat?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="No adeudo SAT" style="opacity: 0.6">S</button>
                                </a>
                                <?php } 
                                if($g['contrato_status']=='Asignar Dictamen'){
                                    if($g['contrato_tipo_s']!=''){
                                ?>
                                <a href="<?=  base_url()?>conservacion/contratos/generarcaratula?c=<?=$g['contrato_id']?>" target="_blank">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Generar Caratula">C</button>
                                </a>
                                <?php }?>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Fianza">F</button>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="No adeudo IMSS">I</button>
                                <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="No adeudo SAT">S</button>
                                <a href="<?=  base_url()?>conservacion/contratos/dictamen?c=<?=$g['contrato_id']?>">
                                    <button type="button" class="btn back-imss btn-xs btn-mini tip" data-original-title="Agregar Dictamen"><i class="fa fa-arrow-right"></i></button>
                                </a>
                                <?php }?>
                                <button type="button" class="btn btn-success btn-xs btn-mini tip " data-id="<?=$g['contrato_id']?>" data-original-title="Modificar contrato">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs btn-mini tip " data-id="<?=$g['contrato_id']?>" data-original-title="Eliminar contrato">
                                    <i class="fa fa-trash-o"></i>
                                </button>
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
</div>

<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>
