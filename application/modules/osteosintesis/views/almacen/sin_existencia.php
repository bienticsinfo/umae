<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?>
   <div class="page-content">
      <div class="clearfix"></div>
      <div class="content a-pace no-display">
         <div class="row">
            <div class="grid-body no-border">
               <div class="col-md-11 col-centered">
                  <div class="grid simple">
                     <div class="grid-title no-border b-gray" style="padding-bottom: 0;">
                        <h4 class="c-green-i">
                           <strong>Sin existencia</strong>
                        </h4>
                     </div>
                     <div class="grid-body no-border b-green-b-i" style="padding-top: 26px;">
                        <div class="grid simple">
                           <div class="m-r-10 input-prepend inside search-form no-boarder">
                              <span class="add-on custom-search-small" style="margin-left: -3px;"> 
                                 <span class="iconset top-search"></span>
                              </span>
                              <input id="filter" name="" type="text" class="no-boarder input-sm" style="width:250px;">
                           </div>
                        </div>
                        <table id="ver-tabla-sin-existencia" class="footable" data-filter="#filter" data-page-size="10">
                           <thead>
                              <tr>
                                 <th data-toggle="true" class="text-center">No. de solicitud</th>
                                 <th>Médico Tratante</th>
                                 <th data-hide="phone">Especialidad</th>
                                 <th data-hide="phone" data-sort-ignore="true">Material</th>
                                 <th class="text-center" data-sort-ignore="true">Acciones</th>
                              </tr>
                           </thead>
                           <tbody></tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="5">
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
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/almacen_o.js')?>" type="text/javascript"></script>