<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Equipos_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function consulta() {
        return $this->db
            ->get_where('equipo','status = "1"')
            ->result_array();
    }

}
