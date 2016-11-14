<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Hora Cero</a></li>
                    <li><a href="#">Generar Ticket</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Generar Ticket</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="agregar-horacero-paciente">
                            <div class="row row-sm" >
                                
                                <div class="col-sm-12">
                                    <div class="md-form-group text-center" style="margin-top: -35px;text-transform: uppercase">
                                        <b>Hospital de Traumatología “Dr. Victorio de la Fuente Narvaez”</b><br><br>
                                    </div>  
                                    <div class="md-form-group text-center" style="margin-top: -35px">
                                        Av. Colector 15 S/N esq. Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas. Del. Gustavo a. Madero
                                    </div> 

                                </div>
                                <div class="col-sm-12">
                                    <div  id="barcode"></div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token" >
                                    <center>
                                    <button class="md-btn md-raised btn-block m-b btn-fw back-imss waves-effect no-text-transform" type="submit" style="margin-bottom: -10px">Generar Ticket</button>                     
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>

<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>