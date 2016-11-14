<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quirofano extends MX_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('Quirofano_m');
   }

   public function index() {
      $this->load->view('quirofano/index');
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------

   public function eliminar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_quirofano', 'ID equipo', 'trim|required|integer');
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
            Modules::run('master/update','quirofano',array('status' => '0'),array(
               'idquirofano' => $post['id_quirofano']
            ));
            $json = (array(
               'action' => '1'
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function update() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('nombre', 'quirófano', 'trim|required|max_length[45]');
         $this->form_validation->set_rules('id_quirofano', 'ID equipo', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode());
         }
         else {
            $post = $this->input->post();
            Modules::run('master/update','quirofano',elements(array('nombre'),$post),array(
               'idquirofano' => $post['id_quirofano']
            ));
            $json = (array(
               'action' => '1'
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function quirofano_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_quirofano', 'ID quirófano', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $quirofano = Modules::run('master/filas_c',array(
               'tabla'     => 'quirofano',
               'condicion' => array(
                  'status'      => '1',
                  'idquirofano' => $this->input->post('id_quirofano')
               )
            ));
            if (!empty($quirofano)) {
               $quirofano = html_purify($quirofano);
               $json = (array(
                  'action' => '1',
                  'id'     => $quirofano[0]['idquirofano'],
                  'nombre' => $quirofano[0]['nombre']
               )); // Success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Quirófano no encontrado'
               )); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function insert() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('nombre', 'quirófano', 'trim|required|max_length[45]');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // INSERT INTO quirofano (nombre) VALUES ("<EQUIPO>")
            Modules::run('master/insert','quirofano',$this->input->post());
            $json = (array(
               'action' => '1'
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function consulta() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofanos = $this->getQuirofanos();
         if ($quirofanos != '') {
            $json = array(
               'action'     => '1',
               'quirofanos' => $quirofanos
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }  
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'Quirófanos no encontrados'
            ); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   // ------------------------------
   // - Fin peticiones de AJAX
   // ------------------------------

   private function getQuirofanos() {
      $quirofanos = $this->Quirofano_m->consulta();
      if (!empty($quirofanos)) {
         $quirofanos = html_purify($quirofanos);
         $quirofanos = $this->tables->addCellValue($quirofanos,'accion','<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i><i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>');
         $quirofanos = $this->tables->setAttr($quirofanos,[
            'tr' => ['data-id-quirofano'=>'idquirofano'],
            'nombre' => ['class'=>'text-center'],
            'accion' => ['class'=>'iconos-acciones iconos-2']
         ]);   
         $this->tables->noAttr = ['idquirofano'];
         return $this->tables->generate($quirofanos,'tbodyTr');
         // $tr = '';
         // foreach ($quirofanos as $value) {
         //    $tr .= 
         //    '<tr data-id-quirofano="'.$value['idquirofano'].'">
         //       <td class="text-center">'.$value['nombre'].'</td>
         //       <td class="iconos-acciones iconos-2">
         //          <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
         //          <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>   
         //       </td>
         //    </tr>';
         // }
         // return $tr;
      } 
      else {
         return '';
      }
   }

}

/* End of file Quirofano.php */
/* Location: ./application/modules/configuracion/controllers/Quirofano.php */