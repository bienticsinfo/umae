<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?>
   <div class="page-content">
      <div class="clearfix"></div>
      <div class="content a-pace no-display">
        <div class="grid-body no-border">
          <div class="col-md-11 col-centered">
            <ul class="nav nav-tabs" id="gestion-cirugia">
              <li class="active">
                <a id="ver-a" href="#ver" style="cursor:pointer;">Ver</a>
              </li>
              <li id="estado-a" href="#estado" class="disable no-display">
                <a>Estado</a>
              </li>
              <li id="modificar-a" href="#modificar" class="disable no-display">
                <a>Modificar</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane b-green-b-i" id="ver" style="padding-top:0;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grid-body no-border b-green-b-i" style="padding-top: 26px;">
                      <div class="grid simple">
                         <div class="m-r-10 input-prepend inside search-form no-boarder">
                            <span class="add-on custom-search-small" style="margin-left: -3px;"> 
                              <span class="iconset top-search"></span>
                            </span>
                            <input id="filter" name="" type="text" class="no-boarder input-sm" style="width:250px;">
                         </div>
                      </div>
                      <table id="ver-tabla-cirugias" class="table-responsive width-100 footable" 
                             data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                         <thead>
                            <tr>
                               <th data-type="numeric" data-sort-initial="true" class="text-center" >No. Cirugía</th>
                               <th data-sort-ignore="true">Médico tratante</th>
                               <th data-hide="phone,tablet" data-sort-ignore="true">Especialidad</th>
                               <th data-hide="phone" data-sort-ignore="true">Material</th>
                               <th data-hide="phone" data-sort-ignore="true">I. Quirúrgico</th>
                               <th data-hide="phone,tablet" data-sort-ignore="true">Quirófano</th>
                               <th>Estado</th>
                               <th data-sort-ignore="true" class="text-center">Acciones</th>
                            </tr>
                         </thead>
                         <tbody>
                            <?= ($cirugias != '' ? $cirugias : ''); ?>
                         </tbody>
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
              <div class="tab-pane b-green-b-i" id="estado" style="padding-bottom:0">
                <div class="row column-seperation">
                  <div id="estados-cirugia" class="col-md-6" style="padding-left:14%;margin-bottom:3%;"></div>
                  <div class="col-md-6 c-white" style="padding-left:11%;">
                    <!-- <div class="grid simple">
                      Mensaje del estado
                    </div>
                    <div class="grid simple">
                      <span>Fecha programada:</span>
                      <br>
                      <span>00/00/0000 - 00:00:00</span>
                    </div>
                    <div class="grid simple">
                      <span>Fecha programada:</span>
                      <br>
                      <span>00/00/0000 - 00:00:00</span>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="tab-pane b-green-b-i" id="modificar">
                <div class="row">
                  <div class="col-md-10 col-centered">
                    <div class="grid simple" style="margin:0;">
                       <div class="grid-body no-border b-gray">
                       <?= form_open(null,array('id'=>'p-cirugia-form')); ?>   
                          <div class="form-group" style="margin-top: 20px;">
                             <label class="form-label">Derechohabiente</label>
                             <div class="controls input-with-icon right input-group" style="width:64%;">
                                <i class="exclamation-3"></i>
                                <input id="derechohabiente" name="derechohabiente" type="text" class="form-control">
                                <span id="buscar-dh" class="input-group-addon primary pointer b-green-i bor-green-i">     
                                   <span class="arrow arrow-m c-green-i b-green-i"></span>
                                   <i class="fa fa-plus-square fa-white"></i>    
                                </span>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="form-label">Médico tratante</label>
                             <div class="controls input-with-icon right input-group" style="width:64%;">
                                <i class="exclamation-3"></i>
                                <input id="medico-tratante" name="medico_tratante" type="text" class="form-control">
                                <span id="buscar-medico" class="input-group-addon primary pointer b-green-i bor-green-i">     
                                   <span class="arrow arrow-m c-green-i b-green-i"></span>
                                   <i class="fa fa-plus-square fa-white"></i>    
                                </span>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="form-label">Tipo de cirugía</label>
                             <div class="controls input-with-icon right" style="width:64%;">
                                <i class=""></i>
                                <select id="tipo-cirugia" name="tipo_cirugia" class="select2 form-control">
                                   <option value="">Seleccionar</option>
                                   <option value="1">Cirugía 1</option>
                                   <option value="2">Cirugía 2</option>
                                   <option value="2">Cirugía 3</option>
                                </select>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="form-label">Material</label>
                             <div class="controls input-with-icon right" style="width:64%;">
                                <i class="exclamation-3 multi-excla"></i>
                                <select id="material" name="material" class="select2 form-control" multiple></select>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="form-label">Instrumental quirúrgico</label>
                              <div class="controls input-with-icon right" style="width:64%;">
                                <i class="exclamation-3 multi-excla"></i>
                                <select id="i-quirurgico" name="i_quirurgico" class="select2 form-control" multiple></select>
                             </div>
                          </div>
                          <div class="form-actions b-gray">
                             <div class="pull-right">
                                <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Borrar</button>
                                <button id="editar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
                             </div>
                          </div>
                       <?= form_close(); ?>
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
<script src="<?= base_url('assets/js/hospitalizacion.js')?>" type="text/javascript"></script>