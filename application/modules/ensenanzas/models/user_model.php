<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author felipe de jesus
 */
class User_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function _insertUser($datos) {
        return $this->db
                ->insert('en_usuario',$datos); 
    }
    public function _getUsers() {
         return $this->db
            ->where('en_responsables.idResponsable=en_usuario.idResponsable')
            ->where('status!=','hidden')
            ->get('en_usuario, en_responsables')
            ->result_array();
    }
    public function _getUsersCalendar($date) {
         return $this->db
            ->where('en_responsables.idResponsable=en_usuario.idResponsable')
            ->where('status!=','hidden')
            ->where('fechaAsistencia',$date)
            ->get('en_usuario, en_responsables')
            ->result_array();
    }
    public function _getUsersById($id) {
        return $this->db
                ->where('en_responsables.idResponsable=en_usuario.idResponsable')
                ->where('idUsuario',$id)
                ->get('en_usuario, en_responsables')
                ->result_array();
    }
    public function _eliminarUsuario($id) {
        return $this->db
                ->where("idUsuario",$id)
                ->delete('en_usuario');
    }
    public function _eliminarUsuarioV2($id,$data) {
        return $this->db
                ->where("idUsuario",$id)
                ->update('en_usuario',$data);
    }
    public function _updateUser($data,$tabla,$where) {
        return $this->db
                ->where($where,$where)
                ->update($tabla,$data);
    }
    public function _updateUserOk($data,$id) {
        return $this->db
                ->where('idUsuario',$id)
                ->update('en_usuario',$data);
    }
    public function _updateCredencial($data,$id) {
        return $this->db
                ->where('idUsuario',$id)
                ->update('en_usuario',$data);
    }
}
