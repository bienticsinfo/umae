<?= modules::run('menu/index'); ?> 
<div class="box-row">  
    <div class="box-cell"> 
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#" class="back-history2">Triage</a></li>
                <li><a href="#" class="back-history1">Cortes</a></li>
                <li class="active">Buscar Pacientes</li>
            </ol>
            
            <div class="col-md-12" style="margin-top: -10px">
                <div class="panel no-border">
                    <div class="panel-heading back-imss">
                        <span class="">Buscar pacientes</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="GET" action="<?=  base_url()?>triage/buscar_pacientes">
                            <div class="col-md-3">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" name="like" class="form-control" value="<?=$_GET['like']?>" placeholder="Buscar...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="select2 width100" name="filtro_by">
                                    <option value="triage_id">N° de identificador de paciente</option>
                                    <option value="triage_nombre">Nombre del Paciente</option>
                                    <option value="triage_hora">Hora de Creación</option>
                                    <option value="triage_fecha">Fecha de Creación</option>
                                    <option value="triage_color">Color (Toma de decisión)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary pull-left " type="submit">Buscar</button>
                                </div>
                            </div>  
                            </form>
                            <div class="col-md-4">
                                <div class="input-group m-b ">

                                    <input type="text" name="" class="form-control" id="filter" placeholder="Busqueda General">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                </div>
                            </div>    
                        </div>
                        <table class="table m-b-none table-filtros" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="false" data-toggle="true">N°</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th data-hide="phone" style="width: 25%">Nombre</th>
                                    <th>Puntaje</th>
                                    <th data-hide="phone">Estado</th>
                                    <th data-sort-ignore="true" class="text-center" style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $value) {?>
                                <?php 
                                    if($value['triage_puntaje_total']>30){
                                        $background='red';
                                        $color='white';
                                    }if($value['triage_puntaje_total']>=21 && $value['triage_puntaje_total']<=30){
                                        $background='orange';
                                        $color='white';
                                    }if($value['triage_puntaje_total']>=11 && $value['triage_puntaje_total']<=20){
                                        $background='amber';
                                        $color='white';
                                    }if($value['triage_puntaje_total']>=6 && $value['triage_puntaje_total']<=10){
                                        $background='green';
                                        $color='white';
                                    }if($value['triage_puntaje_total']<=5){
                                        $background='indigo';
                                        $color='white';
                                    }


                                ?>

                                <tr id="<?=$value['triage_id']?>" >
                                    <td><?=$value['triage_id']?></td>
                                    <td><?=$value['triage_fecha']?></td>
                                    <td><?=$value['triage_hora']?></td>
                                    <td><?=$value['triage_nombre']?> </td>
                                    <td style="background: ;color: <?=$color?>;text-align: center;">
                                        <?php if($value['triage_etapa']=='2'){?>
                                        <span class="label <?=$background?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['triage_puntaje_total']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        <?php }else{?>
                                        <span class="label blue">No Clasificado</span>
                                        <?php } ?>

                                    </td>
                                    <td>
                                        <?php if($value['triage_status']=='En proceso'){?>
                                        <span class="label light-blue">En Proceso</span>
                                        <?php }else{?>
                                        <span class="label green">Finalizado&nbsp;&nbsp;</span>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">

                                        <?php if(in_array('34', $_SESSION['IMSS_ROLES'])  && $value['triage_etapa']=='1'){?>
                                        <a href="<?=  base_url()?>triage/paso2?t=<?=$value['triage_id']?>">
                                            <i class="fa fa-stethoscope icono-accion tip" data-original-title="Evaluar Paciente"></i>
                                        </a>&nbsp;

                                        <?php } ?>
                                        <?php if(in_array('34', $_SESSION['IMSS_ROLES'])  && $value['triage_etapa']=='2' && $value['triage_solicitud']==''){?>
                                        <a href="<?=  base_url()?>triage/solicitar_rx?t=<?=$value['triage_id']?>" class="solicitar-estidios-rx" data-id="<?=$value['triage_id']?>">
                                            <i class="fa fa-medkit pointer  icono-accion tip" data-original-title="Solicitar RX"></i>&nbsp;
                                        </a>

                                        <?php } ?>     
                                        <?php if($value['triage_solicitud_rx']=='Si'){?>
                                        <a href="<?=  base_url()?>asistentesmedicas/estudios_clinicos?t=<?=$value['triage_id']?>" target="_blank">
                                            <i class="fa fa-medkit tip icono-accion" data-original-title="Ver estudios clinicos"></i>
                                        </a>&nbsp;
                                        <?php }?>
                                        <?php if( $value['triage_etapa']=='2'){?>
                                        <a href="<?=  base_url()?>triage/generar_documento?t=<?=$value['triage_id']?>" target="_blank">
                                            <i class="fa fa-file-pdf-o icono-accion tip" data-original-title="Generar Documento"></i>
                                        </a>&nbsp;
                                        <?php } ?>
                                        
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>