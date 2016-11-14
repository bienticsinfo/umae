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
        <div style="text-align: right;margin-right: 60px;margin-top: 15px">
            <b>No. PREI: <?=$prei[0]['prei_num']?></b>
        </div>
        <div style="margin-left: 20px;margin-top: -15px">
            <b>CONTRATO OBRAS PÚBLICAS, PERSONA MORAL No. <?=$contrato[0]['contrato_numero_tmp']?></b>
        </div>
        <div style="width: 90%;height: 2px;background: black;margin-top: 5px;text-align: center;margin-left: 20px"></div>
    </page_header>
    <page_footer>
        <div style="text-align: center;font-size: 11px">
            Página [[page_cu]]/[[page_nb]]<br>
            CONTRATO OBRAS PÚBLICAS, PERSONA MORAL MENOR
        </div>
    </page_footer>
    <div style="margin-top: 190px;text-align: justify;margin-left: 20px;margin-right: 60px;font-family: Arial;font-weight: normal;line-height: 1.5">
        Contrato de obra pública bajo la condicion de pago sobre la base de precios unitarios y tiempo determinado que celebran por
        una parte el Instituto Mexicano del Seguro Social, a quien en lo sucesivo se denominará “EL INSTITUTO”,
        representado por el DR. JUAN CARLOS DE LA FUENTE ZUNO en su carácter de DIRECTOR DE LA UNIDAD y por la otra <?=$contrato[0]['prov_nombre']?> 
        a quien se denominará "EL CONTRATISTA", representado por el <?=$contrato[0]['prov_nombre']?> a quienes en forma conjunta se les denominará "Las Partes" al tenor de las declaciones y clausulas siguientes:
        <br><br>
    </div>
    <div style="text-align: center;margin-top: 15px">
        Declaraciones:
    </div>
    <div style="margin-top: 15px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        <strong><p>I.- “El Instituto” declara:</p></strong>
        <strong>I.1</strong> Es un organismo público descentralizado de la administracion publica federal con personalidad jurídica y patrimonio propios, que tiene a su cargo la organizacion y 
        administracion del Seguro Social como un servicio publico de caracter nacional, en los terminos de los artículos 4 y 5 de la Ley del Seguro Social.
        <br>
        <strong>I.2.-</strong>
        Que para cubrir las erogaciones que se deriven del presente contrato, la División de Conservación aprobó el ejercicio del gasto corriente con fundamento en el calendario financiero del programa anual de operación autorizado
        en el presupuesto de egresos de la federación con Oficio No. <?=$contrato[0]['contrato_autorizacion_shcp']?> en su sesión celebrada el <?=$contrato[0]['contrato_autorizacion_shcp_emi']?> para el ejercicio fiscal del año <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[2]?>.  <br>													
        <strong>I.3.-</strong> 
        El <strong style="color: green">
        <?php foreach ($firmas as $value) { 
            //Hospital 1
            if($value['res_id']=='8'){
                echo $value['res_nombre'];
            //Hospital 2
            }if($value['res_id']=='24'){
                echo $value['res_nombre'];
            }//Hospital 3
            if($value['res_id']=='16'){
                echo $value['res_nombre'];
            }
            //Hospital 4
            if($value['res_id']=='21'){
                echo $value['res_nombre'];
            }
        } ?>
        </strong>
        <br>
        <strong>I.4.-</strong>
         I.4.- Que tiene la responsabilidad de mantener los inmuebles en los niveles apropiados de funcionamientos para cumplir con los objetivos y acciones para los que fueron construidos.
        <br>
        <strong>I.5.-</strong>
        El inmueble ubicado en <?=$contrato[0]['hospital_inmueble_den']?> donde se ejecutarán los trabajos objeto del presente instrumento juridico, es propiedad de "El Instituto" .
        <br>
        <strong>I.6.-</strong>
        Que la adjudicación del presente contrato se realizó, por el procedimiento de contratacion por <?=$contrato[0]['contrato_tipo']?>
        con fundamento en lo dispuesto por los artículos 134 de la Constitucion Política de los Estados Unidos Méxicanos y <?=$contrato[0]['contrato_articulo']?> - F <?=$contrato[0]['contrato_fraccion']?> de la Ley de Obras Públicas y Servicios Relacionados con las Mismas.
        <br>
        <strong>I.7.- </strong>
        Señala como domicilio para todos los efectos de este acto jurídico la Unidad Médica de Alta Especialidad "Dr. Victorio de la Fuete Narváez", Ciudad de México, Av. Colector 15 S/N Esquina con Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas Delegación Gustavo A. Madero, Ciudad de México C.P. 07760.

        <p><strong>II.- "EL CONTRATISTA" declara:</strong></p>	
        <strong>II.1-</strong>
        Que acredita su existencia legal con el testimonio de la escritura pública número <?=$contrato[0]['prov_num_escritura_publica']?> de fecha
        <?=$contrato[0]['prov_fecha_escritura_publica']?> otorgada ante la fe del <?=$contrato[0]['prov_fedatorio_escritura_publica']?> del <?=$contrato[0]['prov_estado_notaria']?>
        inscrita en el registro público de la propiedad y del Comercio de <?=$contrato[0]['prov_estado_rp']?> de fecha <?=$contrato[0]['prov_fecha_inscripcion_rp']?>
        con folio numero <?=$contrato[0]['prov_folio_rp']?>
        <br>
        <strong>II.2-</strong>
        Que la personalidad de su representante, con el carácter ya mencionado, para la suscripción del presente contrato, la
        acredita mediante el testimonio de la escritura pública número <?=$contrato[0]['prov_rl_numero_ep']?> de fecha: <?=$contrato[0]['prov_rl_fecha_ep']?>
        otorgada ante la fe del <?=$contrato[0]['prov_fedatorio_escritura_publica']?> ; Titular de Notaría Número <?=$contrato[0]['prov_rl_numero_notaria_ep']?> del <?=$contrato[0]['prov_rl_estado_notaria_ep']?>
        inscrita en el Registro Público de la Propiedad y del Comercio de <?=$contrato[0]['prov_rl_estado_rpp']?> en el folio número <?=$contrato[0]['prov_rl_folio_rpp']?>
        de fecha <?=$contrato[0]['prov_rl_fecha_rpp']?> ; declarando bajo protesta decir verdad, que las facultades que tiene conferidas no le
        han sido modificadas, rebocadas, o limitadas en forma alguna.
    </div> 
