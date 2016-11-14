<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?> 

    <div class="page-content">
    <div class="content">
        <ul class="nav nav-tabs" id="tab-Calendario">
          <li class="active pointer  tabCalendario ">
             <a id="calendario">Calendario</a>
          </li>
          <li class="pointer  tabAsistencia no-display">
             <a id="asistencias">Asistencias</a>
          </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active  b-green-b-i" id="tab-calendario" style="padding-top:0;">
                <div class="row tiles-container no-padding" >
                    <br>
                    <div class="col-md-3 "></div>
                    <div class="col-md-6 tiles white no-padding">
                        
                        <div class="tiles-body">
                            <div class="full-calender-header">
                                <div class="pull-left">
                                    <div class="btn-group ">
                                        <button class="btn btn-success" id="calender-prev"><i class="fa fa-angle-left"></i></button>
                                        <button class="btn btn-success" id="calender-next"><i class="fa fa-angle-right"></i></button>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <h3 class="text-black semi-bold pull-left" id="calender-current-day"></h3>
                                    <h3 class="text-black pull-left" style="margin-left: 10px" id="calender-current-date"></h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id='calendar'></div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div class="tab-pane  b-green-b-i" id="tab-asistencias" style="padding-top:0;">
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
<style>
    #ver-tabla-asistencia tr,.horaEntrada, .horaSalida,.fc-widget-content{
        cursor: pointer;
    }
</style>
<?= modules::run('menu/footer'); ?>
<script src="<?=  base_url()?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?=  base_url()?>assets/js/calender.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/en_asistencia_calendar.js')?>" type="text/javascript"></script>