<?=  Modules::run('config/getHeadAdmin')?>
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Gestión de usuarios
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
                            
                            <a href="<?=  base_url()?>conservacion/usuarios/add?a=add&u=0">
                                    <button class="btn btn-cons pull-right back-imss">Agregar usuario</button>
                                </a>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-condensed" id="example">
                    <thead>
                        <tr>
                            <th style="width:auto">Nombre</th>
                            <th style="width:auto">Telefono</th>
                            <th style="width:auto" >Email</th>
                            <th style="width:auto" >Rol</th>
                            <th style="width: auto;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $g):?>
                        <tr id="<?=$g['usuario_id']?>">
                            <td class="v-align-middle"><?=$g['usuario_nombre']?> <?=$g['usuario_apellidos']?></td>
                            <td class="v-align-middle"><span class="muted"><?=$g['usuario_telefono']?></span></td>
                            <td><span class="muted"><?=$g['usuario_email']?></span></td>
                            <td class="v-align-middle"><?=$g['rol_tipo']?></td>
                            <td class="text-center">

                                <a href="<?=  base_url()?>conservacion/usuarios/add?a=edit&u=<?=$g['usuario_id']?>" hidden="">
                                    <i class="fa fa-pencil tip" data-original-title="Editar usuario"></i>
                                </a>&nbsp;
                                <i class="fa fa-trash pointer tip" data-original-title="Eliminar usuario" data-id="<?=$g['usuario_id']?>"></i>
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
<script src="<?=  base_url()?>assets/js/conservacion/usuarios.js"></script>
