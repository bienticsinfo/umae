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
    <div style="text-align: center;margin-top: 100px;font-size: 20px;font-weight: 200">
         <qrcode value="9733639"  style="width: 80mm;"></qrcode><br><br><br><br><br><br>
        <barcode type="C128A" value="99350579"></barcode><br><br><br><br><br><br>
        <barcode type="C128A" value="7862768"></barcode><br><br><br><br><br><br>
   
    </div>

</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Solicitid de programación.pdf');
?>