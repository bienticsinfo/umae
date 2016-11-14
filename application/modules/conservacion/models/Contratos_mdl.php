<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contratos_mdl
 *
 * @author felipe de jesus
 */
class Contratos_mdl extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function _get_contratos() {
        return $this->db
                ->where('cs_contrato.proveedor_id=cs_proveedor.prov_id')
                ->where('cs_contrato.hospital_id=cs_hospital.hospital_id')
                ->where('cs_especialidad.especialidad_id=cs_subespecialidad.especialidad_id')
                ->where('cs_contrato.subesp_id=cs_subespecialidad.subesp_id')
                ->get('cs_contrato, cs_proveedor, cs_hospital, cs_especialidad, cs_subespecialidad')
                ->result_array();
    }
    public function _get_contrato($contrato) {
        return $this->db
                ->where('cs_contrato.proveedor_id=cs_proveedor.prov_id')
                ->where('cs_contrato.hospital_id=cs_hospital.hospital_id')
                ->where('cs_especialidad.especialidad_id=cs_subespecialidad.especialidad_id')
                ->where('cs_contrato.subesp_id=cs_subespecialidad.subesp_id')
                ->where('contrato_id',$contrato)
                ->get('cs_contrato, cs_proveedor, cs_hospital, cs_especialidad, cs_subespecialidad')
                ->result_array();
    }
    public function _insert($tabla,$data) {
        return $this->db
                ->insert($tabla,$data);
    }
    public function _max_contrato() {
        return $this->db
                ->query('SELECT MAX(cs_contrato.contrato_id) AS id FROM cs_contrato')
                ->result_array();
    }
    public function _get_hospitales() {
        return $this->db
                ->get('cs_hospital')
                ->result_array();
    }
    public function _get_especialidad() {
        return $this->db
                ->get('cs_especialidad')
                ->result_array();
    }
    public function _get_sub_especialidad($especialidad) {
        return $this->db
                ->where('cs_especialidad.especialidad_id=cs_subespecialidad.especialidad_id')
                ->where('cs_especialidad.especialidad_id',$especialidad)
                ->get('cs_especialidad,cs_subespecialidad')
                ->result_array();
    }
    public function _get_proveedores() {
        return $this->db
                ->get('cs_proveedor')
                ->result_array();
    }
    public function _update_status($status,$contrado) {
        return $this->db
                ->where('contrato_id',$contrado)
                ->update('cs_contrato',array('contrato_status'=>$status));
    }
    public function _contrato_c_f($contrado) {
        return $this->db
                ->where('contrato_id',$contrado)
                ->update('cs_contrato',array('contrato_c_f'=>'OK'));
    }
    public function _contrato_c_i($contrado) {
        return $this->db
                ->where('contrato_id',$contrado)
                ->update('cs_contrato',array('contrato_c_i'=>'OK'));
    }
    public function _contrato_c_s($contrado) {
        return $this->db
                ->where('contrato_id',$contrado)
                ->update('cs_contrato',array('contrato_c_s'=>'OK'));
    }
    public function _contrato_s_d($contrado) {
        return $this->db
                ->where('contrato_id',$contrado)
                ->update('cs_contrato',array('contrato_s_d'=>'OK'));
    }
    //
    public function _get_prei($contrato) {
        return $this->db
                ->where('cs_contrato.contrato_id=cs_prei.contrato_id')
                ->where('cs_contrato.contrato_id',$contrato)
                ->get('cs_contrato, cs_prei')
                ->result_array();
      
    }
    public function _get_res($hospital) {
        return $this->db
                ->where('cs_hospital.hospital_id=cs_hospital_responsables.hospital_id')
                ->where('cs_hospital.hospital_id',$hospital)
                ->get('cs_hospital, cs_hospital_responsables')
                ->result_array();
    }
    public function get_caratulas($contrato){
        return $this->db
                ->query("SELECT * FROM cs_contrato,cs_caratulas WHERE 
                    cs_caratulas.contrato_id=cs_contrato.contrato_id AND
                    cs_contrato.contrato_id=$contrato AND cs_caratulas.caratula_tipo_garantia!=''")
                ->result_array();
    }
    public function _delete_contrato($contrato) {
        $this->db->where('contrato_id',$contrato)->delete('cs_caratulas');
        $this->db->where('contrato_id',$contrato)->delete('cs_contrato_proveedor');
        $this->db->where('contrato_id',$contrato)->delete('cs_dictamen');
        $this->db->where('contrato_id',$contrato)->delete('cs_dictamenprevio');
        $this->db->where('contrato_id',$contrato)->delete('cs_prei');
        return $this->db->where('contrato_id',$contrato)->delete('cs_contrato');
    }
}
