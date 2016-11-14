<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Agregar diagnóstico</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="programar-diagnostico">
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Diagnóstico</label>
                                        <textarea class="md-input" rows="4" name="programacion_diagnostico" required=""></textarea> 
                                    </div>
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Seleccionar destino</label>
                                        <select class="md-input select2 programacion_destino" name="programacion_destino" required="">
                                            <option value="Tratamiento en casa">Tratamiento en casa</option>
                                            <?php if($_SESSION['sess']['idRol']!='14'){?>
                                            <option value="Segundo diagnóstico inicial">Segundo diagnóstico inicial</option>
                                            <?php }?>
                                            <option value="Modulo Ortopédico">Modulo ortopédico</option>
                                            <option value="Modulo neurológico">Modulo neurológico</option>
                                            <option value="Modulo pediatrico">Modulo pediatrico</option>
                                            <option value="Modulo medicina interna y cirugía">Modulo medicina interna y cirugía</option>
                                            <option value="Modulo rehabilitaión para el trabajo">Modulo rehabilitaión para el trabajo</option>
                                        </select> 
                                    </div>
                                    <div class="md-form-group  select-folletos" style="margin-top: -20px">
                                        <label>Seleccionar Folletos</label>
                                        <select class="select2 width100" multiple="" name="pro_folleto[]">
                                            <option value="3_funcionalidad_mano.pdf;Funcionalidad de Mano">Funcionalidad de Mano</option>
                                            <option value="1_funcionalidad_columna_lumbar.pdf;Funcionalidad Columna Lumbar">Funcionalidad Columna Lumbar</option>
                                            <option value="6_articulacion_cadera.pdf;Articulación Cadera">Articulación Cadera</option>
                                            <option value="5_funcionalidad_hombro.pdf;Funcionalidad Hombro">Funcionalidad Hombro</option>
                                            <option value="2_funcionalidad_cuello.pdf;Funcionalidad Cuello">Funcionalidad Cuello</option>
                                            <option value="4_funcionalidad_codo.pdf;Funcionalidad Cuello">Funcionalidad Codo</option>
                                            <option value="8_funcionalidad_tobillo.pdf;Funcionalidad Tobillo">Funcionalidad Tobillo</option>
                                            <option value="7_funcionalidad_rodilla.pdf;Funcionalidad Rodilla">Funcionalidad Rodilla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="programacion_id" value="<?=$_GET['p']?>">
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>