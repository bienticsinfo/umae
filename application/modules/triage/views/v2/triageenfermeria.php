<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
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
                    <div class="row" style="margin-top: 40px">
                        <div class="col-md-12" style="padding: 0px">
                            <table class="table m-b-none table-filtros table-bordered table-hover" style="font-size: 11px" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-sort-ignore="true">Hora Cero</th>
                                        <th data-sort-ignore="true">Hora Enfermería</th>
                                        <th data-hide="phone" data-sort-ignore="true" style="width: 20%">Nombre</th>
                                        <th data-sort-ignore="true" style="width: 20%">Procedencia</th>
                                        <th data-sort-ignore="true">TA</th>
                                        <th data-sort-ignore="true">FC</th>
                                        <th data-sort-ignore="true">FR</th>
                                        <th data-sort-ignore="true">TEMP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total_filas=  count($Gestion);
                                    $total_minutos=0;
                                    ?>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr id="<?=$value['triage_id']?>">
                                        <td><?=$value['triage_horacero_f']?> <?=$value['triage_horacero_h']?></td>
                                        <td><?=$value['triage_fecha']?> <?=$value['triage_hora']?></td>
                                        <td ><?=$value['triage_nombre']?>  </td>
                                        <td><?=$value['triage_procedencia']!='' ? $value['triage_procedencia'] : $value['triage_hospital_procedencia'].' '.$value['triage_hostital_nombre_numero'] ?></td>
                                        <td ><?=$value['triage_tension_arterial']?>  </td>
                                        <td ><?=$value['triage_frecuencia_cardiaco']?>  </td>
                                        <td ><?=$value['triage_frecuencia_respiratoria']?>  </td>
                                        <td ><?=$value['triage_temperatura']?> °C </td>



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