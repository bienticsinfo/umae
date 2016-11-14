<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asistencia_model
 *
 * @author felipe de jesus
 */
class Asistencia_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function _getUserAsis() {
        return $this->db
                ->where('en_usuario.idUsuario=en_user_asistencia.idUser')
                ->where('empleado.idEmpleado=en_usuario.idResponsable')
                ->get('en_usuario, en_user_asistencia,empleado')
                ->result_array();
    }
    public function insertAsistencia($data) {
        return $this->db->insert('en_usuario_asistencia',$data);
    }
    public function _updateAsistencia($data,$id) {
        return $this->db
                ->where('idUsuario',$id)
                ->update('en_usuario',$data);
    }
    public function _updateUserAsis($data,$id) {
        return $this->db
                ->where('idUser',$id)
                ->update('en_usuario_asistencia',$data);   
    }
    public function _buscarUserAsis($id,$fecha) {
        return $this->db
                ->where('idUser',$id)
                ->where('fecha',$fecha)
                ->get('en_usuario_asistencia')
                ->result_array();
    }
    public function _getFechaAistencia($id,$fecha) {
        return $this->db
                ->where('idUsuario',$id)
                ->where('fechaAsistencia',$fecha)
                ->get('en_usuario')
                ->result_array();
    }
    
}