</page>
<page pageset="old">
    <div style="margin-top: 200px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        II.3.- Que reúne las condiciones técnicas y económicas para ejecutar la obra y manifiesta que conoce el sitio de los trabajos objeto de este contrato.	
        <br>
        II.4	
        Que cuenta con los registros siguientes: Registro Federal de Contribuyentes <?=$contrato[0]['prov_rfc']?> 
        Registro Patronal ante el IMSS <?=$contrato[0]['prov_patronal_imss']?> Registro Infonavit: <?=$contrato[0]['prov_registro_infonavit']?>
        <br>
        II.5.- Que sus trabajadores se encuentran inscritos en el regimen obligatorio del Seguro Social, y que se encuentra al corriente en el pago de las cuotas obrero patronales a que haya lugar, conforme a lo dispuesto en la Ley del Seguro Social. 
        Para tal efecto, exhibe en este acto las constancias correspondientes, debidamente emitidas por "El Instituto", las  cuales se agregan al presente instrumento juridico como ANEXO  "1".																														
        <br>
        II.6.- "EL CONTRATISTA" manifiesta bajo protesta de decir verdad, que se encuentra al corriente de sus obligaciones fiscales enlos terminos que establece el numeral 1 de la regla 1.2.1.15, 
        de la Resolucion Miscelanea Fiscal para el año <?=  explode('/', $contrato[0]['contrato_fecha_inicio'])[2]?>.
        <br>
        II.7.- Acepta las obligaciones pactadas en la clausula Decima Segunda, punto 3, de conformidad con lo establecido en el articulo 40 B, ultimo parrafo, de la Ley del Seguro Social, por cuanto al pago de cuotas obrero patronal.
        <br>
        II.8.- Que conoce el contenido y los requisitos que establecen la Ley de Obras Públicas y Servicios Relacionados con las Mismas, el Reglamento de la Ley de Obras Públicas y Servicios Relacionados con las mismas, su Reglamento y sus anexos.
        <br>
        II.9.- Señala como domicilio para los efectos que se deriven de este contrato, el ubicado en <?=$contrato[0]['prov_direccion_principal']?> 
        por lo que por ningun motivo señalará para tales efectos, el domicilio en el cual se llevarán acabo los trabajos materia de este contrato, por lo que, en caso de cambiarlo se obliga a notificarlo por escrito a "El Instituto", en el domicilio señalado en la declaracion I.7. del presente instrumento juridico, de lo contrario cualquier comunicación, notificacion, requerimiento o emplazamiento judicial o extra judicial que se derive o requiera con motivo del presente instrumento legal, seran realizados en dicho domicilio y surtirán plenamente sus efectos en terminos de lo dispuesto por el articulo 307 del Código Fiscal de Procedimientos Civiles, de aplicacion supletoria a la Lay de Obras Públicas y Servicios Relacionados con las Mismas.
        <br>
        II.10.- Que para los efectos del artículo 51 y 78 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, manifiesta bajo protesta de decir verdad, no encontrarse en alguno de los supuestos previstos en el mismo. En razón de lo expuesto, "Las Partes" se obligan en los términos de las siguientes:
    </div>

