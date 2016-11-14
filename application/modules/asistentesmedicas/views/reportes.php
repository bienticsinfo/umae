<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="<?=  base_url()?>asistentesmedicas" class="back-history1">Asistentes Médicas</a></li>
                
                <li><a href="#">Reportes</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">Reportes</span>
                </div>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-2" style='padding-right: 0px'>
                            <select class="width100 select2 select_filter">
                                <option>Buscar por</option>
                                <option value="by_fecha">Fechas</option>
                                <option value="by_hora">Hora</option>
                                <option value="by_like">Busqueda especifica</option>
                            </select>
                        </div>
                        <form action="<?=  base_url()?>asistentesmedicas/reportes" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
                            <div class="col-md-2">
                                <input type="text" name="fi" value="<?=$_GET['fi']?>" placeholder="DEL " class="dd-mm-yyyy form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="ff" value="<?=$_GET['ff']?>" placeholder="AL " class="dd-mm-yyyy form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                        
                        <form action="<?=  base_url()?>asistentesmedicas/reportes" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
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
                                <input type="hidden" name="filter_select" value="<?=$_GET['filter_select']?>">
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                        <form action="<?=  base_url()?>asistentesmedicas/reportes" class="by_like <?=$_GET['filter_select']=='by_like'?'':'hide'?>" method="GET">
                            <div class="col-md-2">
                                <select class="width100 select2" name="filter_by">
                                    <option value="triage_id">Papeleta</option>
                                    <option value="triage_nombre" selected="">Nombre</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="like" value="<?=$_GET['like']?>" placeholder="Ejemplo: felipe de jesus "class="form-control">
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
                <table class="table m-b-none table-filtros table-bordered table-hover table-striped" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th style="width: 15%">N.S.S</th>
                                    <th data-hide="phone" style="width: 20%">Paciente</th>
                                    <th data-hide="phone" style="width: 15%">Hora A.M</th>
                                    <th>U.M.F</th>
                                    <th style="width: 15%">Procedencia</th>
                                    <th>Destino</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $value) {?>

                                <tr id="<?=$value['triage_id']?>">
                                    <td>
                                        <a href="<?=  base_url()?>asistentesmedicas/paciente?p=<?=$value['triage_id']?>" target="_blank">
                                            <span class="label green"><?=$value['triage_id']?></span>
                                        </a>
                                    </td>
                                    <td><?=$value['triage_paciente_afiliacion']?></td>
                                    <td><?=$value['triage_nombre']?> </td>
                                    <td><?=$value['asistentesmedicas_fecha']?> <?=$value['asistentesmedicas_hora']?> </td>
                                    <td><?=$value['triage_paciente_umf']?> </td>
                                    <td><?=$value['triage_procedencia']?> </td>
                                    <td><?=$value['triage_consultorio_nombre']?></td>
                                    
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
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>