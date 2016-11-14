<?php ob_start(); set_time_limit(300);?>
<page> 
    <img src="<?=  base_url()?>assets/img/constancia.png" style="width: 1080px;height: 740px;position: absolute">
    <div style="width: 100%;top: 407px;left: 240px;position: absolute;font-size: 30px;font-family: Arial">
        <?=$Constancia[0]['nombreUsuario'].' '.$Constancia[0]['apatUsuario'].' '.$Constancia[0]['amatUsuario'].''?>
    </div>
    <div style="width: 100%;top: 535px;left: 240px;position: absolute;font-size: 30px;font-family: Arial">
        <?=$Constancia[0]['nombreC']?>
    </div>
</page>
<?php
$content = ob_get_clean();
$pdf = new HTML2PDF('L','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
//$pdf->pdf->IncludeJS('print(true)');
if($Accion=='Email'){
    $pdf->Output('Queries/'.$nombre.'.pdf','F');
}else{
    $pdf->Output('Constancia.pdf');
}
?>