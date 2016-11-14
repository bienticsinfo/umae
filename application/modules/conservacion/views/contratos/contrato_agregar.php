<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding card-body">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                  Contratos
                </div>
                <div class="row card-heading">
                    <div class="col-md-12 panel-body ">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <label class="form-label">Area Solicitante</label>
                                    <div class="controls">
                                        <select style="width: 100%" class="tipo_contrato " id="jtfAreaSolicitanteSELECT"> 
                                            <option value="null">Seleccionar</option>
                                            <option value="Conservación" >Conservación</option>
                                            <option value="Servicios Generales">Servicios Generales</option>
                                        </select>
                                    </div>                                               
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <label class="form-label">Tipo de Contrato</label>
                                    <div class="controls">
                                        <select style="width: 100%" class="tipo_contrato " id="jtfTipoContrato"> 
                                            <option value="null">Seleccionar</option>
                                            <option value="Adjudicación directa" >Adjudicación directa</option>
                                            <option value="ITP & Licitación">ITP & Licitación</option>
                                        </select>
                                    </div>                                                
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <label class="form-label">Clave Presupuestal</label>
                                    <div class="controls">
                                        <select name="jtfClavePresupuestal" class="tipo_contrato " id="selectClave2" style="width: 100%"><option>Seleccionar</option></select>
                                    </div>

                                </div>
                            </div>
                        </div>   
                    </div>    
                </div>    
                <div class="row card-heading" style="margin-top: 0px">
                    <div class="col-md-12 panel-body b-b b-light" style="margin-top: -80px">
                        <div class="grid simple">   
                        <form class="tipo_1 grid-body no-border" enctype="multipart/form-data" method="POST" action="<?=  base_url()?>conservacion/contratos/adjudicacion" style="display: none">
                            <div class="row margin-top-20">
                                <div class="col-md-12 ">
                                    <input type="hidden" name="jtfTipoContrato">
                                    <input type="hidden" name="jtfAreaSolicitante">
                                    <input type="hidden" name="contrato_tipo_s">
                                    <input type="hidden" name="jtfClavePresupuestal2">
                                    <input type="hidden" name="contrato_clave_presupuestal_descrip"> 
                                    <input name="csrf_token" type="hidden">
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">N° de Presupuesto</label>
                                                <input type="text" class="md-input" name="jtfNumero" required="" style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>  
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">N° de Contrato</label>
                                                <input type="text" class="md-input" name="contrato_numero_tmp" required="" style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha de creación de contrato</label>
                                                <input type="text" class="md-input md-input-has-value md-input-focused" name="contrato_fecha_creacion"  style="margin-top: 0px">                                          
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label " >Autorización SHCP</label>
                                                <input type="text" value="099001 6B3000/0049" class="md-input md-input-has-value" name="contrato_autorizacion_shcp"  style="margin-top: 0px">
                                                
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                             <div class="md-form-group float-label" style="margin-top: -10px">
                                                 <label class="form-label"  >Fecha de Emisión</label>
                                                 <input type="text" value="01/11/2016" class="md-input fecha" name="contrato_autorizacion_shcp_emi"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha Inicio</label>
                                                <input type="text" class="md-input fecha" name="jtfFechaInicio"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>   
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha Fin</label>
                                                <input type="text" class="md-input fecha" name="jtfFechaFin"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Duración en Dias</label>
                                                <input type="text" class="md-input" name="contrata_fecha_duracion"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                   
                                                </div>                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Proveedor</label>
                                                <div class="controls">
                                                    <select style="width: 100%" class="tipo_contrato " name="jtfProveedor" id="proveedor_select1">
                                                    </select>
                                                </div>                                                
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Hospital/s de procedencia</label>
                                                <div class="controls">
                                                    <select style="width: 100%" class="tipo_contrato hospital_select " id="hospital_select1" name="jtfHospital">
                                                    </select>
                                                </div>                                                 
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Especialidad</label>
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select style="width: 100%" class="tipo_contrato " id="select_especialidad1" name="jtfEspecialidad"></select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="md-input" readonly="" name="_especialidad">
                                                        </div>
                                                    </div>

                                                </div>                                             
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Sub-especialidad</label>
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select style="width: 100%" class="tipo_contrato " id="select_sub1" ></select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="md-input" readonly="" name="_subespecialidad">
                                                            <input type="hidden" name="jtfSubEspecialidad">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>  
                                            <div class="" style="margin-top: -10px">
                                                <div class="row">
                                                    <div class="col-md-4 ">
                                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                                            <label class="form-label">Monto Total</label>   
                                                            <input type="text"  class="md-input" name="jtfMontoTotal"  style="margin-top: 0px">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8  ">
                                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                                            <label class="form-label">Tipo de Salario</label>
                                                            <input type="text" name="contrato_tipo_salario" readonly="" class="md-input" style="border: 1px solid transparent;background: transparent">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Monto Total Letra</label> 
                                                <input type="text"  class="md-input" name="contrato_monto_total_letra"  style="margin-top: 0px">
                                                
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Articulo</label>
                                                        <div class="controls">
                                                            <select style="width: 100%" class="tipo_contrato" id="select_articulo1" name="contrato_articulo"></select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label">Fracción</label>
                                                        <div class="controls">
                                                            <select style="width: 100%;margin-top: -2px" class="tipo_contrato" id="select_fraccion1" multiple="" name="contrato_fraccion[]"></select>
                                                        </div>     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Descripción del trabajo a realizar</label>
                                                <textarea class="md-input" rows="6" name="jtfDescripcion"></textarea>
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Proveedor 1</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfProveedor1" >
                                                </div>                                              
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Proveedor 2</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfProveedor2" >
                                                </div>                                                
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Proveedor 3</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfProveedor3" >
                                                </div>                                                
                                            </div> 
                                            <center>
                                                <button type="submit" class="btn back-imss btn-cons">Generar N° de Contrato</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </form>
                        <form class="tipo_2 grid-body no-border" enctype="multipart/form-data" method="POST" action="<?=  base_url()?>conservacion/contratos/licitacion" style="display: none">
                            <div class="row margin-top-20">
                                <div class="col-md-12">
                                    <input type="hidden" name="jtfTipoContrato">
                                    <input type="hidden" name="jtfAreaSolicitante">
                                    <input type="hidden" name="contrato_tipo_s">
                                    <input type="hidden" name="jtfClavePresupuestal2">
                                    <input type="hidden" name="contrato_clave_presupuestal_descrip"> 
                                    <input name="csrf_token" type="hidden">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">N° de Licitación</label>
                                                <input type="text" class="md-input" name="jtfNumero" required="" style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">N° de Contrato</label>
                                                <input type="text" class="md-input" name="contrato_numero_tmp" required="" style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha de Fallo</label>
                                                <input type="text" class="md-input fecha" name="jtfFechaFallo"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label" >Fecha de creación de contrato</label>
                                                <input type="text" class="md-input" name="contrato_fecha_creacion"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label" >Autorización SHCP</label>
                                                <input type="text" value="099001 6B3000/0049" class="md-input" name="contrato_autorizacion_shcp"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                             <div class="md-form-group float-label" style="margin-top: -10px">
                                                 <label class="form-label" >Fecha de Emisión</label>
                                                 <input type="text" value="01/11/2016" class="md-input fecha" name="contrato_autorizacion_shcp_emi"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha Inicio</label>
                                                <input type="text" class="md-input fecha" name="jtfFechaInicio"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>   
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Fecha Fin</label>
                                                <input type="text" class="md-input fecha" name="jtfFechaFin"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Duración en Dias</label>
                                                <input type="text" class="md-input" name="contrata_fecha_duracion"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Proveedor Adjudicado</label>
                                                <div class="controls">
                                                    <select style="width: 100%" class="tipo_contrato" name="jtfProveedor" id="proveedor_select5">
                                                        <option>Seleccionar</option>
                                                    </select>
                                                </div>                                                
                                            </div> 

                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Hospital/s de procedencia</label>
                                                <div class="controls">
                                                    <select style="width: 100%" class="tipo_contrato" id="hospital_select2" name="jtfHospital">
                                                    </select>
                                                </div>                                               
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Especialidad</label>
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select style="width: 100%" class="tipo_contrato " id="select_especialidad2" name="jtfEspecialidad"></select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="md-input" readonly="" name="_especialidad">
                                                        </div>
                                                    </div>

                                                </div>                                             
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Sub-especialidad</label>
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select style="width: 100%" class="tipo_contrato" id="select_sub2" ></select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="md-input" readonly="" name="_subespecialidad">
                                                            <input type="hidden" name="jtfSubEspecialidad">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>  
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Unidad udimensional total</label>
                                                <div class="controls">
                                                    <input type="text" class="md-input" name="jtfUnidad"  style="margin-top: 0px">
                                                </div>                                                
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                                            <label class="form-label">Monto Total</label>
                                                            <input type="text"  class="md-input" name="jtfMontoTotal"  style="margin-top: 0px">
                                                        
                                                        </div>                     
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="md-form-group float-label" style="margin-top: -10px">
                                                            <label class="form-label">Tipo de Salario</label>
                                                            <input type="text" name="contrato_tipo_salario" readonly="" class="md-input" style="border: 1px solid transparent;background: transparent">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Monto Total Letra</label>
                                                <input type="text"  class="md-input" name="contrato_monto_total_letra"  style="margin-top: 0px">
                                                
                                                <div class="controls">
                                                    
                                                </div> 
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Articulo</label>
                                                        <div class="controls">
                                                            <select style="width: 100%" class="tipo_contrato" id="select_articulo2" name="contrato_articulo"></select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label">Fracción</label>
                                                        <div class="controls">
                                                            <select style="width: 100%;margin-top: -2px" class="tipo_contrato" id="select_fraccion2" multiple="" name="contrato_fraccion[]"></select>
                                                        </div>     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Descripción del trabajo a realizar</label>
                                                <textarea class="md-input" rows="6" name="jtfDescripcion"></textarea>
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div>
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Descripción tecnica del servicio</label>
                                                <input type="file" class="md-input upload-archivo" name="jtfFile1"  style="margin-top: 0px">   
                                                
                                                <div class="controls">
                                                    
                                                </div>                                                
                                            </div> 
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Propuesta economica</label>
                                                <div class="controls">
                                                    <input type="file" class=" md-input upload-archivo" name="jtfFile2"  style="margin-top: 0px">   
                                                </div>                                                
                                            </div>  
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Unidades de prestación</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfFile3"  style="margin-top: 0px">   
                                                </div>                                                
                                            </div>  
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Calendario servicio</label>
                                                <div class="controls">
                                                    <input type="file" class="md-input upload-archivo" name="jtfFile4"  style="margin-top: 0px">   
                                                </div>                                                
                                            </div>
                                            <center>
                                                <button type="submit" class="btn back-imss btn-cons">Generar N° de Contrato</button>
                                            </center>
                                        </div>
                                    </div>
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
<script src="<?=  base_url()?>assets/js/conservacion/contratos.js"></script>