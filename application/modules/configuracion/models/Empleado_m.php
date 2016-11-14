<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Empleado_m extends CI_Model {

      function __construct() {
         parent::__construct();
      }

      /**
       * [consulta Query:
       * SELECT *
       * FROM empleado
       * JOIN directorio
       * ON empleado.idEmpleado = directorio.idEmpleado AND empleado.idEmpleado = $id
       * WHERE empleado.status = 1]
       * @return [array] [Resultados o empty]
       */
      public function empleado_por_id($id='') {
         return $this->db
            ->select(format_select(array(
               'empleado.idEmpleado'       => 'id_empleado',
               'empleado.matricula'        => 'matricula',
               'empleado.nombre'           => 'nombre',
               'empleado.apellido_paterno' => 'a_paterno',
               'empleado.apellido_materno' => 'a_materno',
               'empleado.fecha_nacimiento' => 'f_nacimiento',
               'empleado.lugar_nacimiento' => 'l_nacimiento',
               'empleado.sexo'             => 'sexo',
               'directorio.direccion'      => 'direccion',
               'directorio.telefono'       => 'telefono',
               'directorio.celular'        => 'celular',
               'directorio.email'          => 'correo'
            )))
            ->join('directorio','empleado.idEmpleado = directorio.idEmpleado AND empleado.status = "1" AND empleado.idEmpleado = "'.$id.'"')
            ->get('empleado')
            ->result_array();
      }

      /**
       * [consulta_por_correo Query:
       * SELECT *
       * FROM empleado
       * JOIN directorio
       * ON empleado.idEmpleado = directorio.idEmpleado
       * WHERE empleado.status = 1 AND directorio.email LIKE "%EMAIL%"]
       * @param  string $busqueda [description]
       * @return [type]           [description]
       */   
      public function consulta_por_correo($busqueda='') {
         return $this->db
            ->select(format_select(array(
               'empleado.idEmpleado'       => 'id_empleado',
               'empleado.matricula'        => 'matricula',
               'empleado.nombre'           => 'nombre',
               'empleado.apellido_paterno' => 'a_paterno',
               'empleado.apellido_materno' => 'a_materno',
               'directorio.email'          => 'correo',
            )))
            ->join('directorio','empleado.idEmpleado = directorio.idEmpleado AND empleado.status = "1"')
            ->where('empleado.status = "1"')
            ->like('directorio.email',$buscar)
            ->get('empleado')
            ->result_array();  
      }

      /**
       * [FunctionName Query:
       * SELECT *
       * FROM empleado
       * JOIN directorio
       * ON empleado.idEmpleado = directorio.idEmpleado
       * WHERE empleado.status = 1 AND empleado.nombre LIKE "%<NOMBRE>%"
       * OR empleado.apellido_paterno LIKE "%<NOMBRE>%"
       * OR empleado.apellido_materno LIKE "%<NOMBRE>%"]
       * @param string $buscar [Búsqueda]
       * @return [array]       [Resultados o empty]
       */
      public function consulta_por_nombre($buscar='') {
         return $this->db
            ->select(format_select(array(
               'empleado.idEmpleado'       => 'id_empleado',
               'empleado.matricula'        => 'matricula',
               'empleado.nombre'           => 'nombre',
               'empleado.apellido_paterno' => 'a_paterno',
               'empleado.apellido_materno' => 'a_materno',
               'directorio.email'          => 'correo',
            )))
            ->join('directorio','empleado.idEmpleado = directorio.idEmpleado AND empleado.status = "1"')
            ->where('empleado.status = "1"')
            ->or_like('empleado.nombre',$buscar)
            ->or_like('empleado.apellido_paterno',$buscar)
            ->or_like('empleado.apellido_materno',$buscar)
            ->get('empleado')
            ->result_array();    
      }

      /**
       * [consulta_por_matricula Query:
       * SELECT *
       * FROM empleado
       * JOIN directorio
       * ON empleado.idEmpleado = directorio.idEmpleado
       * WHERE empleado.status = 1 AND empleado.matricula LIKE "%<matricula>%"]
       * @param  string $buscar [Búsqueda]
       * @return [array]        [Resultados o empty]
       */
      public function consulta_por_matricula($buscar='') {
         return $this->db
            ->select(format_select(array(
               'empleado.idEmpleado'       => 'id_empleado',
               'empleado.matricula'        => 'matricula',
               'empleado.nombre'           => 'nombre',
               'empleado.apellido_paterno' => 'a_paterno',
               'empleado.apellido_materno' => 'a_materno',
               'directorio.email'          => 'correo',
            )))
            ->join('directorio','empleado.idEmpleado = directorio.idEmpleado AND empleado.status = "1"')
            ->where('empleado.status = "1"')
            ->like('empleado.matricula',$buscar)
            ->get('empleado')
            ->result_array();
      }

      /**
       * [consulta Query:
       * SELECT *
       * FROM empleado
       * JOIN directorio
       * ON empleado.idEmpleado = directorio.idEmpleado
       * WHERE empleado.status = 1]
       * @return [array] [Resultados o empty]
       */
      public function consulta() {
         return $this->db
            ->select(format_select(array(
               'empleado.idEmpleado'       => 'id_empleado',
               'empleado.matricula'        => 'matricula',
               'empleado.nombre'           => 'nombre',
               'empleado.apellido_paterno' => 'a_paterno',
               'empleado.apellido_materno' => 'a_materno',
               'directorio.email'          => 'correo',
            )))
            ->join('directorio','empleado.idEmpleado = directorio.idEmpleado AND empleado.status = "1"')
            ->get('empleado')
            ->result_array();
      }

   }

/* End of file Empleado_m.php */
/* Location: ./application/modules/configuracion/models/Empleado_m.php */