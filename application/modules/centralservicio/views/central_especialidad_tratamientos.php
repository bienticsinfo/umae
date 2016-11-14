<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: 20px">
            <ul class="breadcrumb">
                <li><a >Inicio</a></li>
                <li><a href="#" class="back-history1">Central de Servicios</a></li>
                <li><a href="#" class="">Tratamientos</a></li>
            </ul>
        </div>
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Tratamientos</span>
                    <a href="<?=  base_url()?>centralservicio/addtratamiento?a=add&i=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
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
                            <th >N°</th>
                            <th>Tratamiento</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['tratamiento_id']?>">
                            <td><?=$value['tratamiento_id']?></td>
                            <td><?=$value['tratamiento_nombre']?> </td>
                            <td class="text-center"><?=$value['tratamiento_descripcion']?> </td>
                            <td class="text-center">                            
                                <a href="<?=  base_url()?>centralservicio/terapias?t=<?=$value['tratamiento_id']?>">
                                    <i class="fa fa-medkit icono-accion tip" data-original-title="Agregar terapia"></i>
                                </a>&nbsp;&nbsp;
                                <a href="">
                                    <i class="fa fa-pencil icono-accion tip" data-original-title="Editar"></i>
                                </a>&nbsp;&nbsp;
                                <i class="fa fa-trash-o icono-accion pointer tip" data-original-title="ELiminar"></i>
                            </td>
                        </tr>
                        <?php } ?>
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
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>