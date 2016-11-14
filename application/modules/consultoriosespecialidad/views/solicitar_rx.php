<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Consultorios de Especialidad</a></li>
                    <li><a href="#">Solicitar RX</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Solicitar RX</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="guardar-solicitud-rx" >
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-solicitud-rx">
                                        <thead>
                                            <tr>
                                                <th style="width: 40% ">Estudio Solicitado</th>
                                                <th style="width: 5%"></th>
                                                <th>Anotar datos Clinicos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>CRANEO</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo1;CRANEO" class="has-value"><i class="blue"></i>
                                                    </label>
                                                    
                                                </td>
                                                <td><input type="text" name="campo1" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>SENOS PARASANALES</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo2;SENOS PARASANALES" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo2" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>ABDOMEN SIMPLE</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo3;ABDOMEN SIMPLE" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo3" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>ESOFAGO ESTOMAGO DUODENO</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo4;ESOFAGO ESTOMAGO DUODENO" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo4" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>COLESISTOGRAFIA</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox"  name="casoclinico_nombre[]" value="campo5;COLESISTOGRAFIA" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo5" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>COLON POR ENEMA</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo6;COLON POR ENEMA" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo6" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>TORAX P.A</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo7;TORAX P.A" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo7" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>UROGRAFIA EXCRETORA</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo8;UROGRAFIA EXCRETORA" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo8" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>COLUMNA VERTEBRAL</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo9;COLUMNA VERTEBRAL" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo9" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>HUESOS</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo10;HUESOS" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo10" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                            <tr>
                                                <td>OTROS EXAMENES</td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="checkbox" name="casoclinico_nombre[]" value="campo11;OTROS EXAMENES" class="has-value"><i class="blue"></i>
                                                    </label>
                                                </td>
                                                <td><input type="text" name="campo11" placeholder="Anotar datos Clinicos" class="md-input"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="triage_id" value="<?=$_GET['t']?>"> 
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
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
<script src="<?= base_url('assets/js/os/urgencias/consultorios.js')?>" type="text/javascript"></script>