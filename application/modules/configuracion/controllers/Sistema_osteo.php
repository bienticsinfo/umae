<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_osteo extends MX_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('Sistema_osteo_m');
      $this->load->library('Pdf');
   }

   public function index() {
      $this->load->view('Sistema_osteo/index'); 
   }

   public function revisarEnUso() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idSistema_Material', 'ID sistema', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $resultado = $this->Sistema_osteo_m->revisarEnUso($this->input->post('idSistema_Material'));
            if (!empty($resultado)) {
                  $json = array(
                  'action' => '2',
                  'msj'    => 'No es posible modificar sistema debido a que esta en uso'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '1'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function categoriasSistemas() {
      if ($this->input->is_ajax_request()) {
         $categorias = Modules::run('master/filas_c',[
            'tabla' => 'categorias_sis_materiales_vac',
            'condicion' => [
               'status' => '1'
            ]
         ]);
         if (!empty($categorias)) {
            $categorias = html_purify($categorias);
            $categoriasHTML = '<option value="">Seleccionar...</option>';
            foreach ($categorias as $key => $categoria) {
               $categoriasHTML .= '<option value="'.$categoria['id'].'">'.$categoria['nombre'].'</option>';
            }
            $json = array(
               'action' => '1',
               'optionHTML' => $categoriasHTML
            ); // 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'Categorías no encontradas'
            ); // 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function cambiarEstado() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('idSistema_Material', 'ID sistema', 'trim|required|integer');
         $this->form_validation->set_rules('status', 'estado', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            Modules::run('master/update','sistema_material',array('status' => $this->input->post('status')),array(
               'idSistema_Material' => $this->input->post('idSistema_Material')
            ));
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

   private function encontrar_id($id_md5='') {
      $sistemas = Modules::run('Master/filas',array('tabla' => 'sistema_material'));
      foreach ($sistemas as $value) {
         if (md5($value['idSistema_Material']) == $id_md5) {
            return $value['idSistema_Material'];
         }
      }
      return FALSE;
   }

   public function barcode() {
      $id_sis = $this->input->get('sis');
      if ($id_sis) {
         $id_sis = $this->encontrar_id($id_sis);
         if ($id_sis) {
            $sistema = Modules::run('Master/filas_c',array(
               'tabla'     => 'sistema_material',
               'condicion' => array('status' => '1', 'idSistema_Material' => $id_sis)
            ));  
            if (!empty($sistema)) {
               $materiales = Modules::run('Master/filas_c',array(
                  'tabla' => 'sistema_material_osteosintesis',
                  'condicion' => array('status' => '1', 'idsistema_material' => $id_sis)
               ));
               // create new PDF document
               $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
               // set margins
               $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
               $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
               $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
               // set auto page breaks
               $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
               // set image scale factor
               $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
               // set font
               $pdf->SetFont('helvetica', '', 11);
               // define barcode style
               $style = array(
                  'position'     => '',
                  'align'        => 'C',
                  'stretch'      => false,
                  'fitwidth'     => true,
                  'cellfitalign' => '',
                  'border'       => true,
                  'hpadding'     => 'auto',
                  'vpadding'     => 'auto',
                  'fgcolor'      => array(0,0,0),
                  'bgcolor'      => false, //array(255,255,255),
                  'text'         => true,
                  'font'         => 'helvetica',
                  'fontsize'     => 8,
                  'stretchtext'  => 4
               );
               // add a page
               $pdf->AddPage();
               $pdf->Cell(0, 10, $sistema[0]['nombre'], 0, 1);
               $pdf->write1DBarcode(str_replace('-','',$sistema[0]['codigo_barra']), 'C39', '', '', '', 18, 0.4, $style, 'N');
               foreach ($materiales as $key => $value) {
                  $pdf->Cell(0, 10, 'Material '.$value['idMaterial_Osteosintesis'], 0, 1);
                  $pdf->write1DBarcode(str_replace('-','',$value['codigo_barra']), 'C39', '', '', '', 18, 0.4, $style, 'N');
               }
               $pdf->Output('codigo_barras.pdf', 'I');
            }
            else {
               redirect('configuracion/sistema_osteo/index','refresh');
            }
         } 
         else {
            redirect('iconfiguracion/sistema_osteo/index','refresh');
         }
      } 
      else {
         redirect('configuracion/sistema_osteo/index','refresh');
      }
   }

   public function removerMaterialSistema() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('idMaterial_Osteosintesis','ID material','trim|required|integer');
         $this->form_validation->set_rules('idsistema_material','ID sistema','trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            Modules::run('master/update','sistema_material_osteosintesis',array('status' => '0'),$this->input->post());
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

   public function asignarMaterialSistema() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('idMaterial_Osteosintesis','ID material','trim|required|integer');
         $this->form_validation->set_rules('idsistema_material','ID sistema','trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $lastMaterial = $this->getLastMaterial($this->input->post('idsistema_material'),$this->input->post('idMaterial_Osteosintesis'));
            if ($lastMaterial['si']) { 
               $codigo = $lastMaterial['codigo'] . addNumToStr($lastMaterial['sigue']);
               Modules::run('master/insert','sistema_material_osteosintesis',array(
                  'idMaterial_Osteosintesis' => $this->input->post('idMaterial_Osteosintesis'),
                  'idsistema_material'       => $this->input->post('idsistema_material'),
                  'codigo_barra' => $codigo
               ));
               $json = array(
                  'action' => '1'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Error: Relación no encotrada del sistema'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function sistema_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_sistema','ID sistema','trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $sistema = Modules::run('master/filas_c',array(
               'tabla'     => 'sistema_material',
               'condicion' => array(
                  'status' => '0',
                  'idSistema_Material' => $this->input->post('id_sistema')
               )
            ));
            if (!empty($sistema)) {
               $categorias = Modules::run('master/filas_c',[
                  'tabla' => 'categorias_sis_materiales_vac',
                  'condicion' => [
                     'status' => '1'
                  ]
               ]);
               $optionHTMLCateg = '<option value="">Seleccionar</option>';
               foreach ($categorias as $value) {
                  $optionHTMLCateg .= '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
               }
               $proveedores = Modules::run('master/filas_c',[
                  'tabla' => 'proveedor',
                  'condicion' => [
                     'status' => '1'
                  ]
               ]);
               $optionHTML = '<option value="">Seleccionar</option>';
               foreach ($proveedores as $value) {
                  $optionHTML .= '<option value="'.$value['idproveedor'].'">'.$value['nombre'].'</option>';
               }
               $proveedor = Modules::run('master/filas_c',[
                  'tabla' => 'proveedor',
                  'condicion' => [
                     'idproveedor' => $sistema[0]['idProveedor']
                  ]
               ]);
               $materiales = $this->Sistema_osteo_m->getMaterialesVac($sistema[0]['idSistema_Material']);
               $materialesId = [];
               $nombreMateriales = [];
               foreach ($materiales as $key => $value) {
                  $materialesId[] = $value['idMaterial_Osteosintesis'];
                  $nombreMateriales[] = $value['nombre'];
               }
               $stringMateriales = implode(' - ',$nombreMateriales);
               $json = [
                  'action' => '1',
                  'idSistema' => $sistema[0]['idSistema_Material'],
                  'optionCategorias' => $optionHTMLCateg,
                  'optionProveedor' => $optionHTML,
                  'nombre' => $sistema[0]['nombre'], 
                  'idCategoria' => $sistema[0]['categoria'],
                  'nombreProveedor' => $proveedor[0]['nombre'],
                  'idProveedor' => $proveedor[0]['idproveedor'],
                  'nombreMateriales' => $stringMateriales,
                  'materiales' => $materialesId
               ];
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Sistema no disponible'
               ); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function update() {
      if ($this->input->is_ajax_request()) { 
         if ($this->input->post('nombre') != $this->input->post('old_name')) {
            $this->form_validation->set_rules('nombre', 'nombre del sistema', 'trim|required|max_length[45]|is_unique[sistema_material.nombre]');
         }
         $this->form_validation->set_rules('categoria', 'ID categoría', 'trim|required|integer');
         $this->form_validation->set_rules('idProveedor', 'ID proveedor', 'trim|required|integer');
         $this->form_validation->set_rules('idSistema_Material', 'ID sistema', 'trim|required|integer');
         // $this->form_validation->set_rules('materiales', 'materiales del sistema', 'trim|required');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            Modules::run(
               'master/update','sistema_material',
               elements(['nombre','idProveedor','categoria'],$this->input->post()),
               ['idSistema_Material'=>$this->input->post('idSistema_Material')]
            );
            if (!($this->input->post('materiales') === $this->input->post('materiales_old'))) {
               foreach ($this->input->post('materiales_old') as $key => $value) {
                  Modules::run('master/update','sistema_material_osteosintesis',array('status' => '0'),array(
                     'idMaterial_Osteosintesis' => $value
                  ));
               }
               foreach ($this->input->post('materiales') as $key => $value) {
                  $lastMaterial = $this->getLastMaterial($this->input->post('idSistema_Material'),$value);
                  if ($lastMaterial['si']) { 
                     $codigo = $lastMaterial['codigo'] . addNumToStr($lastMaterial['sigue']);
                     Modules::run('master/insert','sistema_material_osteosintesis',array(
                        'idMaterial_Osteosintesis' => $value,
                        'idsistema_material'       => $this->input->post('idSistema_Material'),
                        'codigo_barra' => $codigo
                     ));
                  }
                  else {
                     $json = array(
                        'action' => '2',
                        'msj'    => 'Error: Relación no encotrada del sistema'
                     ); // Error validación
                     $this->output->set_content_type('application/json')->set_output(json_encode($json));
                  }
               }
            }
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

   public function insert() {
      if ($this->input->is_ajax_request()) { 
         $this->form_validation->set_rules('nombre', 'nombre del sistema', 'trim|required|max_length[45]|is_unique[sistema_material.nombre]');
         $this->form_validation->set_rules('categoria', 'ID categoría', 'trim|required|integer');
         $this->form_validation->set_rules('idProveedor', 'ID proveedor', 'trim|required|integer');
         // $this->form_validation->set_rules('materiales', 'materiales del sistema', 'trim|required');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $last_id = $this->Sistema_osteo_m->last_id('sistema_material','idSistema_Material');
            $last_id = $last_id[0]['idSistema_Material'];
            $codigo_sistema = array(
               1 => '0000',
               2 => '000000000',
               3 => '0000'
            );
            $codigo_sistema[3] = str_pad($last_id+1,4,'0',STR_PAD_LEFT);
            $post = $this->input->post();
            $post['codigo_barra'] = $codigo_sistema[1].'-'.$codigo_sistema[2].'-'.$codigo_sistema[3];
            // INSERT INTO sistema_material (nombre, idTipo_Cirugia, idProveedor) 
            // VALUES ("<NOMBRE>", "<ID_TIPO_CIRUGIA>", "ID_PROVEEDOR")
            $data = elements(array('nombre','categoria','idProveedor','codigo_barra'),$post);
            $data['idModulo'] = $this->config->item('modulo')['materiales_consumo'];
            Modules::run('Master/insert','sistema_material',$data);
            $id_sistema = $this->db->insert_id();
            $codigo_material = array(
               1 => $codigo_sistema[1],
               2 => $codigo_sistema[2],
               3 => $codigo_sistema[3],
               4 => '00000'
            );
            $num = 1;
            foreach ($post['materiales'] as $value) {
               $codigo_material[4] = str_pad($num,5,'0',STR_PAD_LEFT);
               // INSERT INTO sistema_material_osteosintesis (idMaterial_Osteosintesis, idsistema_material) 
               // VALUES ("<ID_MATERIAL_OSTEOSINTESIS>","<ID_SISTEMA_MATERIAL>")
               Modules::run('Master/insert','sistema_material_osteosintesis',array(
                  'idMaterial_Osteosintesis' => $value,
                  'idsistema_material'       => $id_sistema,
                  'codigo_barra' => $codigo_material[1].'-'.$codigo_material[2].'-'.$codigo_material[3].'-'.$codigo_material[4]
               ));  
               $num++;
            }
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function get_materiales() {
      if ($this->input->is_ajax_request()) { 
         // $materiales = Modules::run('master/filas',array('tabla' => 'material_osteosintesis'));
         // $materiales = $this->Sistema_osteo_m->getMaterialesVacTotal();
         $materiales = $this->Sistema_osteo_m->getMaterialesVacNo();
         if (!empty($materiales)) {
            $materiales = html_purify($materiales);
            $tr = '';
            foreach ($materiales as $value) {
               $tr .= 
               '<tr class="pointer" data-id-material="'.$value['idMaterial_Osteosintesis'].'">
                  <td>'.$value['nombre'].'</td>
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
               'msj'    => 'Materiales no encontrados'
            ); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function getSisMaterialesTotal() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_sistema', 'ID sistema', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $materiales = $this->Sistema_osteo_m->getMaterialesVac($this->input->post('id_sistema'));
            $materialesNo = $this->Sistema_osteo_m->getMaterialesVacNo($this->input->post('id_sistema'));
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $tr = '';
               foreach ($materiales as $value) {
                  $btnIcon = '<i data-id-accion="quitar-material" data-toggle="tooltip" title="Quitar material" class="tip acciones fa fa-times-circle pointer fa-2x"></i>';
                  $tr .= 
                     '<tr data-id-material="'.$value['idMaterial_Osteosintesis'].'" data-id-sistema="'.$this->input->post('id_sistema').'">
                        <td>'.$value['nombre'].'</td>
                        <td class="text-center">'.$value['cantidad'].'</td>
                        <td class="iconos-acciones iconos-1">
                          '.$btnIcon.' 
                        </td>
                     </tr>';
               }
               if (!empty($materialesNo)) {
                  $materialesNo = html_purify($materialesNo);
                  foreach ($materialesNo as $value) {
                     if (!$this->inList($materiales,$value['idMaterial_Osteosintesis'])) {
                        $btnIcon = '<i data-id-accion="agregar-material" data-toggle="tooltip" title="Asignar material" class="tip acciones fa fa-check-circle pointer fa-2x"></i>';
                        $tr .= 
                           '<tr data-id-material="'.$value['idMaterial_Osteosintesis'].'" data-id-sistema="'.$this->input->post('id_sistema').'">
                              <td>'.$value['nombre'].'</td>
                              <td class="text-center">'.$value['cantidad'].'</td>
                              <td class="iconos-acciones iconos-1">
                                '.$btnIcon.' 
                              </td>
                           </tr>';
                     }
                  }
               } 
               $json = array(
                  'action' => '1',
                  'tr'    => $tr,
                  'last' => $this->db->last_query()
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Materiales no encontrados'
               ); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }            
         }
      }
      else {
          redirect('inicio/index','refresh');
      }
   }

   public function get_sis_materiales() {
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_sistema', 'ID sistema', 'trim|required|integer');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $materiales = $this->Sistema_osteo_m->get_mat_por_sis($this->input->post('id_sistema'));
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $tr = '';
               foreach ($materiales as $value) {
                  $tr .= 
                     '<tr>
                        <td>'.$value['m_nombre'].'</td>
                        <td>'.$value['cantidad'].'</td>
                        <td>'.$value['maxima'].'</td>
                        <td>'.$value['minima'].'</td>
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
                  'msj'    => 'Materiales no encontrados'
               ); // Error 404
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }            
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function buscar_proveedor() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('busqueda', 'buscar', 'trim|required|max_length[100]');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = (array(
               'action' => '2',
               'msj'    => validation_errors()
            )); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $empleado = $this->Sistema_osteo_m->buscar_proveedor($this->input->post('busqueda'));
            if (!empty($empleado)) {
               $tr = '';
               foreach ($empleado as $value) {
                  $tr .= 
                     '<tr data-id="'.$value['idproveedor'].'" data-nombre="'.$value['nombre'].'">
                        <td class="text-center">'.$value['nombre'].'</td>
                        <td>'.$value['correo'].'</td>
                        <td>'.$value['telefono'].'</td>
                     </tr>';
               }
               $json = array(
                  'action' => '1',
                  'tr'     => $tr
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
                $json = array(
                  'action' => '2'
               ); // Error 404
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
         // $materiales = Modules::run('Master/filas',array('tabla' => 'material_osteosintesis'));
         $sistemas = $this->Sistema_osteo_m->consulta();
         if (!empty($sistemas)) {
            $sistemas = html_purify($sistemas);
            $tr = '';
            foreach ($sistemas as $value) {
               $btnStatus = ($value['status'] == '1' ? '<span class="label b-green-i c-white">Activo</span>' : '<span class="label">Inactivo</span>');
               $btnActivar = ($value['status'] == '1' ? '<i data-id-accion="eliminar" data-toggle="tooltip" title="Desactivar" class="tip acciones fa fa-trash pointer fa-2x"></i>':'<i data-id-accion="activar" data-toggle="tooltip" title="Activar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>');
               $tr .= 
               '<tr data-status="'.$value['status'].'" data-id-sistema="'.$value['id_sistema'].'" data-id-proveedor="'.$value['id_proveedor'].'">
                  <td data-id-accion="asignacion-materiales" class="text-center pointer acciones">'.$value['s_nombre'].'</td>
                  <td>'.$value['p_nombre'].'</td>
                  <td>'.$value['c_nombre'].'</td>
                  <td data-value="'.$value['status'].'" class="text-center">
                     '.$btnStatus.'
                  </td>
                  <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                     <i data-toggle="tooltip" title="" class="tip acciones fa fa-arrow-circle-right pointer fa-2x" data-original-title="Ver más"></i>
                  </td>
                  <td class="iconos-acciones iconos-3">
                     <i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>   
                     '.$btnActivar.'
                     <a class="c-green-b-i" target="_blank" href="'.base_url('configuracion/sistema_osteo/barcode?sis='.md5($value['id_sistema'])).'">
                        <i data-id-accion="codigo_barra" data-toggle="tooltip" title="Código de barras" class="tip acciones fa fa-barcode pointer fa-2x"></i>
                     </a>
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
               'msj'    => 'Materiales no encontrados'
            ); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      } 
      else {
         redirect('inicio/index','refresh');
      }
   }

   private function inList($materiales,$idMaterial) {
      $inList = FALSE;
      foreach ($materiales as $key => $value) {
         if ($value['idMaterial_Osteosintesis'] == $idMaterial) {
            $inList = TRUE;
            break;
         }
      }
      return $inList;
   }

   private function getLastMaterial($idSistema,$idMaterial) {
      $material = $this->Sistema_osteo_m->getLastMaterialSistema($idSistema);
      if (!empty($material)) {
         $last = explode('-',$material[0]['codigo_barra']);
         return [
            'si' => TRUE,
            'codigo' => $last[0].'-'.$last[1].'-'.$last[2].'-',
            'sigue' => intval($last[3])+1
         ];
      } 
      else {
         return [
            'si' => FALSE
         ];
      }
   }

}

/* End of file Sistema_osteo.php */
/* Location: ./application/modules/configuracion/controllers/Sistema_osteo.php */