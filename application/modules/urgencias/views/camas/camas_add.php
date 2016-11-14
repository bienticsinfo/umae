<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="clearfix"></div>
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-8 col-centered">
            <?php if($_GET['a']=='add'){
             $accion='Nueva Cama';   
            }else{
                $accion='Editar Cama';
            }
            ?>
                <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                    <ul class="breadcrumb">
                        <li><a >Inicio</a></li>
                        <li><a href="#" class="back-history2">Áreas</a></li>
                        <li><a href="#" class=""><?=$area[0]['area_nombre']?></a></li>
                        <li><a href="#" class="back-history1">Camas</a></li>
                        <li><a href="#"><?=$accion?></a></li>
                    </ul>
                </div>
            <div class="panel panel-default">
                <div class="panel-heading back-imss"><?=$accion?></div>
                <div class="">
                    <form class="card-heading agregar-cama">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form-group float-label">
                                    <label>Nombre</label>
                                    <input class="md-input" name="cama_nombre" placeholder="Ejemplo: Cama 1" value="<?=$info[0]['cama_nombre']?>" required="">
                                    
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <br>
                                        <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="cama_id" value="<?=$_GET['c']?>">
                                        <input type="hidden" name="area_id" value="<?=$_GET['area']?>">
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
</div>
<?= modules::run('menu/footer'); ?> 
<script src="<?=  base_url()?>assets/js/os/urgencias/camas.js" type="text/javascript"></script>
