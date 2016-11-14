<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quirofano extends MX_Controller {

   private static $msj = ''; 

   function __construct() {
      parent::__construct();
      $this->load->model(array('Quirofano_m'));
      self::$msj = json_decode(MSJ,TRUE);
   }

   public function index() {
     
   }

   /**
    * Carga vista Asignado
    * @return [void] 
    */
   public function asignado() {
      $this->load->view('quirofano/asignado');
   }

   /**
    * Carga vista Por asignar
    * @return [void]
    */
   public function por_asignar() {
      $this->load->view('quirofano/por_asignar');
   }   

   /**
    * Carga vista Reportar consumo
    * @return [void] 
    */
   public function reportar_consumo() {
      $this->load->view('quirofano/reportar_consumo');
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------

   // UPDATE stock 
   // SET idCirugia = "<ID_CIRUGIA>", 
   // idMaterial_Osteosintesis = "<ID_MATERIAL_OSTEOSINTESIS>", 
   // idUsuario = "<ID_USUARIO>", 
   // cantidad = "<CANTIDAD>", 
   // fecha = "<FECHA>"

   /**
    * [get_consumo description]
    * @return [type] [description]
    */
   public function get_consumo() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_cirugia','ID cirugía','required|trim');
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
            $consumo = $this->Quirofano_m->consumo($post['id_cirugia']);
            if (!empty($consumo)) {
               $consumo = html_purify($consumo);
               $html = '';
               foreach ($consumo as $value) {
                  $html .= 
                  '<tr data-id_cirugia="'.$value['id_cirugia'].'">
                     <td class="text-center" style="min-width:170px;" >'.$value['nombre'].'</td>
                     <td class="total" data-total ="'.$value['cantidad'].'">'.$value['cantidad'].'</td>
                     <td style="width:40%;">
                        <input name="consumo" class="consumo_m" type="text" value="'.$value['cantidad'].'" placeholder="Consumo">
                     </td>
                  </tr>';
               }
               $json = (array(
                  'action' => '1',
                  'tr'    => $html
               )); // Error  404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Materiales de la cirugía no encontrados'
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
    * [ver_horarios description]
    * @return [type] [description]
    */
   public function ver_horarios() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('hr_inicio','Hora inicio','required|trim');
         $this->form_validation->set_rules('hr_final','Hora final','required|trim');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            if(strtotime($post['hr_final']) < strtotime($post['hr_inicio'])) {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Hora no válida'
               )); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               // $hay_en_hora = Modules::run('master/filas_c',array(
               //    'tabla' =>'cirugia',
               //    'condicion' => array('hora_inicio <' => 'time('.$post['hr_final'].')')
               // ));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [ver_fechas_quiro description]
    * @return [type] [description]
    */
   public function ver_fechas_quiro() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('fecha','fecha','required|trim');
         // $this->form_validation->set_rules('hora_inicio','Hora inicio','required|trim');
         // $this->form_validation->set_rules('hora_final','Hora final','required|trim');
         // $this->form_validation->set_rules('id_cirugia','ID cirugía','required|trim|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            // $hay_en_dia = Modules::run('master/filas_c',array(
            //    'tabla' =>'cirugia',
            //    'condicion' => array('cirugia.fecha' => 'date('.$post['fecha'].')')
            // ));
            $hay_en_dia = $this->Quirofano_m->select_date($post['fecha']);
            $hay = 0;
            if (empty($hay_en_dia)) {
               $hay = 1;
            } 
            $quirofanos = Modules::run('master/filas_c',array(
               'tabla'     =>'quirofano',
               'condicion' => array('status' => '1')
            ));
            if (!empty($quirofanos)) {
               $quirofanos = html_purify($quirofanos);
               $opt = '<option value="">Seleccionar</option>';
               foreach ($quirofanos as $value) {
                  $opt .= '<option value="'.$value['idquirofano'].'">'.$value['nombre'].'</option>';
               }
               $json = (array(
                  'action' => '1',
                  'html'   => $opt,
                  'dispo'   => $hay
               )); // Success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => self::$msj[13]
               )); // Error quirofanos 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [ver_reportar_consumo description]
    * @return [type] [description]
    */
   public function ver_reportar_consumo() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Quirofano_m->reportar_consumo();
         if (!empty($quirofano)) {
            $quirofano = html_purify($quirofano);
            $tr = '';
            foreach ($quirofano as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['idCirugia'].'">
                  <td class="text-center">'.$value['idCirugia'].'</td>
                  <td>
                     '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                  </td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td class="detalles pointer" data-sis="instrumentales">Ver más</td>
                  <td>'.$value['fecha'].'</td>
                  <td>'.$value['quirofano'].'</td>
                  <td>
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="reportar-consumo" class="acciones fa fa-book pointer fa-2x"></i>   
                        </div>
                     </div>
                  </td>
               </tr>';
            }
            $json = (array(
               'action' => '1',
               'tr'     => $tr
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'No se encuentran quirofános asignadoss'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function por_asignar_insert() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('hr_inicio','Hora inicio','required|trim');
         $this->form_validation->set_rules('hr_final','Hora final','required|trim');
         $this->form_validation->set_rules('fecha','Fecha|','required|trim');
         $this->form_validation->set_rules('id_cirugia','ID cirugía','required|trim');
         $this->form_validation->set_rules('id_quiro','ID quirofáno','required|trim');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            Modules::run('master/update','cirugia',array(
               'fecha' => $post['fecha'],
               'hora_inicio' => $post['hr_inicio'],
               'hora_fin' => $post['hr_final'],
               'idquirofano' => $post['id_quiro'],
            ),array('idCirugia' => $post['id_cirugia']));
         }
      }
   }

   /**
    * Retorna <tr> de cirugías por asignar
    * @return [jsons]
    */
   public function ver_por_asignar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Quirofano_m->por_asignar();
         if (!empty($quirofano)) {
            $quirofano = html_purify($quirofano);
            $tr = '';
            foreach ($quirofano as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['idCirugia'].'">
                  <td class="text-center">'.$value['idCirugia'].'</td>
                  <td>
                     '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                  </td>
                  <td>
                     '.$value['especialidad'].'
                  </td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td class="detalles pointer" data-sis="instrumentales">Ver más</td>
                  <td class="acciones pointer">
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="asignar" class="acciones fa fa-edit pointer fa-2x"></i>  
                        </div>
                     </div>
                  </td>
               </tr>';
            }
            $json = (array(
               'action' => '1',
               'tr'     => $tr
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'No se encuentran quirofános asignadoss'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * Retorna <tr> de cirugías asignadas
    * @return [json]
    */
   public function ver_asignados() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Quirofano_m->asignado();
         if (!empty($quirofano)) {
            $quirofano = html_purify($quirofano);
            $tr = '';
            foreach ($quirofano as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['idCirugia'].'">
                  <td class="text-center">'.$value['idCirugia'].'</td>
                  <td>
                     '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                  </td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td class="detalles pointer" data-sis="instrumentales">Ver más</td>
                  <td>'.$value['fecha'].'</td>
                  <td>'.$value['quirofano'].'</td>
               </tr>';
            }
            $json = (array(
               'action' => '1',
               'tr'     => $tr
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'No se encuentran quirofános asignadoss'
            )); // No encontrados
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
