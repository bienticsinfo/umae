<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedores_mdl
 *
 * @author felipe de jesus
 */
class Proveedores_mdl extends CI_Model{
    public function _delete_proveedor($prov) {
        return $this->db
                ->where('prov_id',$prov)
                ->update('cs_proveedor',array('prov_status'=>'hidden'));
    }
}
