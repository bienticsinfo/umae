<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Login extends Config{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('indexV2');
    }
    public function v2() {
        $this->load->view('indexV2');
    }
    public function ger_areas_acceso() {
        $sql_rol=  $this->config_mdl->_get_data('os_areas_acceso');
        $areas=array();
        foreach ($sql_rol as $value) {
            array_push($areas, $value['areas_acceso_nombre']) ;
        }
        $this->setOutput($areas);
    }
    public function loginV2() {
        $sql=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula')
        ));
        $sql_rol=  $this->config_mdl->_get_data('os_areas_acceso');
        $areas=array();
        foreach ($sql_rol as $value) {
            array_push($areas, $value['areas_acceso_nombre']) ;
        }
        $area=  $this->input->post('empleado_area');
        if($area=='Administrador'){
           $AREA_ROL='1';
        }if($area=='Medico Triage' || $area=='Consultorio CPR' || $area=='Consultorio Filtro 1' || $area=='Consultorio Filtro 2' || $area=='Consultorio Filtro 3' || $area=='Consultorio Filtro 4' || $area=='Consultorio Filtro 5' || $area=='Consultorio Neurocirugía' || $area=='Consultorio Cirugía General' || $area=='Consultorio Filtro 8' || $area=='Consultorio Maxilofacial' || $area=='Consultorio Cirugía Maxilofacial' || $area=='Observación Pediatría' || $area=='Observación Adultos Mujeres' || $area=='Observación Adultos Hombres'){
            $AREA_ROL='2';
        }if($area=='Enfermeria Triage'){
           $AREA_ROL='3';
        }if($area=='Hora Cero'){
            $AREA_ROL='4';
        }if($area=='Asistente Médica'){
            $AREA_ROL='5';
        }if($area=='Urgencias'){
            $AREA_ROL='6';
        }
        if(in_array($this->input->post('empleado_area'), $areas)){
            if(!empty($sql)){
                $sql_roles=  $this->config_mdl->_get_data_condition('os_empleados_roles',array(
                    'empleado_id'=>$sql[0]['empleado_id'],
                    'rol_id'=>$AREA_ROL
                ));
                if(!empty($sql_roles)){
                    $_SESSION['UMAE_USER']=$sql[0]['empleado_id'];
                    $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
                    $this->config_mdl->_update_data('os_empleados',array(
                        'empleado_area_acceso'=>$this->input->post('empleado_area')
                    ),array(
                        'empleado_id'=>$sql[0]['empleado_id']
                    ));
                    $this->setOutput(array('ACCESS_LOGIN'=>'ACCESS'));
                }else{
                    $this->setOutput(array('ACCESS_LOGIN'=>'AREA_NO_ROL'));
                }
//                foreach ($sql_roles as $sql_roles) {
//                    if($AREA_ROL==$sql_roles['rol_id']){
//
//                        $_SESSION['UMAE_USER']=$sql[0]['empleado_id'];
//                        $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
//                        $this->config_mdl->_update_data('os_empleados',array(
//                            'empleado_area_acceso'=>$this->input->post('empleado_area')
//                        ),array(
//                            'empleado_id'=>$sql[0]['empleado_id']
//                        ));
//                        $this->setOutput(array('ACCESS_LOGIN'=>'ACCESS'));
//                    }else{
//                        $this->setOutput(array('ACCESS_LOGIN'=>'AREA_NO_ROL'));
//                    }   
//                }

            }else{
                $this->setOutput(array('ACCESS_LOGIN'=>  'MATRICULA_NO_ENCONTRADA'));
            }  
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>  'AREA_NO_ENCONTRADA'));
        }
        
    }    
}
