<?=  Modules::run('config/getHeadAdmin')?>
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuevo usuario
                </div>
                <div class="card-"> <br>
                    <form id="registro-user" class="card-heading">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-form-group float-label">
                                    <input class="md-input" name="txtNombre" id="txtNombre" value="<?=$info[0]['usuario_nombre']?>" required="">
                                    <label>Nombre</label>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    
                                    <input type="text" name="txtApellidos" id="txtApellidos" value="<?=$info[0]['usuario_apellidos']?>" class="md-input" required="" >
                                    <label >Apellidos</label>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    
                                    <input type="text" name="txtDireccion" id="txtDireccion" value="<?=$info[0]['usuario_direccion']?>" class="md-input" required="" >
                                    <label>Dirección</label>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <input type="text" name="txtTelefono" id="txtTelefono" value="<?=$info[0]['usuario_telefono']?>" class="md-input" required="">
                                    <label class="form-label">Telefono</label>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <input type="text" name="txtEmail" id="txtEmail" class="md-input" value="<?=$info[0]['usuario_email']?>" required="" >
                                    <label class="form-label">Email</label>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-top: 5px">
                                    <br>
                                    <div class="controls">
                                        <select name="txtRol" id="txtRol" style="width: 100%">
                                            <option>Seleccionar rol</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Jefe de Departamento</option>
                                            <option value="3">Jefe de conservacion</option>
                                            <option value="4">Asistente administrativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <input type="text" name="txtUsuario" id="txtUsuario" value="<?=$info[0]['usuario_user']?>" class="md-input" required="" >
                                        <label class="form-label">Usuario</label>
                                </div> 
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <input type="password" name="txtContra" id="txtContra" class="md-input" required="" >
                                    <label class="form-label">Contraseña</label>
                                </div>
                                <div class="md-form-group float-label" style="margin-top: -10px">
                                    <input type="password" name="txtContraC" id="txtContraC" class="md-input" required="" >
                                    <label class="form-label">Confirmar contraseña</label>
                                </div> 
                                <div class="form-group">
                                    <div class="">
                                        <br>
                                        <input type="hidden" name="txtAccion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="txtId" value="<?=$_GET['u']?>">
                                        <input name="csrf_token" type="hidden">
                                        <button type="submit" class="btn btn-cons back-imss btn-add pull-right">Guardar</button>
                                        
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
<?=  Modules::run('config/getFooterAdmin')?>
<script src="<?=  base_url()?>assets/js/conservacion/usuarios.js"></script>
