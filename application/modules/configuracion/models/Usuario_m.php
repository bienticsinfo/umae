<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Usuario_m extends CI_Model {

      function __construct() {
         parent::__construct();
      }

      public function _get_empleados() {
          return $this->db
                  ->get('empleado')
                  ->result_array();
      }
      public function _get_roles() {
          return $this->db
                  ->get('tipo_usuario')
                  ->result_array();          
      }
      public function _get_equipos() {
          return $this->db
                  ->get('os_equipo')
                  ->result_array();     
      }
      public function buscar_equipo($buscar='') {
         return $this->db
            ->like('direccionIP',$buscar)
            ->get('equipo')
            ->result_array();
      }

      public function tipo_usuario() {
         return $this->db
            ->select(format_select(array(
               'tipo_usuario.idTipo_Usuario' => 'id_tipo_usuario',
               'tipo_usuario.tipo'           => 'tipo'
            )))
            ->join('departamento','tipo_usuario.idDepartamento = departamento.idDepartamento')
            ->join('especialidad','departamento.idEspecialidad = especialidad.idEspecialidad')
            ->where('tipo_usuario.status = "1"')
            ->get('tipo_usuario')
            ->result_array();
      }

    /*__________________________________________________________________________*/
    public function _delete_usuario($empleado) {
        return $this->db
                ->where('os_empleados.empleado_id',$empleado)
                ->update('os_empleados',array('empleado_status' => 'hidden'));
    } 
    public function _get_usuario_id($empleado) {
        return $this->db
                ->where('os_empleados.empleado_id',$empleado)
                ->get('os_empleados')
                ->result_array();   
    }
    public function _get_usuarios() {
        return $this->db
                ->get('os_empleados')
                ->result_array();   
    }
    public function _insert($table,$data) {
        return $this->db
                ->insert($table,$data); 
    }
    public function _update_usuario($empleado,$data) {
        return $this->db
                ->where('os_empleados.empleado_id',$empleado)
                ->update('os_empleados',$data);
    }
    public function _check_user($user) {
        return $this->db
                ->where('os_empleados.empleado_usuario',$user)
                ->get('os_empleados')
                ->result_array();  
    }
}

/* End of file usuario_m.php */
/* Location: ./application/modules/configuracion/models/usuario_m.php */