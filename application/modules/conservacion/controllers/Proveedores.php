<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedores
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Proveedores extends Config{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $sql['Gestion']=  $this->contratos_mdl->_get_proveedores();
        $this->load->view('proveedores/proveedores_gestion',$sql);
    }
    public function agregar() {
        $this->load->view('proveedores/proveedores_agregar');
    }
    public function nuevoproveedor() {
        $sql=  $this->contratos_mdl->_insert('cs_proveedor',  $this->input->post());
        if($sql){
            echo'<script>
                    alert("REGISTRO GUARDADO CORRECTAMENTE");
                    location.href="'.  base_url().'conservacion/proveedores";
                </script>';
        }else{
            echo'<script>
                    alert("ERROR AL GUARDAR EL REGISTRO ");
                    location.href="'.  base_url().'conservacion/proveedores";
                </script>';
        }
    }
    public function delete_proveedor() {
        $sql=  $this->proveedores_mdl->_delete_proveedor($this->input->post('id'));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
