<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ceye_m extends CI_Model {

   function __construct(){
      parent::__construct();
   }

   // SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, 
   // empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno, 
   // especialidad.nombre AS especialidad, usuario.usuario, stock.fecha
   // FROM tipo_usuario
   // JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
   // JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
   // JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
   // JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
   // JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
   // JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
   // JOIN cirugia ON cirugia.idProceso = proceso.idProceso
   // JOIN stock ON cirugia.idCirugia = stock.idCirugia AND stock.idUsuario

   public function devolucion() {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'id_cirugia',
            'empleado.idEmpleado'       => 'id_empleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'usuario.usuario'           => 'usuario',
            'stock.fecha'               => 's_fecha'
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso')
         ->join('stock','cirugia.idCirugia = stock.idCirugia AND stock.idUsuario')
         ->get('tipo_usuario')
         ->result_array();
   }

   // SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, 
   // empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno, 
   // especialidad.nombre AS especialidad
   // FROM tipo_usuario
   // JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
   // JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
   // JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
   // JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
   // JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
   // JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
   // JOIN cirugia ON cirugia.idProceso = proceso.idProceso
   // JOIN cirugia_material_osteosintesis ON cirugia.idCirugia = cirugia_material_osteosintesis.idCirugia
   // JOIN estado_componente ON cirugia_material_osteosintesis.idestado_componente = estado_componente.idestado_componente 
   // WHERE cirugia.status = 1 AND estado_componente.nombre = "Aceptado"

   public function entregado() {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'id_cirugia',
            'empleado.idEmpleado'       => 'id_empleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad'
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1"')
         ->join('cirugia_material_osteosintesis','cirugia.idCirugia = cirugia_material_osteosintesis.idCirugia')
         ->join('estado_componente','cirugia_material_osteosintesis.idestado_componente = estado_componente.idestado_componente AND estado_componente.nombre = "Aceptado"')
         ->get('tipo_usuario')
         ->result_array();
   }

   // SELECT * FROM instrumental_quirurgico INNER JOIN sistema_instrumental

   public function instrumental_quiru() {
      // return $this->db
      //    ->join()
   }

   //  SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, 
   //  empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno, especialidad.nombre AS especialidad
   // FROM tipo_usuario
   // INNER JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
   // INNER JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
   // INNER JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
   // INNER JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
   // INNER JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
   // INNER JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
   // INNER JOIN cirugia ON cirugia.idProceso = proceso.idProceso
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
            'especialidad.nombre'       => 'especialidad'
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario')
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

}