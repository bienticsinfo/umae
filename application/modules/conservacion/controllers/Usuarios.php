<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Usuarios extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']=  $this->usuario_mdl->_get_users();
        $this->load->view('usuarios/usuario_gestion',$sql);
    }
    public function add() {
        $sql['info']=  $this->usuario_mdl->get_user_data($_GET['u']);
        $this->load->view('usuarios/usuario_add',$sql);
    }
    public function insert_usuario() {
        $data=array(
            'usuario_nombre'    =>  $this->input->post('txtNombre'),
            'usuario_apellidos' =>  $this->input->post('txtApellidos'),
            'usuario_direccion' =>  $this->input->post('txtDireccion'),
            'usuario_telefono'  =>  $this->input->post('txtTelefono'),
            'usuario_email'     =>  $this->input->post('txtEmail'),
            'usuario_user'      =>  $this->input->post('txtUsuario'),
            'usuario_pass'      => md5($this->input->post('txtContra')), 
            'usuario_perfil'    =>  'default.jpg',
            'usuario_status'    =>  'Activo',
            'rol_id'            =>  $this->input->post('txtRol')
        );
        if($this->input->post('txtAccion')=='add'){
            $sql=  $this->usuario_mdl->_insert_data('cs_usuarios',$data);
            if($sql){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            if($this->input->post('txtContra')==''){
                unset($data['usuario_pass']);
            }
            $sql=  $this->usuario_mdl->_update_user($data,  $this->input->post('txtId'));
            if($sql){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            } 
        }
    }//
    public function delete_user() {
        if($this->usuario_mdl->_delete_user($this->input->post('user'))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function check_user() {
        if(empty($this->usuario_mdl->_check_user($this->input->post('user')))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function bloquer_user() {
        $data=array('usuario_status'=>  $this->input->post('accion'));
        $sql=  $this->usuario_mdl->_update_user($data,  $this->input->post('id'));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        } 
    }
}
