<?= modules::run('menu/index'); ?> 
<div class="box-row">  
    <div class="box-cell"> 
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#" class="back-history1">Asistentes Médicas</a></li>
                <li><a href="#" class="">Cortes</a></li>
            </ol>
            
            <div class="col-md-12" style="margin-top: -10px">
                <div class="panel no-border">
                    <div class="panel-heading back-imss">
                        <span class="">
                            Gestión de Cortes Realizados
                        </span>
                            
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b ">
                                    
                                    <input type="text" name="" class="form-control" id="filter" placeholder="Busqueda General">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                </div>
                            </div>    
                        </div>
                        <table class="table m-b-none table-filtros table-bordered table-hover table-condensed" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="false" data-toggle="true">Fecha</th>
                                    <th>Hora</th>
                                    <th data-sort-ignore="true" class="text-center" style="width: 10%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['triage_id']?>" >
                                    <td><?=$value['cortes_am_fecha']?></td>
                                    <td><?=$value['cortes_am_hora']?></td>
                                    
                                    <td class="text-center">
                                        <a href="" hidden="">
                                            <i class="fa fa-file-excel-o icono-accion tip" data-original-title="Exportar a EXCEL"></i>
                                        </a>&nbsp;
                                        <a href="<?=  base_url()?>asistentesmedicas/ver_corte?fecha=<?=$value['cortes_am_fecha']?>">
                                            <i class="fa fa-share icono-accion tip" data-original-title="Detalles del Corte"></i>
                                        </a>
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
            <div class="col-md-12">
                <div class="panel no-border">

                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>