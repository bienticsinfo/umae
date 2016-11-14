<?php ob_start(); ?>
<page>
    <page_header>
        <div style="text-align: center;margin-top: 25px;font-size: 20px">
            <b>INSTITUTO MEXICANO DEL SEGURO SOCIAL</b>

        </div>
        <div style="text-align: center;margin-top: 5px;font-size: 15px;line-height: 1.5">
            DIRECCIÓN DE PRESTACIONES MÉDICAS<br>
            COORDINACIÓN DE UNIDADES MÉDICAS DE ALTA ESPECIALIDAD<br>
            U.M.A.E. "DR. VICTORIO DE LA FUENTE NARVÁEZ", DISTRITO FEDERAL
        </div>
        <div style="text-align: right;margin-right: 60px;margin-top: 20px">
            <b>No. PREI: <?=$prei[0]['prei_num']?></b>
        </div>
        <div style="margin-left: 20px;margin-top: -15px">
            <b>CONTRATO DE SERVICIO PARA PERSONA MORAL No. <?=$contrato[0]['contrato_numero_tmp']?></b>
        </div>
        <div style="width: 90%;height: 2px;background: black;margin-top: 5px;text-align: center;margin-left: 20px"></div>
    </page_header>
    <page_footer>
        <div style="text-align: center;font-size: 11px">
            Página [[page_cu]]/[[page_nb]]<br>
            <!--CONTRATO DE SERVICIO PARA PERSONA MORAL MAYOR OK-->
        </div>
    </page_footer>
    <div style="margin-top: 190px;text-align: justify;margin-left: 20px;margin-right: 60px;font-family: Arial;font-weight: normal;line-height: 1.5">
        Contrato para la prestación del servicio de: <?=$contrato[0]['contrato_descripcion']?> 
        que  celebran   por   una  parte  el  Instituto Mexicano  del  Seguro  Social,  a través de la Delegación  Regional Estado de México Oriente,
        representada en este acto por el DR. JUAN CARLOS DE LA FUENTE ZUNO en su carácter de DIRECTOR DE LA UNIDAD a quien en lo sucesivo se le denominará "EL INSTITUTO", por la otra <?=$contrato[0]['prov_nombre']?> 
        en lo subsecuente “EL PRESTADOR DE SERVICIO”,  representada por el <?=$contrato[0]['prov_nombre']?> en su carácter de REPRESENTANTE LEGAL al tenor de las declaraciones y cláusulas siguientes:
        <br><br>
    </div>
    <div style="text-align: center;margin-top: 5px">
        <b>Declaraciones:</b>
    </div>
    <div style="margin-top: 5px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        <strong><p>I.- “El Instituto” declara:</p></strong>
        I.1 Es un organismo público descentralizado de la administracion publica federal con personalidad jurídica y patrimonio propios, que tiene a su cargo la organizacion y 
        administracion del Seguro Social como un servicio publico de caracter nacional, en los terminos de los artículos 4 y 5 de la Ley del Seguro Social.
        <br>
        I.2.-
        Que para cubrir las erogaciones que se deriven del presente contrato, la División de Conservación aprobó el ejercicio del gasto corriente con fundamento en el calendario financiero del programa anual de operación autorizado
        en el presupuesto de egresos de la federación con Oficio No. <?=$contrato[0]['contrato_autorizacion_shcp']?> en su sesión celebrada el <?=$contrato[0]['contrato_autorizacion_shcp_emi']?> para el ejercicio fiscal del año <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[2]?>.  <br>													
        I.3 Paracumplir con los programas a su cargo requiere de la prestación del servicio:
        <?=$contrato[0]['contrato_descripcion']?> 
        <br>
        I.4             
        El presente contrato fue adjudicado a "EL PRESTADOR DE SERVICIO" mediante el procedimiento de adjudicacion directa con fundamento																																																																																															
        en lo  dispuesto   por  los  articulos 134, de  la  Constitución  Política  de los Estados Unidos   Mexicanos   y   de  conformidad  con  el 																																																																																															
        articulo <strong><?=$contrato[0]['contrato_articulo']?></strong>	<strong>F.<?=$contrato[0]['contrato_fraccion']?>.</strong> de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Publico.																																																														
        <br>
        I.5 Conforme en lo previsto en los articulos 57 de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Publico y 107 de su Reglamento, “ EL PRESTADOR DE SERVICIO” en su caso de auditorias, visitas o inspecciones que practique la Secretaría de la Función Pública y Organo Interno de Control "El Instituto" debera proporcionar la informacion que en su momento requiera, relativa al presente contrato.
        <br>
        I.6 Cuenta   con   la   autorización  de  la  Secretaria  de Hacienda  y Crédito  Público  para   comprometer   los recursos presupuéstales  que   se   requieren   para    cubrir  las  erogaciones   que  se  causen  con  motivo  de   la   celebración  de   este   contrato,   emitida
        mediante oficio No. <?=$contrato[0]['contrato_autorizacion_shcp']?> de fecha <?=$contrato[0]['contrato_autorizacion_shcp_emi']?>																								.																				
        <br>
        I.7         Señala como domicilio para todos los efectos de este acto jurídico la Unidad Médica de Alta Especialidad "Dr. Victorio de la Fuete Narváez", Ciudad de México, Av. Colector 15 S/N Esquina con Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas Delegación Gustavo A. Madero, Ciudad de México C.P. 07760.

    </div> 
