/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (){
    $('body #example_length ,.DTTT ').addClass('hidden');  
    $('.tipo_contrato').select2();
    $('input[name=jtfAreaSolicitante]').val($('#jtfAreaSolicitanteSELECT').val());
    $('#jtfAreaSolicitanteSELECT').change(function (){
        $('input[name=jtfAreaSolicitante]').val($(this).val());
        if($(this).val()=='Servicios Generales'){
            $('#selectClave1,#selectClave2').html(
                '<option>Seleccionar</option>'+
                '<option value="4206 1101">4206 1101</option>'+
                '<option value="4206 1102">4206 1102</option>'+
                '<option value="4206 1103">4206 1103</option>'+
                '<option value="4206 1302">4206 1302</option>'+ 
                '<option value="4206 1401">4206 1401</option>'+
                '<option value="4206 1402">4206 1402</option>'+
                '<option value="4206 1403">4206 1403</option>'+
                '<option value="4206 1404">4206 1404</option>'+
                '<option value="4206 1501">4206 1501</option>'+
                '<option value="4206 1502">4206 1502</option>'+
                '<option value="4206 1503">4206 1503</option>'+
                '<option value="4206 1504">4206 1504</option>'+
                '<option value="4206 1508">4206 1508</option>'+
                '<option value="4206 1509">4206 1509</option>'+
                '<option value="4206 1601">4206 1601</option>'+
                '<option value="4206 1602">4206 1602</option>'+
                '<option value="4206 1603">4206 1603</option>'+
                '<option value="4206 1801">4206 1801</option>'+
                '<option value="4206 1803">4206 1803</option>'+
                '<option value="4206 2107">4206 2107</option>'+
                '<option value="4206 2110">4206 2110</option>'+
                '<option value="4206 2401">4206 2401</option>'+
                '<option value="4206 2403">4206 2403</option>'+
                '<option value="4206 2404">4206 2404</option>'+
                '<option value="4206 2405">4206 2405</option>'+
                '<option value="4206 2414">4206 2414</option>'+
                '<option value="4206 2415">4206 2415</option>'+
                '<option value="4206 2421">4206 2421</option>'+
                '<option value="4206 2422">4206 2422</option>'+
                '<option value="4206 2423">4206 2423</option>'+
                '<option value="4206 2501">4206 2501</option>'+
                '<option value="4206 0104">4206 0104</option>'
                                                                                
            );       
        }else{
            $('#selectClave1,#selectClave2').html(
                '<option>Seleccionar</option>'+
                '<option value="4206 2502">4206 2502</option>'+
                '<option value="4206 2503">4206 2503</option>'+
                '<option value="4206 2506">4206 2506</option>'+
                '<option value="4206 2517">4206 2517</option>'                                                        
            );
        }
    })
    $('#jtfTipoContrato').change(function (){
        $('input[name=jtfTipoContrato]').val($(this).val())
        if($(this).val()=='ITP & Licitación'){
            $('.tipo_1').hide();
            $('.tipo_2').show();
        }else if($(this).val()=='Adjudicación directa'){
            $('.tipo_1').show();
            $('.tipo_2').hide(); 
        }else{
            $('.tipo_1').hide(); 
            $('.tipo_2').hide(); 
        }
    })
    //Date Pickers
    $('.fecha').datepicker({
        format:'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    $.ajax({
        url: base_url+"conservacion/contratos/get_hospitales",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#hospital_select1,#hospital_select2').html(data['option']);
        },error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error al obtener registros');
        }
    })
    $.ajax({
        url: base_url+"conservacion/contratos/get_especialidades",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#select_especialidad1,#select_especialidad2').html('');
            $('#select_especialidad1,#select_especialidad2').append('<option>Seleccionar</option>');
            $('#select_especialidad1,#select_especialidad2').append(data['option']);
        },error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error al obtener registros');
        }
    })
    $.ajax({
        url: base_url+"conservacion/contratos/get_proveedores",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#proveedor_select1,#proveedor_select2,#proveedor_select5').html(data['option']);
        },error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error al obtener registros');
        }
    }) 
    $('#select_especialidad1,#select_especialidad2').change(function (){
        var valor_=$(this).val().split(',')
        $('input[name=_especialidad]').val(valor_[1])
        $.ajax({
            url: base_url+"conservacion/contratos/get_sub_especialidades",
            dataType: 'json',
            type: 'POST',
            data:{
                'id':valor_[0],
                'csrf_token':   $.cookie('csrf_cookie'),
            },
            success: function (data, textStatus, jqXHR) {
                $('#select_sub1,#select_sub2').html('');
                $('#select_sub1,#select_sub2').append('<option>Seleccionar</option>');
                $('#select_sub1,#select_sub2').append(data['option']);
            },error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error al obtener registros');
            }
        })  
    })
    $('#select_sub1,#select_sub2').change(function (){
        var _valor=$(this).val().split(',');
        $('input[name=_subespecialidad]').val(_valor[1])
        $('input[name=jtfSubEspecialidad]').val(_valor[0])
    })

    $('#selectClave1,#selectClave2').change(function (){
        $('input[name=jtfClavePresupuestal2]').val($(this).val())
        if($(this).val()=='4206 2502'){
            $('input[name=contrato_tipo_s]').val('Servicio')
        }else if($(this).val()=='4206 2506'){
            $('input[name=contrato_tipo_s]').val('Obra')
        }else if($(this).val()=='4206 2517'){
            $('input[name=contrato_tipo_s]').val('Adquisición')
        }else{
            $('input[name=contrato_tipo_s]').val('')
        }
        if($(this).val()=='4206 2502' || $(this).val()=='4206 2517' && $('input[name=jtfTipoContrato]').val()=='Adjudicación directa'){
            $('#select_articulo1,#select_articulo2').html(
                    '<option>Seleccionar</option>'+
                    '<option value="41">41</option>'+
                    '<option value="42">42</option>'
            ).removeAttr('disabled') ;
        }else if($(this).val()=='4206 2502' || $(this).val()=='4206 2517' && $('input[name=jtfTipoContrato]').val()=='ITP & Licitación'){
            $('#select_articulo1,#select_articulo2').html(
                    '<option>Seleccionar</option>'+
                    '<option value="41">41</option>'+
                    '<option value="42">42</option>'
            ).removeAttr('disabled') ;
        }else if($(this).val()=='4206 2506' && $('input[name=jtfTipoContrato]').val()=='Adjudicación directa'){
            $('#select_articulo1,#select_articulo2').html(
                    '<option>Seleccionar</option>'+
                    '<option value="42">42</option>'+
                    '<option value="43">43</option>'
            ).removeAttr('disabled') ;
        }else if($(this).val()=='4206 2506' && $('input[name=jtfTipoContrato]').val()=='ITP & Licitación'){
            $('#select_articulo1,#select_articulo2').html(
                    '<option>Seleccionar</option>'+
                    '<option value="42">42</option>'+
                    '<option value="43">43</option>'
            ).removeAttr('disabled') ;
        }else{
            $('#select_articulo1,#select_fraccion1','#select_articulo2,#select_fraccion2').attr('disabled',true);
        }
        if($(this).val()=='4206 2502'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Conservación bienes/inmueble y equipamiento');
        }if($(this).val()=='4206 2503'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Contratos consolidados conservación');
        }if($(this).val()=='4206 2506'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicios de conservación de bienes inmuebles');
        }if($(this).val()=='4206 2517'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Refacciones');
        }if($(this).val()=='4206 1101'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Combustibles y lubricantes para vehiculos');
        }if($(this).val()=='4206 1102'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Combustibles y lubricantes para maquinaria');
        }if($(this).val()=='4206 1103'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Trasp. Comb y lub c. vac y u.c');
        }if($(this).val()=='4206 1302'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('De inmueble y cajones de estacionamiento');
        }if($(this).val()=='4206 1401'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Alumbrado fuerza y calefacción');
        }if($(this).val()=='4206 1402'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Agua');
        }if($(this).val()=='4206 1403'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Derechos municipales');
        }if($(this).val()=='4206 1404'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('RPBI');
        }if($(this).val()=='4206 1501'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicio postal');
        }if($(this).val()=='4206 1502'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicio de telefonia celular y radiocomunicación');
        }if($(this).val()=='4206 1503'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicio telefonico local');
        }if($(this).val()=='4206 1504'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicio de telefonía de larga distancia');
        }if($(this).val()=='4206 1508'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicio postal y mensajeria pago ff');
        }if($(this).val()=='4206 1509'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicios de comunicación por ff');
        }if($(this).val()=='4206 1601'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Gastos por translado de pacientes');
        }if($(this).val()=='4206 1602'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Mensajería');
        }if($(this).val()=='4206 1603'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Viáticos');
        }if($(this).val()=='4206 1801'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Contra daños de bienes patrimoniales');
        }if($(this).val()=='4206 1803'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Gastos de autoseguro por siniestros');
        }if($(this).val()=='4206 2107'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('De intendencia y lavado de ropa');
        }if($(this).val()=='4206 2110'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicios de intendencia y lavado de ropa ff');
        }if($(this).val()=='4206 2401'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Maniobras y acarreos');
        }if($(this).val()=='4206 2403'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Gastos menores');
        }if($(this).val()=='4206 2404'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Aval. Y loc. Terr. Escrit. Y exh');
        }if($(this).val()=='4206 2405'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Hon. Aval. Loc. Terr. Escrit. Y exh');
        }if($(this).val()=='4206 2414'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicios de policia auxiliar');
        }if($(this).val()=='4206 2415'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Fletes');
        }if($(this).val()=='4206 2421'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Servicios de fotocopiado');
        }if($(this).val()=='4206 2422'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Oxigeno domiciliario');
        }if($(this).val()=='4206 2423'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Oxigeno hospitalario');
        }if($(this).val()=='4206 2501'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Materiales y refacciones de conservación');
        }if($(this).val()=='4206 0104'){
            $('input[name=contrato_clave_presupuestal_descrip]').val('Comisiones por servicios bancarios');
        }
    })
    $('#select_articulo1,#select_articulo2').change(function (){
        if($(this).val()=='41'){
            $('#select_fraccion1,#select_fraccion2').html(
                    '<option value="I">I</option>'+
                    '<option value="II">II</option>'+
                    '<option value="V">V</option>'+
                    '<option value="VI">VI</option>'+
                    '<option value="VIII">VIII</option>'
            ).removeAttr('disabled')   
        }else if($(this).val()=='42' && $('#selectClave2').val()=='4206 2502' || $('#selectClave2').val()=='4206 2517'){
            $('#select_fraccion1,#select_fraccion2').html('').attr('disabled',true);
        }else if($(this).val()=='42' && $('#selectClave2').val()=='4206 2506'){
            $('#select_fraccion1,#select_fraccion2').html(
                    '<option value="II">II</option>'+
                    '<option value="IV">IV</option>'+
                    '<option value="V">V</option>'+
                    '<option value="VI">VI</option>'+
                    '<option value="VIII">VII</option>'+
                    '<option value="VIII">XIV</option>'
            ).removeAttr('disabled') 
        }else if($(this).val()=='43' && $('#selectClave2').val()=='4206 2506'){
            $('#select_fraccion1,#select_fraccion2').html('').attr('disabled',true);
        }
    })
    $('input[name=jtfMontoTotal]').keyup(function (){
        var salario_300=300 * 70.04;
        var salario_600=600 * 70.04;
        if($(this).val()<salario_300){
            $('input[name=contrato_tipo_salario]').val('Salario Menor a 300');
        }else if($(this).val()>salario_300 && $(this).val()<salario_600 ){
            $('input[name=contrato_tipo_salario]').val('Salario Mayor a 300');
        }else if($(this).val()>salario_600){
            $('input[name=contrato_tipo_salario]').val('Salario Mayor a 600');
        }else if($(this).val()==''){
            $('input[name=contrato_tipo_salario]').val('');
        }
        
    })
    $('input[name=contrato_fecha_creacion]').val(fechaActual())
    function fechaActual(){
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
        var f=new Date(); 
        return diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
    }   
    $('.btn-danger').click(function (){
        var el=$(this).attr('data-id');
        if(confirm("¿DESEA ELIMINAR ESTE REGISTRO Y TODOS LOS DATOS ASOCIADOS A ESTE?")){
            $.ajax({
                url: base_url+"conservacion/contratos/delete_contrato",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':el,
                    'csrf_token':   $.cookie('csrf_cookie'),
                },beforeSend: function (xhr) {
                    msj_success_noti('Eliminando Contrato...');
                },success: function (data, textStatus, jqXHR) {
                    if(data['accion']==1){
                        msj_success_noti('Contrato eliminado');
                        $('#'+el).remove()       
                    }else{
                        msj_error_noti('Error al eliminar el contrato')
                    }

                },error: function (e) {
                    msj_error_noti('Error al eliminar el contrato:'+e);
                }
            })
        }
    })
    $('.btn-success').click(function (){
        msj_error_noti('No disponible');
    })
})

