<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/config/controllers/Config.php';
class Derechohabiente extends Config {
    public function __construct(){
        parent::__construct();
        $this->load->model('Derechohabiente_m');
        $this->load->model('materiales_consumo/Almacen_osteo_m');
    }
    public function index() {
        $data['Gestion'] = $this->Derechohabiente_m->_get_derechohabiente();
        $this->load->view('derechohabiente/index',$data);
    }

    public function insert_derechohabiente() {
        $data=array(
            'derechohabiente_nss'=>  $this->input->post('derechohabiente_nss'),
            'derechohabiente_nombre'=>  $this->input->post('derechohabiente_nombre'),
            'derechohabiente_apat'=>  $this->input->post('derechohabiente_apat'),
            'derechohabiente_amat'=>  $this->input->post('derechohabiente_amat')
        );
        if($this->input->post('accion')=='add'){
            $sql=  $this->Almacen_osteo_m->_insert('os_derechohabiente',$data);
            if($sql){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $sql=  $this->Derechohabiente_m->_update_derechohabiente($this->input->post('derechohabiente_id'),$data);
            if($sql){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            } 
        }
    }
    public function get_derechohabiente_id() {
        $this->setOutput($this->Derechohabiente_m->_get_derechohabiente_($this->input->post('id')));       
    }
    public function delete_derechohabiente() {
        $sql=  $this->Derechohabiente_m->_delete_derechohabiente($this->input->post('id'));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }    
    }
   public function derechohabiente_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_usuario', 'ID derechohabiente', 'trim|required');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $derechohabiente = Modules::run('master/filas_c',array(
               'tabla'     => 'derechohabiente',
               'condicion' => array(
                  'idDerechohabiente' => $this->input->post('id_usuario'),
                  'status'            => '1'
               )));
            if (!empty($derechohabiente)) {
               $derechohabiente = html_purify($derechohabiente);
               $json = (array(
                  'action'           => '1',
                  'id'               => $derechohabiente[0]['idDerechohabiente'],
                  'nss'              => $derechohabiente[0]['nss'],
                  'nombre'           => $derechohabiente[0]['nombre'],
                  'apellido_paterno' => $derechohabiente[0]['apellido_paterno'],
                  'apellido_materno' => $derechohabiente[0]['apellido_materno']
               )); // Error success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Derechohabiente no encontrado'
               )); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [update description]
    * @return [type] [description]
    */
   public function update() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('nss', 'NSS', 'trim|required|max_length[20]');
         $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[80]');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            Modules::run('master/update','derechohabiente',array(
               'nss'              => $post['nss'],
               'nombre'           => $post['nombre'],
               'apellido_paterno' => $post['a_paterno'],
               'apellido_materno' => $post['a_materno']
            ),array(
               'idDerechohabiente' => $post['id_usuario']
            ));
            $json = (array(
               'action' => '1',
               'msj'    => 'Success'
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [insert description]
    * @return [type] [description]
    */
   public function insert() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
      	$this->form_validation->set_rules('nss', 'NSS', 'trim|required|max_length[20]');
      	$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[80]');
      	$this->form_validation->set_rules('a_paterno', 'Apellido paterno', 'trim|required|max_length[40]');
      	$this->form_validation->set_rules('a_materno', 'Apellido materno', 'trim|required|max_length[40]');
      	$this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
         	$post = $this->input->post();
         	// INSERT INTO 
         	// derechohabiente (nss, nombre, apellido_paterno, apellido_materno) 
         	// VALUES ("<NSS>", "<NOMBRE>", "<APELLIDO_PATERNO>", "<APELLIDO_MATERNO>")
         	Modules::run('master/insert','derechohabiente',array(
					'nss'              => $post['nss'],
					'nombre'           => $post['nombre'],
					'apellido_paterno' => $post['a_paterno'],
					'apellido_materno' => $post['a_materno']
            ));
            $json = (array(
               'action' => '1',
               'msj'    => 'Success'
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
      	redirect('inicio/index','refresh');
      }
   }

   /**
    * [consulta_filtrada Consulta derechohabientes por filtros]
    * @return [json] [action : que va hacer
    *                 tr     : lista de 
    *                 msj    : Mensaje del error]
    */
   public function consulta_filtrada() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('busqueda', 'NSS o Nombre', 'trim|required');
         $this->form_validation->set_rules('tipo_busqueda', 'Tipo de búsqueda', 'trim|required');
         $this->form_validation->set_error_delimiters('','');
          if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            $derechohabiente = array();
            switch ($post['tipo_busqueda']) {
               case '1':
                  $derechohabiente = $this->Derechohabiente_m->consulta_por_nss($post['busqueda']);
                  break;
               case '2':
                  $derechohabiente = $this->Derechohabiente_m->consulta_por_nombre($post['busqueda']);
                  break;
               default: 
                  $json = (array(
                     'action' => '2',
                     'msj'    => 'Búsqueda no valida'
                  )); // Error búsqueda
                  $this->output->set_content_type('application/json')->set_output(json_encode($json));
                  exit();
            }
            if (!empty($derechohabiente)) {
               $derechohabiente = html_purify($derechohabiente);
               $tr = '';
               foreach ($derechohabiente as $value) {
                  $tr .= 
                  '<tr data-id-usuario="'.$value['idDerechohabiente'].'">
                     <td class="text-center">'.$value['nss'].'</td>
                     <td>'.$value['nombre'].'</td>
                     <td>'.$value['apellido_paterno'].'</td>
                     <td>'.$value['apellido_materno'].'</td>
                     <td class="iconos-acciones iconos-2">
                        <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
                        <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>   
                     </td>
                  </tr>';
               }
               $json = (array(
                  'action' => '1',
                  'tr'    => $tr
               )); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Derechohabiente no encontrado'
               )); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [consulta Retorna <tr> del derechohabiente]
    * @return [json] [action : que va hacer
    *                 tr     : lista de 
    *                 msj    : Mensaje del error]
    */
   public function consulta() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $derechohabientes = $this->getDerechohabientes();
         if ($derechohabientes != '') {
            $json = array(
            'action' => '1',
               'derechohabientes'    => $derechohabientes
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'Derechohabiente no encontrado'
            ); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   // ------------------------------
   // - Fin de peticiones AJAX
   // ------------------------------

   private function getDerechohabientes() {
      $derechohabiente = $this->Derechohabiente_m->consulta();
      if (!empty($derechohabiente)) {
         $derechohabiente = html_purify($derechohabiente);
         $derechohabiente = $this->tables->addCellValue($derechohabiente,'accion',
            '<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i><i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>'
         );
         $derechohabiente = $this->tables->setAttr($derechohabiente,[
            'tr' => ['data-id-usuario'=>'idDerechohabiente'],
            'nss' => ['class'=>'text-center'],
            'accion' => ['class' => 'iconos-acciones iconos-2']
         ]);  
         $this->tables->noAttr = ['idDerechohabiente','status'];
         return $this->tables->generate($derechohabiente,'tbodyTr');
      } 
      else {
         return '';
      }
   }

}

/* End of file Derechohabiente.php */
/* Location: ./application/modules/configuracion/controllers/Derechohabiente.php */