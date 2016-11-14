<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MX_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Master_m');
	}

	/**
	 * Ejecuta la función filas_c en el modelo Master_m
	 * @param  [Array] $parametros [Contiene: nombre_tabla,condiciones]
	 * @return [Array]             [Resultados]
	 */
	public function filas_c($parametros) {
		return $this->Master_m->filas_c($parametros['tabla'],$parametros['condicion'],($parametros['select'] == null ?'*':$parametros['select']));
	}

	/**
	 * Ejecuta la función filas en el modelo Master_m
	 * @param  [Array] $parametros [Contiene: nombre_tabla]
	 * @return [Array]             [Resultados]
	 */
	public function filas($parametros) {
		return $this->Master_m->filas($parametros['tabla']);
	}

	/**
	 * [insert Ejecuta la función insert en el modelo Master_m]
	 * @param  [string] 			$tabla [Nombre de la tabla]
	 * @param  [array/string]  $data  [Datos a insertar]
	 * @return [false/void]         	 [false en caso de error]
	 */
	public function insert($tabla,$data) {
		return $this->Master_m->insert($tabla,$data);
	}

	/**
	 * [update Ejecuta la función update en el modelo Master_m]
	 * @param  [string] 		  $tabla 		[Nombre la tabla]
	 * @param  [array/string] $data  		[Datos a actualizar]
	 * @param  [array/string] $condiciones [Condiciones]
	 * @return [false/void]              	[false en caso de error]
	 */
	public function update($tabla,$data,$condiciones) {
		return $this->Master_m->update($tabla,$data,$condiciones);
	}

   public function last_id($idColumna='',$tabla) {
      $resultado = $this->Master_m->getLastId($idColumna,$tabla);
      if (!empty($resultado)) {
         return $resultado[0]['last_id'];
      }
      return FALSE;
   }

}