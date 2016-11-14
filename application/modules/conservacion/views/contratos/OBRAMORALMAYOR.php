<?php ob_start(); ?>
<page>
    <page_header>
        <div style="margin-top: 25px;margin-left: 20px;margin-right: 20px">
            <table style="width: 100%">
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>INSTITUTO MEXICANO DEL SEGURO SOCIAL</strong></td>
                    <td style="text-align: right!important;width: 30%"><strong>No. PREI: <?=$prei[0]['prei_num']?></strong></td>
                </tr>
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>DIRECCIÓN DE PRESTACIONES MÉDICAS</strong></td>
                    <td style="text-align: right!important;width: 30%"><strong>No. ADJCU416018</strong></td>
                </tr>
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>COORDINACIÓN DE UNIDADES MÉDICAS DE ALTA ESPECIALIDAD</strong></td>
                    <td style="text-align: right!important;width: 30%"></td>
                </tr>
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>UNIDAD MÉDICA DE ALTA ESPECIALIDAD</strong></td>
                    <td style="text-align: right!important;width: 30%"><strong><?=$contrato[0]['contrato_tipo']?></strong></td>
                </tr>
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>“DR. VICTORIO DE LA FUENTE NARVÁEZ” DISTRITO FEDERAL</strong></td>
                    <td style="text-align: right!important;width: 30%"><strong>LA-019GYR049-E75-2015</strong></td>
                </tr>
                <tr style="width: 100%">
                    <td style="text-align: left!important;width: 70%"><strong>DEPARTAMENTO DE CONSERVACIÓN Y SERVICIOS GENERALES</strong></td>
                    <td style="text-align: right!important;width: 30%"> </td>
                </tr>
                
            </table>
        </div>
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
            <!--CONTRATO OBRAS PÚBLICAS, PERSONA MORAL MAYOR-->
        </div>
    </page_footer>
    <div style="margin-top: 350px;text-align: justify;margin-left: 20px;margin-right: 60px;font-family: Arial;font-weight: normal;line-height: 1.5">
        Contrato de obra pública bajo la condicion de pago sobre la base de precios unitarios y 
        tiempo determinado que celebran poruna parte el Instituto Mexicano del Seguro Social, 
        a quien en lo sucesivo se denominará “El Instituto”,representado 
        por el DR. IGNACIO DEVESA GUTIERREZ en su carácter de 
        TITULAR DE LA UMAE "DR. VICTORIO DE LA FUENTE NÁRVAEZ" DISTRITO FEDERAL y por la otra 
        <?=$contrato[0]['prov_razon_social']?> a quien se denominará "El Contratista", 
        representado por el <?=$contrato[0]['prov_nombre']?> a quienes en forma conjunta se les denominará 
        "Las Partes" al tenor de las declaciones y clausulas siguientes:
    </div>
    <div style="margin-top: 20px;text-align: center">
        <strong>Declaraciones:</strong>
    </div>
    <div style="margin-top: 20px;text-align: justify;margin-left: 20px;margin-right: 60px;font-family: Arial;font-weight: normal;line-height: 1.5">
        I.- “El Instituto” declara:<br>
        I.1 Que es un organismo público descentralizado de la Administracion Publica Federal con personalidad jurídica y patrimonio propio, que tiene a su cargo la organizacion y administracion del Seguro Social, como un servicio publico de caracter nacional, en términos de los artículos 4 y 5 de la Ley del Seguro Social.
        <br>
        I.2.- Está facultado para adquirir toda clase de bienes y contratar servicios, en términos de la legislación vigente, para la consecución de los fines para los que fue creado, de conformidad con el artículo 251 fracción IV de la Ley del Seguro Social.
        <br>
        I.3.- Su representante, el Dr. Juan Carlos de la Fuente Zuno Director de la  UMAE “Dr. Victorio de la Fuente Narváez”, Distrito Federal, se encuentra facultado para suscribir el presente instrumento jurídico en representación de "EL INSTITUTO", de acuerdo al poder que le fue conferido en la Escritura Pública número 79,461 de fecha 15 de diciembre de 2014, expedido a su favor por el Licenciado Benito Iván Guerra Silla, Titular de la Notaria Número 7 del Distrito Federal.																																						
        <br>
        I.4.-Que para cubrir las erogaciones que se deriven del presente contrato, 
        la División de Conservación aprobó el ejercicio del gasto corriente con fundamento en 
        el calendario financiero del programa anual de operación autorizadoen el 
        presupuesto de egresos de la federación con Oficio <?=$contrato[0]['contrato_autorizacion_shcp']?> en su sesión celebrada el <?=$contrato[0]['contrato_autorizacion_shcp_emi']?> para el ejercicio fiscal del año 2016.
        <br>
        I.5.-
        El <strong style="color: green">
        <?php foreach ($firmas as $value) { 
            //Hospital 1
            if($value['res_id']=='8'){
                echo $value['res_nombre'];
            //Hospital 2
            }if($value['res_id']=='10'){
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
        Jefe de Conservación de Unidad
        del <?=$contrato[0]['hospital_nombre']?> 
        Intervienen 
        en la firma del presente instrumento jurídico, como áreas Administradoras, 
        en el procedimiento del cual se deriva este contrato, de conformidad con lo 
        dispuesto en el artículo 84 Penúltimo Párrafo del Reglamento de la Ley de 
        Adquisiciones, Arrendamientos y Servicios del Sector Público y numeral 5.3.17 inciso c) 
        de las Políticas, Bases y Lineamientos en Materia de Adquisiciones, Arrendamientos 
        y Servicios del Instituto Mexicano del Seguro Social.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        I.6.- Para el cumplimiento de sus funciones y la realización de sus actividades, requiere de la Contratación lo siguiente:
        <br>
        I.7.- Que la adjudicación del presente contrato se realizó, por el procedimiento de 
        contratacion por <?=$contrato[0]['contrato_tipo']?> con fundamento en lo dispuesto por los artículos 134 de 
        la Constitucion Política de los Estados Unidos Méxicanos y 43 <?=$contrato[0]['contrato_articulo']?> - de la 
        Ley de Obras Públicas y Servicios Relacionados con las Mismas.
        <br>
        I.8.- Para cubrir las erogaciones que se deriven del presente contrato, cuenta con recursos disponibles suficientes, 
        no comprometidos en la partida presupuestal número <?=$contrato[0]['contrato_clave_presupuestal']?> de conformidad con el Dictamen de 
        Disponibilidad Presupuestal Previo Número <strong style="color: red">0000000538-2016</strong> integrado en el Anexo número 1 (uno), 
        del presente Instrumento JurídicoLos compromisos excedentes no cubiertos durante el presente ejercicio, 
        quedan sujetos para fines de ejecución y pago, a la disponibilidad presupuestaria 
        con que cuente “EL INSTITUTO”, conforme al Presupuesto de Egresos de la Federación que 
        apruebe la H. Cámara de Diputados del Congreso de la Unión, sin responsabilidad alguna para “EL INSTITUTO”.
        <br>
        I.9.- Con fecha de <strong><?=$contrato[0]['contrato_fecha_creacion']?></strong>, la Unidad Médica de Alta Especialidad “Dr. Victorio de la Fuente Narvaez” Distrito Federal, 
        emitió el Dictamen de Procedencia del procedimiento de contratación mencionado en la declaración que antecede.
        <br>
        I.10.- Señala como su domicilio para todos los efectos de este acto jurídico el ubicado en Av. Colector 15 S/N Esquina Instituto Politécnico Nacional Col. Magdalena de las Salinas Delegación Gustavo A. Madero C.P. 07760, Ciudad de México.
        <br><br>
        II.- "El Contratista" declara:
        <br>
        II.1.- Que acredita su existencia legal con el testimonio de la escritura pública número <?=$contrato[0]['prov_num_escritura_publica']?> 
        de fecha <?=$contrato[0]['prov_fecha_escritura_publica']?> otorgada ante la fe del <?=$contrato[0]['prov_fedatorio_escritura_publica']?>
        de <?=$contrato[0]['prov_fecha_inscripcion_rp']?> inscrita en el registro público de la propiedad y del Comercio de
        <?=$contrato[0]['prov_rl_numero_ep']?> de fecha <?=$contrato[0]['prov_rl_fecha_ep']?> con folio numero <?=$contrato[0]['prov_folio_rp']?>.
        <br>
        II.2.- Que la personalidad de su representante, con el carácter ya mencionado, para la suscripcióndel presente contrato, 
        la acredita mediante el testimonio de la escritura pública número <?=$contrato[0]['prov_rl_numero_ep']?> de fecha: <?=$contrato[0]['prov_rl_fecha_ep']?> 
        otorgada ante la fe del <?=$contrato[0]['prov_fedatorio_escritura_publica']?>; Titular de Notaría Número <?=$contrato[0]['prov_rl_numero_notaria_ep']?> 
        del <?=$contrato[0]['prov_rl_fecha_ep']?> inscrita en el 
        Registro Público de la Propiedad y del Comercio de <?=$contrato[0]['prov_rl_estado_notaria_ep']?> en el folio número <?=$contrato[0]['prov_rl_folio_rpp']?> de fecha <?=$contrato[0]['prov_rl_fecha_rpp']?>; 
        declarando bajo protesta decir verdad, que las facultades que tiene conferidas no lehan sido modificadas, rebocadas, o limitadas en forma alguna.
        <br>
        II.3.- Que reúne las condiciones técnicas y económicas para ejecutar la obra y manifiesta que conoce el sitio de los trabajos objeto de este contrato.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        II.4.- Que cuenta con los registros siguientes: Registro Federal de Contribuyentes
        <?=$contrato[0]['prov_rfc']?> RegistroPatronal ante el IMSS <?=$contrato[0]['prov_patronal_imss']?>
        Registro Infonavit: <?=$contrato[0]['prov_registro_infonavit']?>
        <br>
        II.5.- Sus trabajadores se encuentran inscritos en el régimen obligatorio del Seguro Social, y al corriente en el pago de sus cuotas obrero patronal a que haya lugar, conforme a lo dispuesto en la Ley del Seguro Social, cuyas constancias correspondientes debidamente emitidas por “EL INSTITUTO” exhibe para efectos de la suscripción del presente instrumento jurídico, las cuales se agregan al presente instrumento juridico como ANEXO "2".
        <br>
        II.6.- Cuenta con el documento correspondiente, vigente y expedido por el servicio de Administración Tributaria (SAT), relativo a la opinión sobre el cumplimiento de sus obligaciones fiscales, conforme a lo dispuesto por la regla 2.1.31 de la Resolución Miscelánea Fiscal 2016 y de conformidad con el articulo 32 D del Código Fiscal de la Federación, del cual presenta copia a “EL INSTITUTO” para efectos de la suscripción del presente contrato, "ANEXO 3".
        <br>
        II.7.- En caso de incumplimiento en sus obligaciones en materia de seguridad social solicita se apliquen los recursos derivados del presente contrato, contra los adeudos que, en su caso, tuviera a favor de “EL INSTITUTO”, de conformidad con lo descrito en los lineamientos para la verificación del cumplimiento de las obligaciones en materia de seguridad social de los proveedores y contratistas de fecha 25 de mayo de 2015.
        <br>
        II.8.- “EL PROVEEDOR” que tenga cuentas liquidas y exigibles a su cargo por concepto de cuotas obrero patronales, conforme a lo previsto en el artículo 40 B de la Ley del Seguro Social, acepta que “EL INSTITUTO” las compense con el o los pagos que tenga que hacerle por concepto de contraprestación por la contratación de bienes o servicios.
        <br>
        II.9.- Que conoce el contenido y los requisitos que establecen la Ley de Obras Públicas y Servicios Relacionados con las Mismas, el Reglamento de la Ley de Obras Públicas y Servicios Relacionados con las mismas, su Reglamento y sus anexos.
        <br>
        II.10.- Señala como domicilio para los efectos que se deriven de este contrato, el ubicado en <?=$contrato[0]['prov_direccion_principal']?> por lo que por ningun motivo señalará para tales efectos, el domicilio en el cual se llevarán acabo los trabajos materia de este contrato, por lo que, en caso de cambiarlo se obliga a notificarlo por escrito a "El Instituto", en el domicilio señalado en la declaracion I.9. del presente instrumento juridico, de lo contrario cualquier comunicación, notificacion, requerimiento o emplazamiento judicial o extra judicial que se derive o requiera con motivo del presente instrumento legal, seran realizados en dicho domicilio y surtirán plenamente sus efectos en terminos de lo dispuesto por el articulo 307 del Código Fiscal de Procedimientos Civiles, de aplicacion supletoria a la Lay de Obras Públicas y Servicios Relacionados con las Mismas.
        <br>
        II.10.- Que para los efectos del artículo 51 y 78 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, manifiesta bajo protesta de decir verdad, no encontrarse en alguno de los supuestos previstos en el mismo. En razón de lo expuesto, "Las Partes" se obligan en los términos de las siguientes:
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: center">
        <strong>Clausulas:</strong>
    </div>
    <div style="margin-top: 20px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        PRIMERA.- OBJETO.-“El Instituto” encomienda a "El Contratista" la ejecución de los trabajos relativos a :<?=$contrato[0]['contrato_descripcion']?>  obligándose éste último a ejecutarlos y entregarlos totalmente terminados y a entera satisfacción de “El Instituto”, cumpliendo con lo establecido en los diversos anexos. 
        <br><br>
        SEGUNDA.- DESCRIPCION PORMENORIZADA DE LOS TRABAJOS.- "El Contratista" se obliga a ejecutar los trabajosrelativos a:<?=$contrato[0]['contrato_descripcion']?> de acuerdo con el contenido de los siguientes Anexos:
        <br>"MMH1" Catalogo de conceptos
        <br>"MMH2" Relacion de planos o croquis.
        <br>"MMH4" Disposiciones de materiales de seguridad e higiene y proteccion ambiental.
        <br>"MMH9" Bitacora
        <br><br>
        TERCERA.- EL PRECIO A PAGAR POR EL OBJETO DEL PRESENTE CONTRATO:- 
        "El Instituto"se obliga a pagar a "El Contratista" por la ejecucion de los trabajos la cantidad de: $<?=  number_format($contrato[0]['contrato_monto_total'], 2)?>( <?=$contrato[0]['contrato_monto_total_letra']?>)mas el Impuesto al Valor Agregado.
        <br><br>
        CUARTA.- PLAZO DE EJECUCION- "Las Partes" establecen un plazo de: <?=$contrato[0]['contrata_fecha_duracion']?> días naturales para la ejecuciónde los trabajos; obligándose “El Contratista”a iniciarlo el día <?=$contrato[0]['contrato_fecha_inicio']?> y a concluirlos el día <?=$contrato[0]['contrato_fecha_fin']?>.
        <br><br>
        QUINTA.- DISPONIBILIDAD DEL INMUEBLE:- “El Instituto” a través del Jefe de Conservación de la Unidad o Jefe de Oficina de la UMAE "Dr. Victorio de la Fuente Narváez" Distrito federal, se obliga a poner a disposición de "El Contratista" el o los inmuebles en el que deben llevarse a cabo los trabajos objeto de este contrato, con antelación a la fecha de inicio de los trabajos, el incumplimiento motivará la prórroga de terminación de los trabajos en igual plazo.El incumplimiento "El Instituto" prorrogará en igual plazo la fecha originalmente pactada para la conclusion de los trabajos lo que se formalizara mediante convenio. Los riesgos, la conservacion y la limpieza de los trabajos, desde el momento en que el inmueble se ponga a disposicion de "El Contratista", seran responsabilidad del mismo.
        <br><br>
        SEXTA.- ANTICIPO.- “ El Instituto” no otorgará anticipo para la realización de estos servicios a “El Contratista” .
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        SEPTIMA.- FORMA DE PAGO:- “EL INSTITUTO” se obliga a pagar a “EL PROVEEDOR”, la cantidad señalada en la Cláusula Tercera en pesos mexicanos, a 
        los 20 días naturales posteriores a la entrega por parte de “EL PROVEEDOR”, 
        de los siguientes documentos:Original y copia de la factura que reúna los requisitos 
        fiscales respectivos, en la que se indique los trabajos realizados entregados, número de proveedor, 
        número de contrato, en su caso, número de alta, número de fianza y denominación social de la afianzadora,
        misma que deberá ser entregada en el Departamento de Finanzas de la 
        Unidad Médica de Alta Especialidad “Dr. Victorio De la Fuente Narváez”, 
        Distrito Federal ubicada en Avenida Colector 15 sin número, esquina con Avenida Instituto Politécnico Nacional, 
        Colonia Magdalena de las Salinas, Delegación Gustavo A. Madero, Código Postal 07760, de la Ciudad de México, 
        horario de atención de 8:00 a 13:00 horas.En caso de que “EL PROVEEDOR” presente su factura con errores o deficiencias, 
        conforme a lo previsto en el artículo 90 del Reglamento de la Ley, “EL INSTITUTO” dentro de los tres días hábiles siguientes
        a la recepción, indicará por escrito a “EL PROVEEDOR” las deficiencias que se deberán corregir.El pago se realizara mediante 
        transferencia electrónica de fondos, a través del esquema electrónico intrabancario que tiene en operación, con las 
        instituciones bancarias siguientes: Banamex, S.A., BBVA, Bancomer, S.A., Banorte, S.A. y Scotiabank Inverlat, S.A., 
        para tal efecto deberá presentar su petición por escrito en Departamento de Finanzas de la Unidad Médica de Alta Especialidad 
        “Dr. Victorio De la Fuente Narváez”, Distrito Federal ubicada en Avenida Colector 15 sin número, esquina con Avenida Instituto Politécnico Nacional, 
        Colonia Magdalena de las Salinas, Delegación Gustavo A. Madero, Código Postal 07760, de la Ciudad de México, horario de atención de 8:00 a 13:00 horas, 
        indicando: razón social, domicilio fiscal, número telefónico y fax, nombre completo del apoderado legal con facultades de cobro y su firma, 
        número de cuenta de cheques (número de clabe bancaria estandarizada), banco, sucursal y plaza, así como,
        número de proveedor asignado por “EL INSTITUTO”.En caso de que “EL PROVEEDOR” solicite el abono en una cuenta contratada en un banco 
        diferente a los antes citados (interbancario), “EL INSTITUTO” realizará la instrucción de pago en la fecha de vencimiento del contra 
        recibo y su aplicación se llevará a cabo al día hábil siguiente, de acuerdo con el mecanismo establecido por el Centro de Compensación 
        Bancaria (CECOBAN).Anexo a la solicitud de pago electrónico (intrabancario e interbancario) “EL PROVEEDOR” deberá presentar original 
        y copia de la cédula del Registro Federal de Contribuyentes, poder notarial e identificación oficial; los originales se solicitan 
        únicamente para cotejar los datos y le serán devueltos en el mismo acto a “EL PROVEEDOR”.“EL PROVEEDOR” que celebre contrato de cesión de
        derechos de cobro, deberá notificarlo por escrito a “EL INSTITUTO”, con un mínimo de 5 (cinco) días naturales anteriores a la fecha de pago 
        programada, entregando invariablemente una copia de los contra-recibos cuyo importe se cede, además de los documentos sustantivos de dicha cesión. 
        El mismo procedimiento aplicará en el caso de que “EL PROVEEDOR” celebre contrato de cesión de derechos de cobro a través de factoraje financiero 
        conforme al Programa de Cadenas Productivas de Nacional Financiera, S.N.C., 
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        Institución de Banca de Desarrollo.Tratándose de pagos en exceso que haya 
        recibido “El Contratista”, por cualquier causa e independientemente del tiempo en que “El Instituto” se percate de ese hecho, 
        "El Contratista" se obliga a reintegrar las cantidades pagadas en exceso mas los intereses correspondientes, conforme a lo 
        establecido en el articulo 55 de la Ley de Obras Publicas y Servicios Relacionados con las Mismas. Los cargos se calcularan 
        sobre las cantidades pagadas en exceso en cada caso y se computaran por dias naturales desde la fecha del pago hasta la fecha 
        en que se pongan efectivamente las cantidades a disposicion de "El Instituto". 
        <br><br>
        OCTAVA.- PROCEDIMIENTO DE AJUSTE DE COSTOS QUE REGIRA DURANTE LA VIGENCIA DEL CONTRATO.- "Las Partes" convienen que cuando a partir de la presentación de propuestas ocurran circunstancias de orden económico no previstas en el contrato y que determinen un aumento o reducción de los costos de los trabajos, de los conceptos aún no ejecutados conforme al programa pactado, cuando procedan, deberán ser ajustados atendiendo al procedimiento de ajuste de costos previsto en la fracción I del artículo 57 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas.
        <br><br>
        NOVENA.- BITACORA.- "Las Partes" Aceptan el uso obligatorio de la Bitacora Manual, su elaboracion, control y seguimiento, constituye el medio de comunicación entre "Las Partes", en esta se registraran los asuntos o eventos importantes que se presenten durante la ejecucion de los trabajos, quedando el resguardo de la informacion a cargo de la Jefatura de Conservacion de Unidad.
        <br><br>
        DECIMA.- RESPONSABLE TECNICO DE "EL CONTRATISTA" EN LA OBRA:- “El Contratista” se obliga a designar a un responsable técnico en el sitio de los trabajos mismo que deberá contar con poder amplio y suficiente para tomar decisiones en todo lo relativo al cumplimiento de este contrato, el cual tendrá los conocimientos y experiencia suficientes para el desempeño del cargo y para el cumplimiento del objeto del contrato.
        <br><br>
        DECIMA PRIMERA.- RESPONSABILIDAD.- "Las Partes" convienen que "El Contratista" sera el unico responsable:
        <br>1. La ejecucion de los trabajos 
        <br>2.- Se obliga a que la calidad de los materiales y equipo que aplicará en los trabajos objeto de la obra motivo del contrato, cumplan con las normas óptimas de calidad y en las especificaciones contenidas en los propios conceptos de los trabajos.
        <br>3.- Los riesgos, la conservacion y la limpieza de los trabajos objeto del presente contrato hasta el momento de su entrega a "El Instituto".
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DECIMA SEGUNDA.- CONTRIBUCIONES.
        <br>1. "El Contratista" se obliga a pagar todos los impuestos, aportaciones de seguridad social, derechos o cualquier otro cargo, que se origine con motivo de la celebracion del presente contrato, con excepcion del Impuesto al Valor Agregado, que le sera trasladado por "El Instituto", en terminos de las disposiciones legales aplicables.
        <br>2. "El Contratista" acepta que "El Instituto" le retenga el equivalente al cinco al millar sobre el importe de cada una de las estimaciones de trabajo que se autoricen para pago por concepto de derechos por el servicio vigilancia, inspeccion y control acargo de la Secretaria de la Funcion Publica previstos en el articulo 191, de la Ley Federal de Derechos.
        <br>3. "El Contratista" podra solicitar por escrito y previo al cobro de cualquier estimacion a "El Instituto", a traves de las Areas Responsables de Recaudacion y Finanzas, que de conformidad con lo dispuesto en el articulo 40 B, ultimo parrafo, de la Ley del Seguro Social, que en el supuesto de que se Generen cuentas por liquidar a su cargo, liquidas y exigibles a favor de "El Instituto", durante la vigencia del presente contrato, le sean aplicados como descuento en las estimaciones de los recursos que le corresponda percibir con motivo del presente instrumento juridico, contra los adeudos que, en su caso, tuviera por concepto de cuotas obrero patronales.
        <br>4. "El Contratista", cumplira con la inscripcion de sus trabajadores en el regimen obligatorio del Seguro Social, asi como el pago de las cuotas patronales a que haya lugar, conforme a lo dispuesto en la Ley del Seguro Social. "El Instituto" podra verificar en cualquier momento el cumplimiento de dicho obligacion.
        <br><br>
        DECIMA TERCERA.- GARANTIAS.“El Contratista” se obliga a constituir la garantia correspondiente a favor de "El Instituto" en forma y terminos siguientes: <br>1 De cumplimiento:- Mediante Póliza de Fianza de "El Instituto" para garantizar el cumplimiento de todas y cada una de las obligaciones derivadas del presente contrato, por importe equivalente al 10% (Diez Porciento), del precio estipulado en la cláusula tercera, sin incluir el impuesto al Valor Agregado, expedida por institución afianzadora legalmente autorizada, en los términos de la Ley Federal de Instituciones de Fianzas. La póliza de fianza de cumplimiento será liberada por "El Instituto" para su cancelacion una vez que "El Contratista" entregue la garantia de los defectos de vicios ocultos o cualquier otra responsabilidad.<br>2 De vicios ocultos:- ART 66: Al concluir los trabajos, “El Contratista” debera constituir garantia, por un plazo de doce meses, contados apartir de la fecha de firma del Acta de Recepcion Fisica de los Trabajos para responder por defectos, vicios ocultos o cualquier otra responsabilidad en que ubiere incurrido con motivo del cumplimieto de las obligaciones contractuales, la que entregará previo a la entrega fisica de los trabajos, recibiendo a cambio la constancia de recepcion correspondiente; dicha garantia debera ser expedida por una institucion afianzadora legalmente autorizada para tal efecto en terminos de la Ley Federal de Instituciones de Fianzas, por el Equivalente al 10% (Diez Porciento) sin incluir Impuesto al Valor Agregado, del monto total ejercido de los trabajos.Quedará a salvo el derecho de “El Instituto”, para exigir a 
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        "El Contratista" el pago de las cantidades no cubiertas de la indemnización que a su juicio corresponda, una vez hecha efectiva la garantia a que se refiere el presente inciso.
        <br><br>
        DECIMA CUARTA.- PENAS CONVENCIONALES . "Las Partes" acuerdan que durante la vigencia del contrato, se aplicaran penas convencionales por atraso en la ejecucion de los trabajos por causas imputables a "El Contratista" que seran determinadas en funcion del importe de los trabajos que no se hayan ejecutado oportunamente, en los terminos y condiciones que establece: el artículo 46 fracción VIII de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, “Las partes” fijan de común acuerdo, a cargo de "El Contratista", una pena convencional del 2.5 (dos punto cinco por ciento) sobre el importe de lo incumplido por cada día natural de retraso por los conceptos que se enuncian en el anexo MMH1 del cual forman parte en el presente contrato. “El Instituto” aplicará el importe de las penas convencionales a que se refiere esta cláusula mediante descuentos al importe de la factura única autorizada a "El Contratista". El monto que se aplique en ningún caso podrá ser superior en su conjunto, al monto de la garantia de cumplimiento.
        <br><br>
        DECIMA QUINTA .- CONCEPTOS DE TRABAJO ADICIONALES Y/O NO PREVISTOS EN EL PRESUPUESTO DE CONCEPTOS DEL CONTRATO.- Si durante la ejecucion de los trabajos "El Contratista" se percata de la necesidad de ejecutar cantidades adicionales o conceptos no previstos en el presupuesto original del contrato, este lo notificara por escrito a "El Instituto" a travez de la Residencia quien resolvera lo conducente "El Contratista" solo podra ejecutarlos una vez que cuente con la autorizacion del Jefe de Oficina de Conservacion dependiente del Departamento de Conservacion y Servicios Generales por escrito, salvo que se trate de situaciones de emergencia en las que no sea posible esperar su autorizacion.
        <br><br>
        DECIMA SEXTA.- RECEPCION DE LOS TRABAJOS. La entrega-recepción de los trabajos objeto del presente contrato, se sujetará al procedimiento previsto por el artículo 64 de la Ley de Obras Públicas y Servicios Relacionados con las Mismas, 164, 165 y 166 de su Reglamento de conformidad con el Programa de ejecución de los trabajos.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        DECIMA SEPTIMA.- NO CESION DE DERECHOS:- “El Contratista”, no podrá ceder a terceras personas físicas o morales los derechos y obligaciones derivados de este contrato y sus anexos, con excepción de los derechos de cobro, previa autorización por escrito de “El Instituto”.DECIMA OCTAVA.- TERMINACION ANTICIPADA. " El Instituto" podra dar por terminado anticipadamente el presente contrato sin responsabilidad para el y sin necesidad de que medie resolucion judicial alguna, cuando concurran razones de interes general;existan causas justificadas que le impidan la continuacion de los trabajos y se demuestre que de continuar con las obligaciones pactadas, se ocacionaria un daño o perjuicio grave a "El Instituto", se determine la nulidad de actos que dieron origen al contrato, con motivo de la resolucion de una inconformidad emitida por la Secretaria de la Funcion Publica o por resolucion de autoridad Judicial competente o bien no sea posible determinar la temporalidad de la suspencion de los trabajos, en este ultimo caso "El Instituto" se obliga a dar aviso por escrito a "El Contratista" con quince dias naturales de anticipacion. Comunicada por "El Instituto", la terminacion anticipada del contrato, este precedera a tomar inmediata posesion de los trabajos ejecutados para hacerce cargo del inmueble y de las instalaciones respectivas y en su caso preceder a suspender los trabajos debiendo realizarse las anotaciones correspondientes en la Bitacora y "El Instituto" levantara un acta circunstanciada en terminos de lo señalado en el articulo 151, del reglamento de la Ley de Obras Publicas y Servicos Relacionados con las Mismas, ante la presencia de fedatario publico.En este supuesto "El Instituto" se obliga a pagar los trabajos ejecutados, asi como los gastos no recuperables señalados en el articulo 152, del reglamento de la Ley de Obras Publicas y Servicios Relacionados con las Mismas, que a favor de "El Contratista" procedan, siempre que estos sean razonables, esten debidamente comprobados y se relacionen directamente con el contrato.
        <br><br>
        DECIMA NOVENA.- CAUSALES DE RESCISION ADMINISTRATIVA. "Las Partes" convienen que “El Instituto” de conformidad a lo establecido por el articulo 157 del reglamento de la Ley de Obras Publicas y Servicios Relacionados con las Mismas podrá llevar a cabo la resicion administrativa del presente contrato, sin necesidad de declaracion judicial de los tribunales competentes, si el contratista incurre en cuales quiera de las siguientes causales de resicion:1.-Interrumpir injustificadamente los trabajos o se niegue a reparar o reponer alguna parte de ellos que hubiere sido detectada como defectuosa por "El Instituto"2.-No ejecute los trabajos de conformidad con lo dispuesto en este contrato y en los anexos que lo integran o sin motivo justificado no acate las órdenes dadas por el Jefe de Conservacion de Unidad o en su caso por el Supervisor de Zona3.-En caso de que sea declarado o sujeto a concurso mercantil en terminos de la Ley de Concursos Mercantiles o figura análoga.4.-Sub contrate parte de los trabajos objeto del presente contrato, sin obtener la autorizacion previa por escrito de "El Instuto".5.-Transfiera los derechos de cobro derivados de este instrumento juridico sin contar con autorizacion previa y por escrito de "El Instituto".6.-No dé a "El Instituto" y a las dependencial de gobierno que tengan facultad de intervenir, las facilñidades y datos necesarios para la inspección, vigilancia y supervisión de los materiales y trabajos.7.-En general,     
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        por el incumplimiento de cualesquiera de las obligaciones derivadas de este contrato, las Leyes, Tratados y demas ordenamientos que sean aplicables.
        <br><br>
        VIGESIMA.- PROCEDIMIENTO DE RESICION ADMINISTRATIVA.- "Las Partes" convienen que en el caso de que "El Contratista" se encuentre en alguna de las causales indicadas en la clausula anterior, el procedimiento de rescisión administrativa se sujetara: 1.- El procedimiento iniciara a partir de que "El Instituto" le notifique a "El Contratista" por oficio el incumplimiento en que haya incurrido, señalando los hechos o circunstancias que motivaron su determinacion de dar por resindido el contrato, relacionandolo con las estipulaciones especificas que se consideren han sido incumplidas, para que en un termino de 15 (quince) dias habiles exponga lo que a su derecho convenga y aporte, en su caso las pruebas que estime pertinentes. 2.-. Transcurrido el termino a que se refiere el numeral anterior "El Instituto" resolvera considerando los argumentos y pruebas que hubiere hecho valer "El Contratista".3.- La determinacion de dar o no por rescindido el contrato por parte de "El Instituto" debera ser debidamente fundada, motivada y comunicada a "El Contratista" dentro de los 15 (quince) dias habiles siguientes a lo señalado en el numeral 1(uno) de esta clausula.La determinacion de dar por recindido administrativamente este contrato no podra ser revocada o modificada por "El Instituto" En el caso de que en el procedimiento de rescisión se determine no resindir este contrato, se reprogramaran los trabajos una vez notificada la resolución correspondiente a "El Contratista"
        <br><br>
        VIGESIMA PRIMERA.- DEL RESIDENTE. El residente de "El Instituto" tendra entre otras cosas funciones las siguientes:
        <br>1.- Fungir como representante de "El Instituto" ante "El Contratista"
        <br>2.- Supervisar, vigilar controlar y revisar la ejecucion de los trabajos.
        <br>3.- Tomar las decisiones tecnicas correspondientes y necesarias para la correcta ejecucion de los trabajos, debiendo resolver oportunamente las consultas, aclaraciones, dudas o solicitudes de autorizacion que presente el Superintendente de Construccion de "El Contratista" y en su caso, el supervisor, con relacion al cumplimiento de los derechos y obligaciones derivadas del presente contrato.
        <br>4. Dar cumplimiento a las actividades previstas a su cargo en la clausula novena que antecede, entre ellas, la apertura a la Bitacora, en terminos de lo estipulado, asi como por medio de ella, emitir las instrucciones pertinentes y recibir las solicitudes que le formule el Super Intendente de Construccion de "El Contratista" cuando la bitacora se lleve por medios convencionales, esta quedara bajo su resguardo.
        <br>5.- Vigilar y controlar el desarrollo de los trabajos, en sus aspectos de calidad, costo, tiempo y apego a los programas de ejecucion de los trabajos, de acuerdo con los avances, recursos asignados y rendimientos pactados en el presente contrato.
        <br>6.- Revisar, controlar y comprobar que los materiales, la mano de obra sean de la calidad y caracteristicas pactadas en el este contrato.
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: justify">
        <br>7.- Coordinar con los servidores publicos responsables responsables las terminaciones anticipadas o rescisiones de contratos y cuando se justifique, las suspensiones de los trabajos debiendose auxiliar de "El Instituto" para su formalizacion
        <br>8.- Informar formalmente al superintendente de "El Contratista" sobre las desviaciones o atrasos que detecte solicitandole su correccion y efectuar las anotaciones correspondientes en la Bitacora
        <br>9.- Verificar la debida terminación de los trabajos dentro del plazo convenido.
        <br><br>
        VIGESIMA SEGUNDA- RELACION LABORAL.- “El Contratista” como empresario y patrón del personal que ocupe con motivo de los trabajos materia de este contrato, será el único responsable de las obligaciones derivadas de las disposiciones legales y demás ordenamiento en materia de trabajo y de seguridad social; por lo que “El Contratista” conviene en responder a todas las reclamaciones que sus trabajadores presentaren en su contra o en contra de “El Instituto” en relación con los trabajos del contrato, así como a resarcir a éste cualquier cantidad que erogue por dichos conceptos.Por lo anterior, no se considera a "El Instituto" como patrón, ni aún substituto, y "El Contratista" expresamente lo exime de cualquier responsabilidad de carácter civil, fiscal, de seguridad social, laboral, o de otra especie, que en su caso podria llegar a generarse."El Contratista" se obliga a liberar a "El Instituto" de cualquier reclamacion índole laboral o de seguridad social que sea presentada por parte de sus trabajadores ante las autoridades competentes.
        <br><br>
        VIGESIMA TERCERA.- LEGISLACION APLICABLE .- "Las Partes" se obligan a sujetarse estrictamente para el cumplimiento del presente contrato a todas y cada una de las clausulas del mismo,asi como lo establecido en la Ley de Obras publicas y Servicios Relacionados con las Misma, su Reglamento y supletoriamente al Codigo Civil Federal, a la Ley de Procedimiento Administrativo, al Código Federal de Procedimientos Civiles y demas ordenamientos aplicables.
        <br><br>
        VIGESIMA CUARTA- RESOLUCION DE CONTROVERSIAS.- Para la interpretación y cumplimiento de este instrumento, asi como para todo aquello que no este expresamente estipulado en el mismo, las partes se someten a la jurisdiccion los tribunales Federales competentes ubicados en la Ciudad de México renunciando a cualquier otro fuero presente o futuro que por razon de domicilio les pudiera corresponder.Previa lectura y debidamente enteradas " Las Partes" del contenido, alcance y duerza legal del presente contrato, en virtud de quese ajusta a la expresion de su libre voluntad y que su consentimiento no se encuentra afectado por dolo, error, mala fe niotros vicios de la voluntad, lo firman y ratifican en todas sus partes, en 4 (cuatro) tantos, en la Ciudad de México el día 
        <?=$contrato[0]['contrato_fecha_creacion']?>
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 350px;margin-left: 20px;margin-right: 60px;line-height: 1.5;text-align: center">
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
            <p>"AREA REQUIRENTE"</p>
            <p style="margin-top: -6px;"><a style="color: black"><?=$value['res_nombre']?></a></p>
            <p style="font-size: 9px;margin-top: -10px"><?=$value['res_descrip']?></p>
        </div>
        <?php } }?>
        <div style="float: left;width: 50%;text-align: center;margin-left: 180px">
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