</page>
<page pageset="old">
    <div style="text-align: center;margin-left: 20px;margin-right: 60px;line-height: 1.5;margin-top: 190px">
        <strong>CLAUSULAS</strong>																																																																																																				
    </div>
    <div style="text-align: justify;margin-top: 10px;margin-left: 20px;margin-right: 60px;line-height: 1.5">
        PRIMERA.- OBJETO.-“El Instituto” encomienda a "EL CONTRATISTA" la ejecución de los trabajos relativos a :
        <?=$contrato[0]['contrato_descripcion']?>
        obligándose éste último a ejecutarlos y entregarlos totalmente terminados y a entera satisfacción de “El Instituto”, cumpliendo con lo establecido en los diversos anexos. 
        <br><br>
        SEGUNDA.- DESCRIPCION PORMENORIZADA DE LOS TRABAJOS.- "EL CONTRATISTA" se obliga a ejecutar los trabajosrelativos a:
        <?=$contrato[0]['contrato_descripcion']?>
        de acuerdo con el contenido de los siguientes Anexos:
        <br>"MMH1" Catalogo de conceptos
        <br>"MMH2" Relacion de planos o croquis.
        <br>"MMH4" Disposiciones de materiales de seguridad e higiene y proteccion ambiental.
        <br>"MMH9" Bitacora
        <br><br>
        TERCERA.- EL PRECIO A PAGAR POR EL OBJETO DEL PRESENTE CONTRATO:- "El Instituto"se obliga a pagar a "EL CONTRATISTA" por la ejecucion de los trabajos la cantidad de: $ <?=  number_format($contrato[0]['contrato_monto_total'],2)?> ( <?=$contrato[0]['contrato_monto_total']?>)mas el Impusto al Valor Agregado.
        <br><br>
        CUARTA.- PLAZO DE EJECUCION- "Las Partes" establecen un plazo de: <?=$contrato[0]['contrata_fecha_duracion']?> días naturales para la ejecuciónde los trabajos; obligándose “EL CONTRATISTA” a 
        iniciarlo el día <?=$contrato[0]['contrato_fecha_inicio']?> y a concluirlos el día <?=$contrato[0]['contrato_fecha_fin']?>
        <br><br>
        QUINTA.- DISPONIBILIDAD DEL INMUEBLE:- “El Instituto” a través del Jefe de Conservación de la Unidad , se obliga a poner a disposición de "EL CONTRATISTA" el o los inmuebles en el que deben llevarse a cabo los trabajos objeto de este contrato, con antelación a la fecha de inicio de los trabajos, el incumplimiento motivará la prórroga de terminación de los trabajos en igual plazo.El incumplimiento "El Instituto" prorrogará en igual plazo la fecha originalmente pactada para la conclusion de los trabajos lo que se formalizara mediante convenio. Los riesgos, la conservacion y la limpieza de los trabajos, desde el momento en que el inmueble se ponga a disposicion de "EL CONTRATISTA" , seran responsabilidadde este.
        <br><br>
        SEXTA.- ANTICIPO.- “ EL INSTITUTO” no otorgará anticipo para la realización de estos servicios a “EL PROVEEDOR”.
        <br><br>
        SEPTIMA.- FORMA DE PAGO:- “El Instituto” conviene con “EL CONTRATISTA”, que el precio del presente contrato se le pagará mediante la formulación de estimacion(es) por unidad concepto de trabajo ejecutados, para tal efecto “EL CONTRATISTA” se obliga a elaborar la estimacion de los trabajos ejecutados, acompañándolas de la documentación que acredite la procedencia de su pago, las que entregará a la U.A.O.1509 de “El Instituto” dentro de los 5 días naturales siguientes a la fecha de corte.Tratándose de pagos en exceso que haya recibido “EL CONTRATISTA”, por cualquier causa e independientemente del tiempo en que “El Instituto” se percate de ese hecho, "EL CONTRATISTA" se obliga a reintegrar las cantidades pagadas en exceso mas los intereses correspondientes, conforme a lo establecido en el articulo 55 de la Ley de Obras Publicas y Servicios Relacionados con las Mismas. Los cargos se calcularan sobre las cantidades pagadas en exceso en cada caso y se computaran por dias naturales desde la fecha del pago hasta la fecha en que se pongan efectivamente las cantidades a disposicion de "El Instituto". 
    </div>   
