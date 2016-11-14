<?= modules::run('menu/index'); ?>
<div class="box-row">
    <div class="box-cell">

        <div class="box-inner padding">
                <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                    <ul class="breadcrumb">
                        <li><a >Inicio</a></li>
                        <li><a  >Almacen</a></li>
                        <li><a  href="<?=  base_url()?>materiales_consumo/hospitalizacion/gestionar_cirugia">Solicitudes de materiales de Osteosíntesis</a></li>
                        <li><a >Solicitud de material de Osteosíntesis</a></li>
                    </ul>
                </div> 
                <div class="col-md-8 col-centered ">
                    <form id="">
                        <div class="card datos-basicos"  >
                            <div class="card-heading back-imss" style="padding: 10px">
                                <h5>Solicitud de material de Osteosíntesis</h5>
                            </div>
                            <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Derechohabiente</label>
                                                <div class="input-group m-b">
                                                <select class="select2 width100" id="derechohabiente_id" name="derechohabiente_id" required=""></select>
                                                <span class="input-group-addon back-imss no-border pointer add-hb"><i class="fa fa-plus"></i></span>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Médico tratante</label>
                                                <div class="controls ">
                                                    <select class="select2 width100" id="empleado_id" name="empleado_id" required=""></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <label class="form-label">Fecha de tratamiento:</label>
                                        <span class="help">"YYYY/MM/DD"</span>
                                        <div class="controls ">
                                            <input id="solicitud_fecha" type="text" name="solicitud_fecha" class=" fecha-calendar md-input form-control" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-group " style="margin-top: 20px;">
                                       <label class="form-label">Diagnóstico:</label>
                                       <span class="help">ejemplo: "Quemaduras"</span>
                                       <div class="controls input-with-icon right input-group width100">
                                           <textarea id="solicitud_diagnostico" name="solicitud_diagnostico" class="form-control md-input width100" required=""></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sistema</label>
                                        <div class="controls input-with-icon right">
                                            <i class="exclamation-3 multi-excla"></i>
                                            <select id="sistema_id" name="sistema_id" re class="select2 width100" multiple=""></select>
                                        </div>
                                    </div>
                                    <div class="element_select"></div>
                                    
                                    <div class="form-group" style="margin-top:20px;">
                                            <div class="pull-right">
                                                <a href="<?=  base_url()?>materiales_consumo/hospitalizacion/gestionar_cirugia">
                                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect" type="button">Regresar</button>
                                                </a>
                                                <button class="md-btn md-raised m-b btn-fw back-imss waves-effect save-cirugia" type="button">Guardar</button>
                                            </div>
                                        <br>
                                    </div>
                            </div>  
                        </div>
                    </form>
               </div>
        </div>
    </div>
</div>

<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/material_consumo/programar_cirugia.js')?>" type="text/javascript"></script>