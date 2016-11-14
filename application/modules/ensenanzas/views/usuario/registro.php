<?php ob_start(); set_time_limit(300);
$fecha=explode("/", $Info[0]['fechaRegistro']);
    if($Info[0]['lugarSede']==14){
        $Unidad14='X';
    }else{
        $Unidad14='';
    }
    if($Info[0]['lugarSede']==20){
        $Unidad20='X';
    }else{
        $Unidad20='';
    }
    if($Info[0]['lugarSede']==21){
        $Unidad21='X';
    }else{
        $Unidad21='';
    }
    if($Info[0]['tipoResidente']=='Sede'){
        $sede='X';
        $rotante='';
    }else{
        $sede='';
        $rotante='X';
    }
?>
<style>
div{
    font-family: Arial;
    font-size: 19px;
}
</style>
<page> 
    <img src="<?=  base_url()?>assets/img/registro.png" style="width: 100%;position: absolute">
    <!--Nombre del usuario-->
    <div style="width: 100%;position: absolute;left: 450px;top: 35px;font-size: 14px">
        <?=$folio='RPF3501'.$Info[0]['lugarSede'].date('Y').$Info[0]['idUsuario'];?>
    </div>
    <div style="width: 100%;position: absolute;left: 480px;top: 90px;font-size: 14px">
        <?=$fecha[0]?>
    </div>
    <div style="width: 100%;position: absolute;left: 570px;top: 90px;font-size: 14px">
        <?=$fecha[1]?>
    </div>
    <div style="width: 100%;position: absolute;left: 660px;top: 90px;font-size: 14px">
        <?=$fecha[2]?>
    </div>
    <div style="width: 33%;position: absolute;left: 20px;top: 200px;font-size: 14px;text-align: center">
        <?=$Info[0]['nombreUsuario']?> 
    </div>
    <div style="width: 33%;position: absolute;left: 260px;top: 200px;font-size: 14px;text-align: center">
        <?=$Info[0]['apatUsuario']?>  
    </div>
    <div style="width: 33%;position: absolute;left: 510px;top: 200px;font-size: 14px;text-align: center">
        <?=$Info[0]['amatUsuario']?> 
    </div>
    <!--fin nombre usuario-->
    <div style="width: 50%;position: absolute;left: 20px;top: 280px;font-size: 14px;text-align: center">
        <?=$Info[0]['matriculaUsuario']?> 
    </div>
    <div style="width: 50%;position: absolute;left: 350px;top: 280px;font-size: 14px;text-align: center;">
        <?=$Info[0]['email']?>  
    </div>
    <!--Nombre del responsable-->
    <div style="width: 100%;position: absolute;left: 20px;top: 350px;font-size: 14px;text-align: center">
        <?=$Info[0]['nombreRes']?> <?=$Info[0]['apatRes']?> <?=$Info[0]['amatRes']?>  
    </div>
    <!--fin nombre responsable-->
    <div style="width: 50%;position: absolute;left: 50px;top: 437px;font-size: 14px ">
        <?=$sede?>
    </div>
    <div style="width: 50%;position: absolute;left: 230px;top: 430px;font-size: 14px ">
        <?=$rotante?>
    </div> 
    <div style="width: 50%;position: absolute;left: 400px;top: 430px;font-size: 14px">
        <?=$Info[0]['grado']?>
    </div> 
    <div style="width: 50%;position: absolute;left: 530px;top: 430px;font-size: 14px">
        <?=$Info[0]['especialidad']?> 
    </div>
    <div style="width: 50%;position: absolute;left: 40px;top: 500px;font-size: 14px ">
        <?=$Unidad14?>
    </div>
    <div style="width: 50%;position: absolute;left: 325px;top: 500px;font-size: 14px">
        <?=$Unidad20?>
    </div>
    <div style="width: 50%;position: absolute;left: 540px;top: 500px;font-size: 14px">
        <?=$Unidad21?>
    </div>
    <div style="width: 100%;position: absolute;left: 20px;top: 570px;text-align: center;font-size: 14px">
        <?=$Info[0]['insOrigenRes']?> 
    </div>
    <div style="width: 33%;position: absolute;left: 20px;top: 640px;font-size: 14px;text-align: center">
       <?=$Info[0]['matriculaUsuario']?> 
    </div>
    <div style="width: 33%;position: absolute;left: 260px;top: 640px;font-size: 14px;text-align: center">
        <?=$Info[0]['frInicio']?> 
    </div>
    <div style="width: 33%;position: absolute;left: 510px;top: 640px;font-size: 14px;text-align: center">
        <?=$Info[0]['frFin']?> 
    </div>
    
</page>
<?php
$content = ob_get_clean();
$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
//$pdf->pdf->IncludeJS('print(true)');
$pdf->Output('Constancia.pdf');
?>