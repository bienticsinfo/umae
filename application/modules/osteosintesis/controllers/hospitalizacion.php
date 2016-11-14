<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalizacion extends MX_Controller {

   /**
    * [$msj Mensajes a mostrar]
    * @var string
    */
   private static $msj = ''; 

   function __construct() {
      parent::__construct();
      $this->load->model(['Hospitalizacion_m']);
      // $this->load->library('Excel');
      $this->form_validation->set_error_delimiters('','');
      self::$msj = json_decode(MSJ,TRUE);
   }

   public function index() {
      // Ejemplo
      // $file = './assets/uploads/files_excel/Financial_Sample.xlsx';
      // $objPHPExcel = PHPExcel_IOFactory::load($file);
      // $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
      // foreach ($cell_collection as $cell) {
      //    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
      //    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
      //    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
      //    $arr_data[$row][$column] = $data_value;
      // }
      // echo '<pre>';
      // print_r($arr_data);
      // print_r($this->input->post('param1'));
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
      $cirugias = $this->getCirugias();
      $data['cirugias'] = ($cirugias != '' ? $cirugias : false);
      $this->load->view('hospitalizacion/gestionar_cirugia',$data);
   }   

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------

   public function doAccion() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia','ID cirugía','required|trim|integer');
         $this->form_validation->set_rules('accion','acción a realizar','required|trim');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            switch ($this->input->post('accion')) {
               case 'esperar':
                  $mensaje = [
                     'mensaje'      => 'Esperar al proveedor por los materiales',
                     'destinatario' => '4',
                     'remitente'    => '1',
                     'subtitulo'    => 'Esperar a los proveedores',
                     'nota'         => 'No. Cirugía: '.$this->input->post('idCirugia')
                  ];
                   $json = array(
                     'action' => 'esperar'
                  ); // success
                  Modules::run('inicio/notificaciones/setNotificacion',$mensaje,'notificacionesdepartamentos');
                  break;
               case 'cambiar':
                  $json = array(
                     'action' => '1'
                  ); // success
                  Modules::run('Master/update','estado_de_cirugia',['idEstado_Cirugia'=>'1'],elements(['idCirugia'],$this->input->post()));
                  break;   
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function eliminarCirugia() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia','ID cirugía','required|trim|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // UPDATE cirugia SET status = 0 WHERE idCirugia = <ID_CIRUGIA>
            Modules::run('Master/update','cirugia',['status'=>'0'],$this->input->post());
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

   /**
    * [get_materiales_sis Retorna <tr> de los elementos de los materiales de Osteo e instrumentales]
    * @return [json] [action : lo que va hacer
    *                 msj    : mensaje del error
    *                 tr     : elementos html]
    */
   public function get_materiales_sis() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_sis','ID cirugía','required|trim|integer');
         $this->form_validation->set_rules('tabla','Sistema','required|trim');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $tabla = $this->input->post('tabla');
            if ($tabla == 'i-quirurgico') {
               $materiales = $this->Hospitalizacion_m->get_instrumentales_sis($this->input->post('id_sis'));  
            }
            else if ($tabla == 'material') {
               $materiales = $this->Hospitalizacion_m->get_materiales_sis($this->input->post('id_sis'));  
            }
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Error 505'
               )); // Error nombre de la tabla
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
               exit();
            }
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $html = '';
               foreach ($materiales as $value) {
                  $html .= 
                  '<tr>
                     <td style="width:1px;" class="text-center">
                        <input type="checkbox" name="" value="" checked>
                     </td>
                     <td class="text-center" style="min-width:170px;" >'.$value['nombre'].'</td>
                     <td class="total" data-total ="'.$value['cantidad'].'">'.$value['cantidad'].'</td>
                     <td style="width:40%;">
                        <input class="elementos_sis" data-id_m="'.$value['id_m_osteo'].'" type="text" value="0" placeholder="Cantidad">
                     </td>
                  </tr>';
               }
               $json = (array(
                  'action' => '1',
                  'tr'    => $html
               )); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => 'Materiales del sistema no encontrados'
               )); // Error  404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function editar_cirugia() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idCirugia','ID cirugía','required|trim|integer');
         $this->form_validation->set_rules('idTipo_Cirugia','ID tipo cirugía','required|trim|integer');
         $this->form_validation->set_rules('idDerechohabiente','ID Derechohabiente','required|trim|integer');
         $this->form_validation->set_rules('idTipo_CirugiaOld','ID tipo cirugía','required|trim|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            Modules::run('master/update','cirugia',
               elements(['idTipo_Cirugia','idDerechohabiente'],$this->input->post()),
               elements(['idCirugia'],$this->input->post())
            );
            // if ($this->input->post('idTipo_Cirugia') != $this->input->post('idTipo_CirugiaOld')) {
               $config = array(
                  'tabla' => 'cirugia_material_osteosintesis',
                  'elementos' => $this->input->post('elementos_mat'),
                  'idElemento' => 'idMaterial_Osteosintesis',
                  'post' => $this->input->post()
               );
               $this->deleteMatInst($config);
               $config = array(
                  'tabla' => 'cirugia_instrumental_quirurgico',
                  'elementos' => $this->input->post('elementos_instru'),
                  'idElemento' => 'idInstrumental_Quirurgico',
                  'post' => $this->input->post()
               );
               $this->deleteMatInst($config);
               $json = array(
                  'action' => '1',
                  'msj'    => 'Cambios guardados'
               );
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            // } 
            // else {
            //    $config = array(
            //       'tabla' => 'cirugia_material_osteosintesis',
            //       'elementos' => $this->input->post('elementos_mat'),
            //       'idElemento' => 'idMaterial_Osteosintesis',
            //       'post' => $this->input->post()
            //    );
            //    $this->updateMatIns($config);
            //    $config = array(
            //       'tabla' => 'cirugia_instrumental_quirurgico',
            //       'elementos' => $this->input->post('elementos_instru'),
            //       'idElemento' => 'idInstrumental_Quirurgico',
            //       'post' => $this->input->post()
            //    );
            //    $this->deleteMatInst($config);
            // }
            // $this->output->set_content_type('application/json')->set_output(json_encode($this->input->post()));
         }
      } 
      else {
         redirect('inicio/indez','refresh');
      }
   }

   private function updateMatIns($config) {
      foreach ($config['elementos'] as $key => $value) {
         $material = Modules::run('master/filas_c',array(
            'tabla' => $config['tabla'],
            'condicion' => [
               'idCirugia' => $config['post']['idCirugia'],
               $config['idElemento'] => $value[0],
               'idSistema' => str_replace('_sis','',$value[2])
            ]
         ));
         if (!empty($material)) {
            Modules::run('master/update',$config['tabla'],array(
               'cantidad' => $value[1]
            ),[
               'idCirugia' => $config['post']['idCirugia'],
               $config['idElemento'] => $value[0],
               'idSistema' => str_replace('_sis','',$value[2])
            ]);
         }
         else {
            Modules::run('master/insert',$config['tabla'],array(
               'idCirugia' => $config['post']['idCirugia'],
               $config['idElemento'] => $value[0],
               'cantidad' => $value[1],
               'idSistema' => str_replace('_sis','',$value[2])
            ));
         }
      }
      // $this->quitarSobrante($config);
      // $elemento
      // $this->output->set_content_type('application/json')->set_output(json_encode($config['elementos']));
   }

   private function quitarSobrante($config) {
      $elementos = Modules::run('master/filas_c',array(
         'tabla' => $config['tabla'],
         'condicion' => [
            'idCirugia' => $config['post']['idCirugia']
         ]
      ));
      $elementosFormated = [];
      foreach ($elementos as $key => $value) {
         $elementosFormated[] = [
            $value[$config['idElemento']],
            $value['cantidad'],
            $value['idSistema'] . '_sis'
         ];
      }
      // $sobrantes = [];
      // foreach ($config['idElemento'] as $key => $value) {
      //    foreach ($elementosFormated as $key => $values) {
      //       $sobrantes[] = 
      //    }
      // }
      // $this->output->set_content_type('application/json')->set_output(json_encode($sobrantes));
      // $sobrantes = array_diff($elementosFormated,$config['elementos']);
      // $this->output->set_content_type('application/json')->set_output(json_encode($sobrantes));
   }

   private function deleteMatInst($config) {
      $this->Hospitalizacion_m->delete($config['tabla'],elements(['idCirugia'],$config['post']));
      foreach ($config['elementos'] as $value) {
         Modules::run('master/insert',$config['tabla'],array(
            'idCirugia' => $this->input->post('idCirugia'),
            $config['idElemento'] => $value[0],
            'cantidad' => $value[1],
            'idSistema' => str_replace('_sis','',$value[2])
         ));
      }
   }

   /**
    * [insert_cirugia Guarda la programación de cirugía]
    * @return [json] [action : lo que hacer
    *                 msj    : mensaje del error]
    */
   public function insert_cirugia() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_Tipocirugia','ID cirugía','required|trim|integer');
         $this->form_validation->set_rules('id_derechohabiente','ID Derechohabiente','required|trim|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $material     = $this->input->post('elementos_mat');
            $instru       = $this->input->post('elementos_instru');
            $tipo_usuario = $this->Hospitalizacion_m->tipo_usuario($this->session->sess['idUsuario']);
            $idDepartamento = $this->Hospitalizacion_m->getIdDepartemento($this->session->sess['idUsuario']);
            $idEstado = 1;
            if (!empty($idDepartamento)) {
               if ($idDepartamento[0]['idDepartamento'] == '4') {
                  $idEstado = 3;
               }  
               else if ($idDepartamento[0]['idDepartamento'] == '1') {
                  $idEstado = 1;
               }
            } 
            else {
               $idEstado = 1;
            }
            Modules::run('master/insert','cirugia',array(
               'idDerechohabiente' => $this->input->post('id_derechohabiente'),
               'idTipo_Cirugia'    => $this->input->post('id_Tipocirugia'),
               'idProceso'         => '1'
            ));
            $id = $this->db->insert_id();
            Modules::run('master/insert','programacion_cirugia',array(
               'idTipo_Usuario' => $tipo_usuario[0]['id_usuario']
            ));
            foreach ($material as $value) {
               Modules::run('master/insert','cirugia_material_osteosintesis ',array(
                  'idCirugia' => $id,
                  'idMaterial_Osteosintesis' => $value[0],
                  'cantidad' => $value[1],
                  'idSistema' => str_replace('_sis','',$value[2])
               ));
               // $sinExistencia = ($value[1] == '0');
               $cantidadTotal = Modules::run('master/filas_c',array(
                  'tabla' => 'material_osteosintesis',
                  'condicion' => [
                     'idMaterial_Osteosintesis' => $value[0]
                  ]
               ));
               if (!empty($cantidadTotal)) {
                  $sinExistencia = ($cantidadTotal[0]['cantidad'] == '0');
               }
            }
            foreach ($instru as $value) {
               Modules::run('master/insert','cirugia_instrumental_quirurgico ',array(
                  'idCirugia' => $id,
                  'idInstrumental_Quirurgico' => $value[0],
                  'cantidad' => $value[1],
                  'idSistema' => str_replace('_sis','',$value[2])
               ));
               $cantidadTotal = Modules::run('master/filas_c',array(
                  'tabla' => 'instrumental_quirurgico',
                  'condicion' => [
                     'idInstrumental_Quirurgico' => $value[0]
                  ]
               ));
               if (!empty($cantidadTotal)) {
                  $sinExistencia = ($cantidadTotal[0]['cantidad'] == '0');
               }
            }
            // INSERT INTO estado_de_cirugia (idCirugia,idEstado_Cirugia) VALUES ("<ID CIRUGIA>","<ID ESTADO DE CIRUGIA>")
            $idEstado = ($sinExistencia ? 2 : $idEstado);
            Modules::run('master/insert','estado_de_cirugia',
               ['idCirugia' => $id, 'idEstado_Cirugia' => $idEstado]
            );
            $json = array(
               'action' => '1',
               'msj'    => 'Cambios guardados'
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else{
         redirect('inicio/indez','refresh');
      }
   }

   /** 
    * Selecciona los sistemas de materiales e instrumentales dependiendo el tipo de cirugía
    * @return [json]
    */
   public function sis_elementos() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_cirugia','ID cirugía','required|trim');
         $this->form_validation->set_rules('tipo','Tipo de sistema','required|trim');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $lista_elementos = array();
            switch ($this->input->post('tipo')) {
               case 'materiales':
                  $lista_elementos = $this->Hospitalizacion_m->detalles_sistema_materiales($this->input->post('id_cirugia'));
                  break;
               case 'instrumentales':
                  $lista_elementos = $this->Hospitalizacion_m->detalles_sistema_instru($this->input->post('id_cirugia'));
                  break;
            }
            if (!empty($lista_elementos)) {
               $lista_elementos = html_purify($lista_elementos);
               $tr = '';
               foreach ($lista_elementos as $value) {
                  $tr .= 
                  '<tr>
                     <td>'.$value['nombre'].'</td>
                     <td>'.$value['cantidad'].'</td>
                  </tr>';
               }
               $json = array(
                  'action'  => '1',
                  'tr_html' => $tr
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Error'
               ); // Error elementos de sistemas no encontrados
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * Consulta los sistemas de materias existentes con un ID del tipo de cirugía
    * @return [json]
    */
   public function sistemas() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $sistemas = $this->Hospitalizacion_m->sistemas_materiales($this->input->post('id_cirugia'));
         if (!empty($sistemas)) {
            $html_sis_mat = '';
            foreach ($sistemas as $value) {
               $html_sis_mat .= '<option value="'.$value['idSistema_Material'].'">'.$value['sistema'].'</option>';
            }
            $sistemas = $this->Hospitalizacion_m->sistemas_quirurjico($this->input->post('id_cirugia'));
            if (!empty($sistemas)) {
               $sistemas = html_purify($sistemas);
               $html_sis_quir = '';
               foreach ($sistemas as $value) {
                  $html_sis_quir .= '<option value="'.$value['idsistema_instrumental'].'">'.$value['sistema'].'</option>';
               }
               $json = array(
                  'action' => '1',
                  'html_material' => $html_sis_mat,
                  'html_instru' => $html_sis_quir
               ); // success       
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => self::$msj[12]
               ); // Sistema de instrumentales no encontrados     
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }  
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => self::$msj[11]
            ); // Sistema de materiales no encontrados     
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         
      }
      else {
         redirect('inicio/index','refresh');
      }
   }
   
   /**
    * Retorna los estados de la cirugía
    * @return [json]
    */
   public function estados_cirugia() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_cirugia','ID cirugía','required');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $estados = $this->Hospitalizacion_m->estados_cirugia($this->input->post('id_cirugia'));
            if (!empty($estados)) {
               $estados = html_purify($estados);
               $html_estados = '';
               foreach ($estados as $value) {
                  $html_estados .=
                     '<div class="row pointer">
                        <div class="c-white" style="font-size: x-large;">
                        <i class="fa fa-check-circle"></i> 
                        '.$value['estado'].'
                        </div>
                     </div>'; 
               }
               $json = array(
                  'action' => '1',
                  'msj'    => $html_estados
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Estados de cirugía no encontrados'
               ); // Error validación     
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }



   public function ver_cirugia_editar() {
       $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_cirugia','ID cirugía','trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $cirugia = $this->Hospitalizacion_m->ver_cirugia_modificar($this->input->post('id_cirugia'));
            if (!empty($cirugia)) {
               $cirugia = html_purify($cirugia);
               $cirugia = $cirugia[0];
               // $sistemasMateriales = $this->Hospitalizacion_m->getSistemasMatByIdCirugia($idCirugia);
               $sistemasMatElementos = $this->Hospitalizacion_m->detalles_sistema_materiales($this->input->post('id_cirugia'));
               // $sistemasInstru = $this->Hospitalizacion_m->getSistemasByIdCirugia($idCirugia);
               $sistemasInstruElementos = $this->Hospitalizacion_m->detalles_sistema_instru($this->input->post('id_cirugia'));
               $cirugia['nombreCompletoDerHabiente'] = $cirugia['nombreDerechohabiente'].' '.$cirugia['paternoDerechohabiente'].' '.$cirugia['maternoDerechohabiente'];
               $cirugia['nombreCompletoEmpleado'] = $cirugia['nombreEmpleado'].' '.$cirugia['paternoEmpleado'].' '.$cirugia['maternoEmpleado'];
               $cirugia['sistemasMatElementos'] = $sistemasMatElementos;
               $cirugia['sistemasInstruElementos'] = $sistemasInstruElementos;
               $json = array(
                  'action'   => '1',
                  'cirugia' => $cirugia
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
              $json = array(
                  'action'   => '1',
                  'cirugia' => ''
               ); // No encontrado 
              $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * Retorna <tr> de todas las cirugías
    * @return [json] [Contiene la acción a realizar y HTML de los <tr>]
    */
   public function ver_cirugia() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $html = $this->getCirugias();
         if ($html != '') {
            $json = array(
               'action'   => '1',
               'cirugias' => $html
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
           $json = array(
               'action'   => '1',
               'cirugias' => ''
            ); // No encontrado 
           $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   private function getCirugias() {
      $html = '';
      $cirugias = $this->Hospitalizacion_m->ver_cirugia();
      if (!empty($cirugias)) {
         $cirugias = html_purify($cirugias);
         $html = '';
         $btnEsperar = '';
         foreach ($cirugias as $value) {
            $btnEsperar = ($value['idEstado_Cirugia'] == '2' ? '<i data-id-accion="accion-esperar" class="acciones fa fa-medkit pointer fa-2x"></i>' : '');
            $html .= 
            '<tr data-no-cirugia="'.$value['idCirugia'].'">
               <td class="text-center" >'.$value['idCirugia'].'</td>
               <td data-matricula="'.$value['matricula'].'">'.$value['nom_empleado'].'</td>
               <td>'.$value['especialidad'].'</td>
               <td class="detalles pointer" data-sis="materiales">Ver más</td>
               <td class="detalles pointer" data-sis="instrumentales">Ver más</td>
               <td>'.$value['quirofano'].'</td>
               <td data-id-accion="estado" class="acciones pointer">Ver</td>
               <td style="min-width:85px;max-width:150px;width: 85px;">
                  <i style="float:left;" data-id-accion="modificar" class="acciones fa fa-edit pointer fa-2x"></i>
                  <i data-id-accion="eliminar" class="acciones fa fa-trash-o pointer fa-2x"></i>     
                  '.$btnEsperar.'
               </td>
            </tr>';
         }
      }
      return $html;
   }

   /**
    * [elementos_cirugia Retorna los elementos Tipo de cirugías, Material de Osteos e Instrumental quirúrjico]
    * @return [json] [action: qué va a realizar,
    *                 cirugias: Tipo de cirugías,
    *                 material: Material de osteos,
    *                 instrumental: Instrumental quirúrjico]
    */
   public function elementos_cirugia() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $cirugias = Modules::run('master/filas',array(
            'tabla' =>'tipo_cirugia'
         ));
         if ($cirugias and !empty($cirugias)) {
            $cirugias = html_purify($cirugias);
            $html_cirugias = '<option value="">Seleccionar</option>';
            foreach ($cirugias as $value) {
               $html_cirugias .= '<option value="'.$value['idTipo_Cirugia'].'">'.$value['tipo'].'</option>';
            }
            $json = array(
               'action'   => '1',
               'cirugias' => $html_cirugias
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => self::$msj[10]
            ); // Cirugías no encontrado
            $this->output->set_content_type('application/json')->set_output(json_encode());
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * Retorna <tr> de todos los médicos
    * @return [json] [Contiene acción y HTML de los <tr>]
    */
   public function medico_tratante() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('buscar','búsqueda','required|trim');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $medico = $this->Hospitalizacion_m->medico_tratante($this->input->post('buscar'));
            if (!empty($medico)) {
               $medico = html_purify($medico);
               $tr = '';
               foreach ($medico as $value) {
                  $tr .= 
                  '<tr class="pointer" data-matricula="'.$value['matricula'].'" data-nombre="'.$value['nombre'].'">
                     <td>'.$value['matricula'].'</td>
                     <td>'.$value['nombre'].'</td>
                     <td>'.$value['a_paterno'].'</td>
                     <td>'.$value['a_materno'].'</td>
                  </tr>';
               }
               $json = array(
                  'action'  => '1',
                  'html_tbody' => $tr
               ); // Médico encontrado
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => self::$msj[9]
               ); // Médico no encontrado
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   /**
    * Retorna <tr> de los derechohaciente encontrados
    * @return [json] [Contiene acción y HTML de los <tr>]
    */
   public function derechohabiente() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('nss','NSS','required|trim');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $derechohabiente = $this->Hospitalizacion_m->derechohabiente_especifica($this->input->post('nss'));
            if (!empty($derechohabiente)) {
               $derechohabiente = html_purify($derechohabiente);
               $tr = '';
               foreach ($derechohabiente as $value) {
                  $tr .= 
                  '<tr class="pointer" data-nss="'.$value['nss'].'" data-id-derecho="'.$value['idDerechohabiente'].'" data-nombre="'.$value['nombre'].'">
                     <td>'.$value['nss'].'</td>
                     <td>'.$value['nombre'].'</td>
                     <td>'.$value['apellido_paterno'].'</td>
                     <td>'.$value['apellido_materno'].'</td>
                  </tr>';
               }
               $json = (array(
                  'action'  => '1',
                  'html_tbody' => $tr
               )); // Derechohabiente encontrado
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = (array(
                  'action' => '2',
                  'msj'    => self::$msj[8]
               )); // Derechohabiente no encontrado
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
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
