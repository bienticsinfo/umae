<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="<?=  base_url()?>triage/triagemedico" class="back-history1">Triage</a></li>
                
                <li><a href="#">Reportes</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">
                        <div class="row">
                            <div class="col-md-4">
                                Total de Pacintes: <?=  count($CLASIFICADOS)+count($NO_CLASIFICADOS)?> Pacientes<br>
                                Documentos Clasificados: <?=  count($CLASIFICADOS)?> Documentos<br>
                                Documentos NO Clasificados: <?=  count($NO_CLASIFICADOS)?> Documentos 
                            </div>
                            <div class="col-md-8">
                                <h4 style="margin-top: 3px;text-align: right">Tiempo Promedio Transcurrido</h4>
                                <h3 class="total_minutos" style="margin-top: -5px;text-align: right">0 Minutos</h3>
                            </div>
                        </div>
                    </span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip show-hide-grafica" data-original-title="Ver Gráfica" style="position: absolute;right: 50px;">
                        <i class="fa fa-arrow-down"></i>
                    </a>  
                </div>
                <div class="panel-body  show-hide-grafica-panel" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if(count($CLASIFICADOS)!=0 || count($NO_CLASIFICADOS)!=0){?>
                            <div ui-jp="plot" ui-options="
                              [{label:'Clasificados (<?=  count($CLASIFICADOS)?>)', data: <?=  count($CLASIFICADOS)?>}, {label:'No Clasificados (<?=  count($NO_CLASIFICADOS)?>)', data: <?=  count($NO_CLASIFICADOS)?>}],
                              {
                                series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                                colors: ['#2196F3','#4CAF50'],
                                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                                tooltip: true,
                                tooltipOpts: { content: '%s: %p.0%' }
                              }
                            " style="height:350px;width: 100%"></div>
                            <?php }else{?>
                            <center>
                                 <h1>NO HAY DOCUMENTOS CLASIFICADOS</h1>
                             </center>
                            <?php }?>
                        </div>
                        <div class="col-md-6">
                            <?php if(count($CLASIFICADOS)!=0){?>
                            <div ui-jp="plot" ui-options="
                                [{label:'Reanimación (<?=  count($triage_rojo)?>)', data: <?=  count($triage_rojo)?>}, {label:'Emergencia (<?=  count($triage_naranja)?>)', data: <?=  count($triage_naranja)?>}, {label:'Urgencia (<?=  count($triage_amarillo)?>)', data: <?=  count($triage_amarillo)?>}, {label:'Urgencia Menor (<?=  count($triage_verde)?>)', data: <?=  count($triage_verde)?>}, {label:'Sin Urgencia (<?=  count($triage_azul)?>)', data: <?=  count($triage_azul)?>}],
                                {
                                    series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
                                    colors: ['#E50914','#FF7028','#FDE910','#4CBB17','#0000FF'],
                                    grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                                    tooltip: true,
                                    tooltipOpts: { content: '%s: %p.0%' }
                                }
                            " style="height:350px;width: 100%"></div>
                            <?php }else{?>
                            <center>
                                 <h1>NO HAY DOCUMENTOS CLASIFICADOS</h1>
                             </center>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-2" style='padding-right: 0px'>
                            <select class="width100 select_filter" data-value="<?=$_GET['filter_select']?>">
                                <option selected="">Buscar por</option>
                                <option value="by_fecha">Fechas</option>
                                <option value="by_hora">Hora</option>
                                <option value="by_like">Búsqueda específica</option>
                            </select>
                        </div>
                        <form action="<?=  base_url()?>triage/indicadores" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
                            <div class="col-md-2">
                                <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="ff" value="<?=$_GET['ff']?>" placeholder="AL " class="dd-mm-yyyy form-control">
                            </div>
                            <div class="col-md-2">
                                <select name="triage_color" class="form-control" data-value="<?=$_GET['triage_color']?>">
                                    <option value="Todos" selected="">Todos</option>
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
                        
                        <form action="<?=  base_url()?>triage/indicadores" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
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
                                    <option value="Todos" selected="">Todos</option>
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
                        <form action="<?=  base_url()?>triage/indicadores" class="by_like <?=$_GET['filter_select']=='by_like'?'':'hide'?>" method="GET">
                            <div class="col-md-2">
                                <select class="width100 select2" name="filter_by" data-value="<?=$_GET['filter_by']?>">
                                    <option value="triage_id">Papeleta</option>
                                    <option value="triage_nombre" selected="">Nombre</option>
                                    <option value="triage_color">Color</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="like" value="<?=$_GET['like']?>" placeholder="Ejemplo: Juan "class="form-control">
                            </div>
                            <div class="col-md-2">
                                <select name="triage_color" class="form-control" data-value="<?=$_GET['triage_color']?>">
                                    <option value="Todos" selected="">Todos</option>
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
                <input type="hidden" name="total_minutos" value="<?=  ceil($total_minutos/$total_filas)?>"> 
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>