<?php ob_start(); ?>
<page>
    <page_header>
        <div style="margin-left: 20px;margin-right: 50px;">
            <div style="width: 30%;float: left;position: absolute;top: 20px">
                <img src="<?=  base_url()?>assets/img/logo.png" style="width: 50%">
            </div>
            <div style="float: left;position: absolute;top: 20px;left: 100px;text-align: center;width: 30%">
                <p style="font-size: 25px;font-weight: 600;margin-top: 0px">Solicitid de Consumo VAC</p>
                <p style="text-align: center;font-size: 15px;margin-top: 6px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</p>
            </div>
            <div style="float: left;position: absolute;top: 20px;left: 350px;text-align: left;width: 50%">
                <table>
                    <tr>
                        <td><br>Folio N° </td>
                        <td>
                            <barcode type="C128C" value="SCV3501142015<?=$sol[0]['solicitud']?>" style="margin-left: 30px;margin-top: 0px" ></barcode>
                        </td>
                    </tr>
                </table>
                
                
                <table style="width: 100%;margin-left: -14px" >
                    <tr style="width: 100%">
                        <td style="width: 60%;padding: 10px">FECHA DE EMISIÓN</td>
                        <td style="width: 5%;padding: 10px"><?=  explode('/', $sol[0]['solicitud_fecha_emision'])[2]?></td>
                        <td style="width: 5%;padding: 10px">/ <?=  explode('/', $sol[0]['solicitud_fecha_emision'])[1]?></td>
                        <td style="width: 10%;padding: 10px">/ <?=  explode('/', $sol[0]['solicitud_fecha_emision'])[0]?></td>
                    </tr>
                    <tr style="width: 100%">
                        <td style="width: 60%;padding: 10px">FECHA DE TRATAMIENTO</td>
                        <td style="width: 5%;padding: 10px"><?=  explode('/', $sol[0]['solicitud_fecha'])[2]?></td>
                        <td style="width: 5%;padding: 10px">/ <?=  explode('/', $sol[0]['solicitud_fecha'])[1]?></td>
                        <td style="width: 10%;padding: 10px">/ <?=  explode('/', $sol[0]['solicitud_fecha'])[0]?></td>
                    </tr>
                </table>
            </div>
            <div style="float: left;position: absolute;top: 150px;left: 0px;text-align: left;width: 100%">
                <table style="width: 100%;">
                    <tr>
                        <td>MEDICO TRATANTE:<br><br></td>
                        <td><?=$mt[0]['empleado_matricula']?> | <?=$mt[0]['empleado_nombre']?> <?=$mt[0]['empleado_apellidos']?></td>
                    </tr>
                    <tr>
                        <td>DERECHOHABIENTE:</td>
                        <td><?=$dh[0]['derechohabiente_nss']?> | <?=$dh[0]['derechohabiente_nombre']?> <?=$dh[0]['derechohabiente_apat']?> <?=$dh[0]['derechohabiente_amat']?></td>
                    </tr>
                </table>
            </div>
        </div>
    </page_header>
    <page_footer>
        <div style="margin-left: 30px;margin-right: 30px;">
            <table style="width: 100%;border: 1px solid black">
                <tr>
                    <td style="text-align: center">
                        <p style="font-size: 25px;text-align: center">Recibe</p>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________________&nbsp;&nbsp;&nbsp;&nbsp;
                        <p>Nombre y Firma</p>
                        <br><br>
                    </td>
                    <td style="width: 10px;border-left: 1px solid black;margin-left: 20px"></td>
                    <td style="text-align: center;">
                        <p style="font-size: 25px;text-align: center">Recibe</p>
                        <br>
                        __________________________________________&nbsp;&nbsp;&nbsp;
                        <p>Nombre y Firma</p>
                        <br><br>
                    </td>
                </tr>
            </table>
        </div>
        <br><br>
        <div style="text-align: center;">
            Página [[page_cu]]/[[page_nb]]<br>
            <!--CONTRATO DE ADQUISICION PARA PERSONA FISICA MAYOR OK-->
        </div>
    </page_footer>
    <div style="text-align: center;margin-top: 200px;font-size: 20px;font-weight: 200">
        <b>Materiales</b>
    </div>
    <div style="margin-top: 5px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify;">
        <table style="width: 500px!important;">
            <tr style="width: 500px!important;">
                <th style="padding: 7px">Cantidad</th>
                <th style="padding: 7px">Material</th>
                <th style="padding: 7px">Tipo</th>
                <th style="padding: 7px">Descripción</th>
            </tr>
            <?php foreach ($mat_in as $value){?>
            <tr style="width: 500px!important;">
                <td style="padding: 7px"><?=$value['solicitud_m_cantidad']?></td>
                <td style="padding: 7px"><?=$value['intermedia_nombre']?></td>
                <td style="padding: 7px">Material Intermedio</td>
            </tr>
            <?php }?>
            <?php foreach ($mat as $value){?>
            <tr style="width: 500px!important;">
                <td style="padding: 7px"><?=$value['solicitud_m_cantidad']?></td>
                <td style="padding: 7px"><?=$value['material_nombre']?></td>
                <td style="padding: 7px">Material</td>
            </tr>
            <?php }?>
        </table>
        <?php

        ?>
        
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Solicitid de programación de ciguría.pdf');
?>