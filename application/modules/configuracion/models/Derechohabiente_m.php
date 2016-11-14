<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Derechohabiente_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function consulta_por_nombre($nombre='') {
         return $this->db
            ->where('status','1')
            ->like('nombre',$nombre)
            ->or_like('apellido_paterno',$nombre)
            ->or_like('apellido_materno',$nombre)
            ->get('derechohabiente')
            ->result_array();
    }
    public function consulta_por_nss($nss='') {
         return $this->db
            ->where('status = "1"')
            ->like('nss',$nss)
            ->get('derechohabiente')
            ->result_array();
    }
    public function _get_derechohabiente() {
        return $this->db
            ->where("derechohabiente_status",'')
            ->get('os_derechohabiente')
            ->result_array();
    }   
    public function _get_derechohabiente_($dh) {
        return $this->db
            ->where('os_derechohabiente.derechohabiente_id',$dh)
            ->get('os_derechohabiente')
            ->result_array();
    }   
    public function _update_derechohabiente($dh,$data) {
        return $this->db
                ->where('os_derechohabiente.derechohabiente_id',$dh)
                ->update('os_derechohabiente',$data);
    }
    public function _delete_derechohabiente($dh) {
        return $this->db
                ->where('derechohabiente_id',$dh)
                ->update('os_derechohabiente',array('derechohabiente_status'=>'hidden'));
    }
}

/* End of file Derechohabiente_m.php */
/* Location: ./application/modules/configuracion/models/Derechohabiente_m.php */