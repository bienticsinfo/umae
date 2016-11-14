<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_mdl
 *
 * @author felipe de jesus
 */
class Login_mdl extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function login_user($user,$pass) {
        return $this->db
                ->where('os_empleados.empleado_usuario',$user)
                ->where('os_empleados.empleado_contrasena',  md5($pass)) 
                ->get('os_empleados')
                ->result_array();
    }
}
