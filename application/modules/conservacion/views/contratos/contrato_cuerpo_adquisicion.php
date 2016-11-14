<?php ob_start(); ?>
<page>
    <page_header>
        <div style="text-align: center;margin-top: 25px;font-size: 20px">
            <b>INSTITUTO MEXICANO DEL SEGURO SOCIAL</b>

        </div>
        <div style="text-align: center;margin-top: 5px;font-size: 15px;line-height: 1.5">
            DIRECCIÓN DE PRESTACIONES MÉDICAS <br>
            COORDINACIÓN DE UNIDADES MÉDICAS DE ALTA ESPECIALIDAD<br>
            U.M.A.E. "DR. VICTORIO DE LA FUENTE NARVÁEZ", DISTRITO FEDERAL
        </div>
        <div style="text-align: right;margin-right: 60px;margin-top: 10px">
            <b>No. PREI: C 4M0923</b>
        </div>
        <div style="margin-left: 20px">
            <b>CONTRATO OBRAS PÚBLICAS, PERSONA MORAL No. C 141413</b>
        </div>
        <div style="width: 90%;height: 2px;background: black;margin-top: 5px;text-align: center;margin-left: 20px"></div>
    </page_header>
    <page_footer>
        <div style="text-align: center">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>
    <div style="margin-top: 200px;text-align: justify;margin-left: 20px;margin-right: 60px;font-family: Arial;font-weight: normal;line-height: 1.5">
        Contrato de obra pública bajo la condicion de pago sobre la base de precios unitarios y tiempo determinado que celebran por
        una parte el Instituto Mexicano del Seguro Social, a quien en lo sucesivo se denominará “El Instituto”, representado por el 
        <strong> <a style="color: black">DR. RAFAEL R. VILLANUEVA ROMERO</a></strong>
        en su carácter de <strong><a style="color: black">DIRECTOR DE LA UNIDAD</a></strong> y por la otra 
        <strong><a style="color: black">KARISMA INGENIERIA, S.A. DE C.V.</a></strong> 
        a quien se denominará "El Contratista", representado por el C. <strong><a style="color: black">BERNAL CARRILLO PEDRO</a></strong>
        a quienes en forma conjunta se les denominará <strong>"Las Partes"</strong> al tenor de las declaciones y clausulas siguientes:
    </div>
    <div style="text-align: center;margin-top: 15px">
        D e c la r a c i o n e s:
    </div>
    <div style="margin-top: 15px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        <strong><p>I.- “El Instituto” declara:</p></strong>
        <strong>I.1</strong> Quees un organismo público descentralizado de la Administracion Publica Federal conpersonalidad jurídica y patrimonio propio, que tiene a su cargo la organizacion 
        y administracion del SeguroSocial, comoun servicio publico decaracternacional, entérminosde los artículos 4 y 5 de la Ley del Seguro Social.
        <br>
        <strong>I.2.</strong>-Que para  cubrir  las erogaciones que se deriven del presente contrato, la División  de  Conservación  aprobó el ejercicio del 
        gasto corriente con fundamento en el calendario  financiero  del  programa  anual de  operación  autorizado en el presupuesto de
        egresos de la federación con Oficio No.	en su sesión celebrada el 6 de enero de 2014 para el ejercicio fiscal del año 2014
        <br>													
        <strong>I.3.-</strong>  El C. ARQ. ADRIAN SALINAS PEREZ jefe de conservacion de la unidad interviene como representante Area 
        Responsable de la Ejecución de los Trabajos.
        <br>
        <strong>I.4.-</strong> Que tiene la responsabilidad de mantener los inmuebles en los niveles apropiados de funcionamientos para cumplir con los objetivos y acciones para los que fueron construidos.																																						
        <br>
        <strong>I.5.-</strong>El inmueble ubicado en ANTIGUA CARRETERA MEXICO-PACHUCA KM. 12.5 COL. URBANA XALOSTOC																												
        ECATEPEC DE MORELOS, ESTADO DE MEXICO																																						
        donde se ejecutarán los trabajos objeto del presente instrumento juridico, es propiedad de "El Instituto" .
        <br>
        <strong>I.6.-</strong> Que la adjudicación del presente contrato se realizó, por el procedimiento de contratacion por ADJUDICACION DIRECTA
        con fundamento en lo dispuesto por los artículos 134 de la Constitucion Política de los Estados Unidos Méxicanos y 42	
        F.V. 				de la Ley de Obras Públicas y Servicios Relacionados con las Mismas.	
        <br>
        <strong>I.7.- </strong>Señala como domicilio para los efectos que deriven este contrato el ubicado en calle 4 numero 25 primer piso, fraccionamiento Industrial Alce Blanco, Naucalpan de Juarez,Estado de México, codigo postal 53370.																																						
        <strong><p>II.- "El Contratista" declara:</p></strong>
        
    </div>
</page>
<page pageset="old">
    
</page>
<page pageset="old">
    
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Generación de Contrato.pdf');
?>