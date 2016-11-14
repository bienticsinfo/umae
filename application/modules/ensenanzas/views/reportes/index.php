<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?> 
   <div class="page-content">
      <div class="content a-pace no-display">
         <div class="grid-body no-border">
            <div class="col-md-11 col-centered">
               <ul class="nav nav-tabs" id="tab-usuario">
                  <li class="active pointer  tabConsultar ">
                     <a id="consultar">Reportes</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane b-green-b-i" id="tab-consultar" style="padding-top:0;">
                     <div class="row">
                        <div class="col-md-10 col-centered">
                           <div class="grid-body no-border b-green-b-i" style="padding-top: 26px;">
                               <div class="row form-actions b-gray" >
                                   <div class="col-md-3">
                                        <div class="form-group ">
                                            <span class="help"></span>
                                            <div class="controls">
                                                <div class="input-with-icon ">                                       
                                                    <i class="fa fa-search" style="color: black;opacity: 0.5"></i>
                                                    <input type="text" name="filter"  placeholder="Matricula" id="filter" class="form-control">                                 
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="controls input-with-icon right input-group date" id="f-inicio" >
                                                <i class="exclamation-5"></i>
                                                <input id="jtfFechaInicio" type="text" name="jtfFechaInicio" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>	
                                   </div>
                                   <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="controls input-with-icon right input-group date" id="f-inicio" >
                                                <i class="exclamation-5"></i>
                                                <input id="jtfFechaFin" type="text" name="jtfFechaFin" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>		
                                   </div>
                                    <div class="col-md-12">
                                        <table id="ver-tabla-usuario" class="footable table-sig table-hover table-condensed" data-filter="#filter" data-page-size="10">
                                            <thead >
                                                <tr style="text-align: center">
                                                  <th data-toggle="true" class="text-center">Matricula</th>
                                                  <th data-hide="phone">Contancia</th>
                                                  <th data-hide="phone">Lugar</th>
                                                  <th data-hide="phone">Horarios</th>
                                                  <th data-sort-ignore="true" class="text-center">Fecha</th>
                                               </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                               <tr>
                                                  <td colspan="7">
                                                     <div class="grid simple" style="margin-top: 25px;">
                                                        <div class="pagination pagination-centered width-100"></div>
                                                     </div>
                                                  </td>
                                               </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-actions b-gray" style="margin-right: -10px">
                                            <div class="pull-right" >
                                                <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Cancelar</button>&nbsp;&nbsp;
                                                <button id="aceptar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Generar reporte</button>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/en_reportes.js')?>" type="text/javascript"></script>