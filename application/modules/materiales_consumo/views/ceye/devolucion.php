<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?>
   <div class="page-content">
      <div class="content a-pace no-display">
         <div class="row">
            <div class="grid-body no-border">
               <div class="col-md-11 col-centered">
                  <div class="grid simple">
                     <div class="grid-title no-border b-gray" style="padding-bottom: 0;">
                        <h4 class="c-green-i">
                           <strong>Devolución</strong>
                        </h4>
                     </div>
                     <div class="grid-body no-border " style="padding-top: 26px;">
                        <div class="grid simple">
                           <div class="m-r-10 input-prepend inside search-form no-boarder">
                              <span class="add-on custom-search-small" style="margin-left: -3px;"> 
                                 <span class="iconset top-search"></span>
                              </span>
                              <input id="filter" name="" type="text" class="no-boarder input-sm" style="width:250px;">
                           </div>
                        </div>
                        <table id="ver-tabla-devolucion" class="footable table-sig table-hover table-condensed" data-filter="#filter" data-page-size="10">
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
                              </tr>
                           </thead>
                           <tbody></tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="4">
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
<script src="<?= base_url('assets/js/clinica-heridas/vac.js')?>" type="text/javascript"></script>