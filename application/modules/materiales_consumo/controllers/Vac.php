<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vac extends MX_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('Vac_m');
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
   public function por_entregar() {
      $this->load->view('ceye/por_entregar');   
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

   public function revisarMaterial() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         $this->form_validation->set_rules('codigo_barra', 'código', 'trim|required');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $material = Modules::run('master/filas_c',array(
               'tabla' => 'cirugia_material_osteosintesis',
               'condicion' => [
                  'idCirugia' => $this->input->post('idCirugia'),
                  'codigo_barra' => str_replace(' ','-',$this->input->post('codigo_barra'))
               ]
            ));
            if (!empty($material)) {  
               $json = array(
                  'action' => '1',
                  'msj' => 'Material encontrado'
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj' => 'Material no encontrado',
                  'query' => $this->db->last_query()
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function doCancelar() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'1'],$this->input->post());
            Modules::run('Master/update','cirugia',['status'=>'0'],$this->input->post());
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

   public function doReajustar() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'1'],$this->input->post());
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

   public function doParcial() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            Modules::run('Master/update','cirugia_material_osteosintesis',['devolucion'=>'1'],$this->input->post());
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'7'],$this->input->post());
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

   public function enviarDevolver() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia','ID cirugía','trim|required|integer');
         $this->form_validation->set_rules('cantidad','cantidad','trim|required|integer');
         $this->form_validation->set_rules('idMaterial_Osteosintesis','cantidad','trim|required|integer');
         $this->form_validation->set_rules('cantidadDevolver','cantidad a devolver','trim|required|integer|less_than_equal_to['.$this->input->post('cantidad').']');
         $this->form_validation->set_message('less_than_equal_to','La cantidad a devolver debe ser menor que la de consumo');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $cantidadNueva = $this->input->post('cantidad') - $this->input->post('cantidadDevolver');
            Modules::run('Master/update','cirugia_material_osteosintesis',
               ['cantidad' => $cantidadNueva,'devolucion' => '0','devueltos'=>$this->input->post('cantidadDevolver')],
               ['idMaterial_Osteosintesis'=>$this->input->post('idMaterial_Osteosintesis'),'idCirugia'=>$this->input->post('idCirugia')]
            );
            $this->doSumarCantidad($this->input->post('idMaterial_Osteosintesis'),$this->input->post('cantidad'));
            $this->doQuitarMateriales($this->input->post('idCirugia'),$this->input->post('idMaterial_Osteosintesis'));
            $isTerminado = $this->revisarMaterialesSinDevo($this->input->post('idCirugia'));
            if ($isTerminado) {
               $this->enviarEmail($this->input->post('idCirugia'));
            }
            $json = array(
               'action' => '1',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function doTotal() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'6'],$this->input->post());
            Modules::run('Master/update','cirugia',['status'=>'2'],$this->input->post());
            $this->enviarEmail($this->input->post('idCirugia'));
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

   public function doEntregado() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $this->doQuitarMateriales($this->input->post('idCirugia'));
            $this->enviarNotificacion($this->input->post('idCirugia'));
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'8'],$this->input->post());
            $json = array(
               'action' => '1',
               'msj'     => 'Se ha enviado una notificación a almacén'
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function doAsignar() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia', 'ID cirugía', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'tr'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'7'],$this->input->post());
            $json = array(
               'action' => '1',
               'tr'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function getSisMaterialesTotal() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idTratamiento', 'ID tratamiento', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'tr'     => validation_errors()
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $idTipoUsuario = $this->getTipoUsuario();
            if ($idTipoUsuario) {
               $tratamiento = $this->Vac_m->matEnDevolucion($idTipoUsuario,$this->input->post('idTratamiento'));
               if (!empty($tratamiento)) {
                  $cirugia = html_purify($tratamiento);
                  $tr = '';
                  foreach ($tratamiento as $value) {
                     $tr .= 
                     '<tr data-no-cirugia="'.$value['idCirugia'].'" data-cantidad-total="'.$value['cantidad'].'" data-material="'.$value['nombre'].'" data-id-material="'.$value['idMaterial_Osteosintesis'].'">
                        <td>'.$value['nombre'].'</td>
                        <td class="text-center">'.$value['cantidad'].'</td>
                        <td class="text-center">'.$value['sisNombre'].'</td>
                        <td class="iconos-acciones iconos-1">
                           <i data-id-accion="devolver" data-toggle="tooltip" title="Devolver" class="tip acciones fa fa-mail-reply pointer fa-2x"></i>     
                        </td>
                     </tr>';
                  }
                  $json = array(
                     'action' => '1',
                     'tr'     => $tr
                  ); // success
                  $this->output->set_content_type('application/json')->set_output(json_encode($json));
               }
               else {
                  $json = array(
                     'action' => '2',
                     'msj'    => 'No se encontraron devoluciones',
                     'last' => $this->db->last_query()
                  ); // No encontrados
                  $this->output->set_content_type('application/json')->set_output(json_encode($json));
               }
            }
         }  
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function ver_devolucion() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $idTipoUsuario = $this->getTipoUsuario();
         if ($idTipoUsuario) {
            $tratamiento = $this->Vac_m->devolucion($idTipoUsuario);
            if (!empty($tratamiento)) {
               $cirugia = html_purify($tratamiento);
               $tr = '';
               foreach ($tratamiento as $value) {
                  $tr .= 
                  '<tr data-no-cirugia="'.$value['idCirugia'].'">
                     <td>'.$value['nom_derechohabiente'].'</td>
                     <td>'.$value['nombre'].'&nbsp'.$value['a_paterno'].'</td>
                     <td>'.$value['especialidad'].'</td>
                     <td class="iconos-acciones iconos-1">
                        <i data-id-accion="ver-materiales" data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                     </td>
                  </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'     => $tr
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'No se encontraron devoluciones',
                  'last' => $this->db->last_query()
               ); // No encontrados
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron devoluciones'
            ); // No encontrados
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
         $idTipoUsuario = $this->getTipoUsuario();
         if ($idTipoUsuario) {
            $tratamiento = $this->Vac_m->entregado($idTipoUsuario);
            if (!empty($tratamiento)) {
               $tratamiento = html_purify($tratamiento);
               $tr = '';
               foreach ($tratamiento as $value) {
                  $tr .= 
                  '<tr data-no-cirugia="'.$value['idCirugia'].'">
                     <td>'.$value['nom_derechohabiente'].'</td>
                     <td>
                        '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                     </td>
                     <td>
                        '.$value['especialidad'].'
                     </td>
                     <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                        <i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                     </td>
                     <td class="iconos-acciones iconos-1">
                        <i data-id-accion="devolucion" data-toggle="tooltip" title="Aceptar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>     
                     </td>
                  </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'     => $tr
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'No se encontraron tratamientos entregados'
               ); // No encontrados
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron tratamientos entregados'
            ); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
      // $ajax_request = $this->input->is_ajax_request();
      // if ($ajax_request) {
      //    $cirugia = $this->Vac_m->entregado();
      //    if (!empty($cirugia)) {
      //       $cirugia = html_purify($cirugia);
      //       $tr = '';
      //       foreach ($cirugia as $value) {
      //          $tr .= 
      //          '<tr data-no-cirugia="'.$value['id_cirugia'].'">
      //             <td class="text-center">'.$value['id_cirugia'].'</td>
      //             <td>
      //                '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
      //             </td>
      //             <td>
      //                '.$value['especialidad'].'
      //             </td>
      //             <td class="detalles pointer" data-sis="materiales">Ver más</td>
      //          </tr>';
      //       }
      //       $json = array(
      //          'action' => '1',
      //          'tr'     => $tr
      //       ); // success
      //       $this->output->set_content_type('application/json')->set_output(json_encode($json));
      //    } 
      //    else {
      //       $json = array(
      //          'action' => '2',
      //          'msj'    => 'No se encuentran entregados'
      //       ); // No encontrados
      //       $this->output->set_content_type('application/json')->set_output(json_encode($json));
      //    }
      // }
      // else {
      //    redirect('inicio/index','refresh');
      // }
   }

   /**
    * [ver_por_asignar description]
    * @return [type] [description]
    */
   public function ver_por_asignar() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $idTipoUsuario = $this->getTipoUsuario();
         if ($idTipoUsuario) {
            $quirofano = $this->Vac_m->por_asignar($idTipoUsuario);
            if (!empty($quirofano)) {
               $quirofano = html_purify($quirofano);
               $tr = '';
               foreach ($quirofano as $value) {
                  $tr .= 
                  '<tr data-no-cirugia="'.$value['idCirugia'].'">
                     <td>'.$value['nom_derechohabiente'].'</td>
                     <td>
                        '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
                     </td>
                     <td>
                        '.$value['especialidad'].'
                     </td>
                     <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                        <i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                     </td>
                     <td class="iconos-acciones iconos-3">
                        <i data-id-accion="asignar" data-toggle="tooltip" title="Aceptar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>     
                        <i data-id-accion="cancelar" data-toggle="tooltip" title="Cancelar" class="tip acciones fa fa-times-circle pointer fa-2x"></i>     
                        <i data-id-accion="codigo_barra" data-toggle="tooltip" title="Revisar material" class="tip acciones fa fa-barcode pointer fa-2x"></i>
                     </td>
                  </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'     => $tr,
                  'query' =>$this->db->last_query()
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
               'action' => '2',
                  'msj'    => 'No se encontraron tratamientos por entregar'
               ); // No encontrados
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron tratamientos por entregar'
            ); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function ver_asignados() {
      // $ajax_request = $this->input->is_ajax_request();
      // if ($ajax_request) {
      //    $quirofano = $this->Vac_m->asignado();
      //    if (!empty($quirofano)) {
      //       $quirofano = html_purify($quirofano);
      //       $tr = '';
      //       foreach ($quirofano as $value) {
      //          $tr .= 
      //          '<tr data-no-cirugia="'.$value['idCirugia'].'">
      //             <td class="text-center">'.$value['idCirugia'].'</td>
      //             <td>
      //                '.$value['nombre'].'&nbsp'.$value['a_paterno'].'
      //             </td>
      //             <td>'.$value['especialidad'].'</td>
      //             <td class="detalles pointer" data-sis="materiales">Ver más</td>
      //             <td class="detalles pointer" data-sis="instrumentales">Ver más</td>
      //             <td>'.$value['fecha'].'</td>
      //             <td>'.$value['quirofano'].'</td>
      //          </tr>';
      //       }
      //       $json = (array(
      //          'action' => '1',
      //          'tr'     => $tr
      //       )); // success
      //       $this->output->set_content_type('application/json')->set_output(json_encode($json));
      //    } 
      //    else {
      //       $json = (array(
      //          'action' => '2',
      //          'msj'    => 'No se encuentran quirofános asignadoss'
      //       )); // No encontrados
      //       $this->output->set_content_type('application/json')->set_output(json_encode($json));
      //    }
      // }
      // else {
      //    redirect('inicio/index','refresh');
      // }
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $tratamiento = $this->Vac_m->asignado();
         if (!empty($tratamiento)) {
            $tratamiento = html_purify($tratamiento);
            $tr = '';
            foreach ($tratamiento as $value) {
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
                  <td>
                     '.$value['fecha'].'
                  </td>
                  <td style="min-width:85px;max-width:150px;width: 85px;">
                     <i style="float:left;" data-id-accion="entregado" class="acciones fa fa-check-circle pointer fa-2x"></i>     
                  </td>
               </tr>';
            }
            $json = array(
               'action' => '1',
               'tr'     => $tr
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron tratamientos asignados'
            ); // No encontrados
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

   private function enviarEmail($idCirugia) {
      $this->load->library('Mailer');
      $config = array(
         'username' => 'umae.magdalena@gmail.com',
         'password' => 'adminadminumae',
         'gmail' => TRUE,
         'fromName' => 'Hospital Magdalena de la Salinas',
         'confirmar' => TRUE
      );
      $this->mailer->init($config);
      $mensajeMateriales = 'Materiales consumidos: <br>'; 
      $proveedores = $this->Vac_m->getProveedoresByIdCirugiaGroup($idCirugia);
      $sistemaMat = $this->Vac_m->getSistemaMatByIdCirugia($idCirugia);
      if (!empty($proveedores)) {
         foreach ($proveedores as $key => $proveedor) {
            if (!empty($sistemaMat)) {
               foreach ($sistemaMat as $key => $sistema) {
                  if ($sistema['correo'] == $proveedor['correo']) {
                     $mensajeMateriales .= 'Nombre del sistema: <strong>'.$sistema['nombreSis'].'</strong> material: <strong>'.$sistema['nombreMat'].'</strong> cantidad consumida: <strong>'.$sistema['matConsumido'].'</strong><br>';  
                  }
               }
               $this->mailer->sendEmailToProveedor($proveedor['correo'],$mensajeMateriales,'Materiales consumidos');
               $mensajeMateriales = 'Materiales consumidos: <br>'; 
            }
         }
      }
      $resultado = [$proveedores,$sistemaMat];
      $this->output->set_content_type('application/json')->set_output(json_encode($resultado));
   }

   private function enviarNotificacion($idCirugia) {
      $mensajeMateriales = 'Lista de materiales entregados: <br>'; 
      $materiales = $this->Vac_m->getMaterialesByIdCirugia($idCirugia);
      foreach ($materiales as $key => $material) {
         $mensajeMateriales .= 'Nombre: <strong>'.$material['nombre'].'</strong> cantidad: <strong>'.$material['cantidad'].'</strong><br>';
      }
      $mensaje = [
         'mensaje'      => $mensajeMateriales,
         'destinatario' => '4',
         'remitente'    => $this->getDepartamentoByIdUsuario($this->session->sess['idUsuario']),
         'subtitulo'    => 'Materiales entregados a hospitalización',
         'nota'         => 'No. tratamiento: '.$idCirugia
      ];
      Modules::run('inicio/notificaciones/setNotificacion',$mensaje,'notificacionesdepartamentos');
   }

   private function revisarMaterialesSinDevo($idCirugia) {
      $materiales = Modules::run('master/filas_c',array(
         'tabla' => 'cirugia_material_osteosintesis',
         'condicion' => [
            'idCirugia' => $idCirugia,
            'devolucion' => '1'
         ]
      ));
      if (empty($materiales)) {
         Modules::run('master/update','estado_de_cirugia',['idEstado_Cirugia'=>'6'],
            ['idCirugia' => $idCirugia]
         );
         Modules::run('master/update','cirugia',['status'=>'2'],
            ['idCirugia' => $idCirugia]
         );
         return TRUE;
      }
      else {
         return FALSE;
      }
   }

   private function doSumarCantidad($idMaterial,$cantidad) {
      $material = Modules::run('master/filas_c',array(
         'tabla' => 'material_osteosintesis',
         'condicion' => [
            'idMaterial_Osteosintesis' => $idMaterial
         ]
      ));
      if (!empty($material)) {
         $cantidadNueva = $material[0]['cantidad'] + $cantidad;
         Modules::run('master/update','material_osteosintesis',['cantidad'=>$cantidadNueva],
            ['idMaterial_Osteosintesis' => $idMaterial]
         );
      }
   }

   private function doQuitarMateriales($idCirugia,$idMaterial='0') {
      $diferencias = $this->Vac_m->getDiferenciaMateriales($idCirugia);
      if (!empty($diferencias)) {
         foreach ($diferencias as $key => $diferencia) {
            if ($idMaterial == '0') {
               Modules::run('master/update','material_osteosintesis',['cantidad'=>$diferencia['diferencia']],
                  elements(['idMaterial_Osteosintesis'],$diferencia) 
               );
            }
            else {
               if ($diferencia['idMaterial_Osteosintesis'] == $idMaterial) {
                  Modules::run('master/update','material_osteosintesis',['cantidad'=>$diferencia['diferencia']],
                     elements(['idMaterial_Osteosintesis'],$diferencia) 
                  );
               }
            }
         }
      }
   }

   private function getTipoUsuario() {
      $info = [
        'filtro' => 'idUsuario',
        'id' => $this->session->sess['idUsuario']
      ];
      $tipoUsuario = Modules::run('materiales_consumo/hospitalizacion/getTipoUsuario',$info);
      if ($tipoUsuario) {
         return $tipoUsuario;
      }
      else {
         return FALSE;
      }
   }

   private function getDepartamentoByIdUsuario($idUsuario) {
      $departamento = $this->Vac_m->getIdDepartemento($idUsuario);
      if (!empty($departamento)) {
         return $departamento[0]['idDepartamento'];
      }
      else {
         return FALSE;
      }
   }

}
