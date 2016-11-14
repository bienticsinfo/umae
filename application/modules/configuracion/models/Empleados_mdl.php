<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empleados_mdl
 *
 * @author felipe de jesus
 */
class Empleados_mdl extends CI_Model{
    //put your code here
    public function _get_horarios($empleado) {
        return $this->db
                ->where('os_empleados.empleado_id=os_empleados_horarios.empleado_id')
                ->where('os_empleados.empleado_id',$empleado)
                ->get('os_empleados, os_empleados_horarios')
                ->result_array();
    }
    public function _get_horarios_all() {
        return $this->db
                ->where('os_empleados.empleado_id=os_empleados_horarios.empleado_id')
                ->get('os_empleados, os_empleados_horarios')
                ->result_array();
    }
    public function _get_empleados() {
        return $this->db
                ->get('os_empleados')
                ->result_array();
    }
}
