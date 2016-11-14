<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-9 col-centered">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history2">Áreas</a></li>
                    <li><a href="#" class="back-history1">Roles</a></li>
                    <li><a href="#"><?=$roles[0]['area_rol_nombre']?></a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><?=$roles[0]['area_rol_nombre']?></span>
                    <?php if(in_array('25', $_SESSION['IMSS_ROLES'])){?>
                    <a href="<?=  base_url()?>urgencias/agregar_medicos_list?area=<?=$_GET['area']?>&rol=<?=$_GET['rol_id']?>&perfil=<?=$_GET['perfil']?>" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                    <?php }?>
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
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th >Áreas</th>
                            <th >Rol</th>
                            <th >Usuario</th>
                            <th >Matricula</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['empleado_id']?>">
                            <td><?=$value['area_nombre']?></td>
                            <td><?=$value['area_rol_nombre']?></td>
                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                            <td><?=$value['empleado_matricula']?></td>
                            <td class="text-center"> 
                                <i class="fa fa-trash-o icono-accion eliminar-usuario-area pointer" data-rol="<?=$_GET['rol_id']?>" data-perfil="<?=$value['empleado_area_id']?>" data-id="<?=$value['empleado_id']?>"></i>
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/urgencias/areas.js')?>" type="text/javascript"></script>