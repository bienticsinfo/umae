<?php echo modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Jefa Enfermeras</a></li>
            </ol>
            
            <div class="col-md-12 ">
                <div class="panel panel-default ">
                    <div class="panel-body b-b b-light">
                        <form action="<?=  base_url()?>urgencias/graficas">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Configuración de Visor</h6>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="fi_v" value="<?=$_GET['fi_v']?>" placeholder="Fecha " class="dd-mm-yyyy form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="hi_v" value="<?=$_GET['hi_v']?>" placeholder="Hora inicio" class="clockpicker form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="hf_v" value="<?=$_GET['hf_v']?>" placeholder="Hora termino" class="clockpicker form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="filter_select_v2" value="filter_visor">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                                
                            </div>
                        </form>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-4">
                                <div class="card green t_mv" data-value="<?=$hora_cero?>">
                                    <div class="card-heading text-center">
                                    <h2>Hora Cero</h2>
                                        <small style="color: white!important;opacity: 1"><?=$hora_cero?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card indigo t_mnv" data-value="<?=$no_clasificados?>">
                                    <div class="card-heading text-center">
                                    <h2>No Clasificados</h2>
                                    <small style="color: white!important;opacity: 1"><?=$no_clasificados?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card blue t_mc" data-value="<?=$clasificados?>">
                                    <div class="card-heading text-center">
                                    <h2>Clasificados</h2>
                                        <small style="color: white!important;opacity: 1"><?=$clasificados?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-2" style='padding-right: 0px'>
                                <select class="width100 select_filter" data-value="<?=$_GET['filter_select']?>">
                                    <option>Buscar por</option>
                                    <option value="by_fecha">Fechas</option>
                                    <option value="by_hora">Hora</option>
                                    <option value="by_like">Busqueda especifica</option>
                                </select>
                            </div>
                            <form action="<?=  base_url()?>urgencias/graficas" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
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

                            <form action="<?=  base_url()?>urgencias/graficas" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
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
                            <form action="<?=  base_url()?>urgencias/graficas" class="by_like <?=$_GET['filter_select']=='by_like'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <select class="width100 select2" name="filter_by">
                                        <option value="triage_id">Papeleta</option>
                                        <option value="triage_nombre" selected="">Nombre</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="like" value="<?=$_GET['like']?>" placeholder="Ejemplo: felipe "class="form-control">
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
                                        <th>Hora Cero</th>
                                        <th>Hora Enfermería</th>
                                        <th>Hora Clasificación</th>
                                        <th data-hide="phone">Nombre</th>
                                        <th data-hide="phone">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <td class="<?=$background?>" style="color: <?=$color?>"><?=$value['triage_nombre']?> </td>

                                        <td>
                                            <?php if($value['triage_status']=='En proceso' || $value['triage_status']=='En Captura'){?>
                                            <span class="label light-blue"><?=$value['triage_status']?></span>
                                            <?php }else{?>
                                            <a href="<?=  base_url()?>triage/paciente?id=<?=$value['triage_id']?>">
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/os/urgencias/graficas.js"></script>
<script src="<?=  base_url()?>assets/js/os/triage/triage.js"></script>

