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
    <div style="text-align: center;margin-top: 10px;font-size: 20px;font-weight: 200">
        <?php foreach ($codigos as $value) {?>
        <barcode type="C128A" value="<?=$value['intermediocd_sm']?><?=$value['intemediocd_id']?>" ></barcode><br>
        <div style="height: 49px"></div>
        <?php } ?>
        
    </div>

</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Solicitid de programación de ciguría.pdf');
?>