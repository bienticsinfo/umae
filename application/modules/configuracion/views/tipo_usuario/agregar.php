<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            
            <div class="card"  >
                <div class="card-heading back-imss">
                    <h2>Agregar usuario</h2>
                </div>
                <div class="card-body">
                    <form id="registrar-user">
                    <div class="row row-sm">
                        <div class="col-sm-4">
                            <input type="hidden" id="jtf_idTipo_Usuario" value="<?=$info[0]['idTipo_Usuario']?>">
                            <input type="hidden" id="jtf_IdEmpleado" value="<?=$info[0]['idEmpleado']?>">
                            <input type="hidden" id="jtf_idEquipo" value="<?=$info[0]['idEquipo']?>">
                            <input type="hidden" id="jtf_accion" name="jtf_accion" value="<?=$_GET['a']?>">
                            <input type="hidden" id="jtf_idUsuario" name="jtf_idUsuario" value="<?=$info[0]['idUsuario']?>">
                            <div class="md-form-group">
                                <select id="idTipo_Usuario" name="idTipo_Usuario" class="select2 md-input" style="width: 100%"></select>
                                <label style="opacity: 1">Tipo de usuario: ejemplo: "Administrador"</label>
                            </div>
                            <div class="md-form-group">
                                <input class="md-input" name="usuario" required="" id="usuario" value="<?=$info[0]['usuario']?>">
                                <label  style="opacity: 1">Usuario:</label>
                                <span class="md-input-msg right"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" md-form-group">
                                <select id="idEmpleado" class="select2 md-input" name="idEmpleado" style="width: 100%"></select>
                                <label  style="opacity: 1;">Empleado</label>
                            </div>
                            <div class="md-form-group">
                                <input class="md-input" name="contrasena" required="" id="contrasena" type="password" >
                                <label  style="opacity: 1">Contraseña</label>
                                <span class="md-input-msg right msj-pass"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="md-form-group">
                                <select id="idEquipo" class="select2 md-input" name="idEquipo" style="width: 100%"></select>
                                <label  style="opacity: 1;">Equipo</label>
                            </div>
                            <div class="md-form-group">
                                <input class="md-input" name="r_contrasena" required="" id="r-contrasena" type="password">
                                <label  style="opacity: 1">Confirmar Contraseña</label>
                                <span class="md-input-msg right  msj-pass"></span>
                            </div>
                            <input type="hidden" name="csrf_token">
                            <br>
                            <button  type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect width-100 pull-right">Guardar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/tipo_usuario.js')?>" type="text/javascript"></script>