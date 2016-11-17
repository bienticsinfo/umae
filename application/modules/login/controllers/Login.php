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
    public function login_user() {
        $sql=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_usuario'=>    $this->input->post('username'),
            'empleado_contrasena'=> md5($this->input->post('password')) 
        ));
        //$sql=  $this->login_mdl->login_user($this->input->post('username'),  $this->input->post('password'));
        if(!empty($sql)){
            //$_SESSION['idUser']=$sql[0]['idUsuario'];
            $_SESSION['idUser']=$sql[0]['empleado_id'];
            $_SESSION['idRol_']=$sql[0]['idTipo_Usuario'];
            $sql_rol=  $this->config_mdl->_get_data_condition('os_empleados_roles',array('empleado_id'=>$sql[0]['empleado_id']));
            $roles=array();
            foreach ($sql_rol as $value) {
                array_push($roles, $value['rol_id']) ;
            }
            $_SESSION['IMSS_ROLES']=  $roles; 
            $this->sesion($sql);
            $this->setOutput(array('accion'=>'1','tipo'=>$sql[0]['tipo']));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    private function sesion($usuario) {
        $info = array(
                'idUsuario' => $usuario[0]['empleado_id'],
                'idRol'     => $usuario[0]['idTipo_Usuario'],
                'login'     => TRUE
        );
        $_SESSION['sess'] =  $info; 
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
        }if($area=='AUX UNIV DE OFICINAS 80'){
            $AREA_ROL='4';
        }if($area=='Asistente Médica'){
            $AREA_ROL='5';
        }if($area=='Urgencias'){
            $AREA_ROL='6';
        }
        if(in_array($this->input->post('empleado_area'), $areas)){
            if(!empty($sql)){
                if($AREA_ROL==$sql[0]['rol_id']){
                    
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
            }else{
                $this->setOutput(array('ACCESS_LOGIN'=>  'MATRICULA_NO_ENCONTRADA'));
            }  
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>  'AREA_NO_ENCONTRADA'));
        }
        
    }    
}
