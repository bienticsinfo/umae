<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_mdl
 *
 * @author felipe de jesus
 */
class Usuario_mdl extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function get_user_data($user) {
        return $this->db
                ->where('usuario.idEmpleado=empleado.idEmpleado')
                ->where('usuario.idTipo_Usuario=tipo_usuario.idTipo_Usuario')
                ->where('usuario.idUsuario',$user)
                ->get('usuario,empleado, tipo_usuario')
                ->result_array();
    }
    public function _get_users() {
        return $this->db
                ->where('cs_usuarios.rol_id=cs_roles.rol_id')
                ->get('cs_usuarios, cs_roles')
                ->result_array();
    }
    public function _insert_data($tabla,$data) {
        return $this->db->insert($tabla,$data);
    }
    public function _update_user($data,$user) {
        return $this->db
                ->where('usuario_id',$user)
                ->update('cs_usuarios',$data);
    }
    public function _delete_user($user) {
        return $this->db
                ->where('usuario_id',$user)
                ->delete('cs_usuarios');
    }
    public function _check_user($user) {
        return $this->db
                ->where('usuario_user',$user)
                ->get('cs_usuarios')
                ->result_array();
    }    
}
