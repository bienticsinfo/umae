<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?> 
   <div class="page-content">
      <div class="content a-pace no-display">
         <div class="grid-body no-border">
            <div class="col-md-11 col-centered">
               <ul class="nav nav-tabs" id="tab-conatancia">
                  <li class="active pointer  tabConsultar ">
                     <a id="consultar">Asistencias</a>
                  </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active  b-green-b-i" id="tab-consultar" style="padding-top:0;">
                        <div class="row">
                        <div class="col-md-5">
                           <div class="grid-body no-border b-green-b-i" style="padding-top: 26px;">
                              <div class="grid simple">
                                 <div class="m-r-10 input-prepend inside search-form no-boarder">
                                    <span class="add-on custom-search-small" style="margin-left: -3px;"> 
                                       <span class="iconset top-search"></span>
                                    </span>
                                     <input type="hidden" id="HoraActual">
                                     <input type="hidden" id="jtfId">
                                     <input type="hidden" id="jtfHoraEntrada">
                                     <input id="filter" name="" placeholder="Ingrese su matricula" type="text" class="no-boarder input-sm" style="width:250px;margin-right:30px;">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="grid-body no-border b-green-b-i " style="padding-top: 26px;float: left;color: white;margin-left: -100px">
                                <i class="fa fa-arrow-circle-right fa-2x horaEntrada" style=""></i>
                                &nbsp;
                                <i class="fa fa-arrow-circle-left fa-2x horaSalida"></i>
                            </div>
                        </div>
                        </div>
                        <table id="ver-tabla-asistencia" class="footable table-sig  table-condensed" data-filter="#filter" data-page-size="10">
                        <thead>
                            <tr class="text-center">
                                <th  style="width: 20%">Matricula</th>
                                <th  style="width: 20%">Nombre</th>
                                <th  style="width: 20%">Responsable</th>
                                <th  style="width: 20%">Fecha</th>
                                <th  style="width: 20%">Entrada/Salida</th>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
    #ver-tabla-asistencia tr,.horaEntrada, .horaSalida{
        cursor: pointer;
    }
    
</style>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/en_asistencia.js')?>" type="text/javascript"></script>