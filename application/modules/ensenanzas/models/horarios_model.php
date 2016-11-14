<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_horarios_model
 *
 * @author felipe de jesus
 */
class Horarios_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function _getHorarios() {
        return $this->db
                ->get('en_horarios')
                ->result_array();
    }
    public function _insertConfig($data,$table) {
        return $this->db->insert($table, $data);
    }
    public function _updateConfig($data,$tabla,$where) {
        return $this->db
                ->where('idHorario',$where)
                ->update($tabla,$data);
    }
    public function _deleteConfig($tabla,$data) {
        return $this->db->delete($tabla,$data); 
    }
}
