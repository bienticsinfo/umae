<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-8 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history3">Áreas</a></li>
                    <li><a href="#" class="back-history2">Roles</a></li>
                    <li><a href="#" class="back-history1"><?=$roles[0]['area_rol_nombre']?></a></li>
                    <li><a href="#" class="">Nuevo</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Seleccionar Usuario</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip hidden" data-original-title="Agregar Usuarios">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                    <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="6" data-limit-navigation="7">
                        <thead>
                            <tr>
                                <th style="width: 70%">Nombre</th>
                                <th style="width: 30%">Matricula</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $value) {?>
                            <tr id="<?=$value['empleado_id']?>">
                                <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                                <td><?=$value['empleado_matricula']?></td>
                                <td class="text-center"> 

                                    <form class="agregar-perfil-area-medico">
                                        <input type="hidden" name="empleado_id" value="<?=$value['empleado_id']?>">
                                        <input type="hidden" name="csrf_token">
                                        <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="area_id" value="<?=$_GET['area']?>">
                                        <input type="hidden" name="rol_id" value="<?=$_GET['rol']?>">
                                        <input type="hidden" name="area_rol_id" value="<?=$_GET['perfil']?>">
                                        <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Agregar</button>                     
                                    </form>               
                                    
                                </td>
                            </tr>
                            <?php }?>

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
<script src="<?= base_url('assets/js/os/urgencias/areas.js')?>" type="text/javascript"></script>