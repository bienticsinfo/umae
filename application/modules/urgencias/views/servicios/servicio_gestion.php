<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Gestión de servicios
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            
                            <a href="<?=  base_url()?>urgencias/add_servicio?a=add&s=0">
                                    <button class="btn btn-cons pull-right back-imss">Agregar servicio</button>
                                </a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-condensed" id="example">
                    <thead>
                        <tr>
                            <th style="width:auto">N°</th>
                            <th style="width:auto">Servicio</th>
                            <th style="width:auto" >N° max médicos</th>
                            <th style="width:auto" >N° min médicos</th>
                            <th style="width: auto;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $g):?>
                        <tr id="<?=$g['servicio_id']?>">
                            <td class="v-align-middle"><?=$g['servicio_id']?></td>
                            <td class="v-align-middle"><span class="muted"><?=$g['servicio_nombre']?></span></td>
                            <td><span class="muted"><?=$g['servicio_max_medicos']?></span></td>
                            <td class="v-align-middle"><?=$g['servicio_min_medicos']?></td>
                            <td class="text-center">

                                <a href="<?=  base_url()?>urgencias/add_servicio?a=edit&s=<?=$g['servicio_id']?>" >
                                    <i class="fa fa-pencil tip icono-accion " data-original-title="Editar servicio"></i>
                                </a>&nbsp;
                                <i class="fa fa-trash pointer tip icono-accion eliminar-servicio" data-original-title="Eliminar servico" data-id="<?=$g['servicio_id']?>"></i>
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
<?= modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/os/urgencias/servicios.js"></script>
