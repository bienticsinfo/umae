<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="<?=  base_url()?>triage/horacero" >Hora Cero</a></li>
                <li><a href="#">Indicadores</a></li>
            </ol> 
            <div class="panel no-border">
                <div class="panel-heading back-imss">
                    <span class="">
                        <div class="row">
                            <div class="col-md-4">
                                TOTAL DE TICKES GENERADOS : <b><?=  count($Gestion)?> Tickets</b>
                            </div>
                        </div>
                    </span> 
                </div>
                <div class="panel-body  show-hide-grafica-panel" >
                    <div class="">
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-2" style='padding-right: 0px'>
                                <select class="width100 select_filter" data-value="<?=$_GET['filter_select']?>">
                                    <option selected="">Buscar por</option>
                                    <option value="by_fecha">Fechas</option>
                                    <option value="by_hora">Hora</option>
                                </select>
                            </div>
                            <form action="<?=  base_url()?>triage/indicador_horacero" class="by_fecha <?=$_GET['filter_select']=='by_fecha'?'':'hide'?>" method="GET">
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

                            <form action="<?=  base_url()?>triage/indicador_horacero" class="by_hora <?=$_GET['filter_select']=='by_hora'?'':'hide'?>" method="GET">
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
                            <div class="col-md-4 pull-right hide">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" id="filter" placeholder="Filtro General">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table style="margin-top: 20px" class="table m-b-none table-filtros table-bordered table-hover" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                        <thead>
                            <tr>
                                <th data-sort-ignore="true">Folio</th>
                                <th data-sort-ignore="true">Fecha</th>
                                <th data-sort-ignore="true">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Gestion as $value) {?>
                            <tr id="<?=$value['triage_id']?>">
                                <td><?=$value['triage_id']?></td>
                                <td><?=$value['triage_horacero_f']?></td>
                                <td><?=$value['triage_horacero_h']?></td>
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>