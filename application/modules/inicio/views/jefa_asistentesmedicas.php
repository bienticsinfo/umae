<?php echo modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Jefa Asistentes Médicas</a></li>
            </ol>
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
                            <form action="<?=  base_url()?>inicio/jefa_asistentesmedicas" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="input-date form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="ff" value="<?=$_GET['ff']?>" placeholder="AL " class="input-date form-control">
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

                            <form action="<?=  base_url()?>inicio/jefa_asistentesmedicas" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
                                <div class="col-md-2">
                                    <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="input-date form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hi" value="<?=$_GET['hi']?>" placeholder="DE " class="input-time form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="hf" value="<?=$_GET['hf']?>" placeholder="A" class="input-time form-control">
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
                            <form action="<?=  base_url()?>inicio/jefa_asistentesmedicas" class="by_like <?=$_GET['filter_select']=='by_like'?'':'hide'?>" method="GET">
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
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-12" >
                                <h3>Total de registros encontrados: <?=  count($Gestion)?> Registros</h3><br><br>
                            </div>
                            <div class="col-md-6">
                                <div ui-jp="plot" ui-options="
                                     [{label:'Clasificados', data: <?=  count($CLASIFICADOS)?>}, {label:'No Clasificados', data: <?=  count($NO_CLASIFICADOS)?>}],
                                  {
                                    series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                                    colors: ['#4CAF50','#078BF4'],
                                    grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#212121' },   
                                    tooltip: true,
                                    tooltipOpts: { content: '%s: %p.0%' }
                                  }
                                " style="height:240px"></div>
                            </div>
                            <div class="col-md-6" style="padding: 0px;border-left: 2px solid #256659">
                                <div ui-jp="plot" ui-options="
                                     [{label:'Reanimación', data: <?=  count($CLASIFICADOS)?>}, {label:'Emergencia', data: <?=  count($NO_CLASIFICADOS)?>},{label:'Urgencia',data:<?=$NO_CLASIFICADOS?>}, {label:'Urgencia Menor',data:<?=$NO_CLASIFICADOS?>}, {label:'Sin Urgencia',data:<?=$NO_CLASIFICADOS?>}],
                                  {
                                    series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                                    colors: ['#F92718','#FF9800','#FFC107','#00C853','#2196F3'],
                                    grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#212121' },   
                                    tooltip: true,
                                    tooltipOpts: { content: '%s: %p.0%' }
                                  }
                                " style="height:240px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/os/urgencias/graficas.js"></script>
<script src="<?=  base_url()?>assets/js/os/inicio/filtros.js"></script>
<script src="<?=  base_url()?>assets/js/os/triage/triage.js"></script>

