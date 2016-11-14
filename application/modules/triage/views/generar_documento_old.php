<?php ob_start(); ?>
<page>
    <page_header>
        <div style="border:1px solid black;padding: 5px;">
            <img src="<?=  base_url()?>assets/img/logo_left.jpg" style="width: 70%">
        </div>
        <div style="border-left:1px solid black;border-right: 1px solid black;border-top: 1px solid black;padding: 5px;margin-top: 5px;margin-right: -2px">
            <div style="width: 30%;float: left!important;">
                <img src="<?=  base_url()?>assets/img/logo.png" style="width: 30%;margin-left: 50px">
            </div>
            <div style="width: 60%;float: left!important;margin-left: 200px;text-align: center;margin-top: -95px">
                <p><strong>INSTITUTO MEXICANO DEL SEGURO SOCIAL DIRECCIÓN DE PRESTACIONES MÉDICAS</strong></p>
                <p style="margin-top: -6px;font-size: 11px">UNIDAD DE ATENCIÓN MÉDICACOORDINACIÓN DE UNIDADES MÉDICAS DE ALTA ESPECIALIDAD</p>
                <p style="margin-top: -6px;font-size: 11px">CLASIFICACIÓN DE PACIENTES (TRIAGE)</p>
            </div>
        </div>
    </page_header>
    <page_footer>

        <div style="text-align: center;">
            Página [[page_cu]]/[[page_nb]]<br>
            <!--CONTRATO DE ADQUISICION PARA PERSONA FISICA MAYOR OK-->
        </div>
        <div style="float: right;position: absolute;right: 10px;bottom: 0px">
            Clave: 2430-003-039
        </div>
    </page_footer>
    <style>table {border-collapse: collapse; width: 100%;}th, td {text-align: left;padding: 8px;}tr:nth-child(even){background-color: #f2f2f2} th {}</style>
        
    <div style="text-align: center;margin-top: 170px;font-size: 13px;font-weight: 200;border: 1px solid black;">
 
        <span style="margin-bottom: 5px;margin-top: 5px">DATOS GENERALES</span>
        <table style="border:1px solid black;width: 100%; border-collapse: separate;margin-left: 10px;text-align: left;margin-top: 10px">
            <tr>
                <td style="width: 57%;padding: 3px">
                    <p style="font-size: 12px;margin-top: 0px">&nbsp;&nbsp; Unidad Médica Hospitalaria: <?=$info[0]['triage_unidad_medica']?></p>
                </td>
                <td style="border-left: 1px solid black;width: 20%;padding: 3px">
                    <p style="font-size: 12px;width: 40px;margin-top: 0px">&nbsp;&nbsp; Fecha: <?=$info[0]['triage_fecha']?></p>
                </td>
                <td style="border-left: 1px solid black;width: 20%;padding: 3px">
                    <p style="font-size: 12px;margin-top: 0px">&nbsp;&nbsp;Hora: <?=$info[0]['triage_hora']?></p>
                </td>
            </tr>
        </table>
        <table style="border:1px solid black;width: 100%; border-collapse: separate;margin-left: 10px;text-align: left;margin-top: 5px">
            <tr>
                <td style="width: 97%;padding: 3px;">
                    <p style="font-size: 12px;margin-top: 0px">&nbsp;&nbsp; Nombre: <?=$info[0]['triage_nombre']?></p>
                </td>
            </tr>
        </table>
        <br>
        <span style="margin-top: -5px;margin-bottom: 5px">SIGNOS VITALES</span>
        <table  style="border:1px solid black;width: 100%; border-collapse: separate;margin-left: 10px;text-align: left">
            <tr>
                <td style="width: 21%;padding: 3px">
                    <p style="font-size: 11px;margin-top: 0px;">&nbsp;&nbsp; Tensión arterial: <?=$info[0]['triage_tension_arterial']?></p>
                </td>
                <td style="border-left: 1px solid black;width: 17%;padding: 3px">
                    <p style="font-size: 11px;margin-top: 0px">&nbsp;&nbsp; Temperatura: <?=$info[0]['triage_temperatura']?> °C</p>
                </td>
                <td style="border-left: 1px solid black;width: 30%;padding: 3px">
                    <p style="font-size: 11px;margin-top: 0px">&nbsp;&nbsp;Frecuencia cardiaca o pulso: <?=$info[0]['triage_frecuencia_cardiaco']?> X Min</p>
                </td>
                <td style="border-left: 1px solid black;width: 29%;padding: 3px">
                    <p style="font-size: 11px;margin-top: 0px">&nbsp;&nbsp;Frecuencia cardiaca o pulso: <?=$info[0]['triage_frecuencia_respiratoria']?> X Min</p>
                </td>
            </tr>
        </table>
        <br>
        <span style="margin-top: -5px;margin-bottom: 5px">PRIMERA SECCIÓN</span>
        <br>
                                    
        <table class="" border="1" style="width: 100%; margin-left: 10px;text-align: left;font-size: 9px;">
            <thead>
                <tr style="">
                    <th style="width: 50%;padding: 2px" >Parámetro</th>
                    <th style="width: 23%;text-align: center;padding: 1px" >Ausente</th>
                    <th style="width: 24%;text-align: center;padding: 1px" >Presente</th>
                </tr>       
            </thead>
            <tbody>

                <tr>
                    <td style=";padding: 2px">Pérdida súbita del estado de alerta</td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg1_s1']=='0'){echo '0';}?></td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg1_s1']=='31'){echo '31';}?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Apnea</td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg2_s1']=='0'){echo '0';}?></td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg2_s1']=='31'){echo '31';}?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Ausencia de pulso</td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg3_s1']=='0'){echo '0';}?></td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg3_s1']=='31'){echo '31';}?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Intubación de vía respiratoria</td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg4_s1']=='0'){echo '0';}?></td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg4_s1']=='31'){echo '31';}?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Angor o equivalente</td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg5_s1']=='0'){echo '0';}?></td>
                    <td style="text-align: center;padding: 2px"><?php if($info[0]['triage_preg5_s1']=='31'){echo '31';}?></td>
                </tr>
            </tbody>
        </table>
        <div style="text-align: center;margin-top: 5px;margin-bottom: 0px"> 
            <span style="">SEGUNDA SECCIÓN</span>
        </div>
        <table class="" border="1" style="width: 100%; margin-left: 10px;text-align: left;font-size: 9px;margin-top: 0px">
            <thead>
                <tr style="padding: 0px">
                    <th style="width: 26%;padding: 2px;border-bottom: 1px solid transparent" >Parámetro</th>
                    <th style="width: 52%;padding: 2px" colspan="4">Puntuación</th>
                    <th style="width: 19%;padding: 2px;border-bottom: 1px solid transparent">Puntaje</th>
                </tr>      
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 2px;border-top: 1px solid transparent"></td>
                    <td style="padding: 2px">0</td>
                    <td style="padding: 2px">5</td>
                    <td style="padding: 2px">10</td>
                    <td style="padding: 2px">15</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Traumatismo</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Menor</td>
                    <td style="padding: 2px">Moderado</td>
                    <td style="padding: 2px">Mayor</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg1_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Herida(s)</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Superficial</td>
                    <td style="padding: 2px">No Penetrante</td>
                    <td style="padding: 2px">Extensa-Profunda</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg2_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Aumento del trabajo respiratorio</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Leve</td>
                    <td style="padding: 2px">Moderado</td>
                    <td style="padding: 2px">Severo</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg3_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Cianosis</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Leve</td>
                    <td style="padding: 2px">Moderado</td>
                    <td style="padding: 2px">Severo</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg4_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Palidez</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Leve</td>
                    <td style="padding: 2px">Moderado</td>
                    <td style="padding: 2px">Severo</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg5_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Hemorragia</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px">Inactiva-Leve</td>
                    <td style="padding: 2px">Moderado</td>
                    <td style="padding: 2px">Severo</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg6_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Dolor (Escala análoga visual 0-10)</td>
                    <td style="padding: 2px">0</td>
                    <td style="padding: 2px">1-4/10</td>
                    <td style="padding: 2px">5-8/10</td>
                    <td style="padding: 2px">9-10/10</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg7_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Intoxicación o auto-daño</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px">Dudosa</td>
                    <td style="padding: 2px">Evidente</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg8_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Convulsiones</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px">Estado Postictal</td>
                    <td style="padding: 2px">Presente</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg9_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Escala de Glasgow Neurológico</td>
                    <td style="padding: 2px">15</td>
                    <td style="padding: 2px">14-12</td>
                    <td style="padding: 2px">11-8</td>
                    <td style="padding: 2px"><8</td>
                    <td style="padding: 2px;text-align:center"> <?=$info[0]['triage_preg10_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Deshidratación</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px">Presente</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg11_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px">Psicosis, agitación o violencia</td>
                    <td style="padding: 2px">Ausente</td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px"></td>
                    <td style="padding: 2px">Presente</td>
                    <td style="padding: 2px;text-align:center"><?=$info[0]['triage_preg12_s2']?></td>
                </tr>
                <tr>
                    <td style="padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style="padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style="padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style="padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style="padding: 2px;border-left: transparent;border-bottom: transparent"></td>
                    <td style="padding: 2px">Suma subtotal: <?=$info[0]['triege_preg_puntaje_s2']?></td>
                </tr>
            </tbody>
        </table>
        <div style="text-align: center">
        <span style="margin-bottom: 0px;margin-top: 0px;text-align: center">TERCERA SECCIÓN</span>
        </div>
        <table border="1" style="width: 100%;margin-left: 10px;text-align: left;font-size: 9px;margin-top: 5px">
            <thead>
                <tr>
                    <th style="width: 25%;padding: 2px" >Parámetro</th>
                    <th style="width: 60%;padding: 2px" colspan="5">Puntuación</th>
                    <th style="width: 12%;padding: 2px">Puntaje</th>
                </tr>      
            </thead>
            <tbody>
                 <tr>
                     <td style=";padding: 2px"></td>
                     <td style=";padding: 2px">10</td>
                     <td style=";padding: 2px">5</td>
                     <td style=";padding: 2px">0</td>
                     <td style=";padding: 2px">5</td>
                     <td style=";padding: 2px">10</td>
                     <td style=";padding: 2px"></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Frecuencia cardiaca (x’)</td>
                    <td style=";padding: 2px"> Menor a 40 </td>
                    <td style=";padding: 2px"> 40-59 </td>
                    <td style=";padding: 2px"> 60-100</td>
                    <td style=";padding: 2px"> 101-140 </td>
                    <td style=";padding: 2px"> > 140 </td>
                    <td style="text-align:center;padding: 2px"><?=$info[0]['triage_preg1_s3']?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Temperatura (°C)</td>
                    <td style=";padding: 2px">Menor a 34.5</td>
                    <td style=";padding: 2px">34.5-35.9</td>
                    <td style=";padding: 2px">36-37</td>
                    <td style=";padding: 2px">37.1-39</td>
                    <td style=";padding: 2px">> 39</td>
                    <td style="text-align:center;padding: 2px"><?=$info[0]['triage_preg1_s3']?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Frecuencia respiratoria (x’)</td>
                    <td style=";padding: 2px">Menor a 8</td>
                    <td style=";padding: 2px">8-12</td>
                    <td style=";padding: 2px">13-18</td>
                    <td style=";padding: 2px">19-25</td>
                    <td style=";padding: 2px">> 25</td>
                    <td style="text-align:center;padding: 2px"><?=$info[0]['triage_preg1_s3']?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Tensión Arterial (mmHg)</td>
                    <td style=";padding: 2px">Menor a 70 / 50</td>
                    <td style=";padding: 2px">70 / 50 – 90 / 60</td>
                    <td style=";padding: 2px">91 / 61 – 120 / 80</td>
                    <td style=";padding: 2px">121 / 81 – 160 / 110</td>
                    <td style=";padding: 2px">> 160 / 110</td>
                    <td style="text-align:center;padding: 2px"><?=$info[0]['triage_preg1_s3']?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px">Glicemia capilar</td>
                    <td style=";padding: 2px">Menor a 40</td>
                    <td style=";padding: 2px">40 - 60</td>
                    <td style=";padding: 2px">61 – 140</td>
                    <td style=";padding: 2px">141 – 400</td>
                    <td style=";padding: 2px">> 400</td>
                    <td style="text-align:center;padding: 2px"><?=$info[0]['triage_preg5_s3']?></td>
                </tr>
                <tr>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent;border-right: transparent"></td>
                    <td style=";padding: 2px;border-left: transparent;border-bottom: transparent"></td>
                    <td style=";padding: 2px">Suma total: <?=$info[0]['triage_puntaje_total']?></td>
                </tr>
            </tbody>  
        </table>
        <br>
        <span style="margin-bottom: 5px;margin-bottom: -10px">TOMA DE DECISIÓN</span>
        <table border="1" style="width: 100%;margin-left: 10px;text-align: center;font-size: 9px;margin-top: -10px">
            <thead>
                <tr>
                    <th style="width: 15%;text-align: center;padding: 2px">Puntaje/Color</th>
                    <th style="width: 16%;text-align: center;padding: 2px;background: #E50914">30 puntos | Rojo</th>
                    <th style="width: 17%;text-align: center;padding: 2px;background: #FF7028">21-3 puntos| Naranja</th>
                    <th style="width: 17%;text-align: center;padding: 2px;background: #FDE910">11-20 puntos | Amarillo</th>
                    <th style="width: 16%;text-align: center;padding: 2px;background: #4CBB17">6-10 puntos | Verde</th>
                    <th style="width: 16%;text-align: center;padding: 2px;background: #0000FF">0 – 5 puntos | Azul</th>
                </tr>      
            </thead>
            <tbody>
                 <tr>
                    <td style="text-align: center;padding: 2px">Decisión</td>
                    <td style="text-align: center;padding: 2px">Reanimación <br>Inmediatamente, <br>Activar Alerta Roja</td>
                    <td style="text-align: center;padding: 2px">Emergencia <br>10 minutos</td>
                    <td style="text-align: center;padding: 2px">Urgencia <br>11-60 minutos</td>
                    <td style="text-align: center;padding: 2px">Urgencia <br>Menor 61-120 minutos</td>
                    <td style="text-align: center;padding: 2px">Sin Urgencia <br>121-240 minutos</td>
                </tr>
            </tbody>
        </table>
        <br>
        <span style="margin-bottom: 5px">DATOS DEL MÉDICO NO FAMILIAR</span>
        <br>
        <table border="1" style="width: 100%;margin-left: 10px;text-align: left;margin-top: 10px">
            <tr>
                <td style="width: 32%;padding: 2px">
                    <p style="font-size: 12px;margin-top: 0px;text-align: center">
                        ______________________________
                        <br>
                        Nombre Completo
                    </p>
                </td>
                <td style="width: 33%;padding: 2px">
                    <p style="font-size: 12px;margin-top: 0px;text-align: center">
                        ______________________________
                        <br>
                        Matrícula
                    </p>
                </td>
                <td style="width: 32%;padding: 2px">
                    <p style="font-size: 12px;margin-top: 0px;text-align: center">
                        ______________________________
                        <br>
                        Firma
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border: transparent"></td>
                <td style="border: transparent"></td>
                <td style="border: transparent;text-align: right">2430-021-091</td>
            </tr>
        </table>
        <br>
    </div>

</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>