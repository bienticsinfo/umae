<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/config/controllers/Config.php';
class Equipos extends Config {
    function __construct() {
        parent::__construct();
        $this->load->model('Equipos_m');
        $this->load->model('config/config_mdl');
    }

    public function index() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_equipo');
        $this->load->view('equipos/index',$sql);
    }
    public function insert_equipos() {
        $data=array(
            'equipo_ip'=>  $this->input->post('equipo_ip')
        );
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('os_equipo',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            if($this->config_mdl->_update_data('os_equipo',$data,array('equipo_id'=>  $this->input->post('equipo_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    public function get_equipo() {
        $this->setOutput($this->config_mdl->_get_data_condition('os_equipo',array('equipo_id'=>  $this->input->post('id'))));
    }
    public function delete_equipo() {
        if($this->config_mdl->_delete_data('os_equipo',array('equipo_id'=>  $this->input->post('id')))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }

}
