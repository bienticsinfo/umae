<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_osteo_m extends CI_Model {

   public function __construct() {
      parent::__construct();
   }   

   // SELECT material_osteosintesis.*
   // FROM sistema_material
   // JOIN sistema_material_osteosintesis
   // ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
   // AND sistema_material.idModulo = '7'
   // JOIN material_osteosintesis
   // ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
   // GROUP BY material_osteosintesis.idMaterial_Osteosintesis
   public function getMaterialesVac() {
      return $this->db
         ->order_by('status','DESC')
         ->get_where('material_osteosintesis',['idModulo'=> $this->config->item('modulo')['materiales_consumo']])
         ->result_array();
      // return $this->db
      //    ->select('material_osteosintesis.*')
      //    ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'"')
      //    ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
      //    ->group_by('material_osteosintesis.idMaterial_Osteosintesis')
      //    ->get('sistema_material')
      //    ->result_array();
   }

}

/* End of file Material_osteo_m.php */
/* Location: ./application/modules/configuracion/models/Material_osteo_m.php */