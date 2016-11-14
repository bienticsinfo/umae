<?= modules::run('menu/header'); ?>
<?= modules::run('menu/index'); ?>
   <div class="page-content">
      <div class="clearfix"></div>
      <div class="content a-pace no-display">
         <div class="grid-body no-border">
            <div class="row">
               <div class="col-md-8 col-centered">
                  <div id="c-programar-cirugia" class="grid simple">
                     <div class="grid-body no-border b-gray">
                     <?= form_open(null,array('id'=>'p-cirugia-form')); ?>   
                        <div class="form-group" style="margin-top:20px;">
                           <label class="form-label">Derechohabiente</label>
                           <div class="controls input-with-icon right input-group">
                              <i class="exclamation-3"></i>
                              <input id="derechohabiente" name="derechohabiente" type="text" class="form-control">
                              <span id="buscar-dh" class="input-group-addon primary pointer b-green-i bor-green-i popovers">     
                                 <span class="arrow arrow-m c-green-i b-green-i"></span>
                                 <i class="fa fa-plus-square fa-white"></i>
                              </span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">Médico tratante</label>
                           <div class="controls input-with-icon right input-group">
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
                           <div class="controls input-with-icon right">
                              <i class=""></i>
                              <select id="tipo-cirugia" name="tipo_cirugia" class="select2 form-control">
                                 <option value="">Seleccionar</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">Material</label>
                           <div class="controls input-with-icon right">
                              <i class="exclamation-3 multi-excla"></i>
                              <select id="material" name="material" class="select2 form-control" multiple></select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">Instrumental quirúrgico</label>
                            <div class="controls input-with-icon right">
                              <i class="exclamation-3 multi-excla"></i>
                              <select id="i-quirurgico" name="i_quirurgico" class="select2 form-control" multiple></select>
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
               <!-- <div class="col-md-2" style="margin-left:3%;"></div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/hospitalizacion.js')?>" type="text/javascript"></script>