<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
class Almacen_osteo extends Config {

   private static $msj = ''; 

   public function __construct() {
      parent::__construct();
      $this->load->model('Almacen_osteo_m');
      $this->load->model('config/config_mdl');
      $this->form_validation->set_error_delimiters('','');
      self::$msj = json_decode(MSJ,TRUE);
   }


   public function index() {
      
   }

   public function pendiente() {
      $this->load->view('almacen/almacen_o');
   }
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
        $sql['Gestion']=  $this->Almacen_osteo_m->_get_sistemas();
        $this->load->view('almacen/gestion_inventario',$sql);
    }
    public function agregar_sistema() {
        $sql['info']=$this->Almacen_osteo_m->_get_sistema($this->input->get_post('id'));
        $this->load->view('almacen/agregar_sistema',$sql);
    }
    public function get_proveedores() {
        foreach ($this->contratos_mdl->_get_proveedores() as $value) { 
            if($value['prov_tipo']=='Personal moral'){
                $option.='<option value="'.$value['prov_id'].'">'.$value['prov_razon_social'].'</option>';
            }else{
                $option.='<option value="'.$value['prov_id'].'">'.$value['prov_nombre'].'</option>';
            }
            
        }
        $this->setOutput(array('option'=>$option)); 
    }
    public function insert_sistema() {
        $data=array(
            'sistema_nombre'=>  $this->input->post('sistema_nombre'),
            'sistema_descripcion'=>  $this->input->post('sistema_descripcion'),
            'sistema_contrato'=>  $this->input->post('sistema_contrato'),
            'prov_id'=>  $this->input->post('prov_id')
        );
        if($this->input->post('jtf_accion')=='add'){
            $sql=  $this->Almacen_osteo_m->_insert('os_sistema_osteosintesis',$data);
            if($sql){
                $this->setOutput(array('accion'=>1));
            }else{
                $this->setOutput(array('accion'=>1));
            }
        }else{
            $sql=  $this->Almacen_osteo_m->_update_sistema($this->input->post('jtf_Id'),$data);
            if($sql){
                $this->setOutput(array('accion'=>1));
            }else{
                $this->setOutput(array('accion'=>1));
            }    
        }
    }
    public function sistema_material() {
        $sql['Gestion']=  $this->Almacen_osteo_m->_get_materiales_sistema($this->input->get_post('id'));
        $this->load->view('almacen/material_sistema',$sql);
    }
    public function agregar_material() {
        $sql['info']=$this->Almacen_osteo_m->_get_material_sistema($this->input->get_post('id'));
        $this->load->view('almacen/agregar_material',$sql);
    }
    
   public function programar_cirugia() {
      $this->load->view('hospitalizacion/programar_cirugia');
   }
    public function insert_material() {
        if($this->input->post('material_intermedio')=='No'){
            $cantidad=$this->input->post('material_cantidad');
        }else{
            $cantidad='';
        }
        $data=array(
            'material_nombre'       =>  $this->input->post('material_nombre'),
            'material_descripcion'  =>  $this->input->post('material_descripcion'),
            'material_clave'        =>  $this->input->post('material_clave'),
            'material_img'          =>  $this->input->post('filename'),
            'material_intermedio'   =>  $this->input->post('material_intermedio'),
            'material_cantidad'     =>  $cantidad,
            'empleado_id'           =>  $_SESSION['sess']['idUsuario'],
            'sistema_id'            =>  $this->input->post('sistema_id')
        );
        if($this->input->post('jtf_accion')=='add'){
            $sql=  $this->Almacen_osteo_m->_insert('os_material_osteosintesis',$data);
            if($sql){
                if($this->input->post('material_intermedio')=='No'){
                    $sql_max=  $this->Almacen_osteo_m->_get_max_material();
                    for ($i = 0; $i < $this->input->post('material_cantidad'); $i++) {
                        
                        $this->Almacen_osteo_m->_insert('os_material_osteosintesis_intermedias_cb',array(
                            'intemediocd_status'=>'Disponible',
                            'intermediocd_sm'=>$this->input->post('sistema_id'),
                            'intermediocd_tipo'=>'Material',
                            'intermedia_id'=>$sql_max[0]['material_id']
                        ));
                    }
                    $this->Almacen_osteo_m->_insert('os_materiales_historial',array(
                        'historial_cantidad'=>  $this->input->post('material_cantidad'),
                        'historial_tipo'=>'Material',
                        'historial_accion'=>'Agregar',
                        'historial_fecha'=>  $this->input->post('jtf_fecha'),
                        'material_id'=>$sql_max[0]['material_id']
                    ));
                }
                $this->setOutput(array('accion'=>'1','id'=>$this->input->post('sistema_id')));
            }else{
                $this->setOutput(array('accion'=>'2','id'=>$this->input->post('sistema_id')));
            }
        }else{
            $sql=  $this->Almacen_osteo_m->_update_material($this->input->post('jtf_Id'),$data);
            if($sql){
                $this->setOutput(array('accion'=>'1','id'=>$this->input->post('sistema_id')));
            }else{
                $this->setOutput(array('accion'=>'2','id'=>$this->input->post('sistema_id')));
            }    
        }
    }
    public function material_intermedio() {
        $sql['Gestion']=  $this->Almacen_osteo_m->_get_materiales_intermedios($this->input->get_post('m'));
        $this->load->view('almacen/material_intermedio',$sql);
    }
    public function agregar_material_intermedio() {
        $sql['info']=  $this->Almacen_osteo_m->_get_material_intermedio($this->input->get_post('id'));
        $this->load->view('almacen/agregar_material_intermedio',$sql);
    }
    public function insert_material_intermedio() {
        $data=array(
            'intermedia_nombre'=>  $this->input->post('intermedia_nombre'),
            'intermedia_descripcion'=>  $this->input->post('intermedia_descripcion'),
            'intermedia_medida'=>  $this->input->post('intermedia_medida'),
            'intermedia_cantidad'=>  $this->input->post('intermedia_cantidad'),
            'intermedia_codigo_barras'=> rand(0,100000)*1000000,
            'material_id'=>  $this->input->post('material_id')
        );
        if($this->input->post('jtf_accion')=='add'){
            $sql=  $this->Almacen_osteo_m->_insert('os_material_osteosintesis_intermedias',$data);
            $sql_max=  $this->Almacen_osteo_m->_get_max_materialintermedio();
            for ($i = 0; $i < $this->input->post('intermedia_cantidad'); $i++) {
                $this->Almacen_osteo_m->_insert('os_material_osteosintesis_intermedias_cb',array(
                    'intemediocd_status'=>'Disponible',
                    'intermediocd_tipo'=>'Material intermedio',
                    'intermediocd_sm'=>  $this->input->post('jtf_si').$this->input->post('material_id'),
                    'intermedia_id'=>$sql_max[0]['intermedia_id']
                ));
            }
            $this->Almacen_osteo_m->_insert('os_materiales_historial',array(
                'historial_cantidad'=>  $this->input->post('intermedia_cantidad'),
                'historial_tipo'=>'Material intermedio',
                'historial_accion'=>'Agregar',
                'historial_fecha'=>  $this->input->post('jtf_fecha'),
                'material_id'=>$sql_max[0]['intermedia_id']
            ));
            if($sql){
                echo '<script>alert("Registro Guardado");location.href="'.  base_url().'materiales_consumo/almacen_osteo/material_intermedio?m='.$this->input->post('material_id').'&si='.$this->input->get_post('jtf_si').'"</script>';
                //$this->setOutput(array('accion'=>1));
            }else{
                echo '<script>alert("Error al guardar Guardado");location.href="'.  base_url().'materiales_consumo/almacen_osteo/material_intermedio?m='.$this->input->post('material_id').'&si='.$this->input->get_post('jtf_si').'"</script>';
                //$this->setOutput(array('accion'=>1));
            }
        }else{
            $sql=  $this->Almacen_osteo_m->_update_material_intermedio($this->input->post('jtf_Id'),$data);
            if($sql){
                echo '<script>alert("Registro Guardado");location.href="'.  base_url().'materiales_consumo/almacen_osteo/material_intermedio?m='.$this->input->post('material_id').'&si='.$this->input->get_post('jtf_si').'"</script>';
                //$this->setOutput(array('accion'=>1));
            }else{
                echo '<script>alert("Error al guardar Guardado");location.href="'.  base_url().'materiales_consumo/almacen_osteo/material_intermedio?m='.$this->input->post('material_id').'&si='.$this->input->get_post('jtf_si').'"</script>';
                //$this->setOutput(array('accion'=>1));
            }    
        }
    }
    public function delete_sistema() {
        if($this->Almacen_osteo_m->_delete_sistema($this->input->get_post('id'))){
            $this->setOutput(array('accion'=>'1','url'=>'delete_sistema'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_material() {
        if($this->Almacen_osteo_m->_delete_material($this->input->get_post('id'))){
            $this->setOutput(array('accion'=>'1','url'=>'delete_material'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_material_intermedio() {
        if($this->Almacen_osteo_m->_delete_material_intermedio($this->input->get_post('id'))){
            $this->setOutput(array('accion'=>'1','url'=>'delete_material_intermedio'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function codigosdebarrami() {
        $sql['Gestion']=  $this->Almacen_osteo_m->_get_codigosbarrami($this->input->get_post('mi'));
        $this->load->view('almacen/material_intermedio_cb',$sql);
    }
    public function codigosdebarram() {
        $sql['Gestion']=  $this->Almacen_osteo_m->_get_codigosbarram($this->input->get_post('m'));
        $this->load->view('almacen/material_cb',$sql);
    }
    public function generarcodigo() {
        $sql['cb']=  $this->Almacen_osteo_m->_get_codigobarra($this->input->get_post('cb'));
        $this->load->view('almacen/generar_codigodebarras',$sql);
    }
    public function update_cantidad_m() {
        $c_o=$this->input->post('cantidad_old');
        $c_n=$this->input->post('cantidad_new');
        $sql=  $this->Almacen_osteo_m->_update_material($this->input->post('material_id'),array(
            'material_cantidad'=>$c_o+$c_n
        ));
        if($sql){
            for ($i = 0; $i < $this->input->post('cantidad_new'); $i++) {

                $this->Almacen_osteo_m->_insert('os_material_osteosintesis_intermedias_cb',array(
                    'intemediocd_status'=>'Disponible',
                    'intermediocd_sm'=>$this->input->post('sistema_id'),
                    'intermediocd_tipo'=>'Material',
                    'intermedia_id'=>$this->input->post('material_id')
                ));
            }
            $this->Almacen_osteo_m->_insert('os_materiales_historial',array(
                'historial_cantidad'=>  $this->input->post('cantidad_new'),
                'historial_tipo'=>'Material',
                'historial_accion'=>'Actualización',
                'historial_fecha'=>  $this->input->post('jtf_fecha'),
                'material_id'=>$this->input->post('material_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function update_cantidad_mi() {
        $c_n=$this->input->post('cantidad_new');
        $c_o=$this->input->post('cantidad_old');
            $sql=  $this->Almacen_osteo_m->_update_material_intermedio($this->input->post('material_inter_id'),array(
                'intermedia_cantidad'=>  $c_o+$c_n
            ));
            if($sql){
                for ($i = 0; $i < $this->input->post('cantidad_new'); $i++) {
                    $this->Almacen_osteo_m->_insert('os_material_osteosintesis_intermedias_cb',array(
                        'intemediocd_status'=>'Disponible',
                        'intermediocd_tipo'=>'Material intermedio',
                        'intermediocd_sm'=>  $this->input->post('sistema_id').$this->input->post('material_id'),
                        'intermedia_id'=>$this->input->post('material_inter_id')
                    ));
                }
                $this->Almacen_osteo_m->_insert('os_materiales_historial',array(
                    'historial_cantidad'=>  $this->input->post('cantidad_new'),
                    'historial_tipo'=>'Material intermedio',
                    'historial_accion'=>'Actualización',
                    'historial_fecha'=>  $this->input->post('jtf_fecha'),
                    'material_id'=>$this->input->post('material_inter_id')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }  
    }
    public function entregarmateriales() {
        $this->config_mdl->_update_data('os_solicitud_material_osteosintesis',array('solicitud_status'=>'0'),array(
            'solicitud'=>  $this->input->get_post('s')
        ));
        $sql['codigos']=  $this->Almacen_osteo_m->_get_material_m_entregar($this->input->get_post('s'));
        $this->load->view('almacen/entregar_materiales',$sql);
    }
   public function gestionar_cirugia() {
      $cirugias = Modules::run('materiales_consumo/hospitalizacion/getCirugias');
      $data['cirugias'] = ($cirugias != '' ? $cirugias : false);
      $this->load->view('hospitalizacion/gestionar_cirugia',$data);
   }

   // ------------------------------
   // - Peticiones de AJAX
   // ------------------------------
   
   public function materiales($idTratamiento='0') {
      $materiales = Modules::run('master/filas_c',array(
         'tabla' => 'cirugia_material_osteosintesis',
         'condicion' => [
            'idCirugia' => $idTratamiento
         ]
      ));
      if (!empty($materiales)) {
         $materiales = $this->reempGuionByEspacio($materiales);
         $this->pdf->generarBarcodeMateriales($materiales,$idTratamiento);
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

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
            if ($this->revisarExistencia($this->input->post('idCirugia'))) {
               // $this->output->set_content_type('application/json')->set_output(json_encode(['ok']));
               // UPDATE estado_de_cirugia SET idEstado_Cirugia = 3 WHERE idCirugia = <ID_CIRUGIA>
               Modules::run('master/update','estado_de_cirugia',array('idEstado_Cirugia' => '3'),$this->input->post());
               $json = array(
                  'action' => '1',
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'El sistema ha detectado materiales insuficientes, si no es así, favor de actualizar el inventario'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
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
         $this->form_validation->set_rules('accion', 'acción', 'trim|required');
         $this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required|integer');
         $this->form_validation->set_rules('cantidadActual', 'cantidad actual', 'trim|required|integer');
         // $this->form_validation->set_rules('cantMaxMaterial', 'cantidad máxima', 'trim|required|integer|greater_than_equal_to['.$cantidad.']');
         $this->form_validation->set_rules('cantMinMaterial', 'cantidad mínima', 'trim|required|integer|less_than_equal_to['.$cantidad.']');
         // $this->form_validation->set_message('greater_than_equal_to','La cantidad máxima debe ser de: '.$this->input->post('cantMaxMaterial'));
         $this->form_validation->set_message('less_than_equal_to','La cantidad mínima debe ser de: '.$this->input->post('cantMinMaterial'));
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $valido = FALSE;
            $cantidad = $this->input->post('cantidadActual');
            if ($this->input->post('accion') == 'nuevo') {
               $cantidad = $this->input->post('cantidad')+$this->input->post('cantidadActual');
               $valido = TRUE;
            }
            else {
               if ($this->input->post('cantidadActual') > '0' and $this->input->post('cantidad') <= $this->input->post('cantidadActual')) {
                  $cantidad = $this->input->post('cantidadActual')-$this->input->post('cantidad');  
                  $valido = TRUE;
               }
            }
            if ($valido) {
               // UPDATE material_osteosintesis SET cantidad = 3 WHERE  idMaterial_Osteosintesis = <idMaterial>
               Modules::run(
                  'Master/update','material_osteosintesis',
                  ['cantidad'=>$cantidad],
                  elements(['idMaterial_Osteosintesis'],$this->input->post())
               );
               $json = array(
                  'action' => '1'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj' => 'Cantidad no válida'
               ); // Error validación
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
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
         $this->form_validation->set_rules('idSistema', 'ID sistema', 'trim|required|integer');
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
            $materiales = $this->Almacen_osteo_m->consulta_nuevo_material($post['id_material'],$post['id_proveedor'],$post['idSistema']);
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
                  'tr'    => $tr
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
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
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
                       data-max="'.$value['cantidad_maxima'].'" data-min="'.$value['cantidad_minima'].'" data-actual="'.$cantidad.'">
                     <td class="text-center">'.$value['nombre_mat'].'</td>
                     <td>'.$cantidad.'</td>
                     <td>'.$value['cantidad_maxima'].'</td>
                     <td>'.$value['cantidad_minima'].'</td>
                     <td class="iconos-acciones iconos-2">
                        <i data-id-accion="nuevo" data-toggle="tooltip" title="Agregar" class="tip acciones fa fa-plus-circle pointer fa-2x"></i>      
                        <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-minus-circle pointer fa-2x"></i>      
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
                  'msj'    => 'Gestión de procesos no encontrados'
               ); // Error 404
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
                  <td>'.$value['nombre_p'].'</td>
                  <td>'.$value['clave'].'</td>
                  <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                     <i data-toggle="tooltip" class="tip acciones fa fa-arrow-circle-right pointer fa-2x" title="Ver más"></i>
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
               'msj'    => 'Gestión de procesos no encontrados'
            ); // Error 404
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
            $json = array(
               'action' => '1',
               'tr'     => $tr
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron archivos'
            ); // No encontrados
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
            $json = array(
               'action'     => '1',
               'id_usuario' => $info_usuaro[0]['idUsuario'],
               'nombre'     => $info_usuaro[0]['nombre'].' '.$info_usuaro[0]['apellido_paterno'].' '.$info_usuaro[0]['apellido_materno']
            ); // Error 404
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'     => 'Usuario no encontrado'
            ); // Error 404
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
                  <td>'.$value['derechohabiente'].'</td>
                  <td>'.$value['medico_tratante'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                     <i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                  </td>
                  <td class="iconos-acciones iconos-1">
                     <i data-id-accion="continuar" data-toggle="tooltip" title="Aceptar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>      
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
               'msj'    => 'No se encontraron solicitudes sin existencia'
            ); // No encontrados
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
                  <td class="detalles  iconos-acciones iconos-2" data-sis="materiales">
                     <i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                  </td>
                  <td class="iconos-acciones iconos-2 padd-icon">
                     <i data-id-accion="continuar" data-toggle="tooltip" title="Aceptar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>      
                  </td>
               </tr>';
            }
            $json = array(
               'action' => '1',
               'tr'     => $html_tr
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron solicitudes por entregar'
            ); // No encontrados
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
         $mensaje .= 'Nombre del sistema: <strong>'.$value['sistema']['nombre'].'</strong>  -   Nombre del material: <strong>'.$value['info']['nombre'].'</strong><br>';
      }
      return $mensaje;
   }

   private function revisarExistencia($idCirugia) {
      $sistemasMatElementos = $this->Almacen_osteo_m->detalles_sistema_materiales($idCirugia);
      foreach ($sistemasMatElementos as $key => $sistema) {
         $resultado = $this->Almacen_osteo_m->getMaterialesSinExistencia($sistema['idMaterial_Osteosintesis'],$idCirugia);
         if (!empty($resultado)) {
            return FALSE;
         }
      }
      return TRUE;
   }

   private function enviarNotificacionSinExistencia($idCirugia) {
      $sistemasMatElementos = $this->Almacen_osteo_m->detalles_sistema_materiales($idCirugia);
      $sinExistenciaMateriales = [];
      $elementosSin = FALSE;
      $nota = 'No. Cirugía: ' . $idCirugia;
      $sistemasTodos = [];
      foreach ($sistemasMatElementos as $key => $sistema) {
         $resultado = $this->Almacen_osteo_m->getMaterialesSinExistencia($sistema['idMaterial_Osteosintesis'],$idCirugia);
         if (!empty($resultado)) {
            $sistema = $this->getSistemaByIdMaterial($sistema['idMaterial_Osteosintesis'],$idCirugia);
            $sinExistenciaMateriales[] = [
               'info' => $resultado[0],
               'sistema' => $sistema[0]
            ];
            $elementosSin = TRUE;
            $sistemasTodos[] = $sistema[0];
         }
      }
      if ($elementosSin) {
         $this->crearSolicitudProveedor($sinExistenciaMateriales);
         // $elementosSin = FALSE;
         // $enviado = $this->enviarEmail($sinExistenciaMateriales);
         // if ($enviado === TRUE) {
            // $mensaje = $this->doMensaje('Lista de los sistemas de materiales faltantes <br>',$sinExistenciaMateriales);
            // Modules::run('master/insert','notificacionesdepartamentos',[
            //    'mensaje' => $mensaje,
            //    'destinatario' => '1',
            //    'remitente' => '4',
            //    'subtitulo' => 'Sin existencia',
            //    'url_redirect' => 'inicio/notificaciones',
            //    'nota' => $nota
            // ]);
         // }
         // else {
         //    return NULL;  
         // }
         exit();
      }
      return $elementosSin;
   }

   private function enviarEmail($sistemas) {
      $this->load->library('Mailer');
      $config = array(
         'username' => 'umae.magdalena@gmail.com',
         'password' => 'adminadminumae',
         'gmail' => TRUE,
         'fromName' => 'Hospital Magdalena de la Salinas',
         'confirmar' => TRUE
      );
      $this->mailer->init($config);
      $idSinRepetir = [];
      foreach ($sistemas as $key => $sistema) {
         if (!empty($idSinRepetir)) {
            if (!in_array($sistema['sistema']['idProveedor'],$idSinRepetir)) {
               $idSinRepetir[]['idProveedor'] = $sistema['sistema']['idProveedor'];
            }
         }
         else {
            $idSinRepetir[]['idProveedor'] = $sistema['sistema']['idProveedor'];
         }
      }
      foreach ($idSinRepetir as $key => $value) {
         $idSinRepetir[$key]['mensaje'] = 'Lista de los sistemas de materiales faltantes <br>';
         foreach ($sistemas as $sistema) {
            if ($sistema['sistema']['idProveedor'] == $value['idProveedor']) {
               $idSinRepetir[$key]['mensaje'] .= 'Nombre del sistema: <strong>'.$sistema['sistema']['nombre'].'</strong>  -   Nombre del material ó instrumento: <strong>'.$sistema['info']['nombre'].'</strong><br>';
               $infoProveedor = Modules::run('master/filas_c',array(
                  'tabla' => 'proveedor',
                  'condicion' => [
                     'idProveedor' => $value['idProveedor']
                  ]
               ));
               if (!empty($infoProveedor)) {
                  $idSinRepetir[$key]['email'] = $infoProveedor[0]['correo']; 
                  $idSinRepetir[$key]['nombre'] = $infoProveedor[0]['nombre']; 
                  $enviado = $this->mailer->sendEmailToProveedor($infoProveedor[0]['correo'],$idSinRepetir[$key]['mensaje']);
               }
            }
         }
      }
      return $enviado;
   }

   public function cancelar_a_revision() {
      set_time_limit(300);
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
                  'msj' => 'Se ha enviado un correo al proveedor'
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else if ($sinExistencia == FALSE) {
               $json = array(
                     'action' => '2',
                     'msj' => 'El sistema ha detectado suficientes materiales, si no es así, favor de actualizar el inventario'
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                     'action' => '3',
                     'msj' => 'Fallo al enviar el correo, favor de intentarlo más tarde'
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
                  <td>'.$value['derechohabiente'].'</td>
                  <td>'.$value['medico_tratante'].'</td>
                  <td>'.$value['especialidad'].'</td>
                  <td class="detalles iconos-acciones iconos-1" data-sis="materiales">
                     <i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>
                  </td>
                  <td class="iconos-acciones iconos-3">
                     <i data-id-accion="continuar" data-toggle="tooltip" title="Aceptar" class="tip acciones fa fa-check-circle pointer fa-2x"></i>   
                     <i data-id-accion="detener" data-toggle="tooltip" title="Cancelar" class="tip acciones fa fa-times-circle pointer fa-2x"></i>
                     <a class="c-green-b-i" target="_blank" href="'.base_url('materiales_consumo/almacen_osteo/materiales/'.$value['id_cirugia']).'">
                        <i data-id-accion="codigo_barra" data-toggle="tooltip" title="Código de barras" class="tip acciones fa fa-barcode pointer fa-2x"></i>
                     </a>
                  </td>
               </tr>';
            }
            $json = array(
               'action' => '1',
               'tr'     => $html_tr
            ); // success
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         } 
         else {
            $json = array(
               'action' => '2',
               'msj'    => 'No se encontraron solicitudes a revisión'
            ); // No encontrados
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function testPDF() {
      $data['path'] = base_url();
      $this->pdf->guardarSolicitudProvPDF($data);
   }

   private function crearSolicitudProveedor($materiales) {
      $idSinRepetir = [];
      $idSinRepetirInfo = [];
      foreach ($materiales as $key => $material) {
         if (!in_array($material['sistema']['idProveedor'],$idSinRepetir)) {
            $idSinRepetir[] = $material['sistema']['idProveedor'];
            $idSinRepetirInfo[]['idProveedor'] = $material['sistema']['idProveedor'];
         }
      }
      foreach ($idSinRepetir as $key => $value) {
         $infoProveedor = $this->Almacen_osteo_m->getInfoProveedor($value);
         if (!empty($infoProveedor)) {
            $infoSolicitud = [
               'folio' => $this->getFolio(),
               'proveedor' => $infoProveedor[0]['nombre'],
               'noContrato' => $infoProveedor[0]['clave'],
               'idEmpleadoSolicita' => $this->usuario->getInfoEmpleado()['idEmpleado'],
               'fechaEntrega' => $this->dates->addDate($this->config->item('solicitud_proveedor')['entrega_tipo'],$this->config->item('solicitud_proveedor')['entrega_cantidad']),
               'fechaEmision' => $this->dates->now()
            ];
            Modules::run('master/insert','solicitud_proveedor',$infoSolicitud);
            $lastIdSolictud = $this->db->insert_id();
            foreach ($materiales as $key => $material) {
               if ($material['sistema']['idProveedor'] == $value) {
                  Modules::run('master/insert','solicitud_proveedor_materiales',[
                     'idSolicitud' => $lastIdSolictud,
                     'idMaterial' => $material['info']['idMaterial_Osteosintesis'],
                     'nombreMaterial' => $material['info']['nombre'],
                     'solicitado' => $material['info']['cantidadSolicitada'],
                     'entregado' => $material['info']['cantidadSolicitada']
                  ]);
               }
            }
            $infoSolicitud['idSolicitud'] = $lastIdSolictud;
            $this->pdf->guardarSolicitudProvPDF($value,$materiales,$infoSolicitud);
         }
      }
   }

   private function getFolio() {
      $lastId = Modules::run('master/last_id','id','solicitud_proveedor');
      $folio = $this->config->item('nombre_documentos')['entrega_solicitud']['alias'];
      // CAMBIAR A DINAMICO
      $folio .= $this->config->item('info_umae')['delegacion'];
      $folio .= $this->config->item('info_umae')['umae'];
      $folio .= $this->config->item('info_umae')['unidades']['trauma'];
      $folio .= date('Y');
      $folio .= addNumToStr($lastId+1);
      return $folio;
   }

   private function reempGuionByEspacio($materiales) {
      foreach ($materiales as $key => $value) {
         $materiales[$key]['codigo_barra'] = str_replace('-',' ',$value['codigo_barra']);
      }
      return $materiales;
   }

   // ------------------------------
   // - Fin peticiones de AJAX
   // ------------------------------

}
