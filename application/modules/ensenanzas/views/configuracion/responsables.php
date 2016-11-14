<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?> 
   <div class="page-content">
      <div class="content a-pace no-display">
         <div class="grid-body no-border">
            <div class="col-md-11 col-centered">
               <ul class="nav nav-tabs" id="tab-usuario">
                  <li class="active pointer  tabConsultar ">
                     <a id="consultar">Consultar</a>
                  </li>
                  <li class="pointer tabRegistrar" >
                     <a id="registrar">Registrar</a>
                  </li>
                  <li class="pointer tabModificar no-display">
                      <a id="modificar" >Modificar</a>
                  </li>
                </ul>
                <style>
                    .infoMas{
                        cursor: pointer;
                    }
                </style>
                <div class="tab-content">
                  <div class="active tab-pane b-green-b-i" id="tab-consultar" style="padding-top:0;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="grid-body no-border b-green-b-i" style="padding-top: 26px;">
                              <div class="grid simple">
                                 <div class="m-r-10 input-prepend inside search-form no-boarder">
                                    <span class="add-on custom-search-small" style="margin-left: -3px;"> 
                                       <span class="iconset top-search"></span>
                                    </span>
                                    <input id="filter" name="" type="text" class="no-boarder input-sm" style="width:250px;margin-right:30px;">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <table id="ver-tabla-usuario" class="footable table-sig table-hover table-condensed" data-filter="#filter" data-page-size="10">
                        <thead >
                            <tr >
                              <th data-hide="phone">Num°</th>
                              <th data-hide="phone">Nombre</th>
                              <th>Institución Origen</th>
                              <th data-sort-ignore="true" class="text-center">Acciones</th>
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
                    <div class="tab-pane b-green-b-i" id="tab-registrar">
                        <div class="row">
                            
                            <div class="col-md-10 col-centered">
                                <div class="grid simple" style="margin:0;">
                                    <div class="grid-body no-border b-gray">
                                    <?= form_open(null,array('id'=>'registrar-form')); ?>   
                                        <div class="form-group" style="margin-top:20px;">
                                            <label class="form-label">Nombre:</label>
                                            <span class="help">ejemplo: "Jorge"</span>
                                            <div class="controls input-with-icon right" style="width:64%;">
                                                <i class=""></i>
                                                <input type="text" name="jtfNombre" id="jtfNombre" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <label class="form-label">Apellido paterno:</label>
                                            <div class="controls input-with-icon right input-group" style="width:64%;">
                                                <i class=""></i>
                                                <input type="text" name="jtfApat" id="jtfApat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <label class="form-label">Apellido materno:</label>
                                            <div class="controls input-with-icon right" style="width:64%;">
                                                <i class=""></i>
                                                <input type="text" name="jtfAmat" id="jtfAmat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <label class="form-label">Institución Origen:</label>
                                            <div class="controls input-with-icon right" style="width:64%;">
                                                <i class=""></i>
                                                <input type="text" name="jtfInstitucion" id="jtfInstitucion" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-actions b-gray">
                                            <div class="pull-right">
                                                <input type="hidden" name="jtfAccion" id="jtfAccion" value="Agregar">
                                                <input type="hidden" name="jtfIdUser" id="jtfIdUser" value="0">
                                                <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Cancelar</button>
                                                <button id="aceptar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
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
<script src="<?= base_url('assets/js/en_responsables.js')?>" type="text/javascript"></script>