<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen_osteo extends MX_Controller {

   private static $msj = ''; 

   function __construct() {
      parent::__construct();
      $this->load->model('Almacen_osteo_m');
      $this->form_validation->set_error_delimiters('','');
      self::$msj = json_decode(MSJ,TRUE);
   }


   public function index() {
      redirect('inicio/index','refresh');
   }

   /**
    * Carga vista de pendientes en Almacén de Osteosíntesis
    * @return [void]
    */
   public function pendiente() {
      $this->load->view('almacen/almacen_o');
   }

   /**
    * Carga vista sin existencia en Almacén de Osteosíntesis
    * @return [void]
    */
   public function sin_existencia() {
      $this->load->view('almacen/sin_existencia');
   }

   public function archivo() {
      $this->load->view('almacen/archivo');
   }

   public function por_entregar() {
      $this->load->view('almacen/por_entregar');
   }

   public function revision() {
      $this->load->view('almacen/revision');
   }

   public function gestion_inventario() {
      $this->load->view('almacen/gestion_inventario');
   }

   /**
    * Carga vista Programar cirugía
    * @return [void] 
    */
   public function programar_cirugia() {
      $this->load->view('hospitalizacion/programar_cirugia');
   }

   /**
    * Carga vista Gestionar cirugía
    * @return [void] 
    */
   public function gestionar_cirugia() {
      $this->load->view('hospitalizacion/gestionar_cirugia');
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------
   
   public function enviarPorEntregar() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // UPDATE estado_de_cirugia SET idEstado_Cirugia = 3 WHERE idCirugia = <ID_CIRUGIA>
            Modules::run('Master/update','estado_de_cirugia',array('idEstado_Cirugia' => '3'),$this->input->post());
            $json = (array(
               'action' => '1',
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }
   
   public function updateMateriales() {
      if ($this->input->is_ajax_request()) {
         $cantidad = $this->input->post('cantidad');
         $this->form_validation->set_rules('idMaterial_Osteosintesis', 'ID material', 'trim|required|integer');
         $this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required|integer');
         $this->form_validation->set_rules('cantMaxMaterial', 'cantidad máxima', 'trim|required|integer|greater_than_equal_to['.$cantidad.']');
         $this->form_validation->set_rules('cantMinMaterial', 'cantidad mínima', 'trim|required|integer|less_than_equal_to['.$cantidad.']');
         $this->form_validation->set_message('greater_than_equal_to','La cantidad máxima debe ser de: '.$this->input->post('cantMaxMaterial'));
         $this->form_validation->set_message('less_than_equal_to','La cantidad mínima debe ser de: '.$this->input->post('cantMinMaterial'));
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // UPDATE material_osteosintesis SET cantidad = 3 WHERE  idMaterial_Osteosintesis = <idMaterial>
            Modules::run(
               'Master/update','material_osteosintesis',
               elements(['cantidad'],$this->input->post()),
               elements(['idMaterial_Osteosintesis'],$this->input->post())
            );
            $json = array(
               'action' => '1'
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function consultar_materiales() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_material', 'ID material', 'trim|required|integer');
         $this->form_validation->set_rules('id_proveedor', 'ID proveedor', 'trim|required|integer');
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
            $materiales = $this->Almacen_osteo_m->consulta_nuevo_material($post['id_material'],$post['id_proveedor']);
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $tr = '';
               foreach ($materiales as $value) {
                  $cantidad = ($value['cantidad'] != '' ? $value['cantidad'] : '0');
                  $tr .= 
                  '<tr data-id-sistema="'.$value['id_sis_material'].'" data-id-proveedor="'.$value['id_proveedor'].'" 
                       data-id-contrato="'.$value['id_contrato'].'" data-cantidad="'.$cantidad.'"
                       data-id-mat-osteo="'.$value['idMaterialOsteo'].'">
                     <td class="text-center">'.$value['nombre_sis'].'</td>
                     <td>'.$value['nombre_mat'].'</td>
                     <td>'.$value['nombre_p'].'</td>
                     <td>'.$value['clave'].'</td>
                     <td>'.$cantidad.'</td>
                     <td style="width:16%;">
                        <div class="text-center">
                           <input style="width:100%;" type="text" placeholder="Cantidad">      
                        </div>
                     </td>
                  </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'    => $tr,
                  'query' => $this->db->last_query()
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Gestión de procesos no encontrados'
               )); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      } 
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function detalles_material_g() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_sis_material', 'ID sistema material', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $materiales = $this->Almacen_osteo_m->detalles_material_inventario($this->input->post('id_sis_material'));
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $tr = '';
               foreach ($materiales as $value) {
                  $cantidad = ($value['cantidad'] != '' ? $value['cantidad'] : '0');
                  $tr .= 
                  '<tr data-id-sistema="'.$value['id_sis_material'].'" data-id-proveedor="'.$value['id_proveedor'].'" 
                       data-id-contrato="'.$value['id_contrato'].'" data-id-mat-osteo="'.$value['id_mat_osteo'].'"
                       data-max="'.$value['cantidad_maxima'].'" data-min="'.$value['cantidad_minima'].'">
                     <td class="text-center">'.$value['nombre_mat'].'</td>
                     <td>'.$cantidad.'</td>
                     <td>'.$value['cantidad_maxima'].'</td>
                     <td>'.$value['cantidad_minima'].'</td>
                     <td>
                        <div class="text-center">
                           <div class="row">
                              <i data-id-accion="nuevo" class="acciones fa fa-plus-circle pointer fa-2x"></i>      
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
                  'msj'    => 'Gestión de procesos no encontrados'
               )); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      } 
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function ver_gestion_procesos() {
      if ($this->input->is_ajax_request()) {
         $solicitudes = $this->Almacen_osteo_m->consulta_gestion_inventario();
         if (!empty($solicitudes)) {
            $solicitudes = html_purify($solicitudes);
            $tr = '';
            foreach ($solicitudes as $value) {
               $tr .= 
               '<tr data-id-sistema="'.$value['id_sis_material'].'" data-id-proveedor="'.$value['id_proveedor'].'" data-id-contrato="'.$value['id_contrato'].'">
                  <td class="text-center">'.$value['nombre'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td>'.$value['nombre_p'].'</td>
                  <td>'.$value['clave'].'</td>
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
               'msj'    => 'Gestión de procesos no encontrados'
            )); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function detalles_archivo() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_cirugia', 'ID cirugía', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $detalles = $this->Almacen_osteo_m->detalles_archivo($this->input->post('id_cirugia'));
            if (!empty($detalles)) {
               $detalles = html_purify($detalles);
               $tr = '';
               foreach ($detalles as $value) {
                  $tr .= 
                     '<tr>
                        <td>'.$value['nombre'].'</td>
                        <td>'.$value['cantidad'].'</td>
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
                  'msj'    => 'Detalles no encontrados'
               )); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }            
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function ver_archivo() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $archivo = $this->Almacen_osteo_m->archivo();
         if (!empty($archivo)) {
            $archivo = html_purify($archivo);
            $tr = '';
            foreach ($archivo as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>'.$value['fecha'].'</td>
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
               'msj'    => 'No se encontraron archivos'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function get_id_usuario() {
      if ($this->input->is_ajax_request()) {
         $info_usuaro = $this->Almacen_osteo_m->get_info_usuario($this->session->sess['idUsuario']);
         if (!empty($info_usuaro)) {
            $info_usuaro = html_purify($info_usuaro);
            $json = (array(
               'action'     => '1',
               'id_usuario' => $info_usuaro[0]['idUsuario'],
               'nombre'     => $info_usuaro[0]['nombre'].' '.$info_usuaro[0]['apellido_paterno'].' '.$info_usuaro[0]['apellido_materno']
            )); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'     => 'Usuario no encontrado'
            )); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function empleado_ceye() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $empleado = $this->Almacen_osteo_m->empleado_ceye();
         if (!empty($empleado)) {
            $empleado = html_purify($empleado);
            $tr = '';
            foreach ($empleado as $value) {
               $tr .= 
               '<tr data-id-usuario="'.$value['id_usuario'].'" data-nombre="'.$value['nombre'].' '.$value['a_paterno'].'">
                  <td class="text-center">'.$value['matricula'].'</td>
                  <td>'.$value['nombre'].'</td>
                  <td>'.$value['a_paterno'].'</td>
                  <td>'.$value['departamento'].'</td>
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
               'msj'    => 'No se encontraron empleados de C.E.Y.E.'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function ver_sin_existencia() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $cirugia = $this->Almacen_osteo_m->sin_existencia();
         if (!empty($cirugia)) {
            $cirugia = html_purify($cirugia);
            $tr = '';
            foreach ($cirugia as $value) {
               $tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>'.$value['medico_tratante'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td>
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="continuar" class="acciones fa fa-check-circle pointer fa-2x"></i>      
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
               'msj'    => 'No se encontraron solicitudes sin existencia'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function ver_por_entregar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Almacen_osteo_m->por_entregar();
         if (!empty($quirofano)) {
            $quirofano = html_purify($quirofano);
            $html_tr = '';
            foreach ($quirofano as $value) {
               $html_tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>'.$value['medico_tratante'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td>
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="continuar" class="acciones fa fa-check-circle pointer fa-2x"></i>      
                        </div>
                     </div>
                  </td>
               </tr>';
            }
            $json = (array(
               'action' => '1',
               'tr'     => $html_tr
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'No se encontraron solicitudes por entregar'
            )); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   private function getSistemaByIdMaterial($idMaterial,$idCirugia) {
      $sistema = $this->Almacen_osteo_m->getSistemaByIdMaterial($idMaterial,$idCirugia);
      $sistema = Modules::run('master/filas_c',array(
         'tabla' => 'sistema_material',
         'condicion' => [
            'idSistema_Material' => $sistema[0]['idSistema']
         ]
      ));
      return $sistema;
   }

   private function doMensaje($mensaje,$sinExistenciaMateriales) {
      foreach ($sinExistenciaMateriales  as $key => $value) {
         $mensaje .= 'Nombre del sistema: <strong>'.$value['sistema']['nombre'].'</strong>  -   Nombre del material ó instrumento: <strong>'.$value['info']['nombre'].'</strong><br>';
      }
      return $mensaje;
   }

   private function enviarNotificacionSinExistencia($idCirugia) {
      $sistemasMatElementos = $this->Almacen_osteo_m->detalles_sistema_materiales($idCirugia);
      $sistemasInstruElementos = $this->Almacen_osteo_m->detalles_sistema_instru($idCirugia);
      $sinExistenciaMateriales = [];
      $elementosSin = FALSE;
      $nota = 'No. Cirugía: ' . $idCirugia;
      foreach ($sistemasMatElementos as $key => $sistema) {
         $resultado = $this->Almacen_osteo_m->getMaterialesSinExistencia($sistema['idMaterial_Osteosintesis'],$idCirugia);
         if (!empty($resultado)) {
            $sistema = $this->getSistemaByIdMaterial($sistema['idMaterial_Osteosintesis'],$idCirugia);
            $sinExistenciaMateriales[] = [
               'info' => $resultado[0],
               'sistema' => $sistema[0]
            ];
            $elementosSin = TRUE;
         }
      }
      // $config = Array(
      //    'protocol' => 'smtp',
      //    'smtp_host' => 'smtp.gmail.com.',
      //    'smtp_port' => 465,
      //    'smtp_user' => 'edgarn.sr@gmail.com', // change it to yours
      //    'smtp_pass' => '' // change it to yours
      // ); 
      // $this->load->library('email',$config);
      // $this->email->from('edgarn.sr@gmail.com','Edgar');
      // $this->email->to('edgarn.sr@outlook.com');
      // $this->email->subject('subject');
      // $this->email->message('message');
      // if ($this->email->send()) {
      //    $this->output->set_content_type('application/json')->set_output(json_encode(['ok']));
      // }
      // else {
      //    $this->output->set_content_type('application/json')->set_output(json_encode($this->email->print_debugger()));
      // }   
      if ($elementosSin) {
         Modules::run('Master/insert','notificacionesdepartamentos',[
            'mensaje' => $this->doMensaje('Lista de los sistemas de materiales faltantes <br>',$sinExistenciaMateriales),
            'destinatario' => '1',
            'remitente' => '4',
            'subtitulo' => 'Sin existencia',
            'url_redirect' => base_url('inicio/notificaciones'),
            'nota' => $nota
         ]);
      }
      return $elementosSin;
   }

   public function cancelar_a_revision() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $sinExistencia = $this->enviarNotificacionSinExistencia($this->input->post('idCirugia'));
            if ($sinExistencia) {
               // UPDATE estado_de_cirugia SET idEstado_Cirugia = 3 WHERE idCirugia = <ID_CIRUGIA>
               Modules::run('Master/update','estado_de_cirugia',array('idEstado_Cirugia' => '2'),$this->input->post());
               $json = array(
                  'action' => '1',
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                     'action' => '1',
                     'msj' => 'El sistema ha detectado suficientes materiales, si no es así, favor de actualizar el inventario',
                     'bool' => $sinExistencia
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function por_entregar_ci() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         $this->form_validation->set_rules('entrega', 'ID entrega', 'trim|required|integer');
         $this->form_validation->set_rules('recibe', 'ID recibe', 'trim|required|integer');
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
            // UPDATE estado_de_cirugia SET idEstado_Cirugia = 3 WHERE idCirugia = <ID_CIRUGIA>
            Modules::run('Master/update','estado_de_cirugia',array('idEstado_Cirugia' => '4'),elements(array('idCirugia'),$post));
            // INSERT INTO entrega_material (idCirugia,entrega,recibe) 
            // VALUES ("<ID CIRUGIA>","<ID USUARIO QUE ENTREGA>", "<ID USUARIO QUE RECIBE>")
            Modules::run('Master/insert','entrega_material',elements(array('idCirugia','entrega','recibe'),$post));
            $json = array(
               'action' => '1',
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');  
      }
   }

   public function a_revision() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // UPDATE estado_de_cirugia SET idEstado_Cirugia = 3 WHERE idCirugia = <ID_CIRUGIA>
            Modules::run('Master/update','estado_de_cirugia',array('idEstado_Cirugia' => '3'),$this->input->post());
            $json = (array(
               'action' => '1',
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');  
      }
   }

   /**
    * [pendientes_r Retorna <tr> de los pendientes de revisión]
    * @return [json] [action : lo que va realizar
    *                 tr     : <tr> html
    *                 msj    : Mensajes de error]
    */
   public function ver_a_revision() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $quirofano = $this->Almacen_osteo_m->pendiente();
         if (!empty($quirofano)) {
            $quirofano = html_purify($quirofano);
            $html_tr = '';
            foreach ($quirofano as $value) {
               $html_tr .= 
               '<tr data-no-cirugia="'.$value['id_cirugia'].'">
                  <td class="text-center">'.$value['id_cirugia'].'</td>
                  <td>'.$value['medico_tratante'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles pointer" data-sis="materiales">Ver más</td>
                  <td>
                     <div class="text-center">
                        <div class="row">
                        <i data-id-accion="continuar" class="acciones fa fa-check-circle pointer fa-2x"></i>   
                        <i data-id-accion="detener" class="acciones fa fa-times-circle pointer fa-2x"></i>   
                        </div>
                     </div>
                  </td>
               </tr>';
            }
            $json = (array(
               'action' => '1',
               'tr'     => $html_tr
            )); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = (array(
               'action' => '2',
               'msj'    => 'No se encontraron solicitudes a revisión'
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
