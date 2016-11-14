<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Áreas</a></li>
                    <li><a href="#"><?=$area[0]['area_nombre']?></a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><?=$area[0]['area_nombre']?></span>
                    <a href="<?=  base_url()?>urgencias/camas_add?a=add&c=0&area=<?=$_GET['area']?>" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th >Cama</th>
                            <th >Status</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['cama_id']?>">
                            <td><?=$value['cama_nombre']?></td>
                            <td>
                                <?php if($value['cama_status']=='Disponible'){?>
                                <span class="label teal">Disponible</span>
                                <?php }?>
                                <?php if($value['cama_status']=='Ocupado'){?>
                                <span class="label amber">Ocupado</span>
                                <?php }?>
                                <?php if($value['cama_status']=='En Mantenimiento' || $value['cama_status']=='En Limpieza'){?>
                                <span class="label blue"><?=$value['cama_status']?></span>
                                <?php }?>
                            </td>
                            <td class="text-center">   
                                
                                <?php if($value['cama_status']=='Disponible'){?>
                                <i class="fa fa-paint-brush dar-mantenimiento icono-accion tip pointer" data-id="<?=$value['cama_id']?>" data-accion="En Limpieza" data-original-title="En Limpieza"></i>&nbsp;
                                <i class="fa fa-wrench dar-mantenimiento icono-accion tip pointer" data-id="<?=$value['cama_id']?>" data-accion="En Mantenimiento" data-original-title="En mantenimiento"></i>&nbsp;
                                <a hidden="" href="<?=  base_url()?>urgencias/derechohabiente?c=<?=$value['cama_id']?>">
                                    <i class="fa fa-user-plus icono-accion tip" data-original-title="Agregar Derechohabiente"></i>
                                </a>&nbsp;
                                <?php }if($value['cama_status']=='En Mantenimiento' || $value['cama_status']=='En Limpieza'){?>
                                <i class="fa fa-wrench dar-mantenimiento icono-accion tip pointer" data-id="<?=$value['cama_id']?>" data-accion="Disponible" data-original-title="Finalizar mantenimiento / Limpieza"></i>&nbsp;
                                <i class="fa fa-user-times icono-accion tip" data-original-title="Cama en Mantenimiento / Limpieza"></i>
                                <?php }?>
                                <?php if($value['cama_status']=='Ocupado'){?>
                                <a href="<?=  base_url()?>urgencias/derechohabiente?c=<?=$value['cama_id']?>">
                                    <i class="fa fa-share icono-accion tip" data-original-title="Dar de alta al Derechohabiente"></i>
                                </a>&nbsp; 
                                <i class="fa fa-user-times icono-accion tip" data-original-title="Cama NO Disponible"></i>
                                <?php }?>

                                <?php if(in_array('25', $_SESSION['IMSS_ROLES'])){?>
                                
                                <a href="<?=  base_url()?>urgencias/camas_add?a=edit&c=<?=$value['cama_id']?>&area=<?=$_GET['area']?>">
                                    <i class="fa fa-pencil icono-accion"></i>
                                </a>&nbsp;
                                <i class="fa fa-trash-o icono-accion eliminar-cama pointer" data-id="<?=$value['cama_id']?>"></i>
                                <?php } ?>
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
<script src="<?= base_url('assets/js/os/urgencias/camas.js')?>" type="text/javascript"></script>