</page>
<page pageset="old">
    <div style="margin-top: 200px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        <strong><p>II Declara “EL PRESTADOR DE SERVICIO” que:</p></strong>
        II.1	Es una persona moral constituida de conformidad de las Leyes de los  Estados  Unidos  Mexicanos, 
        como según consta en la Escritura Pública numero <?=$contrato[0]['prov_num_escritura_publica']?> del <?=$contrato[0]['prov_fecha_escritura_publica']?>	otorgada ante la fe del licenciado
        <?=$contrato[0]['prov_nombre']?> notario público numero <?=$contrato[0]['prov_num_notaria']?> de la ciudad de <?=$contrato[0]['prov_estado_notaria']?>
        inscrita en el Registo Publica de la Propiedad y el Comercio, bajo el Folio Mercantil numero <?=$contrato[0]['prov_folio_rp']?> de <?=$contrato[0]['prov_fecha_inscripcion_rp']?>
        <br>
        II.2 Se encuentra representada para la celebracion de este contrato por el <?=$contrato[0]['prov_nombre']?> quien acredita su personalidad en terminos de la Escritura Pública numero 
        <?=$contrato[0]['prov_rl_numero_ep']?> del <?=$contrato[0]['prov_rl_fecha_ep']?> otorgada ante la fe del Licenciado <?=$contrato[0]['prov_fedatorio_escritura_publica']?> Notario Público Numero <?=$contrato[0]['prov_rl_numero_notaria_ep']?>
        de la Ciudad de <?=$contrato[0]['prov_rl_estado_notaria_ep']?> manifiesta bajo protesta de decir verdad, que las facultades que le fueron conferidas no le han sido revocadas, modificadas ni restringidas en forma alguna.
        <br>
        II.3 De acuerdo con sus estatutos, su objeto social consiste entre otras actividades, en <?=$contrato[0]['prov_giro']?>
        <br>
        II.4 Su registro Federal del Contribuyente es : <span style="text-transform: uppercase"><?=$contrato[0]['prov_rfc']?> </span>
        No. De Registro Patronal ante el IMSS <span style="text-transform: uppercase"><?=$contrato[0]['prov_patronal_imss']?></span>
        registro infonavit 
        <span style="text-transform: uppercase">
            <?php
            if($contrato[0]['prov_registro_infonavit']!=''){
                echo $contrato[0]['prov_registro_infonavit'];
            }else{
                echo 'EN TRAMITE';
            }
            ?>	 
        </span>
        <br>
        II.5 Que sus trabajadores se encuentran inscritos en el regimen obligatorio del Seguro Social, y que se encuentra al corriente en el pago de las cuotas obrero patronales a que haya lugar, conforme a lo dispuesto en la Ley del Seguro Social. Para tal efecto, exhibe en este acto las constancias correspondientes, debidamente emitidas por "El Instituto", las  cuales se agregan al presente instrumento juridico como ANEXO  "1".
        <br>
        II.6	Manifiesta bajo protesta de decir verdad, que dispone de la organización, experiencia, elementos tecnicos, humanos y economicos necesarios, asi como con la capacidad para cumplir con las obligaciones que asume en el presente contrato.
        <br>
        II.7  Su domicilio para efectos del presente contrato es el ubicado en: <?=$contrato[0]['prov_direccion_principal']?>																																																						
                Hechas las declaraciones anteriores, las partes convienen en otorgar el presente contrato de conformidad con las siguientes:	
    </div>
