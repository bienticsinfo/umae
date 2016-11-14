<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_osteo extends MX_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('Material_osteo_m');
      $this->load->helper('number');
      $this->form_validation->set_error_delimiters('','');
   }

   public function index() {
      $data['materiales'] = $this->getMateriales();
      $this->load->view('material_osteo/index',$data);
   }

   public function cambiarEstado() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('id_material', 'ID material', 'trim|required|integer');
         $this->form_validation->set_rules('status', 'estado', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = $this->input->post();
            Modules::run('master/update','material_osteosintesis',array('status' => $post['status']),array(
               'idMaterial_Osteosintesis' => $post['id_material']
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

   public function update() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('old_name', 'nombre', 'trim|required');
         if ($this->input->post('old_name') != $this->input->post('nombre'))  {
            $this->form_validation->set_rules('nombre', 'nombre del material', 'trim|required|max_length[50]|is_unique[material_osteosintesis.nombre]');
         }
         if ($this->input->post('old_clave') != $this->input->post('clave'))  {
            $this->form_validation->set_rules('clave', 'clave', 'trim|required|max_length[128]|is_unique[material_osteosintesis.clave]');
         }
         $this->form_validation->set_rules('descripcion', 'descripción', 'trim|required');
         $this->form_validation->set_rules('cantidad_maxima', 'cantidad máxima', 'trim|required|integer');
         $this->form_validation->set_rules('cantidad_minima', 'cantidad mínima', 'trim|required|integer');
         $this->form_validation->set_rules('id_material', 'ID material', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = elements(['nombre','cantidad_maxima','cantidad_minima','clave','descripcion'],$this->input->post());
            if (!empty($_FILES)) {
               $isUpload = $this->uploadCropImg($_FILES,elements(['xImgMat','x2ImgMat','yImgMat','y2ImgMat','wImgMat','hImgMat'],$this->input->post()));
               if ($isUpload['success']) {
                  $post['imagen'] = $isUpload['msj'];
               }
            } 
            Modules::run('master/update','material_osteosintesis',$post,array(
               'idMaterial_Osteosintesis' => $this->input->post('id_material')
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

   public function material_por_id() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $this->form_validation->set_rules('idMaterial_Osteosintesis', 'ID material', 'trim|required|integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            // $departamento = $this->Departamento_m->departamento_por_id($this->input->post('id_departamento'));
            $material = Modules::run('master/filas_c',array(
               'tabla' => 'material_osteosintesis',
               'condicion' => $this->input->post()));
            if (!empty($material)) {
               $material = html_purify($material);
               $json = array(
                  'action'          => '1',
                  'id'              => $material[0]['idMaterial_Osteosintesis'],
                  'nombre'          => $material[0]['nombre'],
                  'cantidad_maxima' => $material[0]['cantidad_maxima'],
                  'cantidad_minima' => $material[0]['cantidad_minima'],
                  'clave' => $material[0]['clave'],
                  'descripcion' => $material[0]['descripcion']
                  // 'option'          => $option
               ); // Success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Material no encontrado'
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
      if ($this->input->is_ajax_request()) {
         $cantidad_minima = $this->input->post('cantidad_minima');
         $this->form_validation->set_rules('nombre', 'nombre del material', 'trim|required|max_length[50]|is_unique[material_osteosintesis.nombre]');
         $this->form_validation->set_rules('clave', 'clave', 'trim|required|max_length[128]|is_unique[material_osteosintesis.clave]');
         $this->form_validation->set_rules('descripcion', 'descripción', 'trim|required');
         $this->form_validation->set_rules('cantidad_maxima', 'cantidad máxima', 'trim|required|integer|greater_than_equal_to['.$cantidad_minima.']');
         $this->form_validation->set_rules('cantidad_minima', 'cantidad mínima', 'trim|required|integer|greater_than_equal_to[1]');
         $this->form_validation->set_message('greater_than_equal_to','La {field} debe ser mayor a {param} ');
         if (!empty($_FILES)) {
            $this->form_validation->set_rules('wImgMat', 'ancho de la imagen', 'integer');
            $this->form_validation->set_rules('hImgMat', 'alto de la imagen', 'integer');
         }
         $this->form_validation->set_rules('xImgMat', 'especificaciones de la imagen inválidos', 'integer');
         $this->form_validation->set_rules('x2ImgMat', 'especificaciones de la imagen inválidos', 'integer');
         $this->form_validation->set_rules('yImgMat', 'especificaciones de la imagen inválidos', 'integer');
         $this->form_validation->set_rules('y2ImgMat', 'especificaciones de la imagen inválidos', 'integer');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $post = elements(['nombre','cantidad_maxima','cantidad_minima','clave','descripcion'],$this->input->post());
            if (!empty($_FILES)) {
               $isUpload = $this->uploadCropImg($_FILES,elements(['xImgMat','x2ImgMat','yImgMat','y2ImgMat','wImgMat','hImgMat'],$this->input->post()));
               if ($isUpload['success']) {
                  $post['imagen'] = $isUpload['msj'];
               }
            } 
            $post['idModulo'] = $this->config->item('modulo')['materiales_consumo'];
            // INSERT INTO material_osteosintesis (nombre, cantidad, cantidad_maxima, cantidad_minima) 
            // VALUES ("<NOMBRE>", "0", "<CANTIDAD MAXIMA>", "<CANTIDAD MINIMA>")
            Modules::run('master/insert','material_osteosintesis',$post);
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

   public function consulta() {
      $ajax_request = $this->input->is_ajax_request();
      if ($ajax_request) {
         $materiales = $this->getMateriales();
         if ($materiales != '') {
            $json = array(
               'action'     => '1',
               'materiales' => $materiales
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

   // ------------------------------------------------------------------------
   // FIN DE PETICIONES AJAX
   // ------------------------------------------------------------------------
   
   private function uploadCropImg($files,$post) {
      
      $config['upload_path']   = $this->config->item('url_destino')['materiales_img'];
      $config['allowed_types'] = $this->config->item('allowed_types')['materiales_img'];
      $config['max_size']      = $this->config->item('upload_size')['materiales_img'];
      $config['encrypt_name']  = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')){
         return array('success ' => FALSE,'msj' => $this->upload->display_errors());
      }
      else{
         $imagen = $this->upload->data();
         if ($post['xImgMat'] != '0') {
            $config                   = [];
            $urlTmpImagen             = $this->config->item('url_destino')['materiales_img'].'/'.$imagen['file_name'];
            $config['source_image']   = $urlTmpImagen;
            $config['maintain_ratio'] = FALSE;
            $config['x_axis'] = $this->getSizeNatural([
               'o_size' => $imagen['image_width'],
               'c_size' => $post['xImgMat'],
               'r_size' => $post['wImgMat']
            ]);
            $config['y_axis'] = $this->getSizeNatural([
               'o_size' => $imagen['image_height'],
               'c_size' => $post['yImgMat'],
               'r_size' => $post['hImgMat']
            ]);
            $config['width'] = intval($this->getSizeNatural([
               'o_size' => $imagen['image_width'],
               'c_size' => $post['x2ImgMat'],
               'r_size' => $post['wImgMat']
            ])) - intval($this->getSizeNatural([
               'o_size' => $imagen['image_width'],
               'c_size' => $post['xImgMat'],
               'r_size' => $post['wImgMat']
            ]));
            $config['height'] = intval($this->getSizeNatural([
               'o_size' => $imagen['image_height'],
               'c_size' => $post['y2ImgMat'],
               'r_size' => $post['hImgMat']
            ])) - intval($this->getSizeNatural([
               'o_size' => $imagen['image_height'],
               'c_size' => $post['yImgMat'],
               'r_size' => $post['hImgMat']
            ]));
            $this->load->library('image_lib',$config);
            if (!$this->image_lib->crop()) {
               return array('success ' => FALSE,'msj' => $this->image_lib->display_errors());
            }
            else {
               return array('success' => TRUE, 'msj' => $imagen['file_name'] );  
            }
         }
         else {
            return array('success' => TRUE, 'msj' => $imagen['file_name'] );   
         }
      }
   }

   private function getSizeNatural($sizes) {
      return round(($sizes['o_size'] * $sizes['c_size']) / $sizes['r_size']); 
   }

   public function getMateriales() {
      $materiales = $this->Material_osteo_m->getMaterialesVac();
      if (!empty($materiales)) {
         $materiales = html_purify($materiales);
         $materiales = $this->tables->addCellValue($materiales,'imagen_url','');
         $materiales = $this->tables->addCellValue($materiales,'accion','');
         $materiales = $this->tables->setAttr($materiales,[
            'tr' => ['data-id-material'=>'idMaterial_Osteosintesis','data-imagen'=>'imagen'],
            'nombre' => ['class'=>'text-center'],
            'cantidad_maxima' => ['class'=>'text-center'],
            'cantidad_minima' => ['class'=>'text-center'],
            'accion' => ['class'=>'iconos-acciones iconos-2'],
            'imagen_url' => ['class'=>'text-center'],
            'clave' => ['class'=>'text-center'],
            'status' => ['data-value'=>'status']
         ]);
         $materiales = $this->tables->setCallBack($materiales,[
            'imagen_url' => 'setImagenMaterial',
            'status' => 'setStatus',
            'accion' => 'setIconsMateriales'
         ]);
         $this->tables->noAttr = ['idMaterial_Osteosintesis','cantidad','imagen','idModulo'];
         return $this->tables->generate($materiales,'tbodyTr');
      } 
      else {
         return '';
      }
   }

}

/* End of file Material_osteo.php */
/* Location: ./application/modules/configuracion/controllers/Material_osteo.php */