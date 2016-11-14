<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'modules/config/controllers/Config.php';
class Tipo_de_usuario extends Config {
    function __construct() {
        parent::__construct();
        $this->load->model('Tipo_usuario_m');
    }
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_get_data('tipo_usuario');
        $this->load->view('tipo_usuario/index',$sql);
    }
    public function add_rol() {
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('tipo_usuario',array(
                'tipo'=>  $this->input->post('tipo_rol'),
                'rol_status'=>'1'
            ))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            if($this->config_mdl->_update_data('tipo_usuario',
                array('tipo'=>  $this->input->post('tipo_rol')),
                array('idTipo_Usuario'=>  $this->input->post('idTipo_Usuario')))
            ){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    public function get_data() {
        $this->setOutput($this->config_mdl->_get_data_condition('tipo_usuario',array('idTipo_Usuario'=>  $this->input->post('idTipo_Usuario'))));
    }
    public function delete_rol() {
            if($this->config_mdl->_update_data('tipo_usuario',
                array('rol_status'=>  'hidden'),
                array('idTipo_Usuario'=>  $this->input->post('idTipo_Usuario')))
            ){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
    }
}