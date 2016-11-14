<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Asignación de Dictamen
                </div>
                        <table class="table table-hover table-condensed" id="example">
                            <thead>
                                <tr>
                                    <th style="width:auto">N° Contrato</th>
                                    <th style="width: auto;">Descripción</th>
                                    <th style="width: auto;">Etapa</th>
                                    <th style="width: auto;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $g):?>
                                <tr >
                                    <td class="v-align-middle"><?=$g['contrato_numero_tmp']?></td>
                                    <td class="v-align-middle"><?=  substr($g['contrato_descripcion'], 0,50)?>..</td>
                                    <td class="v-align-middle">
                                    <?php
                                       if($g['contrato_s_d']==''){
                                           echo "Dictamen sin Asignar";
                                           $status='';
                                           $status_='hidden';
                                       }else{
                                           $status='disabled';
                                           $status_='';
                                           echo "Dictamen Asignado";
                                       }
                                    ?></td>
                                    <td class="text-center">
                                        
                                        <a href="<?=  base_url()?>conservacion/contratos/asignardictamen?c=<?=$g['contrato_id']?>">
                                            <button type="button" class="btn back-imss btn-xs btn-mini" <?=$status?>>Asignar Dictamen</button>
                                        </a>
                                        <a href="<?=  base_url()?>conservacion/contratos/cuerpo?c=<?=$g['contrato_id']?>" target="_blank">
                                            <button type="button" class="btn back-imss btn-xs btn-mini" <?=$status_?>>Generar Contrato</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>
