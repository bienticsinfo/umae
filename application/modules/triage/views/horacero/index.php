<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Triage</a></li>
            </ol>    
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">
                        <strong>TRIAGE</strong><br>
                    </span>
                    <a  md-ink-ripple="" class="agregar-horacero-paciente md-btn md-fab m-b tip green waves-effect pull-right" data-original-title="Generar Ticket">
                        <i class="fa fa-clock-o fa-3x"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 0px">
                        <div class="col-sm-12">
                            <div class="md-form-group text-center" style="margin-top: -15px;text-transform: uppercase;font-size: 25px">
                                <b>Hospital de Traumatología</b>
                            </div> 
                            <div class="md-form-group text-center" style="margin-top: -40px;text-transform: uppercase;font-size: 1.2em">
                                <b>“Dr. Victorio de la Fuente Narváez”</b><br><br><br>
                            </div> 
                            <div class="md-form-group text-center hidden" style="margin-top: 0px;text-transform: uppercase;font-size: 1.2em">
                                <img class="code128" style="margin-left:-20px ">
                            </div> 
                            <div class="md-form-group text-center" style="margin-top:calc(30%)">
                                Av. Colector 15 S/N esq. Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas. Del. Gustavo a. Madero
                            </div> 

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('menu/footer'); ?>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/triage/triage_actualizar.js')?>" type="text/javascript"></script>