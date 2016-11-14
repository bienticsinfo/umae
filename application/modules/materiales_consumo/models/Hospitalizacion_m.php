<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalizacion_m extends CI_Model {

   public function __construct(){
      parent::__construct();
   }

   public function getIdDepartementoByMatr($idUsuario='') {
      return $this->db
         ->select(format_select([
            'departamento.idDepartamento' => 'idDepartamento'
         ]))
         // ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND (usuario.idUsuario = "'.$idUsuario.'" OR usuario.idEmpleado = "'.$idUsuario.'")')
         ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->or_where(['usuario.idUsuario'=>$idUsuario])
         ->or_where(['usuario.idEmpleado'=>$idUsuario])
         ->get('usuario')
         ->result_array();
   }

   public function getIdPisoByIdUsuario($idUsuario) {
      return $this->db
         ->join('tipo_usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'"')
         ->join('tipo_usuario_piso','tipo_usuario_piso.idTipoUsuario = tipo_usuario.idTipo_Usuario')
         ->join('quirofano','quirofano.idquirofano = tipo_usuario_piso.idPiso')
         ->get('usuario')
         ->result_array();
   }
      
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

   public function get_mat_por_sis($id_sistema='') {
      return $this->db
         ->select(format_select(array(
            'material_osteosintesis.idMaterial_Osteosintesis' => 'id_material',
            'material_osteosintesis.nombre' => 'm_nombre',
            'material_osteosintesis.cantidad' => 'cantidad',
            'material_osteosintesis.cantidad_maxima' => 'maxima',
            'material_osteosintesis.cantidad_minima' => 'minima'
         )))
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status ="1" AND sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material')
         ->join('material_osteosintesis','sistema_material_osteosintesis.idMaterial_Osteosintesis = material_osteosintesis.idMaterial_Osteosintesis')
         ->where('sistema_material.idSistema_Material',$id_sistema)
         ->get('sistema_material')
         ->result_array();
   }

   public function getSistemaByMaterial($idMaterial,$idCirugia='18') {
      return $this->db
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status ="1" AND sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material_osteosintesis.idMaterial_Osteosintesis = "'.$idMaterial.'"')
         ->join('sistemas_material_cirugias','sistemas_material_cirugias.idSistema = sistema_material_osteosintesis.idsistema_material AND sistemas_material_cirugias.idCirugia = "'.$idCirugia.'"')
         ->get('sistema_material')
         ->result_array();
   }

   public function get_materiales_sis($id='') {
      return $this->db
         ->select(format_select(array(
            'material_osteosintesis.idMaterial_Osteosintesis' => 'id_m_osteo',
            'material_osteosintesis.nombre' => 'nombre',
            'material_osteosintesis.cantidad' => 'cantidad')))
         ->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status ="1" AND sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis AND material_osteosintesis.status = "1"')
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

   public function detalles_sistema_materiales($id_cirugia='') {
      return $this->db
         ->select(format_select(array(
            'cirugia.idCirugia'                                => 'idCirugia',
            'material_osteosintesis.idMaterial_Osteosintesis'  => 'idMaterial_Osteosintesis',
            'material_osteosintesis.nombre'                    => 'nombre',
            'cirugia_material_osteosintesis.cantidad'          => 'cantidad',
            'cirugia_material_osteosintesis.idSistema' => 'idSistema')))
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idCirugia = cirugia.idCirugia')
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis')
         ->where(array('cirugia.idCirugia' => $id_cirugia))
         ->get('cirugia')
         ->result_array();
   }


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
   public function sistemas_materiales() {
        return $this->db
            ->select(format_select(array(
                'sistema_material.idSistema_Material' => 'idSistema_Material',
                'sistema_material.nombre'             => 'sistema')))
            ->where(array(
                'sistema_material.idModulo' => $this->config->item('modulo')['materiales_consumo'],
                'sistema_material.status'   => '1'))
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
         // ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND proceso_tipo_usuario.idProceso ="2"')
         ->where(array('tipo_usuario.idTipo_Usuario' => '7','empleado.status' => '1'))
         ->group_start()
            ->or_like('empleado.matricula',$medico)
            ->or_like('empleado.nombre',$medico)
            ->or_like('empleado.apellido_paterno',$medico)
            ->or_like('empleado.apellido_materno',$medico)
            ->or_like('departamento.nombre',$medico)
            ->or_like('especialidad.nombre',$medico)
         ->group_end()
         ->get('tipo_usuario')
         ->result_array();
   }

   public function ver_cirugia() {
      return $this->db
         ->select(format_select([
            'documento_solicitud_consumo.folio' => 'folio',
            'cirugia.idCirugia'         => 'idCirugia',
            'empleado.idEmpleado'       => 'idEmpleado',
            'empleado.matricula'        => 'matricula',
            'CONCAT(derechohabiente.nombre," ",derechohabiente.apellido_paterno," ",derechohabiente.apellido_materno)' => 'nom_derechohabiente',
            'CONCAT(empleado.nombre," ",empleado.apellido_paterno," ",empleado.apellido_materno)' => 'nom_empleado',
            // 'empleado.apellido_paterno' => 'a_paterno',
            // 'empleado.apellido_materno' => 'a_materno',
            'especialidad.nombre'       => 'especialidad',
            // 'cirugia.idQuirofano'       => 'idQuirofano',
            'quirofano.nombre'          => 'quirofano',
            'estado_de_cirugia.idEstado_Cirugia'  => 'idEstado_Cirugia',
            'documento_solicitud_consumo.solcitudPdf'    => 'solicitud',
            'documento_solicitud_consumo.reajustePdf'    => 'reajuste',
            'documento_solicitud_consumo.reajustePdf2'   => 'reajuste2',
            'documento_solicitud_consumo.cancelacionPdf' => 'cancelacion',
            'documento_solicitud_consumo.tipo_documento' => 'tipo_documento',
         ]),FALSE)
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idTipo_Usuario = "7"')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         // ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         // ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         // ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1" AND cirugia.idModulo = "7" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('cirugia','cirugia.status = "1" AND cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('quirofano','cirugia.idQuirofano = quirofano.idQuirofano')
         // ->join('tipo_cirugia','tipo_cirugia.idTipo_cirugia = cirugia.idTipo_Cirugia')
         ->join('estado_de_cirugia','cirugia.idCirugia = estado_de_cirugia.idCirugia')
         ->join('derechohabiente','cirugia.idDerechohabiente = derechohabiente.idDerechohabiente')
         ->join('documento_solicitud_consumo','cirugia.idCirugia = documento_solicitud_consumo.idTratamiento')
         ->get('tipo_usuario')
         ->result_array();      
   }

   public function ver_cirugia_modificar($idCirugia='22') {
      return $this->db
         ->select(format_select([
            'cirugia.idCirugia' => 'idCirugia',
            'cirugia.fecha' => 'fecha',
            'cirugia.diagnostico' => 'diagnostico',
            'cirugia.idquirofano' => 'idquirofano',
            'derechohabiente.idDerechohabiente' => 'idDerechohabiente',
            'derechohabiente.nss' => 'nss',
            'derechohabiente.nombre' => 'nombreDerechohabiente',
            'derechohabiente.apellido_paterno' => 'paternoDerechohabiente',
            'derechohabiente.apellido_materno' => 'maternoDerechohabiente',
            'empleado.idEmpleado' => 'idEmpleado',
            'empleado.nombre' => 'nombreEmpleado',
            'empleado.apellido_paterno' => 'paternoEmpleado',
            'empleado.apellido_materno' => 'maternoEmpleado',
            'empleado.matricula' => 'matricula'
         ]))
         ->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
         ->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
         // ->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
         // ->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
         // ->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.status = "1" AND cirugia.idCirugia = "'.$idCirugia.'"')
         ->join('cirugia','cirugia.status = "1" AND cirugia.idCirugia = "'.$idCirugia.'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('derechohabiente','derechohabiente.idDerechohabiente = cirugia.idDerechohabiente')
         ->get('tipo_usuario')
         ->result_array();      
   }

   public function delete($tabla,$where) {
      $this->db->delete($tabla,$where);
   }

    public function derechohabiente_especifica($like) {
        return $this->db
         ->like('nss',$like)
         ->or_like('nombre',$like)
         ->or_like('apellido_paterno',$like)
         ->or_like('apellido_materno',$like)
         ->get('derechohabiente')
         ->result_array();
    }
    public function _get_medico_tratante() {
        return $this->db
                ->where('os_empleados.idTipo_Usuario=tipo_usuario.idTipo_Usuario')
                ->where('tipo_usuario.idTipo_Usuario=7')
                ->get('os_empleados, tipo_usuario')
                ->result_array();  
    }
   
    public function _max_solicitid_material() {
        return $this->db
                ->select_max('solicitud','solicitud')
                ->get('os_solicitud_material_osteosintesis')
                ->result_array();
    }
    public function _get_cirugias() {
        return $this->db
                ->where('os_solicitud_material_osteosintesis.empleado_crea',$this->session->sess['idUsuario'])
                ->where('os_solicitud_material_osteosintesis.derechohabiente_id=os_derechohabiente.derechohabiente_id')
                ->where('os_solicitud_material_osteosintesis.empleado_id=os_empleados.empleado_id')
                ->get('os_solicitud_material_osteosintesis, os_derechohabiente, os_empleados')
                ->result_array();
    }
    public function _get_cirugias_almacen() {
        return $this->db
                ->where('os_solicitud_material_osteosintesis.derechohabiente_id=os_derechohabiente.derechohabiente_id')
                ->where('os_solicitud_material_osteosintesis.empleado_id=os_empleados.empleado_id')
                ->get('os_solicitud_material_osteosintesis, os_derechohabiente, os_empleados')
                ->result_array();
    }
    public function _get_cirugia($cirugia) {
        return $this->db
                ->where('os_solicitud_material_osteosintesis.derechohabiente_id=os_derechohabiente.derechohabiente_id')
                ->where('os_solicitud_material_osteosintesis.empleado_id=os_empleados.empleado_id')
                ->where('os_solicitud_material_osteosintesis.solicitud',$cirugia)
                ->get('os_solicitud_material_osteosintesis, os_derechohabiente, os_empleados')
                ->result_array();
    }
    public function _get_medico_tratante_($empleado) {
        return $this->db
                ->where('os_empleados.idTipo_Usuario=tipo_usuario.idTipo_Usuario')
                ->where('os_empleados.empleado_id',$empleado)
                ->get('os_empleados, tipo_usuario')
                ->result_array();
    }
    public function _get_materiales_s_in($sol) {
        return $this->db
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_id=os_solicitud_material_osteosintesis.solicitud')
                ->where('os_solicitud_materiales_osteosintesis.material_id=os_material_osteosintesis.material_id')
                ->where('os_material_osteosintesis_intermedias.material_id=os_material_osteosintesis.material_id')
                ->where('os_solicitud_materiales_osteosintesis.intermedio_id=os_material_osteosintesis_intermedias.intermedia_id')
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_tipo','Material intermedio')
                ->where('os_solicitud_material_osteosintesis.solicitud',$sol)
                ->get('os_solicitud_materiales_osteosintesis, os_solicitud_material_osteosintesis,os_material_osteosintesis, os_material_osteosintesis_intermedias')
                ->result_array();
    }
    public function _get_materiales_s_m($sol) {
        return $this->db
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_id=os_solicitud_material_osteosintesis.solicitud')
                ->where('os_solicitud_materiales_osteosintesis.material_id=os_material_osteosintesis.material_id')
                ->where('os_sistema_osteosintesis.sistema_id=os_material_osteosintesis.sistema_id')
                ->where('os_solicitud_material_osteosintesis.solicitud',$sol)
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_tipo','Material')
                ->get('os_solicitud_materiales_osteosintesis, os_solicitud_material_osteosintesis,os_material_osteosintesis,os_sistema_osteosintesis')
                ->result_array();
    }
    public function _get_materiales_s_mi($sol) {
        return $this->db
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_id=os_solicitud_material_osteosintesis.solicitud')
                ->where('os_solicitud_materiales_osteosintesis.material_id=os_material_osteosintesis.material_id')
                ->where('os_material_osteosintesis_intermedias.intermedia_id=os_solicitud_materiales_osteosintesis.intermedio_id')
                ->where('os_material_osteosintesis_intermedias.material_id=os_material_osteosintesis.material_id')
                ->where('os_sistema_osteosintesis.sistema_id=os_material_osteosintesis.sistema_id')
                ->where('os_solicitud_material_osteosintesis.solicitud',$sol)
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_tipo','Material intermedio')
                ->get('os_solicitud_materiales_osteosintesis, os_solicitud_material_osteosintesis,os_material_osteosintesis,os_sistema_osteosintesis,os_material_osteosintesis_intermedias')
                ->result_array();
    }    
    /*Get Materiales*/
    public function _get_material_tipo($sol) {
        return $this->db
                ->where('os_solicitud_materiales_osteosintesis.solicitud_m_id=os_solicitud_material_osteosintesis.solicitud')
                ->where('os_solicitud_material_osteosintesis.solicitud',$sol)
                ->get('os_solicitud_materiales_osteosintesis, os_solicitud_material_osteosintesis')
                ->result_array();
    }
    
    public function _delete_prog_cirugia($sol) {
        $this->db
                ->where('solicitud_m_id',$sol)
                ->delete('os_solicitud_materiales_osteosintesis');
        return $this->db
                ->where('solicitud',$sol)
                ->delete('os_solicitud_material_osteosintesis');
    }
    public function _get_mi_cb($mi,$limit) {
        return $this->db
                ->where('os_material_osteosintesis_intermedias.intermedia_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                ->where('os_material_osteosintesis_intermedias.intermedia_id',$mi)
                ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material intermedio')
                ->where('intemediocd_status','Disponible')
                ->limit($limit)
                ->get('os_material_osteosintesis_intermedias, os_material_osteosintesis_intermedias_cb')
                ->result_array();
    }
    public function _get_m_cb($m,$limit) {
        return $this->db
                ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                ->where('os_material_osteosintesis.material_id',$m)
                ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material')
                ->where('intemediocd_status','Disponible')
                ->limit($limit)
                ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias_cb')
                ->result_array();
    }
    public function _get_mi_cb_no($mi,$limit) {
        return $this->db
                ->where('os_material_osteosintesis_intermedias.intermedia_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                ->where('os_material_osteosintesis_intermedias.intermedia_id',$mi)
                ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material intermedio')
                ->where('intemediocd_status','No disponible')
                ->limit($limit)
                ->get('os_material_osteosintesis_intermedias, os_material_osteosintesis_intermedias_cb')
                ->result_array();
    }
    public function _get_m_cb_no($m,$limit) {
        return $this->db
                ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                ->where('os_material_osteosintesis.material_id',$m)
                ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material')
                ->where('intemediocd_status','No disponible')
                ->limit($limit)
                ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias_cb')
                ->result_array();
    }    
    public function _update_mi_cb($intemediocd_id,$tipo,$sol) {
        return $this->db
                ->where('intemediocd_id',$intemediocd_id)
                ->where('intermediocd_tipo',$tipo)

                ->update('os_material_osteosintesis_intermedias_cb',array(
                    'intemediocd_status'=>'No disponible',
                    'solicitud_id'=>$sol
                ));
    }
}