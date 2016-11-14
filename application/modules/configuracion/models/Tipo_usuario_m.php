<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Tipo_usuario_m extends CI_Model {

      public function __construct() {
         parent::__construct();
      }      

      // SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo  
      // FROM tipo_usuario_piso
      // RIGHT JOIN tipo_usuario
      // ON tipo_usuario_piso.idTipoUsuario = tipo_usuario.idTipo_Usuario
      // WHERE tipo_usuario_piso.idTipoUsuario IS NULL
      public function getTiposSinPiso() {
         return $this->db
            ->select('tipo_usuario.idTipo_Usuario, tipo_usuario.tipo')
            ->join('tipo_usuario','tipo_usuario_piso.idTipoUsuario = tipo_usuario.idTipo_Usuario','RIGHT')
            ->where('tipo_usuario_piso.idTipoUsuario IS NULL',NULL,FALSE)
            ->get('tipo_usuario_piso')
            ->result_array();
      }

      // SELECT quirofano.idquirofano, quirofano.nombre 
      // FROM quirofano
      // LEFT JOIN tipo_usuario_piso
      // ON quirofano.idquirofano = tipo_usuario_piso.idPiso
      // WHERE tipo_usuario_piso.idPiso IS NULL
      // AND quirofano.tipo = $this->config->item('tipos_destino')['piso']

      public function getPisoSinTipos() {
         return $this->db
            ->select('quirofano.idquirofano, quirofano.')
            ->join('tipo_usuario_piso','quirofano.idquirofano = tipo_usuario_piso.idPiso','LEFT')
            ->where('tipo_usuario_piso.idPiso IS NULL',NULL,FALSE)
            ->where('quirofano.tipo = '.$this->config->item('tipos_destino')['piso'])
            ->get('quirofano')
            ->result_array();
      }

      /**
       * [tipo_usuario_id Query:
       * SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo, departamento.nombre
       * FROM tipo_usuario
       * INNER JOIN departamento ON tipo_usuario.idDepartamento = departamento.idDepartamento
       * WHERE tipo_usuario.status = 1 AND idTipo_Usuario $id]
       * @param  string $id [description]
       * @return [type]     [description]
       */
      public function tipo_usuario_id($id='') {
         return $this->db
            ->select(format_select(array(
               'tipo_usuario.idTipo_Usuario' => 'id_tipo',
               'tipo_usuario.tipo'           => 'tipo',
               'departamento.nombre'         => 'departamento',
               'departamento.idDepartamento' => 'id_departamento'
            )))
            ->join('departamento','tipo_usuario.idDepartamento = departamento.idDepartamento AND tipo_usuario.status = "1" AND idTipo_Usuario = "'.$id.'"')
            ->get('tipo_usuario')
            ->result_array();
      }

      /**
       * [FunctionName Query:
       * SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo, departamento.nombre
       * FROM tipo_usuario
       * INNER JOIN departamento ON tipo_usuario.idDepartamento = departamento.idDepartamento
       * WHERE tipo_usuario.status = 1 AND departamento.nombre LIKE "%<DEPARTAMENTO>%"]
       * @param string $busqueda [description]
       */
      public function consulta_por_departamento($busqueda='') {
         return $this->db
            ->select(format_select(array(
               'tipo_usuario.idTipo_Usuario' => 'id_tipo',
               'tipo_usuario.tipo'           => 'tipo',
               'departamento.nombre'         => 'departamento'
            )))
            ->join('departamento','tipo_usuario.idDepartamento = departamento.idDepartamento')
            ->where('tipo_usuario.status','1')
            ->like('departamento.nombre',$busqueda)
            ->get('tipo_usuario')
            ->result_array();
      }

      /**
       * [FunctionName Query:
       * SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo, departamento.nombre
       * FROM tipo_usuario
       * JOIN departamento ON tipo_usuario.idDepartamento = departamento.idDepartamento
       * WHERE tipo_usuario.status = 1 AND tipo_usuario.tipo LIKE "%<TIPO DE USUARIO>%"]
       * @param string $busqueda [description]
       */  
      public function consulta_por_tipo($busqueda='') {
         return $this->db
            ->select(format_select(array(
               'tipo_usuario.idTipo_Usuario' => 'id_tipo',
               'tipo_usuario.tipo'           => 'tipo',
               'departamento.nombre'         => 'departamento'
            )))
            ->join('departamento','tipo_usuario.idDepartamento = departamento.idDepartamento')
            ->where('tipo_usuario.status','1')
            ->like('tipo_usuario.tipo',$busqueda)
            ->get('tipo_usuario')
            ->result_array();
      }

      /**
       * [consulta Query:
       * SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo, departamento.nombre
       * FROM tipo_usuario
       * JOIN departamento ON tipo_usuario.idDepartamento = departamento.idDepartamento
       * WHERE tipo_usuario.status = 1]
       * @return [type] [description]
       */ 
      public function consulta() {
         return $this->db
            ->select(format_select(array(
               'tipo_usuario.idTipo_Usuario' => 'id_tipo',
               'tipo_usuario.tipo'           => 'tipo',
               'departamento.nombre'         => 'departamento'
               // 'quirofano.nombre'            => 'piso'
            )))
            ->join('departamento','tipo_usuario.idDepartamento = departamento.idDepartamento AND tipo_usuario.status = "1"')
            // ->join('tipo_usuario_piso','tipo_usuario_piso.idTipoUsuario = tipo_usuario.idTipo_Usuario')
            // ->join('quirofano','quirofano.idquirofano = tipo_usuario_piso.idPiso')
            ->get('tipo_usuario')
            ->result_array();
      }

//       SELECT tipo_usuario.idTipo_Usuario, tipo_usuario.tipo, departamento.nombre, quirofano.nombre
// FROM tipo_usuario
// JOIN departamento 
// ON tipo_usuario.idDepartamento = departamento.idDepartamento
// AND tipo_usuario.status = '1'
// JOIN tipo_usuario_piso
// ON tipo_usuario_piso.idTipoUsuario = tipo_usuario.idTipo_Usuario
// JOIN quirofano 
// ON quirofano.idquirofano = tipo_usuario_piso.idPiso

   }

/* End of file Tipo_usuario.php */
/* Location: ./application/modules/configuracion/models/Tipo_usuario.php */