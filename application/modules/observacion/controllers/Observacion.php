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
        $UMAE_USER=$_SESSION['UMAE_USER'];
        $sql['info']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_nombre'=>$_SESSION['UMAE_AREA']
        ))[0];
        $sql['GestionV2']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_observacion , os_areas, os_observacion_llamada
            WHERE   os_triage.triage_id=os_observacion.triage_id AND 
                    os_observacion.observacion_alta='' AND os_observacion.observacion_crea='$UMAE_USER' AND
                    os_areas.area_id=os_observacion.observacion_area AND os_observacion.triage_id=os_observacion_llamada.triage_id");
        $this->load->view('index',$sql);
    }
    public function obtener_paciente() {
        $sql=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=>  $this->input->post('id')
        ));
        if(!empty($sql)){
            if($sql[0]['observacion_fl']==''){
                $this->setOutput(array('accion'=>'1','folio'=>$sql[0]['triage_id']));
            }else{
                $this->setOutput(array('accion'=>'3','folio'=>$sql[0]['triage_id']));
            }
            
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
        $info=  $this->config_mdl->_get_data_condition('os_camas',array(
            'cama_id'=>  $this->input->post('observacion_cama')
        ))[0];
        $this->config_mdl->_update_data('os_observacion',array(
            'observacion_cama'=>  $this->input->post('observacion_cama'),
            'observacion_cama_nombre'=>  $info['cama_nombre'],
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
        if($this->input->post('observacion_alta')=='Alta e ingreso quirófano'){
            $this->config_mdl->_insert('os_quiforano',array(
                'quiforano_fi'=>  date('d/m/Y'),
                'quiforano_hi'=>  date('H:i'),
                'triage_id'=>$this->input->post('triage_id')
            ));
        }if($this->input->post('observacion_alta')=='Alta e ingreso a hospitalización'){
            $this->config_mdl->_insert('os_hospitalizacion',array(
                'hospitalizacion_fi'=>  date('d/m/Y'),
                'hospitalizacion_hi'=>  date('H:i'),
                'triage_id'=>$this->input->post('triage_id')
            ));
        }
        
        
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
    public function llamar_paciente() {
        $this->config_mdl->_insert('os_observacion_llamada',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_observacion',array(
            'observacion_fl'=> date('d/m/Y'),
            'observacion_hl'=>  date('H:i'),
            'observacion_crea'=>$_SESSION['UMAE_USER']
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function reportes() {
        $UMAE_SESSION=$_SESSION['UMAE_USER'];
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_observacion , os_areas, os_observacion_llamada WHERE
                    os_triage.triage_id=os_observacion.triage_id AND
                    os_observacion.observacion_alta!='' AND
                    os_observacion.observacion_crea='$UMAE_SESSION' AND os_areas.area_id=os_observacion.observacion_area AND os_observacion.triage_id=os_observacion_llamada.triage_id AND  os_observacion.observacion_fs BETWEEN '$fi' AND '$ff' ORDER BY os_observacion_llamada.observacion_llamada_id DESC");
            
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');  $hi=  $this->input->get('hi'); $hf=  $this->input->get('hf');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_observacion , os_areas, os_observacion_llamada WHERE
                    os_triage.triage_id=os_observacion.triage_id AND
                    os_observacion.observacion_alta!='' AND
                    os_observacion.observacion_crea='$UMAE_SESSION' AND os_areas.area_id=os_observacion.observacion_area AND os_observacion.triage_id=os_observacion_llamada.triage_id AND os_observacion.observacion_fs='$fi' AND os_observacion.observacion_hs BETWEEN '$hi' AND '$hf' ORDER BY os_observacion_llamada.observacion_llamada_id DESC");
               
        }
        $this->load->view('reportes',$sql);
    }
}
