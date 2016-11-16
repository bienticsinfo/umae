<?= modules::run('menu/index'); ?> 
<div class="box-row">

    <div class="box-cell">
        <div class="box-inner padding">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="" data-toggle="tab" data-target="#tab1">Información de usuario</a>
                        </li>
                        <li class="hidden">
                            <a href="" data-toggle="tab" data-target="#tab2">Información de acceso</a>
                        </li>
                        <li class="hidden">
                            <a href="" data-toggle="tab" data-target="#tab3">Cambiar mi perfil</a>
                        </li>
                    </ul>  
                    <div class="tab-content p b-a no-b-t bg-white m-b-md">
                        <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab1">
                            <form id="registrar-usuario">
                                <div class="row row-sm">
                                    <div class="col-sm-3">
                                        <input type="hidden" id="jtf_empleado_id" name="jtf_empleado_id" value="<?=$info[0]['empleado_id']?>">
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_matricula" readonly="" id="empleado_matricula" value="<?=$info[0]['empleado_matricula']?>">
                                            <label  style="opacity: 1">Matricula:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>

                                        <div class="md-form-group" style="margin-top: -22px">
                                            <label  style="opacity: 1;">Sexo:</label>
                                            <select name="empleado_sexo" required="" data-value="<?=$info[0]['empleado_sexo']?>" class="select2 width100 ">
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_tel" required="" id="empleado_tel" value="<?=$info[0]['empleado_tel']?>">
                                            <label  style="opacity: 1">Telefono:</label>
                                            <span class="md-input-msg right"></span>
                                        </div> 
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_email" required="" id="empleado_email" value="<?=$info[0]['empleado_email']?>">
                                            <label  style="opacity: 1">Email:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_nombre" required="" id="empleado_nombre" value="<?=$info[0]['empleado_nombre']?>">
                                            <label  style="opacity: 1">Nombre:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>

                                        <div class="md-form-group">
                                            <input class="md-input fecha-calendar" name="empleado_fecha_nac" required="" id="empleado_fecha_nac" value="<?=$info[0]['empleado_fecha_nac']?>">
                                            <label  style="opacity: 1">Fecha de Nacimiento:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_telcel" required="" id="empleado_telcel" value="<?=$info[0]['empleado_telcel']?>">
                                            <label  style="opacity: 1">Telefono Celular:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>
                                        <br>
                                        <button  type="submit" class="btn-save md-btn md-raised m-b btn-fw back-imss waves-effect width-100 pull-right btn-block">Guardar</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_apellidos" required="" id="empleado_apellidos" value="<?=$info[0]['empleado_apellidos']?>">
                                            <label  style="opacity: 1">Apellidos:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>
                                        <div class="md-form-group">

                                            <select data-value="<?=$info[0]['empleado_estado']?>" class="select2 md-input" name="empleado_estado" style="width: 100%">
                                                <option value="">Seleccionar</option>
                                                <option value="Aguascalientes">Aguascalientes</option>
                                                <option value="Baja California">Baja California</option>
                                                <option value="Baja California Sur">Baja California Sur</option>
                                                <option value="Campeche">Campeche</option>
                                                <option value="Chiapas">Chiapas</option>
                                                <option value="Chihuahua">Chihuahua</option>
                                                <option value="Coahuila">Coahuila</option>
                                                <option value="Colima">Colima</option>
                                                <option value="Distrito Federal">Distrito Federal</option>
                                                <option value="Durango">Durango</option>
                                                <option value="Estado de México">Estado de México</option>
                                                <option value="Guanajuato">Guanajuato</option>
                                                <option value="Guerrero">Guerrero</option>
                                                <option value="Hidalgo">Hidalgo</option>
                                                <option value="Jalisco">Jalisco</option>
                                                <option value="Michoacán">Michoacán</option>
                                                <option value="Morelos">Morelos</option>
                                                <option value="Nayarit">Nayarit</option>
                                                <option value="Nuevo León">Nuevo León</option>
                                                <option value="Oaxaca">Oaxaca</option>
                                                <option value="Puebla">Puebla</option>
                                                <option value="Querétaro">Querétaro</option>
                                                <option value="Quintana Roo">Quintana Roo</option>
                                                <option value="San Luis Potosí">San Luis Potosí</option>
                                                <option value="Sinaloa">Sinaloa</option>
                                                <option value="Sonora">Sonora</option>
                                                <option value="Tabasco">Tabasco</option>
                                                <option value="Tamaulipas">Tamaulipas</option>
                                                <option value="Tlaxcala">Tlaxcala</option>
                                                <option value="Veracruz">Veracruz</option>
                                                <option value="Yucatán">Yucatán</option>
                                                <option value="Zacatecas">Zacatecas</option>
                                            </select>
                                            <label  style="opacity: 1;">Estado</label>
                                        </div>
                                        <div class="md-form-group">
                                            <input class="md-input" name="empleado_direccion" required="" id="empleado_direccion" value="<?=$info[0]['empleado_direccion']?>">
                                            <label  style="opacity: 1">Dirección:</label>
                                            <span class="md-input-msg right"></span>
                                        </div>
                                        <input type="hidden" name="csrf_token">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <center>
                                            <div style="margin-top: 25%; " >
                                            <div class="img-perfi-user" style="background: url(<?=  base_url()?>assets/img/perfiles/<?=$info[0]['empleado_perfil']?>);background-size: cover;width: 150px;height: 150px;border-radius: 50%">
                                                <div class="img-perfi-user-change">
                                                    <i class="fa fa-pencil edit-perfil-image icono-accion pointer" style="font-size: 25px;margin-top: 45%;color: white!Important"></i>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </center>
                                    </div>
                                    <style>
                                        .img-perfi-user-change{
                                            height: 150px;
                                            width: 150px;
                                            display: none;
                                            z-index: 1000000;
                                            border-radius: 50%;
                                            position: absolute;
                                            
                                        }
                                        .img-perfi-user:hover .img-perfi-user-change{
                                            display: block;
                                            background: rgb(54, 25, 25); 
                                            background: rgba(54, 25, 25, .5);  
                                        }
                                    </style>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane animated fadeIn" id="tab3">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <form class="informacion-perfil">
 
                                        <center>
                                            <div id="retrievingfilename" class="html5imageupload" data-width="250" data-height="200" data-url="<?=  base_url()?>config/upload_image_pt?tipo=img/perfiles" style="width: 250px;height: 200px" data-resize="true">
                                                <input type="file" name="thumb" >
                                            </div>
                                        </center>
                                        <input type="hidden" name="filename"  id="filename" />
                                        <center>
                                            <input type="hidden" name="csrf_token">
                                            <button class="md-btn md-raised m-b btn-fw back-imss waves-effect width-100" style="width: 100%!important" type="submit">Guardar</button>
                                        </center>
                                    </form>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hide">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="" data-toggle="tab" data-target="#tab_perfil">Imagen de perfil actual</a>
                        </li>
                    </ul>  
                    <div class="tab-content p b-a no-b-t bg-white m-b-md">
                        <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab_perfil">
                            
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/configuracion/miperfil.js')?>" type="text/javascript"></script>