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
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/sistema_material?id=<?=$_GET['si']?>">Gestión de materiales</a></li>
                    <li><a href="<?=  base_url()?>materiales_consumo/almacen_osteo/material_intermedio?m=<?=$_GET['m']?>&si=<?=$_GET['si']?>">Gestión de materiales intermedios</a></li>
                    <li class="active"><a >Agregar material intermedio</a></li>
                </ul>
            </div> 
            <div class="col-md-8 col-centered">
                <div class="card"  >
                    <div class="card-heading back-imss">Agregar material intermedio</div>
                    <div class="card-body">
                        <form action="<?=  base_url()?>materiales_consumo/almacen_osteo/insert_material_intermedio" method="POST" enctype="multipart/form-data">      
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row row-sm" >
                                        <div class="col-md-12">
                                            <div class="md-form-group">
                                                <input class="md-input" name="intermedia_nombre" value="<?=$info[0]['intermedia_nombre']?>" required="" id="sistema_nombre" type="text" >
                                                <label  style="opacity: 1">Nombre</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>      
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="material_id" name="material_id" value="<?=$_GET['m']?>">
                                            <input type="hidden" id="jtf_accion" name="jtf_accion" value="<?=$_GET['a']?>"> 
                                            <input type="hidden" id="jtf_si" value="<?=$_GET['si']?>" name="jtf_si">
                                            <input type="hidden" id="jtf_Id" name="jtf_Id" value="<?=$_GET['id']?>">
                                            <input type="hidden" id="jtf_fecha" name="jtf_fecha" value="" >
                                            <div class="md-form-group">
                                                <input class="md-input" name="intermedia_cantidad" value="<?=$info[0]['intermedia_cantidad']?>" required="" id="intermedia_cantidad" type="text" >
                                                <label  style="opacity: 1">Cantidad</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="md-form-group">
                                                <input class="md-input" name="intermedia_medida" value="<?=$info[0]['intermedia_medida']?>" required="" id="sistema_nombre" type="text" >
                                                <label  style="opacity: 1">Medida</label>
                                                <span class="md-input-msg right msj-pass"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="md-form-group">
                                                <textarea rows="4" class="md-input" name="intermedia_descripcion"  id="intermedia_descripcion" ><?=$info[0]['intermedia_descripcion']?></textarea>
                                                <label  style="opacity: 1">Descripción</label>
                                                <span class="md-input-msg right "></span>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <input type="hidden" name="csrf_token" id="csrf_token">
                                            <button  type="submit" class="md-btn md-raised m-b btn-fw back-imss waves-effect width-100 pull-right" style="margin-top: 5px">Guardar</button>
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