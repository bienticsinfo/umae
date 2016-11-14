<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Triage_mdl
 *
 * @author felipe de jesus | itifjpp@gmail.com 
 */
class Triage_mdl extends CI_Model{
    //put your code here
    public function filtro_triage($by,$campo,$fecha) {
        return $this->db
                ->where('os_triage.triage_id =os_triage_cortes.triage_id')
                ->where('os_triage_cortes.corte_fecha',$fecha)
                ->like($by,$campo)
                ->order_by('os_triage.triage_id','DESC')
                ->get('os_triage, os_triage_cortes')
                ->result_array();
    }
    public function filtro_pacientes($by,$like) {
        return $this->db
                ->like($by,$like)
                ->order_by('os_triage.triage_id','DESC')
                ->get('os_triage')
                ->result_array();
    } 
}
