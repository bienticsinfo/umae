<?= modules::run('menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default no-border" style="background: transparent;border: transparent;margin-top: -20px">
                <ul class="breadcrumb">
                    <li><a >Inicio</a></li>
                    <li><a href="#" class="back-history1">Consultorios de Especialidad</a></li>
                    <li><a href="#">Requisitar Información</a></li>
                </ul>
            </div>
             <style>
                hr.style-eight {border: 0;border-top: 4px double #8c8c8c;text-align: center;}
                hr.style-eight:after {
                content: attr(data-titulo);display: inline-block;position: relative;top: -0.7em;
                font-size: 1.2em;padding: 0 0.20em;background: white;
            }
            </style>
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Requisitar Información</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right hidden">
                    <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="guardar-solicitud-hf">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: -20px">
                                    <div class="form-group">
                                        <label>Intoxicación</label><br>
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_intoxitacion"  data-value="<?=$hojaforntal[0]['hf_intoxitacion']?>" value="Si" class="has-value">
                                                    <i class="indigo"></i>Si
                                                </label>&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="hf_intoxitacion" value="No" class="has-value">
                                                    <i class="indigo"></i>No
                                                </label>        
                                            </div>
                                            <div class="col-md-10" style="padding-left: 0px">
                                                <input type="text" name="hf_intoxitacion_descrip" value="<?=$hojaforntal[0]['hf_intoxitacion_descrip']?>" class="form-control" placeholder="Especifique" style="margin-top: -8px">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Urgencia</label><br>
                                        <label class="md-check">
                                            <input type="radio" name="hf_urgencia"id="hf_urgencia_si" data-value="<?=$hojaforntal[0]['hf_urgencia']?>"  value="Urgencia Real" class="has-value">
                                            <i class="green"></i>Urgencia Real
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="hf_urgencia" id="hf_urgencia_no" data-value="<?=$hojaforntal[0]['hf_urgencia']?>" value="Urgencia Sentida" class="has-value">
                                            <i class="green"></i>Urgencia Sentida
                                        </label>        
                                    </div>
                                    <div class="form-group">
                                        <label>Especialidad</label><br>
                                        <label class="md-check">
                                            <input type="radio" name="hf_especialidad" data-value="<?=$hojaforntal[0]['hf_especialidad']?>" data-value value="Traumatologia" class="has-value">
                                            <i class="blue"></i>Traumatologia
                                        </label>&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="hf_especialidad" data-value="" value="Neurologia" class="has-value">
                                            <i class="blue"></i>Neurologia
                                        </label>&nbsp;&nbsp;  
                                        <label class="md-check">
                                            <input type="radio" name="hf_especialidad" data-value="" value="C. General" class="has-value">
                                            <i class="blue"></i>C. General
                                        </label>&nbsp;&nbsp;  
                                        <label class="md-check">
                                            <input type="radio" name="hf_especialidad" data-value="" value="C. Reconstructiva" class="has-value">
                                            <i class="blue"></i>C. Reconstructiva
                                        </label>&nbsp;&nbsp;  
                                        <label class="md-check">
                                            <input type="radio" name="hf_especialidad"  value="C. Maxilofacial" class="has-value">
                                            <i class="blue"></i>C. Maxilofacial
                                        </label>&nbsp;&nbsp;  
                                    </div>
                                    <div class="form-group">
                                        <label>Motivo de Urgencia</label>
                                        <textarea class="form-control" rows="4" maxlength="200" name="hf_motivo"><?=$hojaforntal[0]['hf_motivo']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Mecanismo de Lesión</label><br>
                                        <div class="row">
                                            <div class="col-md-3" >
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_caida" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_caida']?>" value="Caida" class="has-value">
                                                    <i class="indigo"></i>Caida
                                                </label>
                                                <input type="text" name="hf_mecanismolesion_mtrs" value="<?=$hojaforntal[0]['hf_mecanismolesion_mtrs']?>" class="form-control" style="width: 60%;float: right;margin-top: -5px" placeholder="Mtrs">
                                            </div>
                                            <div class="col-md-3" style="padding-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_ab" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_ab']?>" value="Arma blanca" class="has-value">
                                                    <i class="indigo"></i>Arma blanca
                                                </label>
                                            </div>
                                            <div class="col-md-3" style="padding-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_td" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_td']?>" value="Traumatismo directo" class="has-value">
                                                    <i class="indigo"></i>Traumatismo directo
                                                </label>&nbsp;&nbsp;    
                                            </div>
                                            <div class="col-md-3" style="padding-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_av" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_av']?>" value="ACC. Vial" class="has-value">
                                                    <i class="indigo"></i>ACC. Vial
                                                </label>&nbsp;&nbsp;    
                                            </div>    
                                        </div>
                                        <div class="row" style="margin-top: 5px"s>
                                            <div class="col-md-3" >
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_maquinaria" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_maquinaria']?>" value="Maquinaria" class="has-value">
                                                    <i class="indigo"></i>Maquinaria
                                                </label>&nbsp;&nbsp;
                                            </div>
                                            <div class="col-md-3" style="padding-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_mecanismolesion_mordedura" data-value="<?=$hojaforntal[0]['hf_mecanismolesion_mordedura']?>" value="Mordedura" class="has-value">
                                                    <i class="indigo"></i>Mordedura
                                                </label>
                                            </div>
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <input name="hf_mecanismolesion_otros" class="form-control" value="<?=$hojaforntal[0]['hf_mecanismolesion_otros']?>" style="margin-top: -5px" placeholder="Otros">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Quemadura</label>
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_quemadura_fd" data-value="<?=$hojaforntal[0]['hf_quemadura_fd']?>" value="Fuego Directo" class="has-value">
                                                    <i class="indigo"></i>Fuego Directo
                                                </label>
                                            </div>
                                            <div class="col-md-3" style="">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_quemadura_ce" data-value="<?=$hojaforntal[0]['hf_quemadura_ce']?>" value="Corriente Electrica" class="has-value">
                                                    <i class="indigo"></i>Corriente Electrica
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_quemadura_e" data-value="<?=$hojaforntal[0]['hf_quemadura_e']?>" value="Escaldadura" class="has-value">
                                                    <i class="indigo"></i>Escaldadura
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding-left: 0px;padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_quemadura_q" data-value="<?=$hojaforntal[0]['hf_quemadura_q']?>" value="Quimica" class="has-value">
                                                    <i class="indigo"></i>Quimica
                                                </label>
                                            </div>
                                            <div class="col-md-3" style="padding-left: 0px;">
                                                <input name="hf_quemadura_otros" value="<?=$hojaforntal[0]['hf_quemadura_otros']?>" class="form-control" style="margin-top: -8px" placeholder="Otros">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Antecedentes</label>
                                        <textarea class="form-control hf_antecedentes" rows="2" maxlength="110" name="hf_antecedentes"><?=$hojaforntal[0]['hf_antecedentes']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Signos Vitales</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>T.A: <?=$info[0]['triage_tension_arterial']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>F.C: <?=$info[0]['triage_frecuencia_cardiaco']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>F.R: <?=$info[0]['triage_frecuencia_respiratoria']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Temp: <?=$info[0]['triage_temperatura']?>°C</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Exploración Física</label>
                                        <textarea class="form-control hf_exploracionfisica" maxlength="330" rows="3" name="hf_exploracionfisica"><?=$hojaforntal[0]['hf_exploracionfisica']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>RX: <?=  empty($rx)?'No Solicitado':''?></label>
                                        <div class="row">
                                            <?php foreach ($rx as $value) {?>
                                            <div class="col-md-12">
                                                <?=$value['casoclinico_nombre']?> : <?=$value['casoclinico_datos']?>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Interpretación</label>
                                        <textarea class="form-control hf_interpretacion" maxlength="240" rows="3" name="hf_interpretacion"><?=$hojaforntal[0]['hf_interpretacion']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Diagnosticos (<span class="hf_diagnosticos_length">0 / 540</span>)</label>
                                        <textarea class="form-control hf_diagnosticos" maxlength="540" rows="4" name="hf_diagnosticos"><?=$hojaforntal[0]['hf_diagnosticos']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tratamiento</label>
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_trataminentos_curacion" data-value="<?=$hojaforntal[0]['hf_trataminentos_curacion']?>" value="Curación" class="has-value">
                                                    <i class="indigo"></i>Curación
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_trataminentos_sutura" data-value="<?=$hojaforntal[0]['hf_trataminentos_sutura']?>" value="Sutura" class="has-value">
                                                    <i class="indigo"></i>Sutura
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_trataminentos_vendaje" data-value="<?=$hojaforntal[0]['hf_trataminentos_vendaje']?>" value="Vendaje" class="has-value">
                                                    <i class="indigo"></i>Vendaje
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding: 0px;margin-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_trataminentos_ferula" data-value="<?=$hojaforntal[0]['hf_trataminentos_ferula']?>" value="Ferula"  class="has-value">
                                                    <i class="indigo"></i>Ferula
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding: 0px;margin-left: 0px">
                                                <label class="md-check">
                                                    <input type="checkbox" name="hf_trataminentos_vacunas" data-value="<?=$hojaforntal[0]['hf_trataminentos_vacunas']?>" value="Vacunas" class="has-value">
                                                    <i class="indigo"></i>Vacunas
                                                </label>
                                            </div>
                                            <div class="col-md-2" style="padding-left: 0px;">
                                                <input type="text" name="hf_trataminentos_otros" placeholder="Otros" value="<?=$hojaforntal[0]['hf_trataminentos_otros']?>" style="margin-top: -6px" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-md-4">
                                                <label>Por</label><input type="number" name="hf_trataminentos_por" value="<?=$hojaforntal[0]['hf_trataminentos_por']?>" placeholder="Dias" style="margin-top: -6px;float: right;width: 90%" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Receta Por</label>
                                        <textarea class="form-control" maxlength="110" rows="2" name="hf_receta_por"><?=$hojaforntal[0]['hf_receta_por']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Indicaciones</label>
                                        <textarea class="form-control hf_indicaciones" maxlength="240" rows="3" name="hf_indicaciones"><?=$hojaforntal[0]['hf_indicaciones']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Notificación al ministerio publico</label><br>
                                        <label class="md-check">
                                            <input type="radio" name="hf_ministeriopublico" data-value="<?=$hojaforntal[0]['hf_ministeriopublico']?>" value="Si" class="has-value">
                                            <i class="red"></i>Si
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="hf_ministeriopublico" data-value="<?=$hojaforntal[0]['hf_ministeriopublico']?>" value="No" class="has-value">
                                            <i class="red"></i>No
                                        </label>  
                                    </div>
                                    <div class="form-group">
                                        <label>Alta a</label>
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_alta" data-value="<?=$hojaforntal[0]['hf_alta']?>" value="Domicilio" class="has-value">
                                                    <i class="indigo"></i>Domicilio
                                                </label>
                                            </div>
                                            <div class="col-md-4" style="padding: 0px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_alta" data-value="<?=$hojaforntal[0]['hf_alta']?>" value="Observación" class="has-value">
                                                    <i class="indigo"></i>Se interna al servicio de Observación
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Amerita Incapacidad</label><br>
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_incapacidad_am" data-value="<?=$am[0]['asistentesmedicas_incapacidad_am']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                    <i class="blue"></i>Si
                                                </label>&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_incapacidad_am" data-value="<?=$am[0]['asistentesmedicas_incapacidad_am']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                    <i class="blue"></i>No
                                                </label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" required="" name="asistentesmedicas_incapacidad_folio" value="<?=$am[0]['asistentesmedicas_incapacidad_folio']?>" class="form-control  hojafrontal-info" style="margin-top: 13px" placeholder="Folio">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="asistentesmedicas_incapacidad_fi"  value="<?=$am[0]['asistentesmedicas_incapacidad_fi']?>"  required="" class="form-control d-m-y  hojafrontal-info" placeholder="Fecha de Inicio" style="margin-top: 13px">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="asistentesmedicas_incapacidad_da" value="<?=$am[0]['asistentesmedicas_incapacidad_da']?>" required="" class="form-control  hojafrontal-info" placeholder="Dias Autorizados" style="margin-top: 13px">
                                            </div>
                                            <div class="col-md-3" style="">
                                                <div style="margin-top: 20px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_incapacidad_ptr_eg" data-value="<?=$hojaforntal[0]['hf_incapacidad_ptr_eg']?>" value="PTR" class="has-value">
                                                    <i class="indigo"></i>PTR
                                                </label>&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="hf_incapacidad_ptr_eg" data-value="<?=$hojaforntal[0]['hf_incapacidad_ptr_eg']?>" value="EG" class="has-value">
                                                    <i class="indigo"></i>EG
                                                </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label>Médico Tratante</label>
                                                <input type="text" name="asistentesmedicas_mt" value="<?=$am[0]['asistentesmedicas_mt']=='' ? $INFO_USER[0]['empleado_nombre'].' '.$INFO_USER[0]['empleado_apellidos'] : $am[0]['asistentesmedicas_mt'] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Matricula</label>
                                                <input type="text" name="asistentesmedicas_mt_m" value="<?=$am[0]['asistentesmedicas_mt_m']=='' ? $INFO_USER[0]['empleado_matricula']  : $am[0]['asistentesmedicas_mt_m']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="triage_paciente_accidente_lugar" value="<?=$info[0]['triage_paciente_accidente_lugar']?>">
                                <div class="col-md-12 hide col-hojafrontal-info"><hr class="style-eight" data-titulo="Hoja Frontal"></div>
                                <div class="col-md-12 hide col-hojafrontal-info">
                                    <div class="form-group">
                                        <label>Señalar claramente como ocurrio el accidente (500 caracteres como máximo)</label>
                                        <textarea name="asistentesmedicas_da" required="" maxlength="500" class="form-control hojafrontal-info" rows="3"><?=$am[0]['asistentesmedicas_da']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción de la(s) lesión(es) y tempo de evolución (500 caracteres como máximo)</label>
                                        <textarea name="asistentesmedicas_dl" required="" maxlength="500" class="form-control  hojafrontal-info" rows="3"><?=$am[0]['asistentesmedicas_dl']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Impresión diagnostica (400 caracteres como máximo)</label>
                                        <textarea name="asistentesmedicas_ip" required="" maxlength="400" class="form-control  hojafrontal-info" rows="3"><?=$am[0]['asistentesmedicas_ip']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tratamientos (400 caracteres como máximo)</label>
                                        <textarea name="asistentesmedicas_tratamientos" required="" maxlength="400" class="form-control  hojafrontal-info" rows="3"><?=$am[0]['asistentesmedicas_tratamientos']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Signos y Sintomas</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Intoxicación Alcoholica</label>&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_in" data-value="<?=$am[0]['asistentesmedicas_ss_in']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                    <i class="amber"></i>Si
                                                </label>
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_in" data-value="<?=$am[0]['asistentesmedicas_ss_in']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                    <i class="amber"></i>No
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Intoxicación por Enervantes</label>&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_ie" data-value="<?=$am[0]['asistentesmedicas_ss_ie']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                    <i class="pink"></i>Si
                                                </label>
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_ie" data-value="<?=$am[0]['asistentesmedicas_ss_ie']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                    <i class="pink"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Otras Condiciones</label><br>
                                        <label>Hubo riña</label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_oc_hr" data-value="<?=$am[0]['asistentesmedicas_oc_hr']?>" value="Si" required="" class="has-value  hojafrontal-info">
                                            <i class="orange"></i>Si
                                        </label>
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_oc_hr" data-value="<?=$am[0]['asistentesmedicas_oc_hr']?>" value="No" required="" class="has-value  hojafrontal-info">
                                            <i class="orange"></i>No
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Atención médica previa extrainstitucional</label>
                                        <textarea name="asistentesmedicas_am" maxlength="200" class="form-control hojafrontal-info" required="" rows="2"><?=$am[0]['asistentesmedicas_am']?></textarea>
                                    </div>
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