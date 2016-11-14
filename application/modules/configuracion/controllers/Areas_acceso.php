<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Areas_acceso
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Areas_acceso extends Config{
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_areas_acceso');
        $this->load->view('areas_acceso/index',$sql);
    }
    public function add_area() {
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('os_areas_acceso',array(
                'areas_acceso_nombre'=>  $this->input->post('areas_acceso_nombre')
            ))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            if($this->config_mdl->_update_data('os_areas_acceso',
                array('areas_acceso_nombre'=>  $this->input->post('areas_acceso_nombre')),
                array('areas_acces_id'=>  $this->input->post('areas_acces_id')))
            ){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    public function get_data() {
        $this->setOutput($this->config_mdl->_get_data_condition('os_areas_acceso',array('areas_acces_id'=>  $this->input->post('areas_acces_id'))));
    }
    public function delete_area() {
        if($this->config_mdl->_delete_data('os_areas_acceso',array('areas_acces_id'=>  $this->input->post('areas_acces_id')))
        ){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
