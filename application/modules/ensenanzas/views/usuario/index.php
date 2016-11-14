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
                  <li class="pointer tabModificar no-display" >
                      <a id="modificar" >Modificar</a>
                  </li>
                </ul>
                <style>
                    #usuario_econtrado tr,.infoMas,.downloadPdf{
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
                              <th data-toggle="true" class="text-center">Matricula</th>
                              <th data-hide="phone">Nombre</th>
                              <th data-hide="phone">Responsable</th>
                              <th>Credencial</th>
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
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Nombre:</label>
                                                    <span class="help">ejemplo: "Jorge"</span>
                                                    <div class="controls input-with-icon right" >
                                                        <i class=""></i>
                                                        <input type="text" name="jtfNombre" id="jtfNombre" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Apellido paterno:</label>
                                                    <div class="controls input-with-icon right" >
                                                        <i class=""></i>
                                                        <input type="text" name="jtfApat" id="jtfApat" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Apellido materno:</label>
                                                    <div class="controls input-with-icon right" >
                                                        <i class=""></i>
                                                        <input type="text" name="jtfAmat" id="jtfAmat" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Matricula:</label>
                                                    <div class="controls input-with-icon right" >
                                                        <i class=""></i>
                                                        <input type="text" name="jtfMatricula" id="jtfMatricula" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Horarios:</label>
                                                    <div class="controls input-with-icon right input-group" >
                                                       <i class="exclamation-3"></i>
                                                       <input id="jtfHorario" name="jtfHorario"  type="text" class="form-control">
                                                       <span class="buscar-horarios input-group-addon primary pointer b-green-i bor-green-i">     
                                                            <span class="arrow arrow-m c-green-i b-green-i"></span>
                                                            <i class="fa fa-plus-square fa-white"></i>    
                                                       </span>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Responsable:</label>
                                                    <div class="controls input-with-icon right input-group" >
                                                        <i class="exclamation-3"></i>
                                                        <input type="hidden" id="jtfIdResponsable" name="jtfIdResponsable" class="form-control">
                                                        <input id="jtfResponsable" name="jtfResponsable"  type="text" class="form-control">
                                                        <span class="buscar-responsable input-group-addon primary pointer b-green-i bor-green-i">     
                                                            <span class="arrow arrow-m c-green-i b-green-i"></span>
                                                            <i class="fa fa-plus-square fa-white"></i>    
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Email:</label>
                                                    <div class="controls input-with-icon right" >
                                                        <i class=""></i>
                                                        <input type="text" name="jtfEmail" id="jtfEmail" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Tipo de residente:</label>
                                                    <div class="controls input-with-icon right" style="">
                                                        <div class="radio radio-success">
                                                             <input type="radio" value="Sede" name="optionyes[]" id="Sede">
                                                             <label for="Sede">Sede</label>
                                                             <input type="radio" checked="checked" value="Rotantes" name="optionyes[]" id="Rotantes">
                                                              <label for="Rotantes">Rotantes</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="" id="jtfTipoRotante">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Especialidad:</label>
                                                    <span class="help">ejemplo: "ANESTESIOLOGÍA"</span>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <input type="text" name="jtfEspecialidad" id="jtfEspecialidad" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group inputSede" hidden="" style="margin-top:20px;">
                                                    <label class="form-label">Año:</label>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <select class="form-control" name="jtfAnio" id="jtfAnio">
                                                            <option value="1er Año">1er Año</option>
                                                            <option value="2do Año">2do Año</option>
                                                            <option value="3er Año">3er Año</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group inputRontantes" style="margin-top:20px;">
                                                    <label class="form-label">Grado:</label>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <select class="form-control" name="jtfGrado" id="jtfGrado">
                                                            <option value="R-1">R-1</option>
                                                            <option value="R-2">R-2</option>
                                                            <option value="R-3">R-3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="jtfFechaRegistro">
                                                <div class="form-group" style="margin-top:20px;">
                                                    <label class="form-label">Lugar Sede:</label>
                                                    <span class="help">ejemplo: "Traumatología"</span>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <select class="form-control" name="jtfLugarSede" id="jtfLugarSede">
                                                            <option value="14">Traumatología</option>
                                                            <option value="20">Rehabilitación</option>
                                                            <option value="21">Ortopedia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group inputRontantes" style="margin-top:20px;">
                                                    <label class="form-label">Servicio de rotación:</label>
                                                    <span class="help">ejemplo: "Choque"</span>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <input type="text" name="jtfServicioR" id="jtfServicioR" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group " style="margin-top:20px;">
                                                    <div class="controls input-with-icon right" style="">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" style="margin-top:0px;">
                                                                    <label class="form-label">Inició vigencia</label>
                                                                    <div class="controls input-with-icon right input-group date" id="f-inicio" >
                                                                        <i class="exclamation-5"></i>
                                                                        <input id="jtfFechaInicio" type="text" name="jtfFechaInicio" class="form-control" />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>	
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group" style="margin-top:0px;">
                                                                    <label class="form-label">Termino vigencia</label>
                                                                    <div class="controls input-with-icon right input-group date" id="f-fin" >
                                                                        <i class="exclamation-5"></i>
                                                                        <input id="jtfFechaFin" type="text" name="jtfFechaFin" class="form-control" />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group inputRontantes" style="margin-top:-20px;">
                                                    <label class="form-label">Hospital:</label>
                                                    <span class="help">ejemplo: "H.T.F.V.N"</span>
                                                    <div class="controls input-with-icon right" style="">
                                                        <i class=""></i>
                                                        <input type="text" name="jtfHospital" id="jtfHospital" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-actions b-gray">
                                                    <div class="pull-right" >
                                                        <input type="hidden" name="jtfAccion" id="jtfAccion" value="Agregar">
                                                        <input type="hidden" name="jtfIdUser" id="jtfIdUser" value="0">
                                                        <input type="hidden" name="jtfDias" id="jtfDias">
                                                        <input type="hidden" name="jtfHoraE" id="jtfHoraE">
                                                        <input type="hidden" name="jtfHoraS" id="jtfHoraS">
                                                        <button id="cancelar" type="button" class="btn btn-white btn-cons-md">Cancelar</button>
                                                        <button id="aceptar" type="submit" class="btn btn-primary btn-cons-md b-green-i">Aceptar</button>
                                                    </div>
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
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/en_usuario.js')?>" type="text/javascript"></script>