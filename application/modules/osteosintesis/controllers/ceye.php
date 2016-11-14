<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ceye extends MX_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('Ceye_m');
   }

   /**
    * Carga vista Asignado en C.E.Y.E
    * @return [void] 
    */
   public function asignado() {
      $this->load->view('ceye/asignado');
   }

   /**
    * Carga vista Por asignar en C.E.Y.E
    * @return [type] [description]
    */
   public function por_asignar() {
      $this->load->view('ceye/por_asignar');   
   }

   /**
    * Carga vista Entregado en C.E.Y.E
    * @return [void] 
    */
   public function entregado() {
      $this->load->view('ceye/entregado');   
   }

   /**
    * [devolucion vista Devolución en C.E.Y.E]
    * @return [void] 
    */
   public function devolucion() {
      $this->load->view('ceye/devolucion','', FALSE); 
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------
   
   public function ver_devolucion() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $cirugia = $this->Ceye_m->devolucion();
         if (!empty($cirugia)) {
            $cirugia = html_purify($cirugia);
            $tr = '';
            foreach ($cirugia as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>'.$value['nombre'].'&nbsp'.$value['a_paterno'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td>'.$value['usuario'].'</td>
                  <td>'.$value['s_fecha'].'</td>
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
               'msj'    => 'No se encuentran devoluciones'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [ver_entregado description]
    * @return [type] [description]
    */
   public function ver_entregado() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $cirugia = $this->Ceye_m->entregado();
         if (!empty($cirugia)) {
            $cirugia = html_purify($cirugia);
            $tr = '';
            foreach ($cirugia as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>
                     '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                  </td>
                  <td>
                     '.$value['especialidad'].'
                  </td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
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
               'msj'    => 'No se encuentran entregados'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * [ver_por_asignar description]
    * @return [type] [description]
    */
   public function ver_por_asignar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Ceye_m->por_asignar();
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

   public function ver_asignados() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Ceye_m->asignado();
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
