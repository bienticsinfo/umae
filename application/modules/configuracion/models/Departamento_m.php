<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Departamento_m extends CI_Model {

      function __construct() {
         parent::__construct();
      }      

      /**
       * [consulta Query:
       * SELECT departamento.idDepartamento, departamento.nombre AS departamento, especialidad.nombre AS especialidad
       * FROM departamento
       * JOIN especialidad
       * ON departamento.idEspecialidad = especialidad.idEspecialidad
       * WHERE departamento.status = 1 AND idDepartamento = $id]
       * @param  string $id [ID departamento]
       * @return [array] [Resultados o emtpy]
       */
      public function departamento_por_id($id='') {
         return $this->db
            ->select(format_select(array(
               'departamento.idDepartamento' => 'id_departamento',
               'departamento.nombre'         => 'departamento',
               'especialidad.idEspecialidad' => 'id_especialidad'
            )))
            ->join('especialidad','departamento.idEspecialidad = especialidad.idEspecialidad')
            ->where('departamento.status = "1" AND idDepartamento = "'.$id.'"')
            ->get('departamento')
            ->result_array();
      }

      /**
       * [consulta_por_especialidad Query:
       * SELECT departamento.idDepartamento, departamento.nombre AS departamento, especialidad.nombre AS especialidad
       * FROM departamento
       * JOIN especialidad
       * ON departamento.idEspecialidad = especialidad.idEspecialidad
       * WHERE departamento.status = 1
       * AND especialidad.nombre LIKE "%<ESPECIALIDAD>%"]
       * @param  string $busqueda [description]
       * @return [type]           [description]
       */
      public function consulta_por_especialidad($busqueda='') {
         return $this->db
            ->select(format_select(array(
               'departamento.idDepartamento' => 'id_departamento',
               'departamento.nombre'         => 'departamento',
               'especialidad.nombre'         => 'especialidad'
            )))
            ->join('especialidad','departamento.idEspecialidad = especialidad.idEspecialidad')
            ->where('departamento.status = "1"')
            ->like('especialidad.nombre',$busqueda)
            ->get('departamento')
            ->result_array();
      }

      /**
       * [FunctionName Query:
       * SELECT departamento.idDepartamento, departamento.nombre AS departamento, especialidad.nombre AS especialidad
       * FROM departamento
       * JOIN especialidad
       * ON departamento.idEspecialidad = especialidad.idEspecialidad
       * WHERE departamento.status = 1 
       * AND departamento.nombre LIKE "%<DEPARTAMENTO>%"]
       * @param string $busqueda [Tipo de búsqueda]
       * @return [array] [Resultados o emtpy]
       */
      public function consulta_por_departamento($busqueda='') {
         return $this->db
            ->select(format_select(array(
               'departamento.idDepartamento' => 'id_departamento',
               'departamento.nombre'         => 'departamento',
               'especialidad.nombre'         => 'especialidad'
            )))
            ->join('especialidad','departamento.idEspecialidad = especialidad.idEspecialidad')
            ->where('departamento.status = "1"')
            ->like('departamento.nombre',$busqueda)
            ->get('departamento')
            ->result_array();
      }

      /**
       * [consulta Query:
       * SELECT departamento.idDepartamento, departamento.nombre AS departamento, especialidad.nombre AS especialidad
       * FROM departamento
       * JOIN especialidad
       * ON departamento.idEspecialidad = especialidad.idEspecialidad
       * WHERE departamento.status = 1]
       * @return [array] [Resultados o emtpy]
       */
      public function consulta() {
         return $this->db
            ->select(format_select(array(
               'departamento.idDepartamento' => 'id_departamento',
               'departamento.nombre'         => 'departamento',
               'especialidad.nombre'         => 'especialidad'
            )))
            ->join('especialidad','departamento.idEspecialidad = especialidad.idEspecialidad')
            ->where('departamento.status = 1')
            ->get('departamento')
            ->result_array();
      }

   }

/* End of file Departamento_m.php */
/* Location: ./application/modules/configuracion/models/Departamento_m.php */