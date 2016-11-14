<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-11 col-centered ">
                <div class="panel panel-default">
                        <div class="panel-heading p teal-900 back-imss">
                            <span style="font-size: 15px;font-weight: 500">Por entregar</span>
                        </div>
                         <div class="panel-body b-b b-light">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="ver-tabla-por-asignar" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="5">
                           <thead>
                              <tr>
                                 <!-- <th data-type="numeric" data-sort-initial="true" class="text-center" >
                                    <span class="hidden-xs">No. tratamiento</span>
                                    <span class="visible-xs xs-custom">No. tto.</span>
                                 </th> -->
                                 <th data-sort-initial="true">Derechohabiente</th>
                                 <th data-hide="phone">Médico</th>
                                 <th data-hide="phone,tablet">Especialidad</th>
                                 <th data-sort-ignore="true">Material</th>
                                 <th data-sort-ignore="true">Acciones</th>
                              </tr>
                           </thead>
                           <tbody></tbody>
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
<script src="<?= base_url('assets/js/clinica-heridas/vac.js')?>" type="text/javascript"></script>