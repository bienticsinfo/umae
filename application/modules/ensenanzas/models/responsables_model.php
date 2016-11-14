<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of responsables_model
 *
 * @author felipe de jesus
 */
class Responsables_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function _getResponsables($buscar) {
        return $this->db
                ->or_like('idResponsable',$buscar)
                ->or_like('nombreRes',$buscar)
                ->get('en_responsables')
                ->result_array();
    }
    public function _getResById($id) {
        return $this->db
                ->where('idResponsable',$id)
                ->get('en_responsables')
                ->result_array();
    }
    public function _insertRes($datos) {
        return $this->db
                ->insert('en_responsables',$datos); 
    }
    public function _updateRespondable($data,$id) {
        return $this->db
                ->where('idResponsable',$id)
                ->update('en_responsables',$data);
    }
}
