<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#">Consultorios</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Consultorios</span>
                    <?php if(in_array('25', $_SESSION['IMSS_ROLES'])){?>
                    <a href="<?=  base_url()?>urgencias/consultorios_add?a=add&c=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                            <th >Consultorio</th>
                            <th >Disponibilidad</th>
                            <th >Usuario & Contraseña</th>
                            <th >Especialidad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['consultorio_id']?>">
                            <td><?=$value['consultorio_nombre']?></td>
                            <td>
                                <?php if($value['consultorio_disponibilidad']=='No Disponible'){?>
                                <span class="label red"><?=$value['consultorio_disponibilidad']?></span>
                                <?php }else{?>
                                <span class="label green"><?=$value['consultorio_disponibilidad']?></span>
                                <?php }?>
                                
                            </td>
                            <td><?=$value['consultorio_acceso']?></td>
                             <td><?=$value['consultorio_especialidad']?></td>
                            <td hidden="">
                                <?php if($value['consultorio_listas']=='No Disponible'){?>
                                <span class="label red"><?=$value['consultorio_listas']?></span>
                                <?php }else{?>
                                <span class="label green"><?=$value['consultorio_listas']?></span>
                                <?php }?>
                            </td>
                            <td class="text-center"> 
                                <?php if($value['consultorio_disponibilidad']=='No Disponible'){?>
                                <i class="fa fa-check-circle hidden icono-accion tip disponibilidad-consultorio pointer" data-accion="Disponible" data-id="<?=$value['consultorio_id']?>" data-original-title="Activar Disponibilidad"></i>
                                <?php }else{?>
                                <i class="fa fa-times-circle hidden icono-accion tip disponibilidad-consultorio pointer" data-accion="No Disponible" data-id="<?=$value['consultorio_id']?>" data-original-title="Desactivar Disponibilidad"></i>
                                <?php }?>
                                
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
<script src="<?= base_url('assets/js/os/urgencias/consultorios.js')?>" type="text/javascript"></script>