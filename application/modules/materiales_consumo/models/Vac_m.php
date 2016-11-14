<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vac_m extends CI_Model {

   function __construct(){
      parent::__construct();
   }

   public function getIdDepartemento($idUsuario) {
      return $this->db
         ->select(format_select([
            'departamento.idDepartamento' => 'idDepartamento'
         ]))
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'" ')
         ->get('tipo_usuario')
         ->result_array();
   }

   // SELECT * FROM sistema_material
   // JOIN cirugia_material_osteosintesis
   // ON sistema_material.idSistema_Material = cirugia_material_osteosintesis.idSistema
   // AND sistema_material.idSistema_Material AND cirugia_material_osteosintesis.idCirugia = '30'
   // JOIN material_osteosintesis
   // ON material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis

   public function getSistemaMatByIdCirugia($idCirugia) {
      return $this->db
         ->select('sistema_material.nombre AS nombreSis, material_osteosintesis.nombre AS nombreMat, cirugia_material_osteosintesis.cantidad AS matConsumido, proveedor.correo AS correo')
         ->join('cirugia_material_osteosintesis','sistema_material.idSistema_Material = cirugia_material_osteosintesis.idSistema AND sistema_material.idSistema_Material AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'" AND cirugia_material_osteosintesis.cantidad > "0"')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->join('proveedor','sistema_material.idProveedor = proveedor.idproveedor')
         ->get('sistema_material')
         ->result_array();
   }

   // SELECT * FROM sistema_material
   // JOIN cirugia_material_osteosintesis 
   // ON cirugia_material_osteosintesis.idSistema = sistema_material.idSistema_Material
   // AND cirugia_material_osteosintesis.idCirugia = '30'
   // JOIN material_osteosintesis 
   // ON material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis
   // JOIN proveedor 
   // ON sistema_material.idProveedor = proveedor.idproveedor
   // GROUP BY proveedor.correo

   public function getProveedoresByIdCirugiaGroup($idCirugia) {
      return $this->db
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idSistema = sistema_material.idSistema_Material AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'"')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->join('proveedor','sistema_material.idProveedor = proveedor.idproveedor')
         ->group_by('proveedor.correo')
         ->get('sistema_material')
         ->result_array();
   }

   public function getMaterialesByIdCirugia($idCirugia) {
      return $this->db
         ->select('cirugia_material_osteosintesis.cantidad, material_osteosintesis.nombre')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'"')
         ->get('cirugia_material_osteosintesis')
         ->result_array();
   }

   public function getDiferenciaMateriales($idCirugia) {
      return $this->db->select(format_select([
            'cirugia_material_osteosintesis.idMaterial_Osteosintesis' => 'idMaterial_Osteosintesis',
            'material_osteosintesis.cantidad - cirugia_material_osteosintesis.cantidad' => 'diferencia'
         ]),FALSE)
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'"')
         ->get('cirugia_material_osteosintesis')
         ->result_array();
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

   public function matEnDevolucion($idTipo,$idTratamiento) {
      return $this->db
         ->select('cirugia_material_osteosintesis.idCirugia, cirugia_material_osteosintesis.cantidad, material_osteosintesis.nombre, cirugia_material_osteosintesis.idMaterial_Osteosintesis, sistema_material.nombre AS sisNombre')
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idCirugia = estado_de_cirugia.idCirugia AND estado_de_cirugia.idEstado_Cirugia = "7" AND cirugia_material_osteosintesis.devolucion = "1"')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->join('cirugia','cirugia.idCirugia = cirugia_material_osteosintesis.idCirugia AND cirugia.idCirugia = "'.$idTratamiento.'"')
         ->join('tipo_usuario_piso','tipo_usuario_piso.idPiso = cirugia.idquirofano AND tipo_usuario_piso.idTipoUsuario = "'.$idTipo.'"')
         ->join('sistema_material','sistema_material.idSistema_Material = cirugia_material_osteosintesis.idSistema')
         ->get('estado_de_cirugia')
         ->result_array();
   }

   public function devolucion($idTipo) {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'CONCAT(derechohabiente.nombre," ",derechohabiente.apellido_paterno," ",derechohabiente.apellido_materno)' => 'nom_derechohabiente'
         )),FALSE)
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idTipo_Usuario = "7"')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('cirugia','cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('derechohabiente','cirugia.idDerechohabiente = derechohabiente.idDerechohabiente')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia')
         ->join('tipo_usuario_piso','tipo_usuario_piso.idPiso = cirugia.idquirofano AND tipo_usuario_piso.idTipoUsuario = "'.$idTipo.'"')
         ->where('cirugia.status = "1" AND estado_de_cirugia.idEstado_Cirugia = "'.$this->config->item('estado_cirugia')['devolucion'].'"')
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

   public function entregado($idTipo) {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'CONCAT(derechohabiente.nombre," ",derechohabiente.apellido_paterno," ",derechohabiente.apellido_materno)' => 'nom_derechohabiente'
         )),FALSE)
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idTipo_Usuario = "7"')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         // ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         // ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('derechohabiente','cirugia.idDerechohabiente = derechohabiente.idDerechohabiente')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia')
         ->join('tipo_usuario_piso','tipo_usuario_piso.idPiso = cirugia.idquirofano AND tipo_usuario_piso.idTipoUsuario = "'.$idTipo.'"')
         ->where('cirugia.status = "1" AND estado_de_cirugia.idEstado_Cirugia = "8"')
         ->get('tipo_usuario')
         ->result_array();
      // return $this->db
      //    ->select(format_select(array(
      //       'cirugia.idCirugia'         => 'id_cirugia',
      //       'empleado.idEmpleado'       => 'id_empleado',
      //       'empleado.matricula'        => 'matricula',
      //       'empleado.nombre'           => 'nombre',
      //       'empleado.apellido_paterno' => 'a_paterno',
      //       'empleado.apellido_materno' => 'a_materno',
      //       'especialidad.nombre'       => 'especialidad'
      //    )))
      //    ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
      //    ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
      //    ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
      //    ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
      //    ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
      //    ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
      //    ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1"')
      //    ->join('cirugia_material_osteosintesis','cirugia.idCirugia = cirugia_material_osteosintesis.idCirugia')
      //    ->join('estado_componente','cirugia_material_osteosintesis.idestado_componente = estado_componente.idestado_componente AND estado_componente.nombre = "Aceptado"')
      //    ->get('tipo_usuario')
      //    ->result_array();
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

   public function por_asignar($idTipo) {
      // return $this->db
      //    ->select(format_select(array(
      //       'cirugia.idCirugia'         => 'idCirugia',
      //       'empleado.idEmpleado'       => 'idEmpleado',
      //       'empleado.matricula'        => 'matricula',
      //       'empleado.nombre'           => 'nombre',
            // 'empleado.apellido_paterno' => 'a_paterno',
            // 'empleado.apellido_materno' => 'a_materno',
      //       'especialidad.nombre'       => 'especialidad'
      //    )))
      //    ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
      //    ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
      //    ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
      //    ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
      //    ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
      //    ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
      //    ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idquirofano = 0 AND cirugia.status = "1" AND cirugia.idModulo = "7"')
      //    ->get('tipo_usuario')
      //    ->result_array();
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nombre',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'CONCAT(derechohabiente.nombre," ",derechohabiente.apellido_paterno," ",derechohabiente.apellido_materno)' => 'nom_derechohabiente'
         )),FALSE)
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idTipo_Usuario = "7"')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         // ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         // ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('derechohabiente','cirugia.idDerechohabiente = derechohabiente.idDerechohabiente')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia')
         ->join('estado_cirugia','estado_cirugia.idEstado_Cirugia = estado_de_cirugia.idEstado_Cirugia')
         ->join('tipo_usuario_piso','tipo_usuario_piso.idPiso = cirugia.idquirofano AND tipo_usuario_piso.idTipoUsuario = "'.$idTipo.'"')
         ->where('cirugia.status = "1" AND estado_cirugia.estado = "Por Entregar"')
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
            'cirugia.fecha'         => 'fecha',
            'empleado.idEmpleado'       => 'idEmpleado',
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
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idModulo = "7"')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia')
         ->where('cirugia.status = "1" AND estado_de_cirugia.idEstado_Cirugia = "7"')
         ->get('tipo_usuario')
         ->result_array();

    	// return $this->db
    	// 	->select(format_select(array(
    	// 		'cirugia.idCirugia'         => 'idCirugia',
	    //         'empleado.idEmpleado'       => 'idEmpleado',
	    //         'empleado.matricula'        => 'matricula',
	    //         'empleado.nombre'           => 'nombre',
	    //         'empleado.apellido_paterno' => 'a_paterno',
	    //         'empleado.apellido_materno' => 'a_materno',
	    //         'especialidad.nombre'       => 'especialidad',
	    //         'cirugia.fecha'             => 'fecha',
	    //         'quirofano.nombre'          => 'quirofano'
	    //     )))
	    //     ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
	    //     ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
	    //     ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
	    //     ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
	    //     ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
	    //     ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
	    //     ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idquirofano > 0 AND cirugia.status = "1"')
	    //     ->join('quirofano','cirugia.idQuirofano = quirofano.idQuirofano')
	    //     ->get('tipo_usuario')
	    //     ->result_array();
    }

}