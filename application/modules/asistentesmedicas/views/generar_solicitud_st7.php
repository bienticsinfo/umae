<?php ob_start(); ?>
<page >
    <page_header>
        
    </page_header>
    
    <div style="position: absolute;">
        <img src="<?=  base_url()?>assets/doc/ST7AM-1.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
        <div style="position: absolute;top: 48px;left: 395px;font-size: 11px"><?=$info['triage_paciente_res_empresa']?></div>
        <div style="position: absolute;top: 78px;left: 395px;font-size: 11px"><?=$info['triage_paciente_accidente_calle']?></div>
        <div style="position: absolute;top: 101px;left: 393px;font-size: 8px;width: 320px;">
            <?=$info['triage_paciente_accidente_colonia']?> <?=$info['triage_paciente_accidente_municipio']?> <?=$info['triage_paciente_accidente_estado']?>
        </div>
        <div style="position: absolute;top: 130px;left: 395px;font-size: 11px"><?=$info['triage_paciente_accidente_cp']?></div>
        <div style="position: absolute;top: 130px;left: 580px;font-size: 11px"><?=$info['triage_paciente_accidente_telefono']?></div>
        <div style="position: absolute;top: 155px;left: 395px;font-size: 11px"><?=$info['triage_paciente_accidente_rp']?></div>
        
        <div style="position: absolute;top: 190px;left: 22px;font-size: 11px"><?=$info['triage_paciente_afiliacion']?></div>
        <div style="position: absolute;top: 190px;left: 255px;font-size: 11px"><?=$info['triage_nombre']?></div>
        
        <div style="position: absolute;top: 214px;left: 22px;font-size: 11px"><?=$info['triage_paciente_identificacion']?></div>
        <div style="position: absolute;top: 214px;left: 367px;font-size: 11px"><?=$info['triage_paciente_curp']?></div>
        <div style="position: absolute;top: 214px;left: 655px;font-size: 11px"><?=$info['triage_paciente_edad']?> Años</div>
        
        <div style="position: absolute;top: 237px;left: 22px;font-size: 11px"><?=$info['triage_paciente_sexo']?></div>
        <div style="position: absolute;top: 237px;left: 100px;font-size: 11px"><?=$info['triage_paciente_estadocivil']?></div>
        <div style="position: absolute;top: 237px;left: 196px;font-size: 11px"><?=$info['triage_paciente_dir_calle']?></div>
        <div style="position: absolute;top: 237px;left: 508px;font-size: 11px"><?=$info['triage_paciente_dir_colonia']?></div>
        
        
        <div style="position: absolute;top: 275px;left: 22px;font-size: 11px"><?=$info['triage_paciente_dir_municipio']?> <?=$info['triage_paciente_dir_estado']?></div>
        <div style="position: absolute;top: 275px;left: 410px;font-size: 11px"><?=$info['triage_paciente_telefono']?></div>
        <div style="position: absolute;top: 275px;left: 510px;font-size: 11px"><?=$info['triage_paciente_dir_cp']?></div>
        <div style="position: absolute;top: 271px;left: 615px;font-size: 10px;width: 100px"><?=$info['triage_paciente_umf']?></div>
        
        <div style="position: absolute;top: 310px;left: 22px;font-size: 11px;width: 180px"><?=$info['triage_paciente_delegacion']?></div>
        <div style="position: absolute;top: 315px;left: 225px;font-size: 11px"><?=$info['triage_paciente_accidente_t_hora']?> - <?=$info['triage_paciente_accidente_t_hora_s']?></div>
        <div style="position: absolute;top: 325px;left: 335px;font-size: 11px"><?=  explode('/', $info['triage_paciente_accidente_fecha'])[0]?></div>
        <div style="position: absolute;top: 325px;left: 385px;font-size: 11px"><?=  explode('/', $info['triage_paciente_accidente_fecha'])[1]?></div>
        <div style="position: absolute;top: 325px;left: 430px;font-size: 11px"><?=  explode('/', $info['triage_paciente_accidente_fecha'])[2]?></div>
        <div style="position: absolute;top: 325px;left: 480px;font-size: 11px"><?=  $info['triage_paciente_accidente_hora']?></div>
        
        <div style="position: absolute;top: 325px;left: 540px;font-size: 11px"><?=  explode('/', $am['asistentesmedicas_fecha'])[0]?></div>
        <div style="position: absolute;top: 325px;left: 590px;font-size: 11px"><?=  explode('/', $am['asistentesmedicas_fecha'])[1]?></div>
        <div style="position: absolute;top: 325px;left: 635px;font-size: 11px"><?=  explode('/', $am['asistentesmedicas_fecha'])[2]?></div>
        <div style="position: absolute;top: 325px;left: 685px;font-size: 11px"><?=  $am['asistentesmedicas_hora']?></div>
        
        <div style="position: absolute;top: 350px;left: 25px;font-size: 10px;width: 680px;text-align: justify;line-height: 1.5"><?=  $am['asistentesmedicas_da']?></div>
        
        <div style="position: absolute;top: 440px;left: 25px;font-size: 10px;width: 680px;text-align: justify;line-height: 1.5"><?=  $am['asistentesmedicas_dl']?></div>
        
        <div style="position: absolute;top: 540px;left: 25px;font-size: 10px;width: 680px;text-align: justify;line-height: 1.5"><?=  $am['asistentesmedicas_ip']?></div>
        
        <div style="position: absolute;top: 603px;left: 25px;font-size: 10px;width: 680px;text-align: justify;line-height: 1.5"><?=  $am['asistentesmedicas_tratamientos']?></div>
        
        <div style="position: absolute;top: 667px;left: 190px;font-size: 11px;">
            <?=$am['asistentesmedicas_ss_in']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 667px;left: 270px;font-size: 11px;">
            <?=$am['asistentesmedicas_ss_in']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 667px;left: 508px;font-size: 11px;">
            <?=$am['asistentesmedicas_ss_ie']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 667px;left: 585px;font-size: 11px;">
            <?=$am['asistentesmedicas_ss_ie']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 704px;left: 190px;font-size: 11px;">
            <?=$am['asistentesmedicas_oc_hr']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 704px;left: 270px;font-size: 11px;">
            <?=$am['asistentesmedicas_oc_hr']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 700px;left: 334px;font-size: 9px;width: 372px">
            <?=$am['asistentesmedicas_am']?>
        </div>
        <div style="position: absolute;top: 751px;left: 140px;font-size: 11px;">
            <?=$am['asistentesmedicas_incapacidad_am']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 751px;left: 190px;font-size: 11px;">
            <?=$am['asistentesmedicas_incapacidad_am']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 751px;left: 240px;font-size: 11px;">
            <?=$am['asistentesmedicas_incapacidad_fi']?>
        </div>
        <div style="position: absolute;top: 751px;left: 355px;font-size: 11px;">
            <?=$am['asistentesmedicas_incapacidad_folio']?>
        </div>
        <div style="position: absolute;top: 751px;left: 480px;font-size: 11px;">
            <?=$am['asistentesmedicas_incapacidad_da']?> Dias
        </div>
        <div style="position: absolute;top: 751px;left: 593px;font-size: 11px;width: 113px">
            <?=$ce['hf_alta']?>
        </div>
        <div style="position: absolute;top: 789px;left: 30px;font-size: 9px;width: 160px;">
            <?=$am['asistentesmedicas_mt']?>
        </div>
        <div style="position: absolute;top: 789px;left: 260px;font-size: 9px;width: 130px;">
            <?=$am['asistentesmedicas_mt_m']?>
        </div>
        <div style="position: absolute;top: 789px;left: 538px;font-size: 9px;width: 160px">
            <?=$info['triage_unidad_medica']?><br>
            <?php //$info['triage_paciente_delegacion']?>
        </div>
    </div>
    <page pageset="old">
        <div style="margin-top: 0px;font-size: 20px;font-weight: 200;width: 100%;margin-right: 20px;">
            <img src="<?=  base_url()?>assets/doc/ST7AM-2.png" style="position: absolute;width: 100%;margin-top: 10px;margin-left: -5px;">
        </div>
    </page>
    <page_footer>


    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>