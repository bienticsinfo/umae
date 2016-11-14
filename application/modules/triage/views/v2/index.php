<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Triage</a></li>
            </ol>    
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Procedimiento para la clasificación de pacientes</span>
                    <a href="<?=  base_url()?>triage/indicadores" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Reportes">
                        <i class="fa fa-pie-chart fa-2x" style="    margin-top: 10px;margin-left: 5px;"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12" style="padding-left: 0px">
                            <div class="input-group ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="input_search" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="panel panel-default " style="margin-top: 0px">
                <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">
                        <div class="row">
                            <div class="col-md-4">
                                Total de Pacientes
                            </div>
                        </div>
                    </span>
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>