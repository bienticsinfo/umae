<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'modules/config/controllers/Config.php';
   class Inicio extends Config {
      
      public function __construct() {
         parent::__construct();
         $this->load->model('Inicio_m');
      }
    public function index() {
        //$this->actualiza_datos();
        $this->load->view('inicio');
    }

    public function obtenerUserT(){
        $sql=  $this->Inicio_m->obtenerUser();
        $sql_info='';
        foreach ($sql->result_array() as $value) {
            $sql_info.= 
               '<tr data-no-cirugia="'.$value['idUsuario'].'">
                  <td class="text-center">'.$value['idUsuario'].'</td>
                  <td>'.$value['usuario'].'</td>
               </tr>';
        }
        $json=array("tr"=>$sql_info,"msj"=>"Mensaje de Prueba",'action'=>'1');
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
   }
   public function notificaciones_total() {
       $sql=  $this->config_mdl->_get_data_condition('os_notificaciones',array(
           'notificacion_status'=>'Nuevo'
       ));
       $total=0;
       foreach ($sql as $value) {
           if(in_array($value['notificacion_para'], $_SESSION['IMSS_ROLES'])){
               $total=$total+1;
           }
          
       }
       $this->setOutput(array('total'=>$total));
       //$this->setOutput(array(''));
   }
}

/* End of file Index.php */
/* Location: ./application/modules/inicio/controllers/Index.php */