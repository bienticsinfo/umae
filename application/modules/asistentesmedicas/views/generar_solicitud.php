<?php ob_start(); ?>
<page>
    <page_header>
        <img src="<?=  base_url()?>assets/doc/asistentesmedicas_c.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
    </page_header>
    <div style="position: absolute;">
        <div style="position: absolute;top: 86px;left: 67px;font-size: 11px"><?=$am['asistentesmedicas_fecha']?></div>
        <div style="position: absolute;top: 86px;left: 250px;font-size: 11px"><?=$am['asistentesmedicas_hora']?></div>
        <div style="position: absolute;top: 86px;left: 430px;font-size: 11px"><?=$am['asistentesmedicas_hoja']?></div>
        <div style="position: absolute;top: 86px;left: 580px;font-size: 11px"><?=$am['asistentesmedicas_renglon']?></div>
        
        <!--2 fila-->
        <div style="position: absolute;top: 106px;left: 80px;font-size: 11px"><?=$info['triage_nombre']?></div>
        <div style="position: absolute;top: 106px;left: 417px;font-size: 11px"><?=$info['triage_paciente_sexo']?></div>
        <div style="position: absolute;top: 106px;left: 511px;font-size: 11px"><?=$info['triage_paciente_edad']?></div>
        <div style="position: absolute;top: 106px;left: 571px;font-size: 11px"><?=$info['triage_paciente_meses']?> </div>
        <!--3 fila-->
        <div style="position: absolute;top: 126px;left: 109px;font-size: 11px;"><?=$info['triage_paciente_afiliacion']?></div>
        <div style="position: absolute;top: 126px;left: 435px;font-size: 11px;"><?=$info['triage_paciente_umf']?></div>
        
        <div style="position: absolute;top: 146px;left: 90px;font-size: 11px;"><?=$info['triage_paciente_dir_calle']?> <?=$info['triage_paciente_dir_colonia']?> <?=$info['triage_paciente_dir_cp']?>  <?=$info['triage_paciente_dir_municipio']?>    <?=$info['triage_paciente_dir_estado']?> </div>
        
        <div style="position: absolute;top: 165px;left: 186px;font-size: 11px;"><?=$info['triage_paciente_res']?></div>
        <div style="position: absolute;top: 165px;left: 500px;font-size: 11px"><?=$info['triage_paciente_res_telefono']?></div>
        <div style="position: absolute;top: 185px;left: 80px;font-size: 11px"><?=  substr($info['triage_paciente_res_empresa'], 0,50)?></div>
        <div style="position: absolute;top: 185px;left: 400px;font-size: 11px">
        <?=$info['triage_paciente_accidente_calle']?> 
        <?=$info['triage_paciente_accidente_colonia']?> 
        <?=$info['triage_paciente_accidente_cp']?> 
        <?=  substr($info['triage_paciente_accidente_municipio'], 0,4)?>.   
        <?=  substr($info['triage_paciente_accidente_estado'], 0,4)?>.   
        </div>
        
        <div style="position: absolute;top: 205px;left: 130px;font-size: 11px"><?=$info['triage_paciente_medico_tratante']?></div>
        <div style="position: absolute;top: 205px;left: 505px;font-size: 11px"><?=$info['triage_paciente_asistente_medica']?></div>
        
        
        <div style="position: absolute;top: 245px;left: 135px;font-size: 11px"><?=$info['triage_paciente_accidente_fecha']?></div>
        <div style="position: absolute;top: 245px;left: 263px;font-size: 11px"><?=$info['triage_paciente_accidente_hora']?></div>
        <div style="position: absolute;top: 245px;left: 380px;font-size: 11px"><?=$info['triage_paciente_accidente_lugar']?></div>
        <div style="position: absolute;top: 245px;left: 554px;font-size: 11px"><?=$info['triage_paciente_accidente_procedencia']?></div>
        <div style="position: absolute;left: 280px;top: 980px">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 20px;" ></barcode>
        </div>
    </div>
    <page_footer>


    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>