<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a href="">Inicio</a></li>
                    <li><a href="#" >Almacen</a></li>
                    <li><a href="#" >Inventarios</a></li>
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/gestion_inventario" >Gestión inventarios</a></li>
                    <li><a href="" class="active">Agregar sistema</a></li>
                </ul>
            </div>    
            <div class="col-md-8 col-centered">
            <div class="card"  >
                <div class="card-heading back-imss">Agregar sistema</div>
                <div class="card-body">
                    <form id="registrar-sistema" >
                        <div class="row row-sm" >
                            <div class="col-sm-6">
                                <input type="hidden" id="jtf_prov_id" value="<?=$info[0]['prov_id']?>">
                                <input type="hidden" id="jtf_accion" name="jtf_accion" value="<?=$_GET['a']?>">
                                <input type="hidden" id="jtf_Id" name="jtf_Id" value="<?=$info[0]['sistema_id']?>">
                                <div class="md-form-group">
                                    <select id="prov_id" name="prov_id" class="select2 md-input" style="width: 100%"></select>
                                    <label style="opacity: 1">Seleccionar Proveedor</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="md-form-group">
                                    <input class="md-input" name="sistema_nombre" value="<?=$info[0]['sistema_nombre']?>" required="" id="sistema_nombre" type="text" >
                                    <label  style="opacity: 1">Nombre</label>
                                    <span class="md-input-msg right msj-pass"></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-sm">
                            <div class="col-md-12">
                                <div class="md-form-group">
                                    <textarea rows="4" class="md-input" name="sistema_descripcion" id="sistema_descripcion" ><?=$info[0]['sistema_descripcion']?></textarea>
                                    <label  style="opacity: 1">Descripción</label>
                                    <span class="md-input-msg right "></span>
                                </div> 
                            </div>

                        </div>
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <div class="md-form-group">
                                    <input class="md-input" name="sistema_contrato" required="" id="sistema_contrato"  value="<?=$info[0]['sistema_contrato']?>" type="text">
                                    <label  style="opacity: 1">Contrato</label>
                                    <span class="md-input-msg right "></span>
                                </div>   
                            </div> 
                            <div class="col-md-6">
                                <br>
                                <input type="hidden" name="csrf_token">
                                <button  type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect width-100">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/material_consumo/gestion_inventario.js')?>" ></script>