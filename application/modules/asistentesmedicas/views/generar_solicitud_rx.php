<?php ob_start(); ?>
<page>
    <page_header>
        <img src="<?=  base_url()?>assets/doc/SOLICITUD_RX_C.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
        <style>
            table, td, th {border: 1px solid #ddd;text-align: left;
            }table {border-collapse: collapse;width: 100%;}
            th, td {padding: 15px;}
    </style>
    </page_header>
    <div style="position: absolute;">
        <div style="position: absolute;top: 27px;left: 330px;font-size: 11px"><?=$info['triage_paciente_afiliacion']?></div>
        <div style="position: absolute;top: 59px;left: 330px;font-size: 11px"><?=$info['triage_nombre']?></div>
        <div style="position: absolute;top: 106px;left: 330px;font-size: 11px"><?=$info['triage_paciente_curp']?></div>
        <table style="position: absolute;top: 230px;width: 100%;left: 10px;right: 30px ">
            <thead>
                <tr>
                    <th style="width: 30%;font-size: 12px;text-align: center">ESTUDIO SOLICITADO</th>
                    <th style="width: 65.3%;font-size: 12px;text-align: center">ANOTAR DATOS CLINICOS Y DX PRESUNCIONAL Y LA REGIÓN ATOMICA INTERESADA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Casos as $value){?>
                <tr>
                    <td><?=  strtoupper($value['casoclinico_nombre'])?></td>
                    <td><?=  strtoupper($value['casoclinico_datos'])?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
    <page_footer>


    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>