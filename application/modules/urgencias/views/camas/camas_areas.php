<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
           <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#">Áreas</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Áreas</span>
                    <?php if(in_array('25', $_SESSION['IMSS_ROLES'])){?>
                    <a href="<?=  base_url()?>urgencias/areas_add?a=add&ar=0" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                    <?php } ?>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th >Áreas</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['area_id']?>">
                            <td><?=$value['area_nombre']?></td>
                            <td class="text-center">    
                                <a href="<?=  base_url()?>urgencias/camas_area?area=<?=$value['area_id']?>">
                                    <i class="fa fa-bed icono-accion tip" data-original-title="Administrar Camas"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>

                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="7" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/centralservicio/programacion.js')?>" type="text/javascript"></script>