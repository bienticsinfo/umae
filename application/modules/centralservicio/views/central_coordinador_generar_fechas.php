<?php ob_start(); ?>
<page>
        <div style="margin-left: 20px;margin-right: 50px;">
            <div style="width: 30%;float: left;position: absolute;top: 20px">
                <img src="<?=  base_url()?>assets/img/logo.png" style="width: 30%">
            </div>
            <div style="float: left;position: absolute;top: 20px;left: 200px;text-align: center;width: 40%">
                <p style="text-align: center;font-size: 20px;margin-top: 6px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</p>
            </div>
            <div style="float: left;position: absolute;top: 20px;left: 470px;text-align: left;width: 50%">
                <table>
                    <tr>
                        <td>
                            <barcode type="C128A" value="<?=$pro[0]['programacion_id']?>" style="margin-left: 30px;margin-top: 0px" ></barcode>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="float: left;position: absolute;top: 100px;left: 0px;text-align: left;width: 100%">
                <table style="width: 100%;">
                    <tr>
                        <td>N.S.S:</td>
                        <td><?=$pro[0]['derechohabiente_nss']?> </td>
                    </tr>
                    <tr>
                        <td>DERECHOHABIENTE:</td>
                        <td><?=$pro[0]['derechohabiente_nombre']?> <?=$pro[0]['derechohabiente_apat']?> <?=$dh[0]['derechohabiente_amat']?></td>
                    </tr>
                    <tr>
                        <td>Diagnostico:</td>
                        <td><?=$pro[0]['programacion_diagnostico']?> </td>
                    </tr>
                </table>
            </div>
        </div>
    <div style="text-align: center;margin-top: 150px;font-size: 20px;font-weight: 200">
        <b>Fecha de terapias</b>
    </div>
    <div style="margin-top: 5px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify;width: 100%!important">
        <table>
            <tr>
                <th style="padding: 7px">N°&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th style="padding: 7px">Tratamiento&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th style="padding: 7px">Teparia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th style="padding: 7px">Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            <?php foreach ($data as $value){?>
            <tr >
                <td style="padding: 7px"><?=$value['terapiafecha_id']?></td>
                <td style="padding: 7px"><?=$value['tratamiento_nombre']?></td>
                <td style="padding: 7px"><?=$value['terapia_nombre']?></td>
                <td style="padding: 7px"><?=$value['terapiafecha_fecha']?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Fecha de terapias.pdf');
?>