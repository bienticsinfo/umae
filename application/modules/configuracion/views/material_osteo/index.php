<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-11 col-centered ">
               <ul class="nav nav-tabs panel panel-default" id="tab-materiales">
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
                     <table id="ver-tabla-material" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                        <thead>
                           <tr>
                              <th class="text-center">Material</th>
                              <th data-hide="all" class="text-center">Máxima</th>
                              <th data-hide="all" class="text-center">Mínima</th>
                              <th data-hide="phone" class="text-center">Clave</th>
                              <th data-hide="phone,tablet">Descripción</th>
                              <th data-hide="phone,tablet">Estatus</th>
                              <th data-hide="phone" class="text-center">Imagen</th>
                              <th data-sort-ignore="true">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?= $materiales; ?>
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
                  <div class=" tab-pane " id="tab-registrar">
                     <div class="row">
                        <div class="col-md-10 col-centered">
                           <div class="grid simple" style="margin:0;">
                              <div class="grid-body no-border b-gray">
                              <?= form_open(null,array('id'=>'registrar-form')); ?>   
                                 <div class="col-md-8 no-padd">
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Nombre:</label>
                                       <span class="help">ejemplo: "Clavos largos"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="nombre" name="nombre" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Clave:</label>
                                       <span class="help">ejemplo: "120 652 120 10 10"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="clave" name="clave" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Descripción:</label>
                                       <span class="help">ejemplo: "Vendas largas"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <textarea class="width-100 no-rezise" name="descripcion" id="descripcion" rows="5"></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Cantidad máxima:</label>
                                       <span class="help">ejemplo: "150"</span>
                                          <div class="controls input-with-icon right input-group width-100" >
                                             <i class="exclamation-4"></i>
                                             <input id="maxima" name="maxima" type="text" class="form-control">
                                          </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Cantidad mínima:</label>
                                       <span class="help">ejemplo: "20"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="minima" name="minima" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Imágen:</label>
                                       <span class="help">tamaño máximo: <?= byte_format($this->config->item('upload_size')['materiales_img']*1000); ?>  sólo: <?= $this->config->item('allowed_types')['materiales_img']; ?></span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-3 exclamation-7 fa"></i>
                                          <input id="imagen" name="imagen" type="file" class="form-control file file-upload" data-preview-file-type="text">
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
                                       <span class="help">ejemplo: "Clavos"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="nombre-m" name="nombre" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Clave:</label>
                                       <span class="help">ejemplo: "120 652 120 10 10"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="clave-m" name="clave" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Descripción:</label>
                                       <span class="help">ejemplo: "Vendas largas"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <textarea class="width-100 no-rezise" name="descripcion" id="descripcion-m" rows="5"></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                       <label class="form-label">Cantidad máxima:</label>
                                       <span class="help">ejemplo: "150"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="maxima-m" name="maxima" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Cantidad mínima:</label>
                                       <span class="help">ejemplo: "20"</span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-4"></i>
                                          <input id="minima-m" name="minima" type="text" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Imágen:</label>
                                       <span class="help">tamaño máximo: <?= byte_format($this->config->item('upload_size')['materiales_img']*1000); ?>  sólo: <?= $this->config->item('allowed_types')['materiales_img']; ?></span>
                                       <div class="controls input-with-icon right input-group width-100" >
                                          <i class="exclamation-3 exclamation-7"></i>
                                          <input id="imagen-m" name="imagen-m" type="file" class="form-control file file-upload" data-preview-file-type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4" style="margin-top:20px;">
                                    <img src="<?= base_url('assets/img/imss.png'); ?>" alt="" class="width-100 contain-img-material">
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
<script src="<?= base_url('assets/js/material_osteo.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/libs/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/libs/bootstrap-fileinput/js/fileinput.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/libs/bootstrap-fileinput/js/fileinput_locale_es.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/libs/tapmodo-jcrop/js/jquery.Jcrop.min.js')?>" type="text/javascript"></script>