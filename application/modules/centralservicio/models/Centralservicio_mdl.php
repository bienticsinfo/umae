<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Centralservicio_mdl
 *
 * @author felipe de jesus
 */
class Centralservicio_mdl extends CI_Model{
    //put your code here
    public function _get_programacion() {
        return $this->db
                ->where('os_derechohabiente.derechohabiente_id=os_programaciones.derechohabiente_id')
                ->order_by('programacion_id','DESC')
                ->get('os_derechohabiente, os_programaciones')
                ->result_array();
    }
    public function _get_programacion_cs() {
        return $this->db
                ->where('os_empleados.empleado_id=os_programaciones.empleado_id')
                ->where('os_derechohabiente.derechohabiente_id=os_programaciones.derechohabiente_id')
                ->where('os_empleados.empleado_id',$_SESSION['sess']['idUsuario'])
                ->order_by('programacion_id','DESC')
                ->get('os_derechohabiente, os_programaciones,os_empleados')
                ->result_array();
    }
    public function _get_programacion_data($pro) {
        return $this->db
                ->where('os_derechohabiente.derechohabiente_id=os_programaciones.derechohabiente_id')
                ->where('os_programaciones.programacion_id',$pro)
                ->get('os_derechohabiente, os_programaciones')
                ->result_array();
    }
    public function _get_terapias($t) {
        return $this->db
                ->where('os_tratamientos.tratamiento_id= os_tratamientos_terapias.tratamiento_id')
                ->where('os_tratamientos.tratamiento_id',$t)
                ->get('os_tratamientos, os_tratamientos_terapias')
                ->result_array();
    }
    public function _get_tratamientos() {
        return $this->db
                ->where('os_empleados.empleado_id=os_tratamientos.empleado_id')
                ->get('os_empleados, os_tratamientos')
                ->result_array();
    }
    public function _get_terapias_coordinador($pro) {
        return $this->db
                ->where('os_programaciones.programacion_id=os_programacion_tratamientos.programacion_id')
                ->where('os_programacion_tratamientos.tratamiento_id=os_tratamientos.tratamiento_id')
                ->where('os_programacion_tratamientos.terapia_id=os_tratamientos_terapias.terapia_id')
                ->where('os_programaciones.programacion_id',$pro)
                ->get('os_programacion_tratamientos, os_programaciones, os_tratamientos, os_tratamientos_terapias')
                ->result_array();
    }    
    public function _get_fechas_terapias($t) {
        return $this->db
                ->where('os_tratamientos.tratamiento_id=os_tratamientos_terapias.tratamiento_id')
                ->where('os_programaciones_fechas_terapias.terapia_id=os_tratamientos_terapias.terapia_id')
                ->where('os_tratamientos_terapias.terapia_id',$t)
                ->get('os_tratamientos, os_tratamientos_terapias, os_programaciones_fechas_terapias')
                ->result_array();
    }
    public function _get_fechas_terapias_ll($prog) {
        return $this->db
                ->where('os_programaciones.programacion_id=os_programacion_tratamientos.programacion_id')
                ->where('os_programacion_tratamientos.tratamiento_id=os_tratamientos.tratamiento_id')
                ->where('os_programacion_tratamientos.terapia_id=os_tratamientos_terapias.terapia_id')
                ->where('os_tratamientos.tratamiento_id=os_tratamientos_terapias.tratamiento_id')
                ->where('os_programaciones_fechas_terapias.terapia_id=os_tratamientos_terapias.terapia_id')
                ->where('os_programaciones.programacion_id',$prog)
                ->get('os_programaciones, os_programacion_tratamientos, os_programaciones_fechas_terapias, os_tratamientos, os_tratamientos_terapias')
                ->result_array();
    }
}
