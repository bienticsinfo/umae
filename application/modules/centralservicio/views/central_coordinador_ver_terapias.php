<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a a href="<?=  base_url()?>centralservicio">Central de Servicios</a></li>
                    <li><a>Terapias</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Administracion de terapias</span>
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
                            <th >N° de Programación</th>
                            <th >Fecha de Programación</th>
                            <th >Tratamiento</th>
                            <th>Terapia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <?php if($value['programacion_tratamiento']=='Tratamientos asignados'){?>
                        <tr id="<?=$value['derechohabiente_nss']?>">
                            <td><?=$value['programacion_id']?></td>
                            <td><?=$value['programacion_fecha']?></td>
                            <td><?=$value['tratamiento_nombre']?> </td>
                            <td ><?=$value['terapia_nombre']?></td>
                            <td class="text-center">                            
                                <a href="<?=  base_url()?>centralservicio/administrarfechas?t=<?=$value['terapia_id']?>&p=<?=$_GET['p']?>">
                                    <i class="fa fa-clock-o icono-accion tip" data-original-title="Asignar fechas"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
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