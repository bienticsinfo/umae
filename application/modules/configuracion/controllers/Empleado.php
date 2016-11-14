<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends MX_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('Empleado_m');
   }

   public function index() {
      $data['empleados'] = $this->getEmpleados();
      $this->load->view('empleado/index',$data);
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------

   public function update() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         if ($this->input->post('matricula') != $this->input->post('old_matricula')) {
            $this->form_validation->set_rules('matricula','matrícula','trim|required|max_length[100]|is_unique[empleado.matricula]');
         }
         $this->form_validation->set_rules('nombre','nombre','trim|required|max_length[80]');
         $this->form_validation->set_rules('apellido_paterno','apellido paterno','trim|required|max_length[40]');
         $this->form_validation->set_rules('apellido_materno','apellido materno','trim|required|max_length[40]');
         $this->form_validation->set_rules('fecha_nacimiento','fecha de nacimiento','trim|required');
         $this->form_validation->set_rules('sexo','sexo','trim|required|integer');
         $this->form_validation->set_rules('lugar_nacimiento','lugar de nacimiento','trim|required|max_length[50]');
         $this->form_validation->set_rules('direccion','dirección','trim|required');
         $this->form_validation->set_rules('telefono','teléfono','trim|required|max_length[15]');
         $this->form_validation->set_rules('celular','celular','trim|required|max_length[20]');
         $this->form_validation->set_rules('email','correo electrónico','trim|required|valid_email|max_length[130]');
         $this->form_validation->set_rules('id_empleado','ID empleado','trim|required|integer');
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
            Modules::run('master/update','empleado',
               elements(array(
                  'matricula',
                  'nombre',
                  'apellido_paterno',
                  'apellido_materno',
                  'fecha_nacimiento',
                  'sexo',
                  'lugar_nacimiento'),$post
               ),
               array(
                  'idEmpleado' => $post['id_empleado']
               )
            );
            Modules::run('master/update','directorio',elements(array('direccion','telefono','celular','email'),$post),array('idEmpleado' => $post['id_empleado']));
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

   public function empleado_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_empleado', 'ID empleado', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $empleado = $this->Empleado_m->empleado_por_id($this->input->post('id_empleado'));
            if (!empty($empleado)) {
               $empleado = html_purify($empleado);
               $json = array(
                  'action'       => '1',
                  'id'           => $empleado[0]['id_empleado'],
                  'matricula'    => $empleado[0]['matricula'],
                  'nombre'       => $empleado[0]['nombre'],
                  'a_paterno'    => $empleado[0]['a_paterno'],
                  'a_materno'    => $empleado[0]['a_materno'],
                  'f_nacimiento' => $empleado[0]['f_nacimiento'],
                  'l_nacimiento' => $empleado[0]['l_nacimiento'],
                  'sexo'         => $empleado[0]['sexo'],
                  'direccion'    => $empleado[0]['direccion'],
                  'telefono'     => $empleado[0]['telefono'],
                  'celular'      => $empleado[0]['celular'],
                  'correo'       => $empleado[0]['correo'],
               ); // Success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Empleado no encontrado'
               ); // Error 404
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
         $this->form_validation->set_rules('matricula', 'matrícula', 'trim|required|max_length[100]|is_unique[empleado.matricula]');
         $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[80]');
         $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|required|max_length[40]');
         $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|required|max_length[40]');
         $this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'trim|required');
         $this->form_validation->set_rules('sexo', 'sexo', 'trim|required|integer');
         $this->form_validation->set_rules('lugar_nacimiento', 'lugar de nacimiento', 'trim|required|max_length[50]');
         $this->form_validation->set_rules('direccion', 'dirección', 'trim|required');
         $this->form_validation->set_rules('telefono', 'teléfono', 'trim|required|max_length[15]');
         $this->form_validation->set_rules('celular', 'celular', 'trim|required|max_length[20]');
         $this->form_validation->set_rules('email', 'correo electrónico', 'trim|required|valid_email|max_length[130]');
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
            // INSERT INTO empleado 
            // (matricula, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, lugar_nacimiento) 
            // VALUES 
            // ("<MATRICULA>", "<NOMBRE>", "<APELLIDO_PATERNO>", "<APELLIDO_MATERNO>", "<FECHA_NACIMIENTO>", "<SEXO>", "<LUGAR_NACIMIENTO>")
            Modules::run('master/insert','empleado',elements(array('matricula','nombre','apellido_paterno','apellido_materno','fecha_nacimiento','sexo','lugar_nacimiento'),$post));
            // INSERT INTO directorio 
            // (idEmpleado, altitud, latitud, direccion, telefono, celular, email)
            // VALUES 
            // (<ID_EMPLEADO>,"<ALTITUD>", "<LATITUD>", "<DIRECCIÓN>", "<TELÉFONO>", "<CELULAR>", "<E-MAIL>")
            $insert = elements(array('direccion','telefono','celular','email'),$post);
            $insert['idEmpleado'] = $this->db->insert_id();
            Modules::run('master/insert','directorio',$insert);
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

   public function consulta_filtrada() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('busqueda', 'Matrícula, nombre o correo', 'trim|required');
         $this->form_validation->set_rules('tipo_busqueda', 'Tipo de búsqueda', 'trim|required');
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
            switch ($post['tipo_busqueda']) {
               case '1':
                  $empleado = $this->Empleado_m->consulta_por_matricula($post['busqueda']);
                  break;
               case '2':
                  $empleado = $this->Empleado_m->consulta_por_nombre($post['busqueda']);
                  break;
               case '3':
                  $empleado = $this->Empleado_m->consulta_por_correo($post['busqueda']);
               default: 
                  $json = array(
                     'action' => '2',
                     'msj'    => 'Búsqueda no valida'
                  ); // Error búsqueda
                  $this->output->set_content_type('application/json')->set_output(json_encode($json));
                  exit();
            }
            if (!empty($empleado)) {
               $empleado = html_purify($empleado);
               $tr = '';
               foreach ($empleado as $value) {
                  $tr .= 
                  '<tr data-id-usuario="'.$value['id_empleado'].'">
                     <td class="text-center">'.$value['matricula'].'</td>
                     <td>'.$value['nombre'].'</td>
                     <td>'.$value['a_paterno'].'</td>
                     <td>'.$value['a_materno'].'</td>
                     <td>'.$value['correo'].'</td>
                     <td class="iconos-acciones iconos-2">
                        <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
                        <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>   
                     </td>
                  </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'    => $tr
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Empleados no encontrado'
               ); // Error validación
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
         $empleados = $this->getEmpleados();
         if ($empleados != '') {
            $json = array(
               'action'    => '1',
               'empleados' => $empleados
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'Empleados no encontrados'
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

   private function getEmpleados() {
      $empleados = $this->Empleado_m->consulta();
      if (!empty($empleados)) {
         $empleados = html_purify($empleados);
         $empleados = $this->tables->addCellValue($empleados,'accion','<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i><i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash pointer fa-2x"></i>');
         $empleados = $this->tables->setAttr($empleados,[
            'tr' => ['data-id-usuario'=>'id_empleado'],
            'matricula' => ['class'=>'text-center'],
            'accion' => ['class'=>'iconos-acciones iconos-2']
         ]);
         $this->tables->noAttr = ['id_empleado'];
         return $this->tables->generate($empleados,'tbodyTr');
      } 
      else {
         return '';
      }
   }

}

/* End of file Empleado.php */
/* Location: ./application/modules/configuracion/controllers/Empleado.php */