<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#" class="back-history1">Listas</a></li>
                <li><a href="#">Urgencias</a></li>
            </ol>    
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Lista Urgencias</span>
                </div>
                
                <table class="table m-b-none" ui-jp="footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="false" data-toggle="true">N°</th>
                            <th>Nombre</th>
                            <th data-sort-ignore="true" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>RX</td>
                            <td>
                                <center>
                                    <a href="<?=  base_url()?>triage/listas_rx" target="_blank">
                                        <i class="fa fa-share icono-accion"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Consultorio de Especialida</td>
                            <td>
                                <center>
                                    <a href="<?=  base_url()?>triage/listas_consultorios_especialidad" target="_blank">
                                        <i class="fa fa-share icono-accion"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
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