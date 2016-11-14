<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-11 col-centered ">
               <ul class="nav nav-tabs panel panel-default" id="tab-sistemas">
                  <li class="active pointer   ">
                     <a id="consultar">Consultar</a>
                  </li>
                  <li class="pointer">
                     <a id="registrar">Registrar</a>
                  </li>
                  <li class="pointer tab-modificar no-display">
                     <a id="modificar">Modificar</a>
                  </li>
               </ul>
               <div class="tab-content panel panel-default">
                  <div class="active tab-pane " id="tab-consultar" style="padding-top:0;">
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
                     <table id="ver-tabla-sistemas" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                        <thead>
                           <tr>
                              <th class="text-center">Sistema</th>
                              <th data-hide="phone" >Proveedor</th>
                              <th data-hide="phone,tablet" >Categoría</th>
                              <th class="text-center">Estatus</th>
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
               <div class=" tab-pane " id="tab-registrar">
                  <div class="row">
                     <div class="col-md-10 col-centered">
                        <div class="grid simple" style="margin:0;">
                           <div class="grid-body no-border b-gray">
                              <?= form_open(null,array('id'=>'registrar-form')); ?>
                              <div class="col-md-8 no-padd">
                                 <div class="form-group " style="margin-top: 20px;">
                                    <label class="form-label">Nombre:</label>
                                    <span class="help">ejemplo: "Sistema 1"</span>
                                    <div class="controls input-with-icon right input-group width-100" >
                                       <i class="exclamation-4"></i>
                                       <input id="nombre" name="nombre" type="text" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group" style="margin-top:20px;">
                                    <label class="form-label">Categoría:</label>
                                    <span class="help">ejemplo: "Osteosíntesis"</span>
                                    <div class="controls input-with-icon right" >
                                       <i class=""></i>
                                    <select id="categoria" name="categoria" class="select2 width100"></select>
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:20px;">
                                 <label class="form-label">Proveedor:</label>
                                 <span class="help">ejemplo: "Edgar"</span>
                                 <div class="controls input-with-icon right input-group" >
                                    <i class="exclamation-3"></i>
                                    <input id="proveedor" name="proveedor"  type="text" class="form-control">
                                    <span id="buscar-proveedor" class="input-group-addon primary pointer b-green-i bor-green-i">
                                       <span class="arrow arrow-m c-green-i b-green-i"></span>
                                       <i class="fa fa-plus-square fa-white"></i>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:20px;">
                                 <label class="form-label">Materiales:</label>
                                 <span class="help">ejemplo: "Clavos"</span>
                                 <div class="controls input-with-icon right input-group" >
                                    <i class="exclamation-3"></i>
                                    <input id="materiales" name="materiales"  type="text" class="form-control">
                                    <span id="buscar-materiales" class="input-group-addon primary pointer b-green-i bor-green-i">
                                       <span class="arrow arrow-m c-green-i b-green-i"></span>
                                       <i class="fa fa-plus-square fa-white"></i>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 no-padd">
                              <div class="form-actions b-gray">
                                 <div class="pull-right">
                                    <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Borrar</button>
                                    <button id="aceptar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
                                 </div>
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
                           <div class="col-md-8 no-padd">
                                 <div class="form-group " style="margin-top: 20px;">
                                    <label class="form-label">Nombre:</label>
                                    <span class="help">ejemplo: "Sistema 1"</span>
                                    <div class="controls input-with-icon right input-group width-100" >
                                       <i class="exclamation-4"></i>
                                       <input id="nombre-m" name="nombre" type="text" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group" style="margin-top:20px;">
                                    <label class="form-label">Categoría:</label>
                                    <span class="help">ejemplo: "Osteosíntesis"</span>
                                    <div class="controls input-with-icon right" >
                                       <i class=""></i>
                                    <select id="categoria-m" name="categoria" class="select2 width100"></select>
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:20px;">
                                 <label class="form-label">Proveedor:</label>
                                 <span class="help">ejemplo: "Edgar"</span>
                                 <div class="controls input-with-icon right input-group" >
                                    <i class="exclamation-3"></i>
                                    <input id="proveedor-m" name="proveedor"  type="text" class="form-control">
                                    <span id="buscar-proveedor-m" class="input-group-addon primary pointer b-green-i bor-green-i">
                                       <span class="arrow arrow-m c-green-i b-green-i"></span>
                                       <i class="fa fa-plus-square fa-white"></i>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group" style="margin-top:20px;">
                                 <label class="form-label">Materiales:</label>
                                 <span class="help">ejemplo: "Clavos"</span>
                                 <div class="controls input-with-icon right input-group" >
                                    <i class="exclamation-3"></i>
                                    <input id="materiales-m" name="materiales"  type="text" class="form-control">
                                    <span id="buscar-materiales-m" class="input-group-addon primary pointer b-green-i bor-green-i">
                                       <span class="arrow arrow-m c-green-i b-green-i"></span>
                                       <i class="fa fa-plus-square fa-white"></i>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 no-padd">
                              <div class="form-actions b-gray">
                                 <div class="pull-right">
                                    <button id="cancelar-m" type="button" class="btn btn-white btn-cons-md">Borrar</button>
                                    <button id="aceptar-m" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
                                 </div>
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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/sistema_osteo.js')?>" type="text/javascript"></script>