<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contratos
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
class Contratos extends Config{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $sql['Gestion']=  $this->contratos_mdl->_get_contratos();
        $this->load->view('contratos/contrato_gestion',$sql);
    }
    public function agregar() {
        $this->load->view('contratos/contrato_agregar');
    }
    public function adjudicacion() {
        if($this->input->post('contrato_fraccion')!=NULL){
            for ($i = 0; $i < count($this->input->post('contrato_fraccion')); $i++) {
                $fraccion.=$this->input->post('contrato_fraccion')[$i].',';
            }  
        }else{
            $fraccion.='';
        }

        $data=array(
            'contrato_numero_tmp'           =>  $this->input->post('contrato_numero_tmp'),
            'contrato_area_solicitante'     =>  $this->input->post('jtfAreaSolicitante'),
            'contrato_tipo'                 =>  $this->input->post('jtfTipoContrato'),
            'contrato_tipo_s'               =>  $this->input->post('contrato_tipo_s'),
            'contrato_num'                  =>  $this->input->post('jtfNumero'),
            'contrato_autorizacion_shcp'    =>  $this->input->post('contrato_autorizacion_shcp'),
            'contrato_autorizacion_shcp_emi'=>  $this->input->post('contrato_autorizacion_shcp_emi'),
            'contrato_fecha_creacion'       =>  $this->input->post('contrato_fecha_creacion'),
            'contrato_fecha_fallo'          =>  '',
            'contrato_fecha_inicio'         =>  $this->input->post('jtfFechaInicio'),
            'contrato_fecha_fin'            =>  $this->input->post('jtfFechaFin'),
            'contrata_fecha_duracion'       =>  $this->input->post('contrata_fecha_duracion'),
            'contrato_monto_total'          =>  $this->input->post('jtfMontoTotal'),
            'contrato_monto_total_letra'    =>  $this->input->post('contrato_monto_total_letra'),
            'contrato_tipo_salario'         =>  $this->input->post('contrato_tipo_salario'),
            'contrato_clave_presupuestal'   =>  $this->input->post('jtfClavePresupuestal2'),
            'contrato_clave_presupuestal_descrip'=>  $this->input->post('contrato_clave_presupuestal_descrip'),
            'contrato_proveedor1'           =>  $_FILES['jtfProveedor1']['name'],
            'contrato_proveedor2'           =>  $_FILES['jtfProveedor2']['name'],
            'contrato_proveedor3'           =>  $_FILES['jtfProveedor3']['name'],
            'contrato_descripcion'          =>  $this->input->post('jtfDescripcion'),
            'contrato_status'               =>  'Asignar Dictamen Previo',
            'contrato_articulo'             =>  $this->input->post('contrato_articulo'),
            'contrato_fraccion'             =>  $fraccion,
            'proveedor_id'                  =>  $this->input->post('jtfProveedor'),
            'hospital_id'                   =>  $this->input->post('jtfHospital'),
            'subesp_id'                     =>  $this->input->post('jtfSubEspecialidad'),            
        );
        $sql=  $this->contratos_mdl->_insert('cs_contrato',$data);
        if($sql){
            if($_FILES['jtfProveedor1']['name']!=''){
                copy($_FILES['jtfProveedor1']['tmp_name'], 'assets/proveedor/'.$_FILES['jtfProveedor1']['name']);
            }if($_FILES['jtfProveedor2']['name']!=''){
                copy($_FILES['jtfProveedor2']['tmp_name'], 'assets/proveedor/'.$_FILES['jtfProveedor2']['name']);
            }if($_FILES['jtfProveedor3']['name']!=''){
                copy($_FILES['jtfProveedor3']['tmp_name'], 'assets/proveedor/'.$_FILES['jtfProveedor3']['name']);
            }
 
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        }   
    }
    public function licitacion() {
        if($this->input->post('contrato_fraccion')!=NULL){
            for ($i = 0; $i < count($this->input->post('contrato_fraccion')); $i++) {
                $fraccion.=$this->input->post('contrato_fraccion')[$i].',';
            }  
        }else{
            $fraccion.='';
        }

        $data=array(
            'contrato_numero_tmp'           =>  $this->input->post('contrato_numero_tmp'),
            'contrato_area_solicitante'     =>  $this->input->post('jtfAreaSolicitante'),
            'contrato_tipo'                 =>  $this->input->post('jtfTipoContrato'),
            'contrato_tipo_s'               => $this->input->post('contrato_tipo_s'),
            'contrato_num'                  =>  $this->input->post('jtfNumero'),
            'contrato_autorizacion_shcp'    =>  $this->input->post('contrato_autorizacion_shcp'),
            'contrato_autorizacion_shcp_emi'=>  $this->input->post('contrato_autorizacion_shcp_emi'),
            'contrato_fecha_creacion'       =>  $this->input->post('contrato_fecha_creacion'),
            'contrato_fecha_fallo'          =>  $this->input->post('jtfFechaFallo'),
            'contrato_fecha_inicio'         =>  $this->input->post('jtfFechaInicio'),
            'contrato_fecha_fin'            =>  $this->input->post('jtfFechaFin'),
            'contrata_fecha_duracion'       =>  $this->input->post('contrata_fecha_duracion'),
            'contrato_monto_total'          =>  $this->input->post('jtfMontoTotal'),
            'contrato_monto_total_letra'    => $this->input->post('contrato_monto_total_letra'),
            'contrato_tipo_salario'         =>  $this->input->post('contrato_tipo_salario'),
            'contrato_unidad_udi'           =>  $this->input->post('jtfUnidad'),
            'contrato_clave_presupuestal'   =>  $this->input->post('jtfClavePresupuestal2'),
            'contrato_clave_presupuestal_descrip'=>  $this->input->post('contrato_clave_presupuestal_descrip'),
            'contrato_descripcion'          =>  $this->input->post('jtfDescripcion'),
            'contrato_status'               =>  'Asignar Dictamen Previo',
            'contrato_articulo'             =>  $this->input->post('contrato_articulo'),
            'contrato_fraccion'             =>  $fraccion,
            'contrato_descripcion_tecnica'  =>  $_FILES['jtfFile1']['name'],
            'contrato_propuesta_economica'  =>  $_FILES['jtfFile2']['name'],
            'contrato_unidad_prestacion'    =>  $_FILES['jtfFile3']['name'],
            'contrato_calendario_servicio'  =>  $_FILES['jtfFile4']['name'],
            'proveedor_id'                  =>  $this->input->post('jtfProveedor'),
            'hospital_id'                   =>  $this->input->post('jtfHospital'),
            'subesp_id'                     =>  $this->input->post('jtfSubEspecialidad'),            
        );
        $sql=  $this->contratos_mdl->_insert('cs_contrato',$data);
        if($sql){
            if($_FILES['jtfFile1']['name']!=''){
                copy($_FILES['jtfFile1']['tmp_name'], 'assets/contratos/'.$_FILES['jtfFile1']['name']);
            }if($_FILES['jtfFile2']['name']!=''){
                copy($_FILES['jtfFile2']['tmp_name'], 'assets/contratos/'.$_FILES['jtfFile2']['name']);
            }if($_FILES['jtfFile3']['name']!=''){
                copy($_FILES['jtfFile3']['tmp_name'], 'assets/contratos/'.$_FILES['jtfFile3']['name']);
            }if($_FILES['jtfFile4']['name']!=''){
                copy($_FILES['jtfFile4']['tmp_name'], 'assets/contratos/'.$_FILES['jtfFile4']['name']);
            }
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        }   
    }
    public function get_hospitales() {
        foreach ($this->contratos_mdl->_get_hospitales() as $value) { 
            $option.='<option value="'.$value['hospital_id'].'">'.$value['hospital_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function get_proveedores() {
        foreach ($this->contratos_mdl->_get_proveedores() as $value) { 
            $option.='<option value="'.$value['prov_id'].'">'.$value['prov_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option)); 
    }
    public function get_especialidades() {
        foreach ($this->contratos_mdl->_get_especialidad() as $value) { 
            $option.='<option value="'.$value['especialidad_id'].','.$value['especialidad_nombre'].'">'.$value['especialidad_id'].'</option>';
        }
        $this->setOutput(array('option'=>$option)); 
    }
    public function get_sub_especialidades() {
        foreach ($this->contratos_mdl->_get_sub_especialidad($this->input->post('id')) as $value) { 
            $option.='<option value="'.$value['subesp_id'].','.$value['subesp_nombre'].'">'.$value['subesp_num'].'</option>';
        }
        $this->setOutput(array('option'=>$option)); 
    }
    /*----------------------------------------------------------------------------------------------*/
    public function asignardictamenprevio() {
        $sql['Gestion']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $this->load->view('contratos/contrato_asignardictamenprevio',$sql);
    }
    public function asignarprei() {
        $sql['Gestion']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $this->load->view('contratos/contrato_asignarprei',$sql);
    }
    public function agregarnumprei() {
        $data=array(
            'prei_num'                   =>  $this->input->post('jtfNum'),
            'contrato_id'                    =>  $this->input->post('jtfContratoId'),    
        );
        $sql=  $this->contratos_mdl->_insert('cs_prei',$data);
        if($sql){
            $this->contratos_mdl->_update_status('Caratulas',$this->input->post('jtfContratoId'));
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        }
    }
    public function agregardictamen() {
        $data=array(
            'dictamen_num'                   =>  $this->input->post('jtfNum'),
            'dictamen_fecha'                 =>  $this->input->post('jtfFecha'),
            'dictamen_importe'               =>  $this->input->post('jtfImporte'),
            'dictamen_partida_presupuestal'  =>  $this->input->post('jtfPartida'),
            'dictamen_doc'                   =>  $_FILES['jtfDictamen']['name'],
            'contrato_id'                    =>  $this->input->post('jtfContratoId'),    
        );
        $sql=  $this->contratos_mdl->_insert('cs_dictamenprevio',$data);
        if($sql){
            $this->contratos_mdl->_update_status('Asignar N° PREI',$this->input->post('jtfContratoId'));
            copy($_FILES['jtfDictamen']['tmp_name'], 'assets/dictamenprevio/'.$_FILES['jtfDictamen']['name']);
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        }    
    }
    /*--------------------------------------------------------------------------*/
    public function fianza() {
        $sql['Gestion']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        if($sql['Gestion'][0]['contrato_tipo_salario']=='Salario Menor a 300'){
            $this->contratos_mdl->_contrato_c_f($this->input->get('c'));
            echo '<script>
                    alert("Acción no permitida, Salario Menor a 300");
                    location.href="'.  base_url().'conservacion/contratos";
                </script>';
        }else{
            $this->load->view('contratos/contrato_fianza',$sql);
        }
        
    }
    public function fianza_save() {
        $data=array(
            'caratula_tipo_fianza'      =>  $this->input->post('jtfTipoGarantia'),
            'caratula_tipo'             =>  $_FILES['jtfTipo']['name'],
            'caratula_tipo_garantia'    =>  $this->input->post('jtfTipoGarantia'),
            'caratula_afianzadora'      =>  $this->input->post('caratula_afianzadora'),
            'caratula_num'              =>  $this->input->post('caratula_num'),
            'caratula_importe'          =>  $this->input->post('caratula_importe'),
            'caratula_vigencia_inicio'  =>  $this->input->post('caratula_vigencia_inicio'),
            'caratula_vigencia_fin'     =>  $this->input->post('caratula_vigencia_fin'),
            'contrato_id'               =>  $this->input->post('jtfContratoId') 
        );
        $sql=  $this->contratos_mdl->_insert('cs_caratulas',$data);
        if($sql){
            copy($_FILES['jtfTipo']['tmp_name'], 'assets/fianza/'.$_FILES['jtfTipo']['name']);
            $this->contratos_mdl->_contrato_c_f($this->input->post('jtfContratoId'));
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        } 
    }
    public function noadeudoimss() {
        $this->load->view('contratos/contrato_noadeudoimss');
    }
    public function noadeudoimss_save() {
        $data=array(
            'caratula_tipo'    =>  $_FILES['jtfTipo']['name'],
            'contrato_id'      =>  $this->input->post('jtfContratoId')
        );
        $sql=  $this->contratos_mdl->_insert('cs_caratulas',$data);
        if($sql){
            copy($_FILES['jtfTipo']['tmp_name'], 'assets/noadeudoimss/'.$_FILES['jtfTipo']['name']);
            $this->contratos_mdl->_contrato_c_i($this->input->post('jtfContratoId'));
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
            //redirect('contratos');
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        } 
    }
    public function noadeudosat() {
        $this->load->view('contratos/contrato_noadeudosat');
    }
    public function noadeudosat_save() {
        $data=array(
            'caratula_tipo'    =>  $_FILES['jtfTipo']['name'],
            'contrato_id'      =>  $this->input->post('jtfContratoId')
        );
        $sql=  $this->contratos_mdl->_insert('cs_caratulas',$data);
        if($sql){
            copy($_FILES['jtfTipo']['tmp_name'], 'assets/noadeudosat/'.$_FILES['jtfTipo']['name']);
            $this->contratos_mdl->_update_status('Asignar Dictamen',$this->input->post('jtfContratoId'));
            $this->contratos_mdl->_contrato_c_s($this->input->post('jtfContratoId'));
            echo '<script>alert("Registro guardado Correctatmente");location.href="'.  base_url().'conservacion/contratos";</script>';
        }else{
            echo '<script>alert("ERROR");location.href="'.  base_url().'conservacion/contratos";</script>';
        } 
    }
    public function dictamen() {
        $sql['Gestion']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $this->load->view('contratos/contrato_dictamen',$sql);
    }
    public function asignardictamen() {
        $sql['Gestion']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $this->load->view('contratos/contrato_asignardictamen',$sql);
    }
    public function asignardictamen_save() {
        $data=array(
            'dictamen_productividad'    =>  $_FILES['jtfProductividad']['name'],
            'dictamen_num_evento'       =>  $this->input->post('jtfNum'),
            'contrato_id'               =>  $this->input->post('jtfContratoId'),    
        );
        $sql=  $this->contratos_mdl->_insert('cs_dictamen',$data);
        if($sql){
            $this->contratos_mdl->_contrato_s_d($this->input->post('jtfContratoId'));
            copy($_FILES['jtfProductividad']['tmp_name'], 'assets/dictamen/'.$_FILES['jtfProductividad']['name']);
            //echo '<script>alert("Registro guardado Correctatmente")</script>';
            redirect('conservacion/contratos/dictamen?c='.$this->input->post('jtfContratoId'));
        }else{
            //echo '<script>alert("Error al guardar el registro")</script>';
            redirect('conservacion/contratos/dictamen?c='.$this->input->post('jtfContratoId'));
        } 
    }
    public function generarcaratula() {
        $sql['caratula']=  $this->contratos_mdl->get_caratulas($this->input->get('c'));
        $sql['contrato']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $sql['prei']=  $this->contratos_mdl->_get_prei($this->input->get('c'));
        $sql['firmas']=  $this->contratos_mdl->_get_res($sql['contrato'][0]['hospital_id']);
        $this->load->view('contratos/contrato_caratula',$sql);
    }
    public function cuerpo() {
        $sql['contrato']=  $this->contratos_mdl->_get_contrato($this->input->get('c'));
        $sql['prei']=  $this->contratos_mdl->_get_prei($this->input->get('c'));
        $sql['firmas']=  $this->contratos_mdl->_get_res($sql['contrato'][0]['hospital_id']);
        $tipo_servicio=$sql['contrato'][0]['contrato_tipo_s'];
        $tipo_persona=$sql['contrato'][0]['prov_tipo'];
        $tipo_salario=$sql['contrato'][0]['contrato_tipo_salario'];
        if($tipo_servicio=='Adquisición' && $tipo_persona=='Personal fisica' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/ADQUISICIONFISICAMENOR',$sql);
        }if($tipo_servicio=='Adquisición' && $tipo_persona=='Personal fisica' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/ADQUISICIONFISICAMAYOR',$sql);
        }if($tipo_servicio=='Adquisición' && $tipo_persona=='Personal moral' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/ADQUISICIONMORALMENOR',$sql);
        }if($tipo_servicio=='Adquisición' && $tipo_persona=='Personal moral' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/ADQUISICIONMORALMAYOR',$sql);
        }if($tipo_servicio=='Obra' && $tipo_persona=='Personal moral' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/OBRAMORALMENOR',$sql);
        }if($tipo_servicio=='Obra' && $tipo_persona=='Personal moral' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/OBRAMORALMAYOR',$sql);
        }if($tipo_servicio=='Obra' && $tipo_persona=='Personal fisica' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/OBRAFISICAMENOR',$sql);
        }if($tipo_servicio=='Obra' && $tipo_persona=='Personal fisica' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/OBRAFISICAMAYOR',$sql);
        }if($tipo_servicio=='Servicio' && $tipo_persona=='Personal moral' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/SERVICIOMORALMENOR',$sql);
        }if($tipo_servicio=='Servicio' && $tipo_persona=='Personal moral' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/SERVICIOMORALMAYOR',$sql);
        }if($tipo_servicio=='Servicio' && $tipo_persona=='Personal fisica' && $tipo_salario=='Salario Menor a 300'){
            $this->load->view('contratos/SERVICIOFISICAMENOR',$sql);
        }if($tipo_servicio=='Servicio' && $tipo_persona=='Personal fisica' && $tipo_salario!='Salario Menor a 300'){
            $this->load->view('contratos/SERVICIOFISICAMAYOR',$sql);
        }
    }
    public function delete_contrato() {
        if($this->contratos_mdl->_delete_contrato($this->input->post('id'))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
