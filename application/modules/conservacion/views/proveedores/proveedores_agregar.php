<?=  Modules::run('config/getHeadAdmin')?>
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Nuevo Proveedor
                </div>
                <div class="row panel-body">
                    <div class="col-md-12"><div class="tab-content">
                            <div class="tab-pane active" id="tab1hellowWorld">
                                <div class="row">
                                        <div class="col-md-4">
                                            <div class="md-form-group float-label" style="margin-top: -10px">
                                                <label class="form-label">Tipo de Persona</label>
                                                <div class="controls">
                                                    <select style="width: 100%" class="proveedores " id="tipoPersona"> 
                                                        <option value="null">Seleccionar</option>
                                                        <option value="Personal moral" >Personal moral</option>
                                                        <option value="Personal fisica">Personal fisica</option>
                                                    </select>
                                                </div>                                               
                                            </div> 
                                        </div> 
                                    </div>   

                            </div>
                        </div>
                    </div>    
                </div>    
                <div class="row panel-body">
                    <div class="col-md-12 card-heading">
                        <div class="grid simple" style="margin-top: -50px">   
                        <form class="tipo_1 grid-body no-border" enctype="multipart/form-data" method="POST" action="<?=  base_url()?>conservacion/proveedores/nuevoproveedor" style="display: none">
                            <div class="row margin-top-20">
                                <div class="col-md-12 ">
                                    <input type="hidden" name="prov_tipo">
                                    <input name="csrf_token" type="hidden">
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_num" required="" style="margin-top: 0px">
                                        <label class="form-label">N° Proveedor</label>                                               
                                    </div> 
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rfc" required="" style="margin-top: 0px">
                                        <label class="form-label">RFC</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_direccion_alternativa"  style="margin-top: 0px">
                                        <label class="form-label">Dirección alternativa.</label>                                         
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_s_fijo"  style="margin-top: 0px">            
                                        <label class="form-label">Teléfono secundario fijo.</label>                        
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_num_escritura_publica"  style="margin-top: 0px">
                                        <label class="form-label">Número de escritura pública</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_num_notaria"  style="margin-top: 0px">
                                        <label class="form-label">No. Notaria</label>                                               
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_folio_rp"  style="margin-top: 0px">
                                        <label class="form-label">Folio registro público de la propiedad.<br><br></label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_fecha_ep"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal fecha de escritura pública.<br><br></label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_estado_rpp"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal estado registro público de la propiedad.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_registro_infonavit"  style="margin-top: 0px">
                                        <label class="form-label">Registro infonavit.</label>
                                               
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_razon_social"  style="margin-top: 0px">
                                        <label class="form-label">Razón social</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_patronal_imss"  style="margin-top: 0px">
                                        <label class="form-label">Registro patronal del IMSS.</label>                                         
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_codigo_postal"  style="margin-top: 0px">
                                        <label class="form-label">Código postal</label>
                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_p_movil"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono principal móvil.</label>                                             
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_fecha_escritura_publica"  style="margin-top: 0px">
                                        <label class="form-label">Fecha escritura pública.</label>                                             
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_estado_notaria"  style="margin-top: 0px">
                                        <label class="form-label">Estado notaria.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_fecha_inscripcion_rp"  style="margin-top: 0px">
                                        <label class="form-label">Fecha de inscripción del registro público de la propiedad.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_numero_notaria_ep"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal número notaria escritura pública.</label>                                             
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_folio_rpp"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal folio registro público de la propiedad.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_giro"  style="margin-top: 0px">
                                        <label class="form-label">Giro</label>                                              
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_nombre"  style="margin-top: 0px">
                                        <label class="form-label">Nombre Representante legal.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_direccion_principal"  style="margin-top: 0px">
                                        <label class="form-label">Dirección principal</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_p_fijo"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono principal fijo. </label>                                             
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_s_movil"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono secundario  móvil. </label>                                               
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_fedatorio_escritura_publica"  style="margin-top: 0px">
                                        <label class="form-label">Fedatario de la escritura pública.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_estado_rp"  style="margin-top: 0px">
                                        <label class="form-label">Estado del registro público de la propiedad.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_numero_ep"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal número de la escritura pública.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_estado_notaria_ep"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal estado notaria escritura pública.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rl_fecha_rpp"  style="margin-top: 0px">
                                        <label class="form-label">Representante legal fecha registro público de la propiedad.</label>                                              
                                    </div>
                                    <center>
                                        <br>
                                        <button type="submit" class="btn back-imss btn-cons">Guardar registro</button>
                                    </center>
                                </div>
                            </div>  
                        </form>
                        <form class="tipo_2 grid-body no-border" enctype="multipart/form-data" method="POST" action="<?=  base_url()?>conservacion/proveedores/nuevoproveedor" style="display: none">
                            <div class="row margin-top-20">
                                <div class="col-md-12 ">
                                    <input type="hidden" name="prov_tipo">
                                    <input name="csrf_token" type="hidden">
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_num" required="" style="margin-top: 0px">
                                        <label class="form-label">N° Proveedor</label>                                               
                                    </div> 
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_patronal_imss" required="" style="margin-top: 0px">
                                        <label class="form-label">Registro patronal del IMSS.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_direccion_alternativa"  style="margin-top: 0px">
                                        <label class="form-label">Dirección alternativa.</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_p_movil"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono principal móvil.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_giro"  style="margin-top: 0px">
                                        <label class="form-label">Giro</label>                                              
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_nombre"  style="margin-top: 0px">
                                        <label class="form-label">Nombre persona Física.</label>                                              
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_codigo_postal"  style="margin-top: 0px">
                                        <label class="form-label">Código postal</label>                                               
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_p_fijo"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono principal fijo.</label>                                               
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_s_movil"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono secundario móvil.</label>                                             
                                    </div>
                                    <br>
                                    <button type="submit" class="btn back-imss btn-cons">Guardar registro</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_rfc"  style="margin-top: 0px">
                                        <label class="form-label">RFC</label>                                                
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_direccion_principal"  style="margin-top: 0px">
                                        <label class="form-label">Dirección principal</label>                                               
                                    </div>

                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_telefono_s_fijo"  style="margin-top: 0px">
                                        <label class="form-label">Teléfono secundario  fijo. </label>                                             
                                    </div>
                                    <div class="md-form-group float-label" style="margin-top: -10px">
                                        <input type="text" class="md-input" name="prov_registro_infonavit"  style="margin-top: 0px">
                                        <label class="form-label">Registro infonavit.</label>                                           
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
<?=  Modules::run('config/getFooterAdmin')?>  
<script src="<?=  base_url()?>assets/js/conservacion/proveedores.js"></script>