<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Observacion
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Observacion extends Config{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql_info=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ))[0];
        $sql['info']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_nombre'=>$_SESSION['UMAE_AREA']
        ))[0];
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_observacion , os_areas
            WHERE os_triage.triage_id=os_observacion.triage_id AND os_areas.area_id=os_observacion.observacion_area AND
            os_areas.area_nombre='".$sql_info['empleado_nombre']."'");
        
        $this->load->view('index',$sql);
    }
    public function obtener_paciente() {
        $sql=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=>  $this->input->post('id')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1','folio'=>$sql[0]['triage_id']));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function asignar_cama() {
        $sql['info']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_observacion , os_areas
            WHERE os_triage.triage_id=os_observacion.triage_id AND os_areas.area_id=os_observacion.observacion_area AND
            os_triage.triage_id=".$this->input->get('t'))[0];
        if($sql['info']['observacion_cama']!=''){
            $sql['Cama']=  $this->config_mdl->_get_data_condition('os_camas',array(
                'cama_id'=>$sql['info']['observacion_cama']
            ))[0];
        }else{
            $sql['Cama']='';
        }
        $this->load->view('asignar_cama',$sql);
    }
    public function buscar_camas() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.cama_status='Disponible' AND os_camas.area_id=os_areas.area_id AND os_areas.area_id=".$this->input->post('area_id'));
        if(!empty($sql)){
            foreach ($sql as $value) {
                $option.='<option value="'.$value['cama_id'].'">'.$value['cama_nombre'].'</option>';
            }
            $this->setOutput(array('option'=>$option));
        }else{
            $this->setOutput(array('option'=>'NO_RESULT'));
        }
        
    }
    public function asignar_cama_paciente() {
        $this->config_mdl->_update_data('os_observacion',array(
            'observacion_cama'=>  $this->input->post('observacion_cama'),
            'observacion_fac'=> date('d/m/Y'),
            'observacion_hac'=>  date('H:i') 
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Ocupado',
            'cama_dh'=>$this->input->post('triage_id')
        ),array(
            'cama_id'=>  $this->input->post('observacion_cama')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function alta_paciente() {
        $this->config_mdl->_update_data('os_observacion',array(
            'observacion_cama'=>  $this->input->post('observacion_cama'),
            'observacion_fs'=> date('d/m/Y'),
            'observacion_hs'=>  date('H:i') ,
            'observacion_alta'=>  $this->input->post('observacion_alta')
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_dh'=>'0',
        ),array(
            'cama_id'=>  $this->input->post('observacion_cama')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function visor_camas() {
        $sql_info=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ))[0];
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.area_id=os_areas.area_id AND os_areas.area_nombre='".$_SESSION['UMAE_AREA']."'");
        $this->load->view('visor_camas',$sql);  
    }
    public function cama_paciente() {
        $sql['info']=  $this->config_mdl->_query("SELECT * FROM os_camas, os_observacion
        WHERE os_observacion.observacion_cama=os_camas.cama_id AND
        os_camas.cama_dh=os_observacion.triage_id AND os_camas.cama_id=".$_GET['cama']);
        $sql['paciente']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$sql['info'][0]['triage_id']
        ));
        $sql_info=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$_SESSION['idUser']
        ))[0];
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_id'=>$sql_info['empleado_area']
        ))[0];
        $this->load->view('cama_paciente',$sql);
    }
}
