<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_m extends CI_Model {

   public  function __construct(){
        parent::__construct();
    }

   public function getLastId($idColumna,$tabla) {
      return $this->db
         ->select_max($idColumna,'last_id')
         ->get($tabla)
         ->result_array();    
   } 
    
    /**
     * [filas_c Query: SELECT $select FROM $tabla WHERE $donde]
     * @param  boolean/string       $tabla  [Nombre de la tabla]
     * @param  boolean/string/array $donde  [Condiciones]
     * @param  string               $select [select]
     * @return [FALSE/array]                [Resultados o FALSE en caso de error]
     */
    public function filas_c($tabla=FALSE, $donde=FALSE, $select='*'){
        if ($tabla || $donde)
            return $this->db
                ->select($select)
                ->get_where($tabla,$donde)
                ->result_array();
        else 
            return FALSE;
    }

    /**
     * [filas Query: SELECT * FROM $tabla]
     * @param  boolean/string $tabla [Nombre de la tabla]
     * @return [FALSE/array]         [Resultafos o FALSE en caso de error]
     */
    public function filas($tabla=FALSE){
        if ($tabla)
            return $this->db->get($tabla)->result_array(); 
        else
            return FALSE;
    }

    /**
     * [insert Query: INSERT INTO $tabla (columnas) VALUES $datos]
     * @param  boolean/string       $tabla [Nombre de la tabla]
     * @param  boolean/string/array $datos [Datos a insert]
     * @return [FALSE/void]                [FALSE en caso de error]
     */
    public function insert($tabla=FALSE, $datos=FALSE){
        if ($tabla or $datos)
           $this->db->insert($tabla, $datos);
        else
            return FALSE;
    }

    /**
     * [update Query: UPDATE $tabla SET $datos WHERE $condiciones]
     * @param  boolean/string       $tabla       [Nombre de la tabla]
     * @param  boolean/string/array $datos       [Datos a actualizar]
     * @param  boolean/string/array $condiciones [Condiciones]
     * @return [FALSE/void]                      [FALSE en caso de error]
     */
    public function update($tabla=FALSE, $datos=FALSE, $condiciones=FALSE ){
        if ($tabla or $datos or $condiciones)
            $this->db->update($tabla, $datos, $condiciones);
        else
            return FALSE;
    }
    
}