<?php ob_start(); ?>
<page>
    <page_header>

    </page_header>
    <page_footer>

        <div style="text-align: center;">
            Página [[page_cu]]/[[page_nb]]<br>
            <!--CONTRATO DE ADQUISICION PARA PERSONA FISICA MAYOR OK-->
        </div>
    </page_footer>
    <div style="text-align: center;margin-top: 200px;font-size: 20px;font-weight: 200">
        <barcode type="C128C" value="<?=$cb[0]['intermediocd_sm']?><?=$cb[0]['intemediocd_id']?>" ></barcode>
    </div>

</page>
<?php 
    $html=  ob_get_clean();
    //HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array('0','0','0','0'));
    $pdf=new HTML2PDF('P','A4','en',true,'UTF-8',array('0','0','0','0'));
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Solicitid de programación de ciguría.pdf','F');
?>