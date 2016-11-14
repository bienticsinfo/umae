<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell ">
        
        <div class="box-inner padding col-md-12 col-centered">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="<?=  base_url()?>centralservicio">Central de Servicios</a></li>
                    <li><a href="<?=  base_url()?>centralservicio/verterapias?p=<?=$_GET['p']?>">Terapias</a></li>
                    <li><a>Adminstrar fechas de terapias</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Adminstrar fechas de terapias</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row toogle-add-terapia">
                        <div class="col-md-3">
                            <div class="form-actions ">
                                <input type="text" placeholder="Hora de inicio" class="form-control clockpicker terapiafecha_hora_i width100" >  
                            </div>   
                        </div>             
                        <div class="col-md-3">
                            <div class="form-actions m-b ">
                                <input type="text" placeholder="Hora de Fin" class="form-control clockpicker terapiafecha_hora_f width100" >
                            </div>   
                        </div>
                        <div class="col-md-3">
                            <div class="input-group m-b ">
                                <input type="text" placeholder="Fecha de terapia" class="form-control fecha-calendar fecha-teparia" >
                                <span class="input-group-addon back-imss no-border pointer btn-add-fecha-terapia" data-id="<?=$_GET['t']?>"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Terapia</th>
                            <th>Fecha de terapia</th>
                            <th>Hora</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['terapiafecha_id']?>">
                            <td><?=$value['terapiafecha_id']?></td>
                            <td><?=$value['terapia_nombre']?></td>
                            <td><?=$value['terapiafecha_fecha']?> </td>
                            <td><?=$value['terapiafecha_hora_f']?> - <?=$value['terapiafecha_hora_i']?> </td>
                            <td class="text-center">                            
                                <i class="fa fa-trash-o icono-accion tip delete-fecha-teparia pointer" data-id="<?=$value['terapiafecha_id']?>" data-original-title="Eliminar fecha"></i>
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