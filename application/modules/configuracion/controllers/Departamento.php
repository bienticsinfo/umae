<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento extends MX_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('Departamento_m');
   }

   public function index() {
      $data['assets'] = minify(array('departamento.js'),'',FALSE);
      $this->load->view('departamento/index',$data);
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------

   public function eliminar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_departamento', 'ID departamento', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
         }
         else {
            $post = $this->input->post();
            Modules::run('master/update','departamento',array('status' => '0'),array(
               'idDepartamento' => $post['id_departamento']
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
         $this->form_validation->set_rules('nombre', 'departamento', 'trim|required|max_length[80]');
         $this->form_validation->set_rules('idEspecialidad', 'ID especialidad', 'trim|required|integer');
         $this->form_validation->set_rules('id_departamento', 'ID departamento', 'trim|required|integer');
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
            Modules::run('master/update','departamento',elements(array('nombre','idEspecialidad'),$post),array(
               'idDepartamento' => $post['id_departamento']
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

   public function departamento_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_departamento', 'departamento', 'trim|required');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $departamento = $this->Departamento_m->departamento_por_id($this->input->post('id_departamento'));
            $especialidades = Modules::run('master/filas',array('tabla' => 'especialidad'));
            if (!empty($departamento)) {
               $departamento = html_purify($departamento);
               $especialidades = html_purify($especialidades);
               $option = '<option value="">Seleccionar</option>';
               foreach ($especialidades as $value) {
                  $option .= '<option value="'.$value['idEspecialidad'].'">'.$value['nombre'].'</option>';
               }
               $json = (array(
                  'action'          => '1',
                  'id'              => $departamento[0]['id_departamento'],
                  'departamento'    => $departamento[0]['departamento'],
                  'id_especialidad' => $departamento[0]['id_especialidad'],
                  'option'          => $option
               )); // Success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Departamento no encontrado'
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
         $this->form_validation->set_rules('nombre', 'Departamento', 'trim|required|max_length[80]');
         $this->form_validation->set_rules('idEspecialidad', 'ID especialidad', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            // INSERT INTO departamento (idEspecialidad, nombre) VALUES ("<ID_ESPECIALIDAD>", "<NOMBRE_DEPARTAMENTO>")
            Modules::run('master/insert','departamento',$this->input->post());
            $json = array(
               'action' => '1'
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function especialidades() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $especialidades = Modules::run('master/filas',array('tabla' => 'especialidad'));
         if (!empty($especialidades)) {
            $especialidades = html_purify($especialidades);
            $option = '<option value="">Seleccionar</option>';
            foreach ($especialidades as $value) {
               $option .= '<option value="'.$value['idEspecialidad'].'">'.$value['nombre'].'</option>';
            }
            $json = (array(
               'action' => '1',
               'option' => $option
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'Especialidades no encontradas'
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }  
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function consulta_filtrada() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('busqueda', 'Departamento o especialidad', 'trim|required');
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
            $departamentos = array();
            switch ($post['tipo_busqueda']) {
               case '1':
                  $departamentos = $this->Departamento_m->consulta_por_departamento($post['busqueda']);
                  break;
               case '2':
                  $departamentos = $this->Departamento_m->consulta_por_especialidad($post['busqueda']);
                  break;
               default: 
                  $json = (array(
                     'action' => '2',
                     'msj'    => 'Búsqueda no valida'
                  )); // Error búsqueda
                  $this->output->set_content_type('application/json')->set_output(json_encode($json));
                  exit();
            }
            if (!empty($departamentos)) {
               $departamentos = html_purify($departamentos);
               $tr = '';
               foreach ($departamentos as $value) {
                  $tr .= 
                  '<tr data-id-departamento="'.$value['id_departamento'].'">
                     <td class="text-center">'.$value['id_departamento'].'</td>
                     <td>'.$value['departamento'].'</td>
                     <td>'.$value['especialidad'].'</td>
                     <td>
                        <div class="text-center">
                           <div class="row">
                           <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
                           <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>   
                           </div>
                        </div>
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
                  'msj'    => 'Departamentos no encontrados'
               )); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function consulta() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $departamentos = $this->Departamento_m->consulta();
         if (!empty($departamentos)) {
            $departamentos = html_purify($departamentos);
            $tr = '';
            foreach ($departamentos as $value) {
               $tr .= 
               '<tr data-id-departamento="'.$value['id_departamento'].'">
                  <td class="text-center">'.$value['id_departamento'].'</td>
                  <td>'.$value['departamento'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td>
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
                        <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>   
                        </div>
                     </div>
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
               'msj'    => 'Departamentos no encontrados'
            )); // Error 404
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

}

/* End of file Departamento.php */
/* Location: ./application/modules/configuracion/controllers/Departamento.php */