<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a  >Almacen</a></li>
                    <li><a  >Inventarios</a></li>
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/gestion_inventario" >Gestión inventarios</a></li>
                    <li><a class="active" href="<?=  base_url()?>materiales_consumo/almacen_osteo/sistema_material?id=<?=$_GET['m']?>">Gestión de materiales</a></li>
                    <li><a class="active">Agregar Material</a></li>
                </ul>
            </div> 
            <div class="col-md-8 col-centered">
                <div class="card"  >
                    <div class="card-heading back-imss">Agregar Material</div>
                    <div class="card-body">
                        <form id="registrar-sistema-material" enctype="multipart/form-data">      
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row row-sm" >
                                        <div class="col-sm-6">
                                            <input type="hidden" id="sistema_id" name="sistema_id" value="<?=$_GET['m']?>">
                                            <input type="hidden" id="jtf_accion" name="jtf_accion" value="<?=$_GET['a']?>"> 
                                            <input type="hidden" id="jtf_Id" name="jtf_Id" value="<?=$info[0]['material_id']?>">
                                            <input type="hidden" id="jtf_material_intermedio" value="<?=$info[0]['material_intermedio']?>">
                                            <input type="hidden" id="jtf_material_cantidad" name="jtf_material_cantidad" value="<?=$info[0]['material_cantidad']?>">
                                            <input type="hidden" id="jtf_fecha" name="jtf_fecha" value="" >
                                            <div class="md-form-group">
                                                <input class="md-input" name="material_nombre" value="<?=$info[0]['material_nombre']?>" required="" id="sistema_nombre" type="text" >
                                                <label  style="opacity: 1">Nombre</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="md-form-group">
                                                <input class="md-input" name="material_clave" value="<?=$info[0]['material_clave']?>" required="" id="sistema_nombre" type="text" >
                                                <label  style="opacity: 1">Clave</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="md-form-group">
                                                <textarea rows="8" class="md-input" name="material_descripcion" id="material_descripcion" ><?=$info[0]['sistema_descripcion']?></textarea>
                                                <label  style="opacity: 1">Descripción</label>
                                                <span class="md-input-msg right "></span>
                                            </div>
                                            <div class="md-form-group" style="margin-top: -20px">
                                                <label  style="opacity: 1">Materiales Intermedios</label><br>
                                                <label class="md-check">
                                                    <input type="radio" class="material-i" name="material_intermedio" value="Si" checked="">
                                                    <i class="indigo"></i>Si
                                                </label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" class="material-i mi_n" name="material_intermedio" value="No">
                                                    <i class="indigo"></i>No
                                                </label>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div id="retrievingfilename" class="html5imageupload" data-width="500" data-height="300" data-url="<?=  base_url()?>config/upload_image_pt?tipo=material_sistema" style="width: 100%;" data-resize="true">
                                                <input type="file" name="thumb" >
                                            </div>
                                            <input type="hidden" name="filename"  id="filename" />
                                            <br><br>
                                            <div class="md-form-group material_cantidad hidden" >
                                                <input class="md-input material_cantidad_input "  name="material_cantidad" value="<?=$info[0]['material_cantidad']?>" required="" id="material_cantidad" type="hidden" >
                                                <label  style="opacity: 1 " class="material_cantidad hidden">Cantidad</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>                                          
                                            <input type="hidden" name="csrf_token" id="csrf_token">
                                            <button  type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect width-100 pull-right" style="margin-top: 5px">Guardar</button>
                                        </div>
                                        
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-md-12">

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
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/material_consumo/gestion_inventario.js')?>" ></script>