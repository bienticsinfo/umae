<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?> 
   <div class="page-content">
      <div class="content a-pace no-display">
         <div class="grid-body no-border">
            <div class="col-md-11 col-centered">
               <ul class="nav nav-tabs" id="tab-departamento">
                  <li class="active pointer   ">
                     <a id="consultar">Consultar</a>
                  </li>
                  <li class="pointer">
                     <a id="registrar">Registrar</a>
                  </li>
                  <li class="pointer tabEdit no-display">
                     <a id="modificar">Modificar</a>
                  </li>
               </ul>
                <!--Cambio por aca-->
               <div class="tab-content">
                  <div class="active tab-pane " id="tab-consultar" style="padding-top:0;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="grid-body no-border " style="padding-top: 26px;">
                              <div class="grid simple">
                                 <div class="m-r-10 input-prepend inside search-form no-boarder container-consultar">
                                    <span class="add-on custom-search-small" style="margin-left: -3px;">
                                       <span class="iconset top-search"></span>
                                    </span>
                                    <input id="filter" name="" type="text" class="no-boarder input-sm" style="width:250px;margin-right:30px;">
                                    <select id="filtro" class="select2" style="width:281px;min-height:30px;margin-right:15px;">
                                       <option value="">Seleccionar</option>
                                       <option value="1">Departamento</option>
                                       <option value="2">Especialidad</option>
                                    </select>
                                    <button id="busqueda" type="submit" class="btn btn-primary btn-cons-md b-green-i" style="padding-top:6px;height:32px;">Buscar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <table id="ver-tabla-departamento" class="footable" data-filter="#filter" data-page-size="10">
                        <thead>
                           <tr>
                              <th data-toggle="true" class="text-center">No. Dpto.</th>
                              <th>Departamento</th>
                              <th>Especialidad</th>
                              <th class="text-center" data-hide="phone" data-sort-ignore="true">Acciones</th>
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
               <div class=" tab-pane " id="tab-registrar">
                  <div class="row">
                     <div class="col-md-10 col-centered">
                        <div class="grid simple" style="margin:0;">
                           <div class="grid-body no-border b-gray">
                              <?= form_open(null,array('id'=>'registrar-form')); ?>
                              <div class="form-group " style="margin-top: 20px;">
                                 <label class="form-label">Departamento:</label>
                                 <span class="help">ejemplo: "Sistemas"</span>
                                 <div class="controls input-with-icon right input-group" style="width:64%;">
                                    <i class="exclamation-4"></i>
                                    <input id="departamento" name="departamento" type="text" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:20px;">
                                 <label class="form-label">Especialidad:</label>
                                 <span class="help">ejemplo: "Osteosíntesis"</span>
                                 <div class="controls input-with-icon right" style="width:64%;">
                                    <i class=""></i>
                                 <select id="especialidad" name="especialidad" class="select2 form-control"></select>
                              </div>
                           </div>
                           <div class="form-actions b-gray">
                              <div class="pull-right">
                                 <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Borrar</button>
                                 <button id="aceptar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
                              </div>
                           </div>
                           <?= form_close(); ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane " id="tab-modificar">
               <div class="row">
                  <div class="col-md-10 col-centered">
                     <div class="grid simple" style="margin:0;">
                        <div class="grid-body no-border b-gray">
                           <?= form_open(null,array('id'=>'modificar-form')); ?>
                           <div class="form-group " style="margin-top: 20px;">
                              <label class="form-label">Departamento:</label>
                              <span class="help">ejemplo: "Sistemas"</span>
                              <div class="controls input-with-icon right input-group" style="width:64%;">
                                 <i class="exclamation-4"></i>
                                 <input id="departamento-m" name="departamento" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group" style="margin-top:20px;">
                              <label class="form-label">Especialidad:</label>
                              <span class="help">ejemplo: "Osteosíntesis"</span>
                              <div class="controls input-with-icon right" style="width:64%;">
                                 <i class=""></i>
                                 <select id="especialidad-m" name="especialidad" class="select2 form-control"></select>
                              </div>
                           </div>
                           <div class="form-actions b-gray">
                              <div class="pull-right">
                                 <button id="cancelar-m" type="button" class="btn btn-white btn-cons-md">Borrar</button>
                                 <button id="aceptar-m" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
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
<?= modules::run('menu/footer'); ?>
<?= $assets['js']; ?>
<!--<script src="<?= base_url('assets/js/departamento.js')?>" type="text/javascript"></script>-->