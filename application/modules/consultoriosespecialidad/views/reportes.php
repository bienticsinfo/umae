<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="<?=  base_url()?>consultoriosespecialidad" class="back-history1">Consultorios de Especialidad & Filtro</a></li>
                
                <li><a href="#">Reportes</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">
                        <div class="row">
                            <div class="col-md-6" style="font-size: 15px">
                                Consultorios de Especialidad & Filtro<br>
                                Total de Pacintes: <?=  count($Gestion)?> Pacientes
                            </div>
                            <div class="col-md-6">
                                <h5 style="margin-top: 3px;text-align: right">Tiempo Promedio Transcurrido</h5>
                                <h4 class="total_minutos" style="margin-top: -5px;text-align: right">0 Minutos</h4>
                            </div>
                        </div>
                    </span>
                    <?php if($_GET['fi']){?>
                    <form action="<?=  base_url()?>consultoriosespecialidad/formato_4306_lechuga" target="_blank">
                        <input type="hidden" name="fi" value="<?=$_GET['fi']?>" class="color-black">
                        <input type="hidden" name="ff" value="<?=$_GET['ff']?>" class="color-black">
                        <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>" class="color-black">
                        <input type="hidden" name="triage_color" value="<?=$_GET['triage_color']?>" class="color-black">
                        <input type="hidden" name="hi" value="<?=$_GET['hi']?>" class="color-black">
                        <input type="hidden" name="hf" value="<?=$_GET['hf']?>" class="color-black">
                        <button href="" type="submit" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-placement="left" data-original-title="Generar Formato de 4.30.6 (lechuga)">
                        <i class="fa fa-file-pdf-o icono-accion" style="color: white!important"></i>
                        </button>
                    </form>
                    <?php }?>
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="" style="margin-bottom: 10px">
                        <div class="row">
                            <div class="col-md-2" style='padding-right: 0px'>
                                <select class="width100 select_filter" data-value="<?=$_GET['filter_select']?>">
                                    <option>Buscar por</option>
                                    <option value="by_fecha">Fechas</option>
                                    <option value="by_hora">Hora</option>
                                </select>
                            </div>
                            <form action="<?=  base_url()?>consultoriosespecialidad/reportes" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="ff" value="<?=$_GET['ff']?>" placeholder="AL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <select name="triage_color" class="form-control" data-value="<?=$_GET['triage_color']?>">
                                        <option value="Todos">Todos</option>
                                        <option value="Rojo">Rojo</option>
                                        <option value="Naranja">Naranja</option>
                                        <option value="Amarillo">Amarillo</option>
                                        <option value="Verde">Verde</option>
                                        <option value="Azul">Azul</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                            </form>

                            <form action="<?=  base_url()?>consultoriosespecialidad/reportes" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hi" value="<?=$_GET['hi']?>" placeholder="DE " class="clockpicker form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hf" value="<?=$_GET['hf']?>" placeholder="A" class="clockpicker form-control">
                                </div>
                                <div class="col-md-2">
                                    <select name="triage_color" class="form-control" data-value="<?=$_GET['triage_color']?>">
                                        <option value="Todos">Todos</option>
                                        <option value="Rojo">Rojo</option>
                                        <option value="Naranja">Naranja</option>
                                        <option value="Amarillo">Amarillo</option>
                                        <option value="Verde">Verde</option>
                                        <option value="Azul">Azul</option>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                            </form>
                            
                            <div class="col-md-4 pull-right hide">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" id="filter" placeholder="Filtro General">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table m-b-none table-filtros table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                        <thead>
                            <tr>
                                <th data-sort-ignore="true">Hora Cero</th>
                                <th data-sort-ignore="true">Hora Enfermería</th>
                                <th data-sort-ignore="true">Hora Clasificación</th>
                                <th data-hide="phone" data-sort-ignore="true" style="width: 20%">Nombre</th>
                                <th data-hide="phone" data-sort-ignore="true">Tiempo Transcurrido</th>
                                <th data-hide="phone" data-sort-ignore="true">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_filas=  count($Gestion);
                            $total_minutos=0;
                            ?>
                            <?php foreach ($Gestion as $value) {?>
                            <?php 
                                if($value['triage_color']=='Rojo'){
                                    $background='red';
                                    $color='white';
                                }else if($value['triage_color']=='Naranja'){
                                    $background='orange';
                                    $color='white';
                                }else if($value['triage_color']=='Amarillo'){
                                    $background='yellow-A700';
                                    $color='white';
                                }else if($value['triage_color']=='Verde'){
                                    $background='green';
                                    $color='white';
                                }else if($value['triage_color']=='Azul'){
                                    $background='indigo';
                                    $color='white';
                                }else{
                                    $background='';
                                    $color='';
                                }
                            ?>
                            <tr id="<?=$value['triage_id']?>">
                                <td><?=$value['triage_horacero_f']?> <?=$value['triage_horacero_h']?></td>
                                <td><?=$value['triage_fecha']?> <?=$value['triage_hora']?></td>
                                <td><?=$value['triage_fecha_clasifica']?> <?=$value['triage_hora_clasifica']?></td>
                                <td class="<?=$background?>" style="color: <?=$color?>">
                                    <?=$value['triage_nombre']?>         
                                </td>
                                <td>
                                    <?php 

                                    if($value['triage_fecha_clasifica']!=''){
                                        date_default_timezone_set('America/Mexico_City');
                                        $hora_cero=new DateTime(str_replace('/', '-', $value['triage_horacero_f']).' '.$value['triage_horacero_h']);
                                        $hora_clas=new DateTime(str_replace('/', '-', $value['triage_fecha_clasifica']).' '. $value['triage_hora_clasifica']);
                                        $diff=$hora_cero->diff($hora_clas);

                                        echo $diff->h*60 + $diff->i. ' Minutos'; 
                                        $total_minutos=$total_minutos+$diff->h*60 + $diff->i;
                                    }else{
                                        echo 'Sin Clasificar';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if($value['triage_status']=='En proceso' || $value['triage_status']=='En Captura'){?>
                                    <span class="label light-blue"><?=$value['triage_status']?></span>
                                    <?php }else{?>
                                    <a href="<?=  base_url()?>consultoriosespecialidad/paciente?id=<?=$value['triage_id']?>" target="_blank">
                                        <span class="label green">Finalizado&nbsp;&nbsp;</span>
                                    </a>
                                    <?php }?>
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
                    <input type="hidden" name="total_minutos" value="<?=  ceil($total_minutos/$total_filas)?>"> 
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>