</page>
<page pageset="old">
    <div style="text-align: center;margin-left: 20px;margin-right: 60px;line-height: 1.5;margin-top: 180px">
        <strong>CLAUSULAS</strong>																																																																																																				
    </div>
    <div style="text-align: justify;margin-top: 10px;margin-left: 20px;margin-right: 60px;line-height: 1.5">
        PRIMERA. OBJETO.- "El Instituto" se obliga a adquirir de “ EL PRESTADOR DE SERVICIO”, y este se obliga a entregar los bienes conforme a las especificaciones indicadas en el presupuesto 1.
        <br><br>
        SEGUNDA. IMPORTE DEL CONTRATO.- El importe total de los bienes objeto del presente contrato es la cantidad de 
        $<?=  number_format($contrato[0]['contrato_monto_total'],2)?> ( <?=$contrato[0]['contrato_monto_total_letra']?>)mas el impuesto al valor agregado, las partes convienen que el presente contrato se celebra bajo la modalidad de precios fijos por lo que el monto de los mismos no cambiará durante la vigencia del mismo.
        <br><br>
        TERCERA. FORMA DE PAGO.- "El Instituto" se obliga a pagar a “ EL PRESTADOR DE SERVICIO”, la cantidad señalada, en la clausula inmediata anterior en pesos mexicanos en la unidad de apoyo a la operación que corresponda, por los bienes entregados.“ EL PRESTADOR DE SERVICIO”,deberá entregar en la Jefatura de Conservación de Unidad, la facturas, anexando a cada una de ellas las actas de recepción de los bienes debidamente requisitadas. La Jefatura de Conservación de Unidad, en un plazo de dos días hábiles a partir de la recepción de las facturas, verificará que las mismas presenten los datos en el documento, tales como: Requisitos fiscales, cálculos, precios unitarios, cantidad y si los datos son correctos, se continuará el procedimiento para el pago de los bienes en un término de quince días naturales contados a partir de la fecha de presentación de las facturas a trámite de pago ante el Departamento de Presupuesto, Contabilidad y Erogaciones.En las facturas que presente “ EL PRESTADOR DE SERVICIO”, deberá desglosarse por separado el importe del bien y el IVA correspondiente. El pago será por servicio terminado y entregado, los cuales se comprobarán mediante las correspondientes actas de recepción debidamente requisitadas.
        <br><br>
        CUARTA. VIGENCIA.-las partes convienen en que la vigencia del presente 
        contrato comprenderá del <?=$contrato[0]['contrato_fecha_inicio']?> al <?=$contrato[0]['contrato_fecha_fin']?>
        <br><br>
        QUINTA.- PROHIBICION DE CESION DE DERECHOS Y OBLIGACIONES. “ EL PRESTADOR DE SERVICIO”, se obliga a no ceder, a favor de cualquier otra persona, los derechos y obligaciones que se deriven de este contrato.
        <br><br>
        SEXTA.- IMPUESTOS Y/O DERECHOS.- Los impuestos y/o derechos que procedan con motivo de la adquisicon del presente contrato seran pagados por “ EL PRESTADOR DE SERVICIO”, conforme a la legislacion aplicable en la materia."El Instituto" solo cubrira el Impuesto al Valor Agregado deacuerdo a lo establecido en las disposiciones fiscales vigentes en la materia.
        <br><br>
        SEPTIMA.- PATENTES Y/O MARCAS- “ EL PRESTADOR DE SERVICIO”, se obliga para con "El Instituto" a responder por los daños y o perjuicios que le pudieran causar a éste o a terceros si con motivo de la adquisición viola los derechos de autor, de patentes y/o marcas u otro derecho reservado a nivel nacional o internacional.Por lo anterior,“ EL PRESTADOR DE SERVICIO”, manifiesta en este acto bajo protesta de decir verdad, no encontrarse en ninguno de los supuestos de infraccion a la Ley Federal de Derechos de Autor, ni a la Ley de la Propiedad Industrial.En caso de que sobreviniera alguna reclamacion encontra de "El Instituto" por cualquiera de las causas antes mencionadas, la uinica obligacion de esté será la de dar aviso en el domicilio previsto en este instrumento a “ EL PRESTADOR DE SERVICIO”, para que este lleve acabo las acciones necesarias que garanticen la liberacion de "El Instituto" de cualquier controversia o responsabilidadde caracter civil, mercantil, penal o administrativa que en su caso se ocasiona.
    </div>   
</page>
<page pageset="old">
    <div style="margin-top: 200px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        OCTAVA GARANTIA.-“ EL PRESTADOR DE SERVICIO”, se obliga a otorgar a "El Instituto" la garantia que se menciona a continuacion:
        GARANTÍA DE CUMPLIMIENTO DEL CONTRATO.- “ EL PRESTADOR DE SERVICIO”, se obliga a otorgar, dentro de un plazo de diez días naturales contados a partir de la firma de este instrumento, una garantía de cumplimiento de todas y cada una de las obligaciones a su cargo derivadas del presente Contrato, mediante fianza expedida por compañía autorizada en los términos de la Ley Federal de Instituciones de Fianzas, y a favor del “Instituto Mexicano del Seguro Social”, por un monto equivalente al 10% (diez por ciento) sobre el importe que se indica en la Cláusula Segunda del presente contrato, sin considerar el Impuesto al Valor Agregado.( este contrato se exime de fianza de acuerdo al articulo 48 de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Publico, ya que los bienes fueron entregados antes de los 10 dias naturales.)
        <br><br>
        NOVENA.- PENA CONVENCIONAL POR ATRASO EN LA ENTREGA DEL BIEN.- “EL INSTITUTO” aplicará una pena convencional por cada día de atraso en la entrega del bien.En caso de atraso en la entrega del bien, imputable a “ EL PRESTADOR DE SERVICIO”, este deberá pagar a “ El Instituto ” una pena convencional consistente en una cantidad igual al 2.5% por cada día de demora en la entrega de este, sobre el monto total incumplido, misma que se hará efectiva aplicando la cantidad correspondiente por concepto de pena convencional. “ EL PRESTADOR DE SERVICIO”, queda obligado ante el "Instituto" a responder de los defectos y vicios ocultos y de la calidad del bien, así como de cualquier otra responsabilidad en que hubieren incurrido. 
        <br><br>
        DÉCIMA .- RESCISIÓN ADMINISTRATIVA DEL CONTRATO.- “EL INSTITUTO” podrá rescindir administrativamente el presente contrato en cualquier momento, cuando “ EL PRESTADOR DE SERVICIO”,” incurra en incumplimiento de cualquiera de las obligaciones a su cargo, de conformidad con el procedimiento previsto en el artículo 54, de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Público. “EL INSTITUTO” podrá suspender el trámite del procedimiento de rescisión, cuando se hubiera iniciado un procedimiento de conciliación respecto del contrato materia de la rescisión.
        <br><br>
        DÉCIMA PRIMERA.- CAUSAS DE RESCISIÓN ADMINISTRATIVA DEL CONTRATO.- “EL INSTITUTO” podrá rescindir administrativamente este contrato sin más responsabilidad para el mismo y sin necesidad de resolución judicial, cuando “ EL PRESTADOR DE SERVICIO”, incurra en cualquiera de las causales siguientes:1. Cuando incurra en falta de veracidad total o parcial respecto a la información proporcionada para la celebración del contrato.2. Cuando se incumpla, total o parcialmente, con cualesquiera de las obligaciones establecidas en el este instrumento jurídico y sus anexos.3. Cuando se compruebe que “ EL PRESTADOR DE SERVICIO”,haya prestado el servicio con descripciones y características distintas a las pactadas en el presente instrumento jurídico."4. Cuando se transmitan total o parcialmente, bajo cualquier título, los derechos y obligaciones pactadas en el presente instrumento jurídico, con excepción de los derechos de cobro, previa autorización de “EL INSTITUTO”."5. Si la autoridad competente declara el concurso mercantil o cualquier situación análoga o equivalente que afecte el patrimonio de “ EL PRESTADOR DE SERVICIO”
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DÉCIMA SEGUNDA.- PROCEDIMIENTO DE RESCISIÓN.- Para el caso de rescisión administrativa las partes convienen en someterse al siguiente procedimiento:a) Si “EL INSTITUTO” considera que “ EL PRESTADOR DE SERVICIO”, ha incurrido en alguna de las causales de rescisión que se consignan en la Cláusula que antecede, lo hará saber a “ EL PRESTADOR DE SERVICIO”, de forma indubitable por escrito a efecto de que éste exponga lo que a su derecho convenga y aporte, en su caso, las pruebas que estime pertinentes, en un término de 5 (cinco) días hábiles, a partir de la notificación de la comunicación de referencia.b) Transcurrido el término a que se refiere el párrafo anterior, se resolverá considerando los argumentos y pruebas que hubiere hecho valer."c) La determinación de dar o no por rescindido administrativamente el contrato, deberá ser debidamente fundada, motivada y comunicada por escrito a “ EL PRESTADOR DE SERVICIO”, dentro de los 15 (quince) días hábiles siguientes, al vencimiento del plazo señalado en el inciso a), de esta Cláusula."En el supuesto de que se rescinda el contrato, “EL INSTITUTO” no aplicará las penas convencionales, ni su contabilización para hacer efectiva la garantía de cumplimiento de este instrumento jurídico.En caso de que “EL INSTITUTO” determine dar por rescindido el presente contrato, se deberá formular un finiquito en el que se hagan constar los pagos que, en su caso, deba efectuar “EL INSTITUTO” por concepto de los bienes entragados por “ EL PRESTADOR DE SERVICIO”, hasta el momento en que se determine la rescisión administrativa.Si previamente a la determinación de dar por rescindido el contrato, “ EL PRESTADOR DE SERVICIO”, cumple con las condiciones delos bienes, el procedimiento iniciado quedará sin efectos, previa aceptación y verificación de “EL INSTITUTO” por escrito, de que continúa vigente la necesidad de contar la prestación del servicio, aplicando en su caso, las penas convencionales correspondientes.“EL INSTITUTO” podrá determinar no dar por rescindido el contrato, cuando durante el procedimiento advierta que dicha rescisión pudiera ocasionar algún daño o afectación a las funciones que tiene encomendadas. En este supuesto, “EL INSTITUTO” elaborará un dictamen en el cual justifique que los impactos económicos o de operación que se ocasionarían con la rescisión del contrato resultarían más inconvenientes.De no darse por rescindido el contrato, “EL INSTITUTO” establecerá, de conformidad con “ EL PRESTADOR DE SERVICIO”, un nuevo plazo para el cumplimiento de aquellas obligaciones que se hubiesen dejado de cumplir, a efecto de que “ EL PRESTADOR DE SERVICIO”, subsane el incumplimiento que hubiere motivado el inicio del procedimiento de rescisión. Lo anterior, se llevará a cabo a través de un convenio modificatorio en el que se considere lo dispuesto en los dos últimos párrafos del artículo 52 de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Público.
        <br><br>
        DÉCIMA TERCERA.- RELACIÓN LABORAL.- Las partes convienen en que “EL INSTITUTO”, no adquiere ninguna obligación de carácter laboral para con “ EL PRESTADOR DE SERVICIO”, ni para con los trabajadores que el mismo contrate para la entrega del bien objeto del presente instrumento jurídico, toda vez que dicho personal depende exclusivamente de “ EL PRESTADOR DE SERVICIO”, siendo por lo tanto a cargo de este todas las responsabilidades provenientes de los servicios del `personal que le auxilie, y que no sea puesto a su disposición por el “EL INSTITUTO”.Por lo anterior no se le considerara a “EL INSTITUTO” como patrón, ni a un sustituto, y “ EL PRESTADOR DE SERVICIO”, expresamente lo exime de cualquier responsabilidad de carácter civil, fiscal, laboral, de seguridad social o de otra especie, que en su caso pudiera llegar a generarse.
        <br><br>
        DECIMA CUARTA.- RELACIÓN DE ANEXOS.- El anexo que se relaciona a continuación es rubricados de conformidad por las partes y forman parte integrante del presente contrato.“Presupuesto 1"
        <br><br>
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DECIMA QUINTA.-  LEGISLACIÓN APLICABLE.- Las partes se obligan a sujetarse estrictamente para el cumplimiento del presente contrato, a todas y cada una de las cláusulas del mismo, asi como a lo establecido en Ley de Adquisiciones, Arrendamientos y Servicios del Sector Público, su Reglamento, el Código Civil Federal, el Código Federal de Procedimientos Civiles, la Ley Federal de Procedimiento Administrativo y las disposiciones administrativas aplicables en la materia.																																																																																																				
        <br><br>
        DECIMA SEXTA- JURISDICCIÓN.- Para la interpretación y cumplimiento de este 
        instrumento jurídico, así como para todo aquello que no esté 
        expresamente estipulado en el mismo, las partes se someten a la 
        jurisdicción de los tribunales federales competentes en la Ciudad de México,
        renunciando a cualquier otro fuero presente o futuro que por razón de su domicilio 
        les pudiera corresponder. Previa lectura y debidamente enteradas las partes del contenido, 
        alcance y fuerza legal del presente contrato, en virtud de que se ajusta a la expresión de su 
        libre voluntad y que su consentimiento no se encuentra afectado por dolo, 
        error, mala fe ni otros vicios de la voluntad,lo firman y ratifican 
        en todas sus partes, por triplicado en el 
        Municipio de: <?=$contrato[0]['hospital_localidad_den']?>																																											el día
       <?=$contrato[0]['contrato_fecha_inicio']?>																																															.																																																				
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: center">
        <table style="width: 100%">
            <tr style="width: 100%">
                <td style="width: 50%">
                    " EL INSTITUTO"																																				
                </td>
                <td style="width: 50%">
                    " EL PRESTADOR DE SERVICIO"
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <p>
                        <a style="color: black">
                            <?php if($firmas[0]['res_tipo']=='POR EL INSTITUTO'){
                                echo $firmas[0]['res_nombre'];
                            }?>
                        </a>
                    </p>
                    <p style="font-size: 11px;margin-top: -10px">TITULAR DE LA UMAE "DOCTOR VICTORIO DE LA FUENTE NARVAEZ", DISTRITO FEDERAL</p>
                </td>
                <td style="width: 50%">
                    <p><a style="color: black"><?=$contrato[0]['prov_nombre']?></a></p>
                    <p style="font-size: 11px;margin-top: -10px">REPRESENTANTE LEGAL</p>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 10px;margin-left: 20px;margin-right: 60px;line-height: 1.5;">
        <?php foreach ($firmas as $value) {
            if($value['res_tipo']=='AREA REQUIRIENTE'){
        ?>
        <div style="float: left!important;width: 50%;text-align: center;margin-left: 180px;" >
            <br>
            <p>"AREA REQUIRENTE"</p>
            <p style="margin-top: -6px;"><a style="color: black"><?=$value['res_nombre']?></a></p>
            <p style="font-size: 9px;margin-top: -10px"><?=$value['res_descrip']?></p>
        </div>
        <?php } }?>
        <div style="float: left;width: 50%;text-align: center;margin-left: 180px">
            <br>
            <p>" ADMINISTRADOR DEL CONTRATO"</p>
            <p><a style="color: black;margin-top: -6px">ARQ. ADRIAN BENITO SALINAS PÉREZ</a></p>
            <p style="font-size: 11px;margin-top: -10px">JEFE DE OFICINA DE CONSERVACIÓN DE LA UMAE "DOCTOR VICTORIO DE LA FUENTE NARVAEZ", DISTRITO FEDERAL</p>
        </div>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS('print(TRUE)');
    $pdf->Output('Generación de Contrato.pdf');
?>