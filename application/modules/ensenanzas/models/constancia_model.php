<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of constancia_model
 *
 * @author felipe de jesus
 */
class Constancia_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function _getConstancias(){
        return $this->db
                ->get('en_constancia')
                ->result_array();
    }
    public function _getConstanciasById($id){
        return $this->db
                ->where('idConstancia',$id)
                ->get('en_constancia')
                ->result_array();
    }
    public function _insertConstancia($data) {
        return $this->db->insert('en_constancia', $data);
    }
    public function _insertUC($data) {
        return $this->db->insert('en_usuario_constancia',$data);
    }
    public function _getUC($idU,$idC) {
        return $this->db
                ->where('idUser',$idU)
                ->where('idC',$idC)
                ->get('en_usuario_constancia')
                ->result_array();
    }
    public function _updateContancia($data,$id) {
        return $this->db
                ->where('idConstancia',$id)
                ->update('en_constancia',$data);
    }
    public function _deleteConstancia($id) {
        return $this->db
                ->where('idConstancia',$id)
                ->delete('en_constancia');
    }
    public function _geConstanciaUser($idU,$idC) {
        return $this->db
                ->where('en_usuario.idUsuario=en_usuario_constancia.idUser')
                ->where('en_constancia.idConstancia=en_usuario_constancia.idC')
                ->where('en_usuario.idUsuario',$idU)
                ->where('en_constancia.idConstancia',$idC)
                ->get('en_usuario, en_constancia, en_usuario_constancia')
                ->result_array();
    }
}
