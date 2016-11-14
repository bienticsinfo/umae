<?php ob_start(); ?>
<page>
    <img src="<?=  base_url()?>assets/img/pdf/Caratula.png" style="width: 108%;margin-left: -30px;margin-top: -6px">
    <div style="position: absolute;top: 139px;left: 600px;font-size: 10px;text-align: center">
        <?=$contrato[0]['contrato_numero_tmp']?>
    </div>
    <div style="position: absolute;top: 177px;left: 615px;font-size: 10px">
        <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[0]?>&nbsp;&nbsp;/&nbsp;&nbsp;
        <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[1]?>&nbsp;&nbsp;/&nbsp;&nbsp;
        <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[2]?>
    </div>
    <div style="position: absolute;top: 172px;left: 365px">
        <?=$prei[0]['prei_num']?>
    </div>
    <div style="position: absolute;top: 211px;left:350px;font-size: 15px;">
        <div>
            <b><?=$contrato[0]['contrato_tipo_s']?></b>
        </div>
    </div>
    <div style="position: absolute;top: 228px;left: 190px;font-size: 10px">
        <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[2]?>
    </div>
    <div style="position: absolute;top: 228px;left: 370px;font-size: 10px">
        <?=$contrato[0]['contrato_fecha_inicio']?>
    </div>
    <div style="position: absolute;top: 226px;left: 570px;font-size: 10px">
        ---
    </div>
    <div style="position: absolute;top: 245px;left: 210px;font-size: 10px">
        <?=$contrato[0]['contrato_tipo']?>	
    </div>
    <div style="position: absolute;top: 245px;left: 460px;font-size: 10px">
        ART.	<?=$contrato[0]['contrato_articulo']?>	 
        <?php 
            if($contrato[0]['contrato_fraccion']!=''){
                echo 'F. '.$contrato[0]['contrato_fraccion'];
            }
        ?>
    </div>
    <div style="position: absolute;top: 260px;left: 190px;font-size: 10px">
        <?php 
        if($contrato[0]['contrato_tipo']!='Adjudicación directa'){
            echo 'NACIONAL';
        }
        ?>
        
    </div>
    <div style="position: absolute;top: 260px;left: 460px;font-size: 10px">
        <?=$contrato[0]['contrato_fecha_inicio']?>
    </div>
    <div style="position: absolute;top: 260px;left: 660px;font-size: 10px">
        SI
    </div>
    <div style="position: absolute;top: 303px;left: 220px;font-size: 9px;">
        <div style="margin-top: 1px;"><?=$contrato[0]['hospital_circunscripcion_cod']?></div>
        <div style="margin-top: 5px"><?=$contrato[0]['hospital_localidad_cod']?></div>
        <div style="margin-top: 12px"><?=$contrato[0]['hospital_inmueble_cod']?></div>
        <div style="margin-top: 4px"><?=$contrato[0]['hospital_tiposervicio_cod']?></div>
        <div style="margin-top: 4px"><?=$contrato[0]['hospital_tipoexplotacion_cod']?></div>
        <div style="margin-top: 5px;margin-left: -10px"><?=$contrato[0]['hospital_unidadpresupuestal_cod']?></div>
        <div style="margin-top: 5px">0<?=$contrato[0]['especialidad_id']?></div>
        <div style="margin-top: 5px">0<?=$contrato[0]['subesp_num']?></div>
        <div style="margin-top: 6px;margin-left: -20px"><?=$contrato[0]['contrato_clave_presupuestal']?></div>
    </div>
    <div style="position: absolute;top: 303px;left: 120px;font-size: 10px">
        <div style="text-align: center;margin-top: 2px">
            <?=$contrato[0]['hospital_circunscripcion_den']?>			
        </div>
        <div style="margin-top: 5px;text-align: center">
            <?=$contrato[0]['hospital_localidad_den']?>								
        </div>
        <div style="margin-top: 8px;font-size: 10px;text-align: center">
            <b>
            <?php
                if($contrato[0]['hospital_id']==2){
                    echo 'HOSPITAL DE TRAUMATOLOGÍA "DR. VICTORIO DE LA FUENTE NARVAEZ"';
                }if($contrato[0]['hospital_id']==3){
                    echo 'HOSPITAL DE ORTOPEDIA "DR. VICTORIO DE LA FUENTE NARVAEZ"';
                }if($contrato[0]['hospital_id']==4){
                    echo 'UMF Y REHABILITACIÓN NORTE "DR. VICTORIO DE LA FUENTE NARVAEZ"';
                }
            ?>	
            </b>			
        </div>
        <div style="margin-top: 4px;text-align: center">
           <?=$contrato[0]['hospital_tiposervicio_den']?>											
        </div>
        <div style="margin-top: 5px;text-align: center">
           <?=$contrato[0]['hospital_tipoexplotacion_den']?>															
        </div>
        <div style="margin-top: 2px;text-align: center;">
           <?=$contrato[0]['hospital_unidadpresupuestal_den']?>																			
        </div>
        <div style="margin-top: 4px;text-align: center">
           <?=$contrato[0]['especialidad_nombre']?>																							
        </div>
        <div style="margin-top: 4px;text-align: center">
           <?=$contrato[0]['subesp_nombre']?>																											
        </div>
        <div style="margin-top: 4px;text-align: center">
           <?=$contrato[0]['contrato_clave_presupuestal_descrip']?>																															
        </div>
    </div>
    <div style="position: absolute;top: 490px;left: 150px;width: 70%;text-align: center;font-size: 10px;">
        <?=$contrato[0]['contrato_descripcion']?>			
    </div>
    <div style="position: absolute;top: 578px;width: 100%;text-align: center;font-size: 10px;">
        <strong>
        <?php 
        if($contrato[0]['contrato_tipo_s']=='Adquisición'){
            echo 'PROVEEDOR'; 
        }if($contrato[0]['contrato_tipo_s']=='Servicio'){
            echo 'PRESTADOR DE SERVICIO';
        }if($contrato[0]['contrato_tipo_s']=='Obra'){
           echo 'CONTRATISTA'; 
        }
        ?>
        </strong>
    </div>
    <div style="position: absolute;top: 591px;left: 184px;">
        <div style="font-size: 9px;margin-top: 2px">
            <?php 
            if($contrato[0]['prov_tipo']=='Personal fisica'){
                echo $contrato[0]['prov_nombre'];
            }else{
                echo $contrato[0]['prov_razon_social'];
            }
            ?>
        </div>	
        <div style="font-size: 9px;">
            <?php 
            $cadena=$contrato[0]['prov_direccion_principal'];
            $result=  explode(' ', $cadena);
            for ($i = 0; $i < 5; $i++) {
                echo $result[$i].' ';
            }
            ?>
        </div>
        <div style="margin-left: 375px;margin-top: -13px;font-size: 9px;">
            <?=$contrato[0]['prov_telefono_p_fijo']?> / <?=$contrato[0]['prov_telefono_p_movil']?>
        </div>
        <div style="margin-left: -130px;font-size: 8px;margin-top: 0px">
            <?php 
            for ($i = 5; $i < count($result); $i++) {
                echo $result[$i].' ';
            }
            ?>
        </div>
        <div style="margin-left: 470px;margin-top: -15px;font-size: 9px;">
            <?=$contrato[0]['prov_codigo_postal']?>
        </div>
        <div style="margin-left: 0px;font-size: 9px;">
            <?=$contrato[0]['prov_nombre']?>		
        </div>
        <div style="margin-left: 390px;margin-top: -13px;font-size: 9px;">
            <?=$contrato[0]['prov_registro_infonavit']?>	
        </div>
        <div style="margin-left: 0px;font-size: 9px;margin-top: 1px">
            <?=$contrato[0]['prov_rfc']?>
        </div>
        <div style="margin-left: 180px;font-size: 9px;margin-top: -15px">
            <?=$contrato[0]['prov_patronal_imss']?>
        </div>
        <div style="margin-left: 460px;font-size: 9px;margin-top: -13px">
            <?=$contrato[0]['prov_num']?>
        </div>
    </div>
    <div style="position: absolute;top: 700px;left: 184px;font-size: 10px">
        <div style="">
            $ <?=  number_format($contrato[0]['contrato_monto_total'],2)?>	
        </div>
        <div style="margin-left: 400px;margin-top: -10px">
            $ <?=  number_format($contrato[0]['contrato_monto_total'] * 1.16,2)?> 		
        </div>
        <div style="margin-top: 20px;margin-left: -90px">
            <?=$contrato[0]['contrato_fecha_inicio']?>
        </div>
        <div style="margin-top: -12px;margin-left: 110px">
            <?=$contrato[0]['contrato_fecha_inicio']?>
        </div>
        <div style="margin-top: -10px;margin-left: 280px">
            <?=$contrato[0]['contrato_fecha_fin']?>
        </div>
        <div style="margin-top: -12px;margin-left: 460px">
            <?=$contrato[0]['contrato_fecha_fin']?>
        </div>
        <div style="margin-top: 4px;margin-left: 0px">
            ----
        </div>
        <div style="margin-top:-12px;margin-left: 100px">
            ----
        </div>
        <div style="margin-top:-11px;margin-left: 300px">
            ----
        </div>
    </div>
    <div style="position: absolute;top: 803px;left: 180px;font-size: 10px;">
        <?php if($caratula[0]['caratula_tipo_fianza']=='ANTICIPO'){?>
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 270px"><?=$caratula[0]['caratula_afianzadora']?></td>
                <td style="width: 100px"><?=$caratula[0]['caratula_num']?></td>
                <td style="width: 70px"><?=$caratula[0]['caratula_importe']?></td>
                <td style="width: 200px;"><?=$caratula[0]['caratula_vigencia_fin']?></td>
            </tr>
        </table>
        <?php }if($caratula[0]['caratula_tipo_fianza']=='CUMPLIMIENTO'){?>
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 270px"><?=$caratula[0]['caratula_afianzadora']?></td>
                <td style="width: 100px"><?=$caratula[0]['caratula_num']?></td>
                <td style="width: 50px"><?=$caratula[0]['caratula_importe']?></td>
                <td style="width: 70px"><?=$caratula[0]['caratula_importe']?></td>
                <td style="width: 200px;"><?=$caratula[0]['caratula_vigencia_fin']?></td>
            </tr>
        </table>
        <?php }if($caratula[0]['caratula_tipo_fianza']=='VICIOS OCULTOS'){?>
        <table style="width: 100%;margin-top: -3px">
            <tr style="width: 100%;">
                <td style="width: 270px"><?=$caratula[0]['caratula_afianzadora']?></td>
                <td style="width: 100px"><?=$caratula[0]['caratula_num']?></td>
                <td style="width: 50px"><?=$caratula[0]['caratula_importe']?></td>
                <td style="width: 70px"><?=$caratula[0]['caratula_importe']?></td>
                <td style="width: 200px;"><?=$caratula[0]['caratula_vigencia_fin']?></td>
            </tr>
        </table>
        <?php } ?>
    </div>
    <div style="position: absolute;top: 905px;font-size: 10px;">
        <table style="width: 100%;">
            <tr style="width: 100%;text-align: center">
                <td style="width: 45%"><?=$contrato[0]['prov_nombre']?></td>
                <td style="width: 50%"><?=$contrato[0]['hospital_director_unidad']?></td>
            </tr>
        </table>
        
        <div style="margin-top: 4px;margin-left: 130px">
            <?php 
            if($contrato[0]['contrato_tipo_s']=='Servicio'){
                echo 'PRESTADOR DEL SERVICIO';
            }if($contrato[0]['contrato_tipo_s']=='Obra'){
                echo 'CONTRATISTA';
            }if($contrato[0]['contrato_tipo_s']=='Adquisición'){
                echo 'PROVEEDOR';
            }
            ?>
        </div>
    </div>
    <!--Seccion proveedor!-->
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Generación de Contrato.pdf');
?>