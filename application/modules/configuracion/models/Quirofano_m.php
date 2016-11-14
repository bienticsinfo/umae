<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Quirofano_m extends CI_Model {

      function __construct() {
         parent::__construct();
      }

      /**
       * [consulta Query:
       * SELECT * FROM quirofano WHERE status = 1]
       * @return [array] [Resultados o empty]
       */
      public function consulta() {
         return $this->db
            ->select('quirofano.nombre, quirofano.idquirofano')
            ->get_where('quirofano','status = "1"')
            ->result_array();
      }      

   }

/* End of file Quirofano_m.php */
/* Location: ./application/modules/configuracion/models/Quirofano_m.php */