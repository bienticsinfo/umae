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
        $sql_admin=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula'),
            'empleado_usuario'=>  'Administrador'
        ));
        $sql_rol=  $this->config_mdl->_get_data('os_areas_acceso');
        $areas=array();
        foreach ($sql_rol as $value) {
            array_push($areas, $value['areas_acceso_nombre']) ;
        }
        
        if(in_array($this->input->post('empleado_area'), $areas)){
            if($this->input->post('empleado_area')=='Administrador'){
                if(!empty($sql_admin)){
                    $_SESSION['UMAE_USER']=$sql_admin[0]['empleado_id'];
                    $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
                    $this->config_mdl->_update_data('os_empleados',array(
                        'empleado_area_acceso'=>$this->input->post('empleado_area')
                    ),array(
                        'empleado_id'=>$sql[0]['empleado_id']
                    ));
                    $this->setOutput(array('ACCESS_LOGIN'=>'1'));
                }else{
                    $this->setOutput(array('ACCESS_LOGIN'=>  'ADMIN_NO_ENCONTRADA'));
                }
            }else{
                if(!empty($sql)){
                    $_SESSION['UMAE_USER']=$sql[0]['empleado_id'];
                    $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
                    $this->config_mdl->_update_data('os_empleados',array(
                        'empleado_area_acceso'=>$this->input->post('empleado_area')
                    ),array(
                        'empleado_id'=>$sql[0]['empleado_id']
                    ));
                    $this->setOutput(array('ACCESS_LOGIN'=>'1'));
                }else{
                    $this->setOutput(array('ACCESS_LOGIN'=>  'MATRICULA_NO_ENCONTRADA'));
                }
            }
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>  'AREA_NO_ENCONTRADA'));
        }
        
    }    
}