<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            
            <div class="card"  >
                <div class="card-heading back-imss">
                    <h2>Agregar usuario</h2>
                </div>
                <div class="card-body">
                    <form id="registrar-usuario">
                        <div class="row row-sm">
                            <div class="col-sm-4">
                                <input type="hidden" id="jtf_idTipo_Usuario" value="<?=$info[0]['idTipo_Usuario']?>">
                                <input type="hidden" id="jtf_idEquipo" value="<?=$info[0]['idEquipo']?>">
                                <input type="hidden" id="jtf_accion" name="jtf_accion" value="<?=$_GET['a']?>">
                                <input type="hidden" id="jtf_empleado_id" name="jtf_empleado_id" value="<?=$info[0]['empleado_id']?>">
                                <input type="hidden" id="empleado_fecha_registro" name="empleado_fecha_registro">
                                <input type="hidden" id="jtf_empleado_estado" value="<?=$info[0]['empleado_estado']?>">
                                <input type="hidden" id="jtf_empleado_sexo" value="<?=$info[0]['empleado_sexo']?>">
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_matricula" required="" id="empleado_matricula" value="<?=$info[0]['empleado_matricula']?>">
                                    <label  style="opacity: 1">Matricula:</label>
                                    <span class="md-input-msg right"></span>
                                </div>

                                <div class="md-form-group" style="margin-top: -22px">
                                    <label  style="opacity: 1;">Sexo:</label>
                                    <select name="empleado_sexo" required="" id="empleado_sexo" class="select2 width100 ">
                                        <option value="M">M</option>
                                        <option value="F" selected="">F</option>
                                    </select>
                                </div>
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_tel" id="empleado_tel" value="<?=$info[0]['empleado_tel']?>">
                                    <label  style="opacity: 1">Telefono:</label>
                                    <span class="md-input-msg right"></span>
                                </div> 
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_email"  id="empleado_email" value="<?=$info[0]['empleado_email']?>">
                                    <label  style="opacity: 1">Email:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_usuario" required="" id="empleado_usuario" value="<?=$info[0]['empleado_usuario']?>">
                                    <label  style="opacity: 1">Usuario:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
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
                                    <input class="md-input" name="empleado_telcel" id="empleado_telcel" value="<?=$info[0]['empleado_telcel']?>">
                                    <label  style="opacity: 1">Telefono Celular:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_curp" id="empleado_curp" value="<?=$info[0]['empleado_curp']?>">
                                    <label  style="opacity: 1">CURP:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                                
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_contrasena" required="" id="empleado_contrasena" type="password" >
                                    <label  style="opacity: 1">Contraseña</label>
                                    <span class="md-input-msg right msj-pass"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_apellidos"  id="empleado_apellidos" value="<?=$info[0]['empleado_apellidos']?>">
                                    <label  style="opacity: 1">Apellidos:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                                <div class="md-form-group">

                                    <select id="empleado_estado" class="select2 md-input" name="empleado_estado" style="width: 100%">
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
                                        <option value="Estado de México" selected="">Estado de México</option>
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
                                    <input class="md-input" name="empleado_direccion" id="empleado_direccion" value="<?=$info[0]['empleado_direccion']?>">
                                    <label  style="opacity: 1">Dirección:</label>
                                    <span class="md-input-msg right"></span>
                                </div>
                                <div class="md-form-group">
                                    <select id="idEquipo" class="select2 md-input" name="idEquipo" style="width: 100%"></select>
                                    <label  style="opacity: 1;">Equipo</label>
                                </div>
                                <div class="md-form-group">
                                    <input class="md-input" name="empleado_contrasena_c" required="" id="empleado_contrasena_c" type="password">
                                    <label  style="opacity: 1">Confirmar Contraseña</label>
                                    <span class="md-input-msg right  msj-pass"></span>
                                </div>
                                <input type="hidden" name="csrf_token">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="md-form-group">
                                    <select id="idTipo_Usuario" name="idTipo_Usuario[]" class="select2 md-input" multiple="" style="width: 100%"></select>
                                    <label style="opacity: 1">Seleccionar Roles</label>
                                    <input type="hidden" name="roles_asignados" value="<?=$roles_asignados?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form-group" style="margin-top: -20px">
                                    <label>Turno</label>
                                    <select name="empleado_turno" class="select2 empleado_turno width100" data-value="<?=$info[0]['empleado_turno']?>">
                                        <option value="Matutino">Matutino</option>
                                        <option value="Vespertino">Vespertino</option>
                                        <option value="Nocturno">Nocturno</option>
                                        <option value="Jornada Acumulada">Jornada Acumulada</option>
                                    </select>
                                </div>
                                <br>
                                <button  type="submit" class="btn-save md-btn md-raised m-b btn-fw back-imss waves-effect width-100 pull-right">Guardar</button>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/configuracion/usuario.js')?>" type="text/javascript"></script>