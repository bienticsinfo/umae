<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quirofano_m extends CI_Model {

   function __construct() {
   	parent::__construct();
   }

   public function select_date($fecha='') {
      return $this->db
         ->get_where('cirugia','cirugia.fecha = date("'.$fecha.'")')
         ->result_array();
   }

   // SELECT cirugia.idCirugia, material_osteosintesis.nombre, cirugia_material_osteosintesis.cantidad AS cantidad
   // FROM cirugia
   // JOIN cirugia_material_osteosintesis ON cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia
   // JOIN material_osteosintesis 
   // ON material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis
   // WHERE cirugia.status = 1 AND cirugia.idCirugia = 3

   public function consumo($id_cirugia) {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'                       => 'id_cirugia',
            'material_osteosintesis.nombre'           => 'nombre',
            'cirugia_material_osteosintesis.cantidad' => 'cantidad'
         )))
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->where('cirugia.status = "1" AND cirugia.idCirugia = "'.$id_cirugia.'"')
         ->get('cirugia')
         ->result_array();
   }

   // SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, 
   // empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno, 
   // especialidad.nombre AS especialidad, cirugia.fecha, quirofano.nombre AS Quirofano
   // FROM tipo_usuario
   // JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
   // JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
   // JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
   // JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
   // JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
   // JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
   // JOIN cirugia ON cirugia.idProceso = proceso.idProceso
   // JOIN quirofano ON cirugia.idQuirofano = quirofano.idQuirofano
   // WHERE cirugia.idquirofano > 0 AND cirugia.status = 1

   public function reportar_consumo() {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'cirugia.fecha'             => 'fecha',
            'quirofano.nombre'          => 'quirofano'
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idquirofano > 0 AND cirugia.status = "1"')
         ->join('quirofano','cirugia.idQuirofano = quirofano.idQuirofano')
         ->get('tipo_usuario')
         ->result_array();
   }

   // SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, empleado.nombre, 
   // empleado.apellido_paterno, empleado.apellido_materno, especialidad.nombre AS especialidad
   // FROM tipo_usuario
   // JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
   // JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
   // JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
   // JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
   // JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
   // JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
   // JOIN cirugia ON cirugia.idProceso = proceso.idProceso
   // WHERE cirugia.idquirofano = 0 AND cirugia.status = 1

   public function por_asignar() {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idquirofano = 0 AND cirugia.status = "1"')
         ->get('tipo_usuario')
         ->result_array();
   }

 	// SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, 
   // empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno, 
   // especialidad.nombre AS especialidad, cirugia.fecha, quirofano.nombre AS Quirofano
	// FROM tipo_usuario
	// JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
	// JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
	// JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
	// JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
	// JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
	// JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
	// JOIN cirugia ON cirugia.idProceso = proceso.idProceso
	// JOIN quirofano ON cirugia.idQuirofano = quirofano.idQuirofano
	// WHERE cirugia.idquirofano > 0 AND cirugia.status = 1

   public function asignado() {
   	return $this->db
   		->select(format_select(array(
   			'cirugia.idCirugia' 			 => 'idCirugia',
   			'empleado.idEmpleado' 		 => 'idEmpleado',
   			'empleado.matricula'			 => 'matricula',
   			'empleado.nombre' 			 => 'nombre',
   			'empleado.apellido_paterno' => 'a_paterno',
   			'empleado.apellido_materno' => 'a_materno',
   			'especialidad.nombre' 		 => 'especialidad',
   			'cirugia.fecha' 				 => 'fecha',
   			'quirofano.nombre'			 => 'quirofano'
   		)))
   		->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
   		->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
   		->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
   		->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
   		->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
   		->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
   		->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idquirofano > 0 AND cirugia.status = "1"')
   		->join('quirofano','cirugia.idQuirofano = quirofano.idQuirofano')
   		->get('tipo_usuario')
   		->result_array();
   }

}