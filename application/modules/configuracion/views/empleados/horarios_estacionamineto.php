<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-8 col-gestion-horarios col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Horarios de estacionamiento</span>
                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b btn-add-horario green waves-effect pull-right">
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
                    <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">
                        <thead>
                            <tr>
                                <th >Dia</th>
                                <th data-hide="phone">Entrada</th>
                                <th data-hide="phone">Salida</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($Gestion as $value) {?>
                            <tr id="<?=$value['horarios_id']?>">
                                <td><?=$value['horarios_dia']?></td>
                                <td><?=$value['horarios_hora_e']?> </td>
                                <td><?=$value['horarios_hora_s']?> </td>
                                <td class="text-center">
                                    <i data-id="<?=$value['horarios_id']?>" data-original-title="Eliminar" class="tip fa fa-trash-o pointer icono-accion del-horario"></i>
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
        <div class="col-md-4 col-add-horario hide">
            <div class="box-inner padding">
                <div class="card"  >
                    <div class="card-heading back-imss">
                        <h2 style="font-size: 15px;font-weight: 500">Agregar horario</h2>
                    </div>
                    <div class="card-body">
                        <form class="registrar-horario">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <input type="hidden" id="empleado_id" name="empleado_id" value="<?=$_GET['u']?>">
                                </div>
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -10px">
                                        <label  style="opacity: 1;">Agregar Dias</label><br>
                                        <input  class="tagsinput" name="horarios_dia" style="width: 100%" >
   
                                    </div>
                                    <div class="md-form-group" style="margin-top: -30px;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label  style="opacity: 1">Hora de entrada:</label>
                                                <input class="md-input clockpicker" name="horarios_hora_e" id="horarios_hora" >
                                            </div>
                                            <div class="col-md-6">
                                                <label  style="opacity: 1">Hora de salida:</label>
                                                <input class="md-input clockpicker" name="horarios_hora_s"  id="horarios_hora" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="md-form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button  type="button" class="btn-save md-btn btn-fw back-imss waves-effect btn-cancelar pull-right" >Cancelar</button>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="csrf_token">
                                                <button  type="submit" class="btn-save md-btn  btn-fw back-imss waves-effect  pull-right">Guardar</button>&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/configuracion/empleados.js')?>" type="text/javascript"></script>