</page>
<page pageset="old">
    <div style="margin-top: 200px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        OCTAVA.- PROCEDIMIENTO DE AJUSTE DE COSTOS QUE REGIRA DURANTE LA VIGENCIA DEL CONTRATO.- "Las Partes" convienen que cuando a partir de la presentación de propuestas ocurran circunstancias de orden económico no previstas en el contrato y que determinen un aumento o reducción de los costos de los trabajos, de los conceptos aún no ejecutados conforme al programa pactado, cuando procedan, deberán ser ajustados atendiendo al procedimiento de ajuste de costos previsto en la fracción I del artículo 57 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas.
        <br><br>
        NOVENA.- BITACORA.- "Las Partes" Aceptan el uso obligatorio de la Bitacora Manual, su elaboracion, control y seguimiento, constituye el medio de comunicación entre "Las Partes", en esta se registraran los asuntos o eventos importantes que se presenten durante la ejecucion de los trabajos, quedando el resguardo de la informacion a cargo de la Jefatura de Conservacion de Unidad.
        <br><br>
        DECIMA.- RESPONSABLE TECNICO DE "EL CONTRATISTA" EN LA OBRA:- “EL CONTRATISTA” se obliga a designar a un responsable técnico en el sitio de los trabajos mismo que deberá contar con poder amplio y suficiente para tomar decisiones en todo lo relativo al cumplimiento de este contrato, el cual tendrá los conocimientos y experiencia suficientes para el desempeño del cargo y para el cumplimiento del objeto del contrato.
        <br><br>
        DECIMA PRIMERA.- RESPONSABILIDAD.- "Las Partes" convienen que "EL CONTRATISTA" sera el unico responsable:1. La ejecucion de los trabajos 2.- Se obliga a que la calidad de los materiales y equipo que aplicará en los trabajos objeto de la obra motivo del contrato, cumplan con las normas óptimas de calidad y en las especificaciones contenidas en los propios conceptos de los trabajos.3.- Los riesgos, la conservacion y la limpieza de los trabajos objeto del presente contrato hasta el momento de su entrega a "El Instituto".
        <br><br>
        DECIMA SEGUNDA.- CONTRIBUCIONES.1. "EL CONTRATISTA" se obliga a pagar todos los impuestos, aportaciones de seguridad social, derechos o cualquier otro cargo, que se origine con motivo de la celebracion del presente contrato, con excepcion del Impuesto al Valor Agregado, que le sera trasladado por "El Instituto", en terminos de las disposiciones legales aplicables.2. "EL CONTRATISTA" acepta que "El Instituto" le retenga el equivalente al cinco al millar sobre el importe de cada una de las estimaciones de trabajo que se autoricen para pago por concepto de derechos por el servicio vigilancia, inspeccion y control acargo de la Secretaria de la Funcion Publica previstos en el articulo 191, de la Ley Federal de Derechos.3. "EL CONTRATISTA" podra solicitar por escrito y previo al cobro de cualquier estimacion a "El Instituto", a traves de las Areas Responsables de Recaudacion y Finanzas, que de conformidad con lo dispuesto en el articulo 40 B, ultimo parrafo, de la Ley del Seguro Social, que en el supuesto de que se Generen cuentas por liquidar a su cargo, liquidas y exigibles a favor de "El Instituto", durante la vigencia del presente contrato, le sean aplicados como descuento en las estimaciones de los recursos que le corresponda percibir con motivo del presente instrumento juridico, contra los adeudos que, en su caso, tuviera por concepto de cuotas obrero patronales.4. "EL CONTRATISTA", cumplira con la inscripcion de sus trabajadores en el regimen obligatorio del Seguro Social, asi como el pago de las cuotas patronales a que haya lugar, conforme a lo dispuesto en la Ley del Seguro Social. "El Instituto" podra verificar en cualquier momento el cumplimiento de dicho obligacion.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DECIMA TERCERA.- GARANTIAS. Se exime a “EL CONTRATISTA” la garantia correspondiente a favor de "El Instituto" en forma y terminos siguientes: 1De cumplimiento:- ART 48 ULTIMO PARRAFO: Para los efectos de este artículo, los titulares de las dependencias o los órganos de gobierno de las entidades, fijarán las bases, la forma y el porcentaje a los que deberán sujetarse las garantías que deban constituirse, considerando los antecedentes de cumplimiento de los contratistas en los contratos celebrados con las dependencias y entidades, a efecto de determinar montos menores para éstos, de acuerdo a los lineamientos que al efecto emita la Secretaría de la Función Pública. En los casos señalados en los artículos 42 fracciones IX y X, y 43 de esta Ley, el servidor público facultado para firmar el contrato, bajo su responsabilidad, podrá exceptuar a los contratistas de presentar la garantía del cumplimiento del contrato respectivo. Quedará a salvo el derecho de “El Instituto”, para exigir a "EL CONTRATISTA" el pago de las cantidades no cubiertas de la indemnización que a su juicio corresponda, una vez hecha efectiva la garantia a que se refiere el presente inciso.
        <br><br>
        DECIMA CUARTA.- PENAS CONVENCIONALES . "Las Partes" acuerdan que durante la vigencia del contrato, se aplicaran penas convencionales por atraso en la ejecucion de los trabajos por causas imputables a "EL CONTRATISTA" que seran determinadas en funcion del importe de los trabajos que no se hayan ejecutado oportunamente, en los terminos y condiciones que establece: el artículo 46 fracción VIII de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, “Las partes” fijan de común acuerdo, a cargo de "EL CONTRATISTA", una pena convencional del 2.5 (dos punto cinco por ciento) sobre el importe de lo incumplido por cada día natural de retraso por los conceptos que se enuncian en el anexo MMH1 del cual forman parte en el presente contrato.“El Instituto” aplicará el importe de las penas convencionales a que se refiere esta cláusula mediante descuentos al importe de la factura única autorizada a "EL CONTRATISTA". El monto que se aplique en ningún caso podrá ser superior en su conjunto, al monto de la garantia de cumplimiento.
        <br><br>
        DECIMA QUINTA .- CONCEPTOS DE TRABAJO ADICIONALES Y/O NO PREVISTOS EN EL PRESUPUESTO DE CONCEPTOS DEL CONTRATO.- Si durante la ejecucion de los trabajos "EL CONTRATISTA" se percata de la necesidad de ejecutar cantidades adicionales o conceptos no previstos en el presupuesto original del contrato, este lo notificara por escrito a "El Instituto" a travez de la Residencia quien resolvera lo conducente "EL CONTRATISTA" solo podra ejecutarlos una vez que cuente con la autorizacion del Jefe de Oficina de Conservacion dependiente del Departamento de Conservacion y Servicios Generales por escrito, salvo que se trate de situaciones de emergencia en las que no sea posible esperar su autorizacion.
        <br><br>
        DECIMA SEXTA.- RECEPCION DE LOS TRABAJOS. La entrega-recepción de los trabajos objeto del presente contrato, se sujetará al procedimiento previsto por el artículo 64 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, 164, 165 y 166 de su Reglamento de conformidad con el Programa de ejecución de los trabajos.
        <br><br>
        DECIMA SEPTIMA.- NO CESION DE DERECHOS:- “EL CONTRATISTA”, no podrá ceder a terceras personas físicas o morales los derechos y obligaciones derivados de este contrato y sus anexos, con excepción de los derechos de cobro, previa autorización por escrito de “El Instituto”.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DECIMA OCTAVA.- TERMINACION ANTICIPADA. " El Instituto" podra dar por terminado anticipadamente el presente contrato sin responsabilidad para el y sin necesidad de que medie resolucion judicial alguna, cuando concurran razones de interes general;existan causas justificadas que le impidan la continuacion de los trabajos y se demuestre que de continuar con las obligaciones pactadas, se ocacionaria un daño o perjuicio grave a "El Instituto", se determine la nulidad de actos que dieron origen al contrato, con motivo de la resolucion de una inconformidad emitida por la Secretaria de la Funcion Publica o por resolucion de autoridad Judicial competente o bien no sea posible determinar la temporalidad de la suspencion de los trabajos, en este ultimo caso "El Instituto" se obliga a dar aviso por escrito a "EL CONTRATISTA" con quince dias naturales de anticipacion. Comunicada por "El Instituto", la terminacion anticipada del contrato, este precedera a tomar inmediata posesion de los trabajos ejecutados para hacerce cargo del inmueble y de las instalaciones respectivas y en su caso preceder a suspender los trabajos debiendo realizarse las anotaciones correspondientes en la Bitacora y "El Instituto" levantara un acta circunstanciada en terminos de lo señalado en el articulo 151, del reglamento de la Ley de Obras Publicas y Servicos Relacionados con las Mismas, ante la presencia de fedatario publico.En este supuesto "El Instituto" se obliga a pagar los trabajos ejecutados, asi como los gastos no recuperables señalados en el articulo 152, del reglamento de la Ley de Obras Publicas y Servicios Relacionados con las Mismas, que a favor de "EL CONTRATISTA" procedan, siempre que estos sean razonables, esten debidamente comprobados y se relacionen directamente con el contrato.
        <br><br>
        DECIMA NOVENA.- CAUSALES DE RESCISION ADMINISTRATIVA. "Las Partes" convienen que “El Instituto” de conformidad a lo establecido por el articulo 157 del reglamento de la Ley de Obras Publicas y Servicios Relacionados con las Mismas podrá llevar a cabo la resicion administrativa del presente contrato, sin necesidad de declaracion judicial de los tribunales competentes, si el contratista incurre en cuales quiera de las siguientes causales de resicion:1 Interrumpir injustificadamente los trabajos o se niegue a reparar o reponer alguna parte de ellos que hubiere sido detectada como defectuosa por "El Instituto"2 No ejecute los trabajos de conformidad con lo dispuesto en este contrato y en los anexos que lo integran o sin motivo justificado no acate las órdenes dadas por el Jefe de Conservacion de Unidad o en su caso por el Supervisor de Zona.3en caso de que sea declarado o sujeto a concurso mercantil en terminos de la Ley de Concursos Mercantiles o figura análoga.4Sub contrate parte de los trabajos objeto del presente contrato, sin obtener la autorizacion previa por escrito de "El Instituto"5 Transfiera los derechos de cobro derivados de este instrumento juridico sin contar con autorizacion previa y por escrito de "El Instituto"6 No dé a "El Instituto" y a las dependencial de gobierno que tengan facultad de intervenir, las facilñidades y datos necesarios para la inspección, vigilancia y supervisión de los materiales y trabajos.7 En general, por el incumplimiento de cualesquiera de las obligaciones derivadas de este contrato, las Leyes, Tratados y demas ordenamientos que sean aplicables.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        VIGESIMA.- PROCEDIMIENTO DE RESICION ADMINISTRATIVA.- "Las Partes" convienen que en el caso de que "EL CONTRATISTA"  se encuentre en alguna de las causales indicadas en la clausula anterior, el procedimiento de rescisión administrativa se sujetara: 																																							
        1. El procedimiento iniciara a partir de que "El Instituto" le notifique a "EL CONTRATISTA"  por oficio el incumplimiento en que haya incurrido, señalando los hechos o circunstancias que motivaron su determinacion de dar por resindido el contrato, relacionandolo con las estipulaciones especificas que se consideren han sido incumplidas, para que en un termino de 15 (quince) dias habiles exponga lo que a su derecho convenga y aporte, en su caso las pruebas que estime pertinentes. 																																							
        2. Transcurrido el termino a que se refiere el numeral anterior "El Instituto" resolvera considerando los argumentos y pruebas que hubiere hecho valer "EL CONTRATISTA".																																							
        3. La determinacion de dar o no por rescindido el contrato por parte de "El Instituto" debera ser debidamente fundada, motivada y comunicada a "EL CONTRATISTA" dentro de los 15 (quince) dias habiles siguientes a lo señalado en el numeral 1(uno) de esta clausula.																																							
        La determinacion de dar por recindido administrativamente este contrato no podra ser revocada o modificada por "El Instituto" 																																							
        En el caso de que en el procedimiento de rescisión se determine no resindir este contrato, se reprogramaran los trabajos una vez notificada la resolución correspondiente a "EL CONTRATISTA"																																							
        <br><br>
        VIGESIMA PRIMERA.- DEL RESIDENTE. El residente de "El Instituto" tendra entre otras cosas funciones las siguientes:1. Fungir como representante de "El Instituto" ante "EL CONTRATISTA"2. Supervisar, vigilar controlar y revisar la ejecucion de los trabajos.3. Tomar las decisiones tecnicas correspondientes y necesarias para la correcta ejecucion de los trabajos, debiendo resolver oportunamente las consultas, aclaraciones, dudas o solicitudes de autorizacion que presente el Superintendente de Construccion de "EL CONTRATISTA" y en su caso, el supervisor, con relacion al cumplimiento de los derechos y obligaciones derivadas del presente contrato.4. Dar cumplimiento a las actividades previstas a su cargo en la clausula novena que antecede, entre ellas, la apertura a la Bitacora, en terminos de lo estipulado, asi como por medio de ella, emitir las instrucciones pertinentes y recibir las solicitudes que le formule el Super Intendente de Construccion de "EL CONTRATISTA" cuando la bitacora se lleve por medios convencionales, esta quedara bajo su resguardo.5. Vigilar y controlar el desarrollo de los trabajos, en sus aspectos de calidad, costo, tiempo y apego a los programas de ejecucion de los trabajos, de acuerdo con los avances, recursos asignados y rendimientos pactados en el presente contrato.6. Revisar, controlar y comprobar que los materiales, la mano de obra sean de la calidad y caracteristicas pactadas en el este contrato.7. Coordinar con los servidores publicos responsables responsables las terminaciones anticipadas o rescisiones de contratos y cuando se justifique, las suspensiones de los trabajos debiendose auxiliar de "El Instituto" para su formalizacion8. Informar formalmente al superintendente de "EL CONTRATISTA" sobre las desviaciones o atrasos que detecte solicitandole su correccion y efectuar las anotaciones correspondientes en la Bitacora9. Verificar la debida terminación de los trabajos dentro del plazo convenido.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 190px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        VIGESIMA SEGUNDA- RELACION LABORAL.- “EL CONTRATISTA” como empresario y patrón del personal que ocupe con motivo de los trabajos materia de este contrato, será el único responsable de las obligaciones derivadas de las disposiciones legales y demás ordenamiento en materia de trabajo y de seguridad social; por lo que “EL CONTRATISTA” conviene en responder a todas las reclamaciones que sus trabajadores presentaren en su contra o en contra de “El Instituto” en relación con los trabajos del contrato, así como a resarcir a éste cualquier cantidad que erogue por dichos conceptos.Por lo anterior, no se considera a "El Instituto" como patrón, ni aún substituto, y "EL CONTRATISTA" expresamente lo exime de cualquier responsabilidad de carácter civil, fiscal, de seguridad social, laboral, o de otra especie, que en su caso podria llegar a generarse."EL CONTRATISTA" se obliga a liberar a "El Instituto" de cualquier reclamacion índole laboral o de seguridad social que sea presentada por parte de sus trabajadores ante las autoridades competentes.
        <br><br>
        VIGESIMA TERCERA.- LEGISLACION APLICABLE .- "Las Partes" se obligan a sujetarse estrictamente para el cumplimiento del presente contrato a todas y cada una de las clausulas del mismo,asi como lo establecido en la Ley de Obras publicas y Servicios Relacionados con las Misma, su Reglamento y supletoriamente al Codigo Civil Federal, a la Ley de Procedimiento Administrativo, al Código Federal de Procedimientos Civiles y demas ordenamientos aplicables.
        <br><br>
        VIGESIMA CUARTA- RESOLUCION DE CONTROVERSIAS.- 
        Para la interpretación y cumplimiento de este instrumento,
        asi como para todo aquello que no este expresamente estipulado en el mismo, 
        las partes se someten a la jurisdiccion los tribunales Federales 
        competentes ubicados en la Ciudad de Mexico renunciando a cualquier otro fuero presente o futuro que por razon de domicilio les pudiera corresponder.Previa lectura y debidamente enteradas " Las Partes" del contenido, alcance y duerza legal del presente contrato, en virtud de quese ajusta a la expresion de su libre voluntad y que su consentimiento no se encuentra afectado por dolo, error, mala fe niotros vicios de la voluntad, lo firman y ratifican en todas sus partes, en 4 (cuatro) tantos, en 
        <?=$contrato[0]['hospital_localidad_den']?> el <?=$contrato[0]['contrato_fecha_inicio']?>
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
                    "CONTRATISTA"
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