<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_osteo_m extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function last_id($tabla,$columna) {
      return $this->db
         ->select_max($columna)
         ->get($tabla)
         ->result_array();
   }

   public function revisarEnUso($idSistema) {
      return $this->db
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia AND cirugia_material_osteosintesis.idSistema = "'.$idSistema.'" AND cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'"')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia AND estado_de_cirugia.idEstado_Cirugia != "'.$this->config->item('estado_cirugia')['finalizado'].'"')
         ->get('cirugia')
         ->result_array();
   }

   public function getLastMaterialSistema($idSistema) {
      return $this->db
         ->select('codigo_barra')
         ->where('sistema_material_osteosintesis.idsistema_material',$idSistema)
         ->order_by('id','DESC')
         ->limit(1)
         ->get('sistema_material_osteosintesis')
         ->result_array();
   }

   // SELECT material_osteosintesis.*, sistema_material.idSistema_Material
   // FROM sistema_material
   // JOIN sistema_material_osteosintesis
   // ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
   // AND sistema_material.idModulo = '7' AND sistema_material.idSistema_Material = "'.$idSistema.'"
   // JOIN material_osteosintesis
   // ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
   public function getMaterialesVacTotal() {
      return $this->db
         ->get_where('material_osteosintesis',['status'=>'1','idModulo'=>$this->config->item('modulo')['materiales_consumo']])
         ->result_array();      
      // return $this->db
      //    ->select('material_osteosintesis.*, sistema_material.idSistema_Material')
      //    ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'"')
      //    ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
      //    ->get('sistema_material')
      //    ->result_array();
   }

   // SELECT material_osteosintesis.*, sistema_material.idSistema_Material
   // FROM sistema_material
   // JOIN sistema_material_osteosintesis
   // ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
   // AND sistema_material.idModulo = '7' AND sistema_material.idSistema_Material = "'.$idSistema.'"
   // JOIN material_osteosintesis
   // ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
   public function getMaterialesVac($idSistema) {
      return $this->db
         ->select('material_osteosintesis.*, sistema_material.idSistema_Material')
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND sistema_material.idSistema_Material = "'.$idSistema.'" AND sistema_material_osteosintesis.status ="1"')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
         ->get('sistema_material')
         ->result_array();
   }

   // SELECT material_osteosintesis.*, sistema_material.idSistema_Material
   // FROM sistema_material
   // JOIN sistema_material_osteosintesis
   // ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
   // AND sistema_material.idModulo = '7' AND sistema_material.idSistema_Material != "'.$idSistema.'"
   // JOIN material_osteosintesis
   // ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
   

   public function getMaterialesVacNo($idSistema='') {
      return $this->db
         ->query('SELECT DISTINCT material_osteosintesis.*
            FROM material_osteosintesis
            LEFT JOIN sistema_material_osteosintesis
            ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
            WHERE sistema_material_osteosintesis.idMaterial_Osteosintesis IS NULL
            OR sistema_material_osteosintesis.status = "0"')
         ->result_array(); 
      // return $this->db
      //    ->select('material_osteosintesis.*, sistema_material.idSistema_Material')
      //    ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status ="1" AND sistema_material_osteosintesis.idsistema_material != sistema_material.idSistema_Material AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND sistema_material.idSistema_Material != "'.$idSistema.'"')
      //    ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
      //    ->group_by('material_osteosintesis.idMaterial_Osteosintesis')
      //    ->get('sistema_material')
      //    ->result_array();
   }

   // SELECT material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre, 
   // material_osteosintesis.cantidad, material_osteosintesis.cantidad_maxima, material_osteosintesis.cantidad_minima 
   // FROM sistema_material
   // JOIN sistema_material_osteosintesis ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
   // JOIN material_osteosintesis ON sistema_material_osteosintesis.idMaterial_Osteosintesis = material_osteosintesis.idMaterial_Osteosintesis
   // WHERE sistema_material.idSistema_Material = 1

   public function get_mat_por_sis($id_sistema='') {
      return $this->db
         ->select(format_select(array(
            'material_osteosintesis.idMaterial_Osteosintesis' => 'id_material',
            'material_osteosintesis.nombre' => 'm_nombre',
            'material_osteosintesis.cantidad' => 'cantidad',
            'material_osteosintesis.cantidad_maxima' => 'maxima',
            'material_osteosintesis.cantidad_minima' => 'minima'
         )))
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material_osteosintesis.status = "1"')
         ->join('material_osteosintesis','sistema_material_osteosintesis.idMaterial_Osteosintesis = material_osteosintesis.idMaterial_Osteosintesis')
         ->where('sistema_material.idSistema_Material',$id_sistema)
         ->get('sistema_material')
         ->result_array();
   }

   public function buscar_proveedor($buscar='') {
      return $this->db
         ->like('nombre',$buscar)
         ->or_like('direccion',$buscar)
         ->or_like('correo',$buscar)
         ->or_like('telefono',$buscar)
         ->where('status = "1"')
         ->get('proveedor')
         ->result_array();
   }

   // SELECT sistema_material.idSistema_Material, sistema_material.nombre, tipo_cirugia.tipo, 
   // proveedor.idproveedor, proveedor.nombre
   // FROM sistema_material
   // JOIN tipo_cirugia ON tipo_cirugia.idTipo_Cirugia = sistema_material.idTipo_Cirugia
   // JOIN proveedor ON proveedor.idproveedor = sistema_material.idProveedor AND sistema_material.status = 1
   public function consulta() {
      return $this->db
         ->select(format_select(array(
            'sistema_material.idSistema_Material' => 'id_sistema',
            'sistema_material.nombre'             => 's_nombre',
            'sistema_material.status'             => 'status',
            'proveedor.idproveedor'               => 'id_proveedor',
            'proveedor.nombre'                    => 'p_nombre',
            'categorias_sis_materiales_vac.nombre' => 'c_nombre'
         )))
         // ->join('tipo_cirugia','tipo_cirugia.idTipo_Cirugia = sistema_material.idTipo_Cirugia A')
         ->join('proveedor','proveedor.idproveedor = sistema_material.idProveedor AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'"')
         ->join('categorias_sis_materiales_vac','categorias_sis_materiales_vac.id = sistema_material.categoria')
         ->order_by('sistema_material.status','DESC')
         ->get('sistema_material')
         ->result_array();
   }

}

/* End of file Sistema_osteo_m.php */
/* Location: ./application/modules/configuracion/models/Sistema_osteo_m.php */