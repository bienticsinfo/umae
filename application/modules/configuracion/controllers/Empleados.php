<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empleados
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
class Empleados extends Config{
    public function __construct() {
        parent::__construct();
        $this->load->model('empleados_mdl');
    }
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_empleados');
        $this->load->view('empleados/index',$sql);
    }
    public function agregar() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>  $this->input->get_post('u')));
        $this->load->view('empleados/agregar',$sql);
    }
    public function insert_empleado() {
        $data=array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula'),
            'empleado_nombre'=>  $this->input->post('empleado_nombre'),
            'empleado_apellidos'=>  $this->input->post('empleado_apellidos'),
            'empleado_fecha_nac'=>  $this->input->post('empleado_fecha_nac'),
            'empleado_estado'=>  $this->input->post('empleado_estado'),
            'empleado_sexo'=>  $this->input->post('empleado_sexo'),
            'empleado_direccion'=>  $this->input->post('empleado_direccion'),
            'empleado_tel'=>  $this->input->post('empleado_tel'),
            'empleado_telcel'=>  $this->input->post('empleado_telcel'),
            'empleado_email'=>  $this->input->post('empleado_email'),
            'empleado_categoria'=>  $this->input->post('empleado_categoria'),
            'empleado_fecha_registro'=>  $this->input->post('empleado_fecha_registro')
        );
        if($this->input->post('jtf_accion')=='add'){
            if($this->config_mdl->_insert('os_empleados',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            unset($data['empleado_fecha_registro']);
            if($this->config_mdl->_update_data('os_empleados',$data,array('empleado_id'=>  $this->input->post('jtf_empleado_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }  
        }
    }
    public function horarios() {
        $sql['Gestion']= $this->empleados_mdl->_get_horarios($this->input->get_post('u'));
        $this->load->view('empleados/horarios_estacionamineto',$sql);
    }
    public function insert_horario() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>  $this->input->get_post('empleado_id')));
        $data=array(
            'horarios_dia'=>  $this->input->post('horarios_dia'),
            'horarios_hora_e'=>  $this->input->post('horarios_hora_e'),
            'horarios_hora_s'=>  $this->input->post('horarios_hora_s'),
            'empleado_matricula'=>$sql['info'][0]['empleado_matricula'],
            'empleado_id'=>  $this->input->post('empleado_id')
        );
        if($this->config_mdl->_insert('os_empleados_horarios',$data)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_horario() {
        if($this->config_mdl->_delete_data('os_empleados_horarios',array('horarios_id'=>$this->input->post('id')))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function matriculas() {
        $this->load->view('empleados/matriculas');
    }
}
