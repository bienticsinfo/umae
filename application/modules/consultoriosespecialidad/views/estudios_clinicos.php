<?php ob_start(); ?>
<page>
    <page_header>
        <img src="<?=  base_url()?>assets/img/triage/1212.jpg" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
    </page_header>
    
    <page_footer>


    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('EStudios Clinicos).pdf');
?>