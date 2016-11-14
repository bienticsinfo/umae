<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalizacion_m extends CI_Model {

   function __construct(){
      parent::__construct();
   }

   /**
    * [getIdDepartemento SELECT * FROM usuario
    * JOIN tipo_usuario
    * ON usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
    * AND usuario.idUsuario = '1'
    * JOIN departamento
    * ON departamento.idDepartamento = tipo_usuario.idDepartamento]
    * @param  [string] $idUsuario [ID usuario]
    * @return [array]             [Resultados]
    */      
   public function getIdDepartemento($idUsuario) {
      return $this->db
         ->select(format_select([
            'departamento.idDepartamento' => 'idDepartamento'
         ]))
         ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'"')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->get('usuario')
         ->result_array();
   }

   /**
    * [get_instrumentales_sis Query:
    * SELECT instrumental_quirurgico.idInstrumental_Quirurgico, instrumental_quirurgico.nombre, instrumental_quirurgico.cantidad
    * FROM sistema_instrumental
    * JOIN sistema_instrumental_quirurgico ON sistema_instrumental_quirurgico.idsistema_instrumental = sistema_instrumental.idsistema_instrumental
    * JOIN instrumental_quirurgico ON instrumental_quirurgico.idInstrumental_Quirurgico = sistema_instrumental_quirurgico.idInstrumental_Quirurgico
    * WHERE sistema_instrumental_quirurgico.idsistema_instrumental = <ID_SISTEMA>]
    * @param  string $id [ID del sistema de instrumentales]
    * @return [array]    [Resultados o empty]
    */
   public function get_instrumentales_sis($id='') {
      return $this->db
         ->select(format_select(array(
            'instrumental_quirurgico.idInstrumental_Quirurgico' => 'id_m_osteo',
            'instrumental_quirurgico.nombre' => 'nombre',
            'instrumental_quirurgico.cantidad' => 'cantidad')))
         ->join('sistema_instrumental_quirurgico','sistema_instrumental_quirurgico.idsistema_instrumental = sistema_instrumental.idsistema_instrumental')      
         ->join('instrumental_quirurgico','instrumental_quirurgico.idInstrumental_Quirurgico = sistema_instrumental_quirurgico.idInstrumental_Quirurgico')
         ->where(array('sistema_instrumental_quirurgico.idsistema_instrumental' => $id))
         ->get('sistema_instrumental')
         ->result_array();               
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
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material')
         ->join('material_osteosintesis','sistema_material_osteosintesis.idMaterial_Osteosintesis = material_osteosintesis.idMaterial_Osteosintesis')
         ->where('sistema_material.idSistema_Material',$id_sistema)
         ->get('sistema_material')
         ->result_array();
   }

   public function getSistemaByMaterial($idMaterial,$idCirugia='18') {
      return $this->db
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material_osteosintesis.idMaterial_Osteosintesis = "'.$idMaterial.'"')
         ->join('sistemas_material_cirugias','sistemas_material_cirugias.idSistema = sistema_material_osteosintesis.idsistema_material AND sistemas_material_cirugias.idCirugia = "'.$idCirugia.'"')
         ->get('sistema_material')
         ->result_array();
   }

   /**
    * [get_materiales_sis Query:
    * SELECT material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre, material_osteosintesis.cantidad
    * FROM sistema_material
    * JOIN sistema_material_osteosintesis ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
    * JOIN material_osteosintesis ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
    * WHERE sistema_material_osteosintesis.idsistema_material = <ID_SISTEMA>]
    * @param  string $id [ID del sistema de materiales de osteosíntesos]
    * @return [array]    [Resultados o empty]
    */
   public function get_materiales_sis($id='') {
      return $this->db
         ->select(format_select(array(
            'material_osteosintesis.idMaterial_Osteosintesis' => 'id_m_osteo',
            'material_osteosintesis.nombre' => 'nombre',
            'material_osteosintesis.cantidad' => 'cantidad')))
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
         ->where(array('sistema_material_osteosintesis.idsistema_material' => $id))
         ->get('sistema_material')
         ->result_array();
   }

   public function tipo_usuario($id_usuario='') {
      return $this->db
         ->select(format_select(array('usuario.idUsuario' => 'id_usuario')))
         ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario ="'.$id_usuario.'"')
         ->get('usuario')
         ->result_array();
   }

   /**
    * [detalles_sistema_materiales Query:
    * SELECT cirugia.idCirugia, material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre
    * FROM cirugia
    * JOIN tipo_cirugia ON tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia
    * JOIN cirugia_material_osteosintesis ON cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia
    * JOIN material_osteosintesis ON material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis
    * WHERE cirugia.idCirugia = <ID_CIRUGIA>]
    * @param  string $id_cirugia [ID de la cirugía]
    * @return [array]            [Resultados o empty]
    */
   public function detalles_sistema_materiales($id_cirugia='') {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'                                => 'idCirugia',
            'material_osteosintesis.idMaterial_Osteosintesis'  => 'idMaterial_Osteosintesis',
            'material_osteosintesis.nombre'                    => 'nombre',
            'cirugia_material_osteosintesis.cantidad'          => 'cantidad',
            'cirugia_material_osteosintesis.idSistema' => 'idSistema')))
         ->join('tipo_cirugia','tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia')
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->where(array('cirugia.idCirugia' => $id_cirugia))
         ->get('cirugia')
         ->result_array();
   }

   /**
    * [detalles_sistema_instru Query:
    * SELECT cirugia.idCirugia, instrumental_quirurgico.idInstrumental_Quirurgico, instrumental_quirurgico.nombre
    * FROM cirugia
    * JOIN tipo_cirugia ON tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia
    * JOIN cirugia_instrumental_quirurgico ON cirugia_instrumental_quirurgico.idCirugia = cirugia.idCirugia
    * JOIN instrumental_quirurgico ON instrumental_quirurgico.idInstrumental_Quirurgico = cirugia_instrumental_quirurgico.idInstrumental_Quirurgico
    * WHERE cirugia.idCirugia = <ID_CIRUGIA>]
    * @param  string $id_cirugia [ID de la cirugía]
    * @return [array]            [Resultados o empty]
    */
   public function detalles_sistema_instru($id_cirugia='') {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'                                 => 'idCirugia',
            'instrumental_quirurgico.idInstrumental_Quirurgico' => 'idInstrumental_Quirurgico',
            'instrumental_quirurgico.nombre'                    => 'nombre',
            'cirugia_instrumental_quirurgico.cantidad'          => 'cantidad',
            'cirugia_instrumental_quirurgico.idSistema' => 'idSistema')))
         ->join('tipo_cirugia','tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia')
         ->join('cirugia_instrumental_quirurgico','cirugia_instrumental_quirurgico.idCirugia = cirugia.idCirugia')
         ->join('instrumental_quirurgico','instrumental_quirurgico.idInstrumental_Quirurgico = cirugia_instrumental_quirurgico.idInstrumental_Quirurgico')
         ->where(array('cirugia.idCirugia' => $id_cirugia))
         ->get('cirugia')
         ->result_array();
   }

   /**
    * Query: 
    * SELECT sistema_instrumental.idsistema_instrumental, sistema_instrumental.nombre AS sistema
    * FROM sistema_instrumental
    * INNER JOIN tipo_cirugia ON tipo_cirugia.idTipo_Cirugia = sistema_instrumental.idTipo_Cirugia
    * WHERE tipo_cirugia.idTipo_Cirugia = <ID_TIPO_CIRUGIA>  AND sistema_instrumental.status = 1
    * @param  string ID de tipo de cirugía
    * @return [array] Resultados o empty
    */
   public function sistemas_quirurjico($id_cirugia='') {
      return $this->db
        ->select(format_select(array(
            'sistema_instrumental.idsistema_instrumental' => 'idsistema_instrumental',
            'sistema_instrumental.nombre'                 => 'sistema')))
        ->join('tipo_cirugia','tipo_cirugia.idTipo_Cirugia = sistema_instrumental.idTipo_Cirugia')
        ->where(array(
            'tipo_cirugia.idTipo_Cirugia' => $id_cirugia,
            'sistema_instrumental.status' => '1'))
        ->get('sistema_instrumental')
        ->result_array();
   }

   /**
    * Query:
    * SELECT sistema_material.idSistema_Material, sistema_material.nombre AS sistema
    * FROM sistema_material
    * JOIN tipo_cirugia ON tipo_cirugia.idTipo_Cirugia = sistema_material.idTipo_Cirugia
    * tipo_cirugia.idTipo_Cirugia = <TIPO_CIRUGIA> AND sistema_material.status = 1
    * @param  string ID de tipo de cirugía
    * @return [array] Resultados o empty
    */
   public function sistemas_materiales($id_cirugia='') {
        return $this->db
            ->select(format_select(array(
                'sistema_material.idSistema_Material' => 'idSistema_Material',
                'sistema_material.nombre'             => 'sistema')))
            ->join('tipo_cirugia','tipo_cirugia.idTipo_Cirugia = sistema_material.idTipo_Cirugia')
            ->where(array(
                'tipo_cirugia.idTipo_Cirugia' => $id_cirugia,
                'sistema_material.status'     => '1'))
            ->get('sistema_material')
            ->result_array();
   }

   /**
    * [estados_cirugia Query:
    * SELECT estado_cirugia.estado AS estado
    * FROM estado_de_cirugia
    * JOIN estado_cirugia ON estado_cirugia.idEstado_Cirugia = estado_de_cirugia.idEstado_Cirugia
    * JOIN cirugia ON cirugia.idCirugia = estado_de_cirugia.idCirugia
    * WHERE cirugia.idCirugia = <ID_CIRUGIA>]
    * @param  [string] $idCirugia [ID de la cirugía]
    * @return [array]             [Resultados o empty]
    */         
   public function estados_cirugia($idCirugia) {
      return $this->db
         ->select(format_select(array('estado_cirugia.estado' => 'estado')))
         ->join('estado_cirugia','estado_cirugia.idEstado_Cirugia = estado_de_cirugia.idEstado_Cirugia')
         ->join('cirugia','cirugia.idCirugia = estado_de_cirugia.idCirugia AND cirugia.idCirugia = "'.$idCirugia.'"')
         ->get('estado_de_cirugia')
         ->result_array();
   }

   /**
    * [medico_tratante Query:
    * SELECT empleado.idEmpleado, empleado.matricula, empleado.nombre, empleado.apellido_paterno, empleado.apellido_materno 
    * FROM tipo_usuario
    * JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario
    * JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
    * JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
    * JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad 
    * WHERE tipo_usuario.tipo = "Médico" AND empleado.status = 1 
    * AND especialidad.nombre LIKE "%<$medico>%"]
    * OR empleado.nombre LIKE "%<$medico>%"]
    * OR empleado.apellido_paterno LIKE "%<$medico>%"]
    * OR empleado.apellido_materno LIKE "%<$medico>%"]
    * OR departamento.nombre LIKE "%<$medico>%"]
    * OR especialidad.nombre LIKE "%<$medico>%"]
    * @param  [array] $medico [Condiciones]
    * @return [array]         [Resultados o empty]
    */
   public function medico_tratante($medico) {
      return $this->db
         ->select(format_select(array(
            'empleado.idEmpleado'        => 'idEmpleado',
            'empleado.matricula'         => 'matricula',
            'empleado.nombre'            => 'nombre',
            'empleado.apellido_paterno'  => 'a_paterno',
            'empleado.apellido_materno ' => 'a_materno'
         )))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->where(array('tipo_usuario.tipo' => 'Médico','empleado.status' => '1'))
         ->or_like('empleado.matricula',$medico)
         ->or_like('empleado.nombre',$medico)
         ->or_like('empleado.apellido_paterno',$medico)
         ->or_like('empleado.apellido_materno',$medico)
         ->or_like('departamento.nombre',$medico)
         ->or_like('especialidad.nombre',$medico)
         ->get('tipo_usuario')
         ->result_array();
   }

   /**
    * [ver_cirugia Query:
    * SELECT cirugia.idCirugia, empleado.idEmpleado, empleado.matricula, empleado.nombre, 
    * empleado.apellido_paterno, empleado.apellido_materno, especialidad.nombre AS especialidad, 
    * quirofano.nombre AS Quirofano, cirugia.idquirofano
    * FROM tipo_usuario
    * JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
    * JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
    * JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
    * JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
    * JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
    * JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
    * JOIN cirugia ON cirugia.idProceso = proceso.idProceso
    * JOIN quirofano ON cirugia.idQuirofano = quirofano.idQuirofano
    * JOIN tipo_cirugia ON tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia
    * WHERE cirugia.status = 1]
    * @return [type] [description]
    */
   public function ver_cirugia() {
      return $this->db
         ->select(format_select([
            'cirugia.idCirugia'         => 'idCirugia',
            'cirugia.esperaMateriales'  => 'esperaMateriales',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'empleado.nombre'           => 'nom_empleado',
            'empleado.apellido_paterno' => 'a_paterno',
            'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            'cirugia.idQuirofano'       => 'idQuirofano',
            'quirofano.nombre'          => 'quirofano',
            'estado_de_cirugia.idEstado_Cirugia'  => 'idEstado_Cirugia'
         ]))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1"')
         ->join('quirofano','cirugia.idQuirofano = quirofano.idQuirofano')
         ->join('tipo_cirugia','tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia')
         ->join('estado_de_cirugia','cirugia.idCirugia = estado_de_cirugia.idCirugia')
         ->get('tipo_usuario')
         ->result_array();      
   }

   /**
    * [getSistemasMatByIdCirugia description]
    * @param  [type] $idCirugia [description]
    * @return [type]            [description]
    */
   // public function getSistemasMatByIdCirugia($idCirugia) {
   //    return $this->db
   //       // ->select()
   //       ->join('sistema_material','sistema_material.idSistema_Material = sistemas_material_cirugias.idSistema AND sistemas_material_cirugias.idCirugia = "'.$idCirugia.'"')
   //       ->get('sistemas_material_cirugias')
   //       ->result_array();
   // }

   /**
    * [getSistemasByIdCirugia 
    * SELECT * FROM cirugia_instrumental_quirurgico
    * JOIN sistema_instrumental
    * ON sistema_instrumental.idsistema_instrumental = cirugia_instrumental_quirurgico.idInstrumental_Quirurgico 
    * AND cirugia_instrumental_quirurgico.idCirugia = 'idCirugia']
    * @param  [type] $idCirugia [ID cirugía]
    * @return [type]            [description]
    */
   // public function getSistemasByIdCirugia($idCirugia) {
   //    return $this->db
   //       // ->select()
   //       ->join('sistema_instrumental','sistema_instrumental.idsistema_instrumental = cirugia_instrumental_quirurgico.idInstrumental_Quirurgico AND cirugia_instrumental_quirurgico.idCirugia = "'.$idCirugia.'"')
   //       ->get('cirugia_instrumental_quirurgico')
   //       ->result_array();
   // }

   /**
    * [ver_cirugia_modificar 
    * SELECT * FROM tipo_usuario
    * JOIN usuario ON tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario 
    * JOIN empleado ON empleado.idEmpleado = usuario.idEmpleado
    * JOIN departamento ON departamento.idDepartamento = tipo_usuario.idDepartamento 
    * JOIN especialidad ON especialidad.idEspecialidad = departamento.idEspecialidad
    * JOIN proceso_tipo_usuario ON proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
    * JOIN proceso ON proceso.idProceso = proceso_tipo_usuario.idProceso
    * JOIN cirugia ON cirugia.idProceso = proceso.idProceso 
    * AND cirugia.status = '1' AND cirugia.idCirugia = '13' 
    * JOIN derechohabiente
    * ON derechohabiente.idDerechohabiente = cirugia.idDerechohabiente
    * JOIN tipo_cirugia
    * On cirugia.idTipo_Cirugia = tipo_cirugia.idTipo_Cirugia]
    * @param  string $idCirugia [ID cirugía]
    * @return [array]           [Resultados o empty]
    */
   public function ver_cirugia_modificar($idCirugia='22') {
      return $this->db
         ->select(format_select([
            'cirugia.idCirugia' => 'idCirugia',
            'derechohabiente.idDerechohabiente' => 'idDerechohabiente',
            'derechohabiente.nss' => 'nss',
            'derechohabiente.nombre' => 'nombreDerechohabiente',
            'derechohabiente.apellido_paterno' => 'paternoDerechohabiente',
            'derechohabiente.apellido_materno' => 'maternoDerechohabiente',
            'empleado.idEmpleado' => 'idEmpleado',
            'empleado.nombre' => 'nombreEmpleado',
            'empleado.apellido_paterno' => 'paternoEmpleado',
            'empleado.apellido_materno' => 'maternoEmpleado',
            'tipo_cirugia.idTipo_Cirugia' => 'idTipo_Cirugia'
         ]))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1" AND cirugia.idCirugia = "'.$idCirugia.'"')
         ->join('derechohabiente','derechohabiente.idDerechohabiente = cirugia.idDerechohabiente')
         ->join('tipo_cirugia','cirugia.idTipo_Cirugia = tipo_cirugia.idTipo_Cirugia')
         ->get('tipo_usuario')
         ->result_array();      
   }

   public function delete($tabla,$where) {
      $this->db->delete($tabla,$where);
   }

   /**
    * [derechohabiente_especifica Query: 
    * SELECT * FROM derechohabiente
    * WHERE STATUS = 1 
    * AND nss LIKE "%<NSS>%" 
    * OR nombre LIKE "%<NOMBRE>%" 
    * OR nombre LIKE "%<A_PATERNO>%" 
    * OR nombre LIKE "%<A_MATERNO>%"]
    * @param  [array] $like [Condiciones]
    * @return [array]       [Resultados o empty]
    */
   public function derechohabiente_especifica($like) {
      return $this->db
         ->like('nss',$like)
         ->or_like('nombre',$like)
         ->or_like('apellido_paterno',$like)
         ->or_like('apellido_materno',$like)
         ->get('derechohabiente')
         ->result_array();
   }

}