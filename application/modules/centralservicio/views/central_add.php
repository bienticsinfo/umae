<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: 20px">
            <ul class="breadcrumb">
                <li><a >Inicio</a></li>
                <li><a href="#" class="back-history1">Central de Servicios</a></li>
                <li><a href="#">Nuevo Registro</a></li>
            </ul>
        </div>
        <div class="col-md-8 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Central de Servicios</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="programar">
                            <div class="row row-sm">
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>N.S.S</label>
                                        <input class="md-input" name="derechohabiente_nss" required="">   
                                    </div>
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Apellido Paterno</label>
                                        <input class="md-input" name="derechohabiente_apat">
                                    </div>
                                </div>  
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Nombre</label>
                                        <input class="md-input" name="derechohabiente_nombre" required="">      
                                    </div>
                                    <div class="md-form-group"style="margin-top: -20px">
                                        <label>Apellido Materno</label>
                                        <input class="md-input" name="derechohabiente_amat">                          
                                    </div>
                                </div> 
                                <div class="col-sm-12">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Procedencia</label>
                                        <textarea class="md-input" rows="2" name="derechohabiente_procedencia"></textarea> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-actions">
                                        <label>Fecha de Programación</label>
                                    </div>
                                    <div class="form-actions" style="margin-top: 10px">
                                        
                                        <label class="md-check">
                                            <input type="radio" name="radio" class="has-value select_fecha" value="Hoy">
                                            <i class="indigo"></i>Hoy
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="radio" class="has-value select_fecha" checked="" value="Other">
                                            <i class="indigo"></i>Otra fecha
                                        </label>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form-group"style="margin-top: -20px">
                                        <label>Seleccionar Fecha</label>
                                        <input class="md-input programacion_fecha fecha_calendar" name="programacion_fecha">                          
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="md-form-group"style="margin-top: -20px">
                                        <label>Seleccionar documentos</label>
                                        <input class="md-input upload-archivo" name="derechohabiente_doc" type="file">                          
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token">
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Programar</button>                     
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