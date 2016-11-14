<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-7 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Triage</a></li>
                    <li><a href="#">Nuevo Registro</a></li>
                </ul>
            </div>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Nuevo Registro</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="agregar-paso1">
                            <div class="row row-sm" style="margin-left: -40px">
                                <div class="col-sm-6 hidden">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Fecha </label>
                                        <input class="md-input triage_fecha" name="triage_fecha" value="<?=$info[0]['triage_fecha']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-6 hidden">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <label>Hora </label>
                                        <input class="md-input triage_hora" name="triage_hora" value="<?=$info[0]['triage_hora']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="md-form-group" style="margin-top: -35px">
                                                <label>Nombre </label>
                                                <input class="md-input" name="triage_nombre" required="" placeholder="Ejemplo: Fuentes Cervantes Manuel Alejandro." value="<?=$info[0]['triage_nombre']?>">   
                                                
                                            </div>          
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group" style="margin-top: -35px">
                                                <label>Fecha de Nac</label>
                                                <input class="md-input dd-mm-yyyy" name="triage_fecha_nac" required="" placeholder="Ej. 03/03/2013" value="<?=$info[0]['triage_fecha_nac']?>">   
                                            </div>                   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="md-form-group" style="margin-top: -20px">
                                                <label>Procedencia Espontánea: </label>&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="triage_procedencia_espontanea" value="Si" checked="" class="has-value "><i class="green"></i>SI
                                                </label>&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="triage_procedencia_espontanea" value="No" class="has-value prosedencia_no" ><i class="green"></i>NO
                                                </label>
                                                <input class="md-input " required="" style="margin-top: 20px" type="text" name="triage_procedencia" placeholder="Lugar de Procedencia" value="<?=$info[0]['triage_procedencia']?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-no-espontaneo hidden">
                                            <div class="md-form-group" style="margin-top: -20px">
                                                <label>Hospital de Procedencia</label>
                                                <select name="triage_hospital_procedencia" class="form-control">
                                                    <option value="UMF">UMF</option>
                                                    <option value="HGZ">HGZ</option>
                                                    <option value="UMAE">UMAE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-no-espontaneo hidden">
                                            <div class="md-form-group" style="margin-top: -20px">
                                                Nombre Hospital/ Numero
                                                <input class="md-input" placeholder="Ejemplo: 36" name="triage_hostital_nombre_numero"  value="<?=$info[0]['triage_hostital_nombre_numero']?>">   
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_2.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Tensión arterial: </label>
                                        </a>
                                        <input class="md-input " placeholder="Ejemplo: 130/90" name="triage_tension_arterial"  value="<?=$info[0]['triage_tension_arterial']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_1.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Temperatura: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 37" name="triage_temperatura"  value="<?=$info[0]['triage_temperatura']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_3.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Frecuencia cardiaca o pulso: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 78" name="triage_frecuencia_cardiaco"  value="<?=$info[0]['triage_frecuencia_cardiaco']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_4.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Frecuencia respiratoria: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 37" name="triage_frecuencia_respiratoria"  value="<?=$info[0]['triage_frecuencia_respiratoria']?>">   
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="triage_id" value="<?=$_GET['t']?>"> 
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="triage_unidad_medica" value="UMAE | Dr. Victorio de la Fuente Narváez">
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
<script src="<?= base_url('assets/js/os/triage/triage.js')?>" type="text/javascript"></script>