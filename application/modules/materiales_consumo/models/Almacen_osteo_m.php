<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen_osteo_m extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

   public function getProveedor($sistema) {
      return $this->db
         ->join('proveedor','sistema_material.idSistema_Material = "'.$sistema.'" sistema_material.idProveedor = proveedor.idproveedor AND sistema_material.status = "1" AND proveedor.status')
         ->get('sistema_material')
         ->result_array();
   }

   public function getInfoProveedor($idProveedor) {
      return $this->db
         ->join('proveedor','proveedor.idProveedor = "'.$idProveedor.'" AND proveedor.idproveedor = contrato.idproveedor AND contrato.status = "1" AND proveedor.status = "1"')
         ->get('contrato')
         ->result_array();
   }

   public function getMaterialesByCirugia($idCirugia) {
      return $this->db
         ->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = cirugia_material_osteosintesis.idMaterial_Osteosintesis AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'"')
         ->join('sistema_material','sistema_material.idSistema_Material = cirugia_material_osteosintesis.idSistema')
         ->get('cirugia_material_osteosintesis')
         ->result_array();
   }

   public function getSistemaByIdMaterial($idMaterial,$idCirugia) {
      return $this->db
         ->where(['idCirugia'=>$idCirugia,'idMaterial_Osteosintesis'=>$idMaterial])
         ->group_by('idSistema')
         ->get('cirugia_material_osteosintesis')
         ->result_array();
   }

   public function getMaterialesSinExistencia($idMaterial,$idCirugia) {
      return $this->db
         // ->get_where('material_osteosintesis',['idMaterial_Osteosintesis'=>$idMaterial,'cantidad'=>'0'])
         ->select('cirugia_material_osteosintesis.*, material_osteosintesis.*, cirugia_material_osteosintesis.cantidad AS cantidadSolicitada')
         ->join('cirugia_material_osteosintesis','cirugia_material_osteosintesis.idMaterial_Osteosintesis = material_osteosintesis.idMaterial_Osteosintesis')
         ->where('cirugia_material_osteosintesis.cantidad > material_osteosintesis.cantidad AND material_osteosintesis.idMaterial_Osteosintesis = "'.$idMaterial.'" AND cirugia_material_osteosintesis.idCirugia = "'.$idCirugia.'"')
         ->get('material_osteosintesis')
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

	public function get_info_usuario($id_usuario=false) {
		if ($id_usuario) {
			return $this->db
				->join('empleado','usuario.idEmpleado = empleado.idEmpleado AND usuario.idUsuario = "'.$id_usuario.'"')
				->get('usuario')
				->result_array();
		} 
		else {
			return false;
		}
	}

	/**
	 * [consulta_nuevo_material Query:
	 * SELECT sistema_material.idSistema_Material, sistema_material.nombre, sistema_material.idProveedor, proveedor.nombre, 
	 * contrato.idcontrato, contrato.clave, material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre, 
	 * material_osteosintesis.cantidad
	 * FROM sistema_material
 	 * JOIN sistema_material_osteosintesis ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
	 * JOIN material_osteosintesis ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
	 * JOIN proveedor ON proveedor.idproveedor = sistema_material.idProveedor
	 * JOIN contrato ON proveedor.idproveedor = contrato.idproveedor
	 * WHERE sistema_material.status = 1 AND sistema_material_osteosintesis.idMaterial_Osteosintesis = <ID_MATERIAL> AND proveedor.idproveedor = <ID_PROVEEDOR>]
	 * @param  [string] $id_sistema   [ID del sistema]
	 * @param  [string] $id_proveedor [ID del proveedor]
	 * @return [array]              [Resultados o emtpy]
	 */
	public function consulta_nuevo_material($idMaterial='',$id_proveedor="",$idSistema) {
		return $this->db
			->select(format_select(array(
				'sistema_material.idSistema_Material' => 'id_sis_material',
				'sistema_material.nombre'             => 'nombre_sis',
				'sistema_material.idProveedor'        => 'id_proveedor',
				'proveedor.nombre'                    => 'nombre_p',
				'contrato.idcontrato'                 => 'id_contrato',
				'contrato.clave'                      => 'clave',
				'material_osteosintesis.nombre'       => 'nombre_mat',
				'material_osteosintesis.cantidad'     => 'cantidad',
            'material_osteosintesis.idMaterial_Osteosintesis' => 'idMaterialOsteo'
			)))
			->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status = "1" AND sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material.status = 1 AND sistema_material_osteosintesis.idMaterial_Osteosintesis = "'.$idMaterial.'" AND sistema_material_osteosintesis.idsistema_material = "'.$idSistema.'"')
			->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
			->join('proveedor','proveedor.idproveedor = sistema_material.idProveedor AND proveedor.idproveedor = "'.$id_proveedor.'"')
			->join('contrato','proveedor.idproveedor = contrato.idproveedor')
			->get('sistema_material')
			->result_array();
	}

	/**
	 * [detalles_material_inventario Query:
	 * SELECT sistema_material.idSistema_Material, sistema_material.nombre, sistema_material.idProveedor, proveedor.nombre, 
	 * contrato.idcontrato, contrato.clave, material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre, 
	 * material_osteosintesis.cantidad, material_osteosintesis.cantidad_maxima, material_osteosintesis.cantidad_minima
	 * FROM sistema_material
	 * JOIN sistema_material_osteosintesis ON sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material
	 * JOIN material_osteosintesis ON material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis
	 * JOIN proveedor ON proveedor.idproveedor = sistema_material.idProveedor
	 * JOIN contrato ON proveedor.idproveedor = contrato.idproveedor
	 * WHERE sistema_material.status = 1 AND sistema_material.idSistema_Material = <ID_SISTEMA>]
	 * @param  [string] $id_sis_material [ID del material del sistema]
	 * @return [array]                   [Resultados o empty]
	 */
	public function detalles_material_inventario($id_sis_material='') {
		return $this->db
			->select(format_select(array(
				'sistema_material.idSistema_Material'    => 'id_sis_material',
				'sistema_material.nombre'                => 'nombre_sis',
				'sistema_material.idProveedor'           => 'id_proveedor',
				'proveedor.nombre'                       => 'nombre_p',
				'contrato.idcontrato'                    => 'id_contrato',
				'contrato.clave'                         => 'clave',
				'material_osteosintesis.nombre'          => 'nombre_mat',
				'material_osteosintesis.cantidad'        => 'cantidad',
				'material_osteosintesis.cantidad_maxima' => 'cantidad_maxima',
				'material_osteosintesis.cantidad_minima' => 'cantidad_minima',
				'material_osteosintesis.idMaterial_Osteosintesis' => 'id_mat_osteo'
			)))
			->join('sistema_material_osteosintesis','sistema_material_osteosintesis.status = "1" AND sistema_material_osteosintesis.idsistema_material = sistema_material.idSistema_Material AND sistema_material.status = "1" AND sistema_material.idSistema_Material = "'.$id_sis_material.'"')
			->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = sistema_material_osteosintesis.idMaterial_Osteosintesis')
			->join('proveedor','proveedor.idproveedor = sistema_material.idProveedor')
			->join('contrato','proveedor.idproveedor = contrato.idproveedor')
			->get('sistema_material')
			->result_array();
	}

	/**
	 * [consulta_gestion_inventario Query:
	 * SELECT sistema_material.idSistema_Material, sistema_material.nombre, sistema_material.idProveedor, proveedor.nombre, 
	 * contrato.idcontrato, contrato.clave
	 * FROM sistema_material
	 * JOIN proveedor ON proveedor.idproveedor = sistema_material.idProveedor
	 * JOIN contrato ON proveedor.idproveedor = contrato.idproveedor
	 * WHERE sistema_material.status = 1]
	 * @return [array] [Resultados o empty]
	 */
	public function consulta_gestion_inventario() {
		return $this->db
			->select(format_select(array(
				'sistema_material.idSistema_Material' => 'id_sis_material',
				'sistema_material.nombre'             => 'nombre',
				'sistema_material.idProveedor'        => 'id_proveedor',
				'proveedor.nombre'                    => 'nombre_p',
				'contrato.idcontrato'                 => 'id_contrato',
				'contrato.clave'                      => 'clave'
			)))
			->join('proveedor','proveedor.idproveedor = sistema_material.idProveedor AND sistema_material.status = "1" AND sistema_material.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'"')
			->join('contrato','proveedor.idproveedor = contrato.idproveedor')
			->get('sistema_material')
			->result_array();
	}

	/**
	 * [detalles_archivo Query:
	 * SELECT stock.idstock, stock.idCirugia, material_osteosintesis.idMaterial_Osteosintesis, material_osteosintesis.nombre
	 * FROM stock
	 * JOIN cirugia ON stock.idCirugia = cirugia.idCirugia
	 * JOIN material_osteosintesis ON material_osteosintesis.idMaterial_Osteosintesis = stock.idMaterial_Osteosintesis
	 * WHERE stock.idCirugia = <ID_CIRUGIA>]
	 * @param  string $id_cirugia [description]
	 * @return [type]             [description]
	 */
	public function detalles_archivo($id_cirugia='') {
		return $this->db
			->select(format_select(array(
				'material_osteosintesis.nombre'   => 'nombre',
				'material_osteosintesis.cantidad' => 'cantidad'
			)))
			->join('cirugia','stock.idCirugia = cirugia.idCirugia')
			->join('material_osteosintesis','material_osteosintesis.idMaterial_Osteosintesis = stock.idMaterial_Osteosintesis')
			->where('stock.idCirugia',$id_cirugia)
			->get('stock')
			->result_array();
	}

	/**
	 * [archivo Query:
	 * SELECT stock.idstock, stock.idCirugia, stock.fecha
	 * FROM stock
	 * JOIN cirugia ON stock.idCirugia = cirugia.idCirugia]
	 * @return [array] [Resultados o empty]
	 */
	public function archivo() {
		return $this->db
			->select(format_select(array(
				'stock.idstock'   => 'id_stock',
				'stock.idCirugia' => 'id_cirugia',
				'stock.fecha'     => 'fecha'
			)))
			->join('cirugia','stock.idCirugia = cirugia.idCirugia')
			->get('stock')
			->result_array();
	}

	public function empleado_ceye() {
		return $this->db
			->select(format_select(array(
				'usuario.idUsuario'         => 'id_usuario',
				'empleado.matricula'        => 'matricula',
				'empleado.nombre'           => 'nombre',
				'empleado.apellido_paterno' => 'a_paterno',
				'departamento.nombre'       => 'departamento'
			)))
			->join('usuario','empleado.idEmpleado = usuario.idEmpleado')
			->join('tipo_usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
			->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
			->where('departamento.nombre = "C.E.Y.E." AND empleado.status = "1"')
			->get('empleado')
			->result_array();
	}
  
	public function por_entregar() {
		 return $this->db
			->select(format_select(array(
				'cirugia.idCirugia'         => 'id_cirugia',
				'empleado.idEmpleado'       => 'id_empleado',
				'empleado.matricula'        => 'matricula',
				'CONCAT(empleado.nombre," ",empleado.apellido_paterno," ",empleado.apellido_materno)' => 'medico_tratante',
				'especialidad.nombre'       => 'especialidad'
			)),FALSE)
			->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario')
			->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
			->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
			->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
			->join('proceso_tipo_usuario','proceso_tipo_usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario')
			->join('proceso','proceso.idProceso = proceso_tipo_usuario.idProceso')
			->join('cirugia','cirugia.idProceso = proceso.idProceso AND cirugia.idModulo = "7"')
			->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia')
			->join('estado_cirugia','estado_cirugia.idEstado_Cirugia = estado_de_cirugia.idEstado_Cirugia')
			->where('cirugia.status = "1" AND estado_cirugia.estado = "Por Entregar"')
			->get('tipo_usuario')
			->result_array();
	}


	public function sin_existencia() {
		return $this->db
			->select(format_select(array(
				'cirugia.idCirugia'         => 'id_cirugia',
				'empleado.idEmpleado'       => 'id_empleado',
				'empleado.matricula'        => 'matricula',
				'CONCAT(empleado.nombre," ",empleado.apellido_paterno," ",empleado.apellido_materno)' => 'medico_tratante',
            'CONCAT(derechohabiente.nombre," ",derechohabiente.apellido_paterno," ",derechohabiente.apellido_materno)' => 'derechohabiente',
				'especialidad.nombre'       => 'especialidad'
			)),FALSE)
			->join('usuario','tipo_usuario.idTipo_Usuario = usuario.idTipo_Usuario AND usuario.idTipo_Usuario = "'.$this->config->item('modulo')['materiales_consumo'].'"')
			->join('empleado','empleado.idEmpleado = usuario.idEmpleado')
			->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
			->join('especialidad','especialidad.idEspecialidad = departamento.idEspecialidad')
			->join('cirugia','cirugia.status = "1" AND cirugia.idModulo = "'.$this->config->item('modulo')['materiales_consumo'].'" AND cirugia.idEmpleado = empleado.idEmpleado')
         ->join('derechohabiente','derechohabiente.idDerechohabiente = cirugia.idDerechohabiente')
         ->join('estado_de_cirugia','estado_de_cirugia.idCirugia = cirugia.idCirugia AND estado_de_cirugia.idEstado_Cirugia = "'.$this->config->item('estado_cirugia')['sin_existencia'].'" AND estado_de_cirugia.status = "1"')
			->get('tipo_usuario')
			->result_array();
	}


        public function _get_sistemas() {
            return $this->db
                    ->where('os_sistema_osteosintesis.prov_id=cs_proveedor.prov_id')
                    ->where("os_sistema_osteosintesis.sistema_status!='hidden'")
                    ->get('os_sistema_osteosintesis, cs_proveedor')
                    ->result_array();
        }
        public function _get_sistema($sistema) {
            return $this->db
                    ->where('os_sistema_osteosintesis.prov_id=cs_proveedor.prov_id')
                    ->where('os_sistema_osteosintesis.sistema_id',$sistema)
                    ->get('os_sistema_osteosintesis, cs_proveedor')
                    ->result_array();
        }
        public function _get_proveedores() {
            return $this->db
                    ->get('proveedor')
                    ->result_array();
        }
        public function _insert($tabla,$data) {
            return $this->db->insert($tabla,$data);
        }
        public function _update_sistema($sistema,$data) {
            return $this->db
                    ->where('os_sistema_osteosintesis.sistema_id',$sistema)
                    ->update('os_sistema_osteosintesis',$data);
        }
        public function _get_materiales_sistema($sistema) {
            return $this->db
                    ->where('os_sistema_osteosintesis.prov_id=cs_proveedor.prov_id')
                    ->where('os_sistema_osteosintesis.sistema_id=os_material_osteosintesis.sistema_id')
                    ->where('os_sistema_osteosintesis.sistema_id',$sistema)
                    //->where("os_sistema_osteosintesis.material_cantidad!=0")
                    ->get('os_sistema_osteosintesis, os_material_osteosintesis,cs_proveedor')
                    ->result_array();
        }
        public function _get_material_sistema($material) {
            return $this->db
                    ->where('os_sistema_osteosintesis.sistema_id=os_material_osteosintesis.sistema_id')
                    ->where('os_material_osteosintesis.material_id',$material)
                    ->get('os_sistema_osteosintesis, os_material_osteosintesis')
                    ->result_array();
        }
        public function _update_material($material,$data) {
            return $this->db
                    ->where('os_material_osteosintesis.material_id',$material)
                    ->update('os_material_osteosintesis',$data);
        }  
        public function _get_materiales_intermedios($material) {
            return $this->db
                    ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias.material_id')
                    ->where('os_material_osteosintesis.material_id',$material)
                    //->where("os_material_osteosintesis_intermedias.intermedia_cantidad!=0")
                    ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias')
                    ->result_array();
        }
        public function _get_material_intermedio($material_in) {
            return $this->db
                    ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias.material_id')
                    ->where('os_material_osteosintesis_intermedias.intermedia_id',$material_in)
                    ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias')
                    ->result_array();
        }
        public function _update_material_intermedio($material_int,$data) {
            return $this->db
                    ->where('os_material_osteosintesis_intermedias.intermedia_id',$material_int)
                    ->update('os_material_osteosintesis_intermedias',$data);
        } 
        public function _delete_material_intermedio($material_int) {
            return $this->db->where('os_material_osteosintesis_intermedias.intermedia_id',$material_int)
                    ->update('os_material_osteosintesis_intermedias',array('intermedia_status'=>'hidden'));
        }
        public function _delete_sistema($sistema) {
            $this->db
                    ->where('os_material_osteosintesis.sistema_id',$sistema)
                    ->update('os_material_osteosintesis',array('material_status'=>'hidden'));
            return $this->db->where('os_sistema_osteosintesis.sistema_id',$sistema)
                    ->update('os_sistema_osteosintesis',array('sistema_status'=>'hidden'));
        }
        public function _delete_material($material) {
            $this->db
                    ->where('os_material_osteosintesis_intermedias.material_id',$material)
                    ->update('os_material_osteosintesis_intermedias',array('intermedia_status'=>'hidden'));
            return $this->db->where('os_material_osteosintesis.material_id',$material)
                    ->update('os_material_osteosintesis',array('material_status'=>'hidden'));
        }
        public function _get_materiales_intermedios_by_sistema($sistema) {
            return $this->db
                    ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias.material_id')
                    ->where('os_material_osteosintesis.sistema_id=os_sistema_osteosintesis.sistema_id')
                    ->where('os_sistema_osteosintesis.sistema_id',$sistema)
                    ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias ,os_sistema_osteosintesis')
                    ->result_array();
        }
        public function _get_max_materialintermedio() {
            return $this->db
                    ->select_max('intermedia_id','intermedia_id')
                    ->get('os_material_osteosintesis_intermedias')
                    ->result_array();
        }
        public function _get_max_material() {
            return $this->db
                    ->select_max('material_id','material_id')
                    ->get('os_material_osteosintesis')
                    ->result_array();
        }
        public function _get_codigosbarrami($mi) {
            return $this->db
                    ->where('os_material_osteosintesis_intermedias.intermedia_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                    ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material intermedio')
                    ->where('os_material_osteosintesis_intermedias.intermedia_id',$mi)
                    ->get('os_material_osteosintesis_intermedias, os_material_osteosintesis_intermedias_cb')
                    ->result_array();
        }
        public function _get_codigosbarram($m) {
            return $this->db
                    ->where('os_material_osteosintesis.material_id=os_material_osteosintesis_intermedias_cb.intermedia_id')
                    ->where('os_material_osteosintesis_intermedias_cb.intermediocd_tipo','Material')
                    ->where('os_material_osteosintesis.material_id',$m)
                    ->get('os_material_osteosintesis, os_material_osteosintesis_intermedias_cb')
                    ->result_array();
        }
        public function _get_codigobarra($cb) {
            return $this->db
                    ->where('os_material_osteosintesis_intermedias_cb.intemediocd_id',$cb)
                    ->get(' os_material_osteosintesis_intermedias_cb')
                    ->result_array();
        } 
        public function _detele_materiale_inter($mi) {
            return $this->db
                    ->where('intermedia_id',$mi)
                    ->delete('os_material_osteosintesis_intermedias_cb');
        }
        public function _update_material_sol($material,$data) {
            return $this->db
                    ->where('material_id',$material)
                    ->update('os_material_osteosintesis',$data);
        }
        public function _get_material_m_entregar($sol) {
            return $this->db
                    ->where('os_material_osteosintesis_intermedias_cb.solicitud_id=os_solicitud_material_osteosintesis.solicitud')
                    ->where('os_solicitud_material_osteosintesis.solicitud',$sol)
                    ->get('os_material_osteosintesis_intermedias_cb, os_solicitud_material_osteosintesis')
                    ->result_array();
        }
}