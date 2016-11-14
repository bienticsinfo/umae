<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
class Hospitalizacion extends Config {
   private static $msj = ''; 
    function __construct() {
        parent::__construct();
        $this->load->model(['Hospitalizacion_m']);
        $this->load->model('materiales_consumo/Almacen_osteo_m');
        $this->load->model('configuracion/Derechohabiente_m');
        $this->load->model('config/config_mdl');

        $this->form_validation->set_error_delimiters('','');
        self::$msj = json_decode(MSJ,TRUE);
    }
    public function index() {
        redirect('inicio/index','refresh');
    }
    public function programar_cirugia() {
        $this->load->view('hospitalizacion/programar_cirugia');
    }
    public function gestionar_cirugia() {
        if($_SESSION['sess']['idRol']=='5' || $_SESSION['sess']['idRol']=='2'){
            $data['cirugias'] = $this->Hospitalizacion_m->_get_cirugias_almacen();
        }else{
            $data['cirugias'] = $this->Hospitalizacion_m->_get_cirugias();
        }
        
        $this->load->view('hospitalizacion/gestionar_cirugia',$data);
    }   
    public function get_dh_mt() {
        foreach ($this->Derechohabiente_m->_get_derechohabiente() as $value) { 
            $option_dh.='<option value="'.$value['derechohabiente_id'].'">'.$value['derechohabiente_nombre'].' '.$value['derechohabiente_apat'].' '.$value['derechohabiente_amat'].'</option>';
        }
        foreach ($this->Hospitalizacion_m->_get_medico_tratante() as $value) { 
            $option_mt.='<option value="'.$value['empleado_id'].'">'.$value['empleado_nombre'].' '.$value['empleado_apellidos'].'</option>';
        }
        foreach ($this->Almacen_osteo_m->_get_sistemas() as $value) { 
            if($value['prov_tipo']=='Personal moral'){
                $option=$value['prov_razon_social'];
            }else{
                $option=$value['prov_nombre'];
            }
            $option_si.='<option value="'.$value['sistema_id'].'">'.$value['sistema_nombre'].' | '.$option.'</option>';
        }
        $this->setOutput(array('option_dh'=>$option_dh,'option_mt'=>$option_mt,'option_si'=>$option_si));
    }
    public function get_materiales() {
        $sql_m=  $this->Almacen_osteo_m->_get_materiales_sistema($this->input->get_post('id'));
        foreach ($sql_m as $value) {
               if($value['material_intermedio']=='Si'){
                   $sql_mi=  $this->Almacen_osteo_m->_get_materiales_intermedios($value['material_id']);
                   foreach ($sql_mi as $mi) {
                       if($mi['intermedia_cantidad']!='0' ){
                            $tr.='<tr class="">
                                <td>
                                    <label class="md-check">
                                        <input type="checkbox" class="has-value">
                                        <i class="green"></i>
                                    </label>
                                </td>
                                <td>'.$mi['intermedia_nombre'].'</td>
                                <td>'.$mi['intermedia_cantidad'].'</td>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control cantidad-agregar" data-tipo="Material intermedio" data-existencia="'.$mi['intermedia_cantidad'].'" data-s="'.$mi['sistema_id'].'" data-m="'.$mi['material_id'].'" data-m-i="'.$mi['intermedia_id'].'">
                                    </div>
                                </td>
                            </tr>';
                       }
                   }
                }else{
                    if($value['material_cantidad']!='0'){
                        $tr.='<tr class="">
                            <td>
                                <label class="md-check">
                                    <input type="checkbox" class="has-value">
                                    <i class="green"></i>
                                </label>
                            </td>
                            <td>'.  substr($value['material_nombre'], 0,100).'</td>
                            <td>'.$value['material_cantidad'].'</td>
                            <td>
                                <div class="">
                                    <input type="text" class="form-control cantidad-agregar" data-tipo="Material" data-existencia="'.$value['material_cantidad'].'" data-s="'.$value['sistema_id'].'" data-m="'.$value['material_id'].'" data-m-i="0">
                                </div>
                            </td>
                        </tr>'; 
                    }
               }
        }

        $this->setOutput(array('tr'=>$tr));
    }
    public function insert_solicitud() {
        $data=array(
            'solicitud_codigo_barras'=>  rand(0,100000)*1000000,
            'solicitud_fecha'=>  $this->input->post('solicitud_fecha'),
            'solicitud_fecha_emision'=>$this->input->post('solicitud_fecha_emision'),
            'solicitud_diagnostico'=>  $this->input->post('solicitud_diagnostico'),
            'derechohabiente_id'=>  $this->input->post('derechohabiente_id'),
            'solicitud_status'=>'1',
            'empleado_crea'=>  $this->session->sess['idUsuario'],
            'empleado_id'=>  $this->input->post('empleado_id')
        );
        $sql=$this->Almacen_osteo_m->_insert('os_solicitud_material_osteosintesis',$data);
        if($sql){
            $max=  $this->Hospitalizacion_m->_max_solicitid_material()[0]['solicitud'];
            foreach ($this->input->post('materiales') as $value) {
                $data_m=array(
                    'solicitud_m_id'=>$max,
                    'solicitud_m_cantidad'=>$value[0],
                    'sistema_id'=>$value[1],
                    'material_id'=>$value[2],
                    'intermedio_id'=>$value[3],
                    'solicitud_m_tipo'=>$value[5]
                );
                if($value[5]=='Material'){//_update_material
                    $new_ca=$value[4] - $value[0];
                    $this->Almacen_osteo_m->_update_material_sol($value[2],array('material_cantidad'=>$new_ca));
                    foreach ($this->Hospitalizacion_m->_get_m_cb($value[2],$value[0]) as $values) { 
                        $this->Hospitalizacion_m->_update_mi_cb($values['intemediocd_id'],$value[5],$max);
                    }
                }else{
                    $new_ca=$value[4] - $value[0];
                    $this->Almacen_osteo_m->_update_material_intermedio($value[3],array('intermedia_cantidad'=>$new_ca));
                    foreach ($this->Hospitalizacion_m->_get_mi_cb($value[3],$value[0]) as $values) { 
                        $this->Hospitalizacion_m->_update_mi_cb($values['intemediocd_id'],$value[5],$max);
                    }
                }
                $this->Almacen_osteo_m->_insert('os_solicitud_materiales_osteosintesis',$data_m);
            }
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function generarsolicitud() {
        $sql=$this->Hospitalizacion_m->_get_cirugia($this->input->get_post('s'));
        $sql['sol']=  $sql;
        $sql['dh']=  $this->Derechohabiente_m->_get_derechohabiente_($sql[0]['derechohabiente_id']);
        $sql['mt']=  $this->Hospitalizacion_m->_get_medico_tratante_($sql[0]['empleado_id']);
        $sql['mat_in']=  $this->Hospitalizacion_m->_get_materiales_s_in($this->input->get_post('s'));
        $sql['mat']=  $this->Hospitalizacion_m->_get_materiales_s_m($this->input->get_post('s'));
        $this->load->view('hospitalizacion/generar_solicitud',$sql);
    }
    
    public function delete_prog_cirugia() {
        if($this->Hospitalizacion_m->_delete_prog_cirugia($this->input->post('id'))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function ver_materiales() {
        $sql=  $this->Hospitalizacion_m->_get_material_tipo($this->input->get_post('id'));
        foreach ($sql as $value) { 
            if($_SESSION['sess']['idRol']=='5'){
                $accion='';
            }else{
                $accion='disabled';
            }
            if($value['solicitud_m_tipo']=='Material'){
                foreach ($this->Hospitalizacion_m->_get_materiales_s_m($value['solicitud']) as $m) { 
                    $tr.='<tr >
                            <td>'.$m['material_nombre'].'</td>
                            <td>'.$m['solicitud_m_cantidad'].'</td>
                            <td ><input type="text" '.$accion.' class="edit_cantidad_mat" data-cantidad="'.$m['solicitud_m_cantidad'].'" data-sol="'.$value['solicitud'].'" data-tipo="'.$m['solicitud_m_tipo'].'" data-m="'.$m['material_id'].'" data-mi="'.$m['intermedio_id'].'" style="width:100%"></td>
                        </tr>';
                }
            }else{
                foreach ($this->Hospitalizacion_m->_get_materiales_s_mi($value['solicitud']) as $mi) { 
                    $tr.='<tr>
                            <td>'.$mi['intermedia_nombre'].'</td>
                            <td>'.$mi['solicitud_m_cantidad'].'</td>
                            <td><input type="text" '.$accion.' class="edit_cantidad_mat" data-cantidad="'.$mi['solicitud_m_cantidad'].'" data-sol="'.$value['solicitud'].'" data-tipo="'.$mi['solicitud_m_tipo'].'" data-m="'.$mi['material_id'].'" data-mi="'.$mi['intermedio_id'].'" style="width:100%"></td>
                        </tr>';
                }  
            }
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function editar_materiales() {
        $cantida_old=  $this->input->post('cantidad_old');
        $cantida_new=  $this->input->post('cantidad_new');
        if($this->input->post('tipo')=='Material'){
            
            $mat=$this->config_mdl->_get_data_condition('os_material_osteosintesis',array('material_id'=>  $this->input->post('material')));
            $cantidad_a=$mat[0]['material_cantidad'];
            $cantidad_update=  $cantida_new + $cantidad_a;
            if($this->config_mdl->_update_data('os_material_osteosintesis',array('material_cantidad'=>$cantidad_update),array(
                'material_id'=>  $this->input->post('material')
            ))){
                $this->config_mdl->_update_data('os_solicitud_materiales_osteosintesis',array('solicitud_m_cantidad'=>$cantida_old-$cantida_new),array(
                    'solicitud_m_tipo'=>'Material',
                    'solicitud_m_id'=>  $this->input->post('solicitud'),
                    'material_id'=>  $this->input->post('material')
                ));
                foreach ($this->Hospitalizacion_m->_get_m_cb_no($this->input->post('material'),$cantida_new) as $values) { 
                    $this->config_mdl->_update_data('os_material_osteosintesis_intermedias_cb',array('intemediocd_status'=>'Disponible','solicitud_id'=>''),array(
                        'intemediocd_id'=>$values['intemediocd_id'],
                        'intermediocd_tipo'=>'Material'
                    ));
                }
                
                $this->setOutput(array('accion'=>'1','input'=>  $this->input->post()));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $mat_in=$this->config_mdl->_get_data_condition('os_material_osteosintesis_intermedias',array('intermedia_id'=>  $this->input->post('material_in')));
            $cantidad_a=$mat_in[0]['intermedia_cantidad'];
            $cantidad_update=  $cantida_new + $cantidad_a;
            if($this->config_mdl->_update_data('os_material_osteosintesis_intermedias',array('intermedia_cantidad'=>$cantidad_update),array(
                'intermedia_id'=>  $this->input->post('material_in')
            ))){
                $this->config_mdl->_update_data('os_solicitud_materiales_osteosintesis',array('solicitud_m_cantidad'=>$cantida_old-$cantida_new),array(
                    'solicitud_m_tipo'=>'Material intermedio',
                    'solicitud_m_id'=>  $this->input->post('solicitud'),
                    'material_id'=>  $this->input->post('material'),
                    'intermedio_id'=>$this->input->post('material_in')
                ));
                foreach ($this->Hospitalizacion_m->_get_mi_cb_no($this->input->post('material_in'),$cantida_new) as $values) { 
                    $this->config_mdl->_update_data('os_material_osteosintesis_intermedias_cb',array('intemediocd_status'=>'Disponible','solicitud_id'=>''),array(
                        'intemediocd_id'=>$values['intemediocd_id'],
                        'intermediocd_tipo'=>'Material intermedio'
                    ));
                }      
                $this->setOutput(array('accion'=>'1','input'=>  $this->input->post()));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }
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
                     'nota'         => 'No. tratamiento: '.$this->input->post('idCirugia')
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
               $json = array(
                  'action' => '2',
                  'msj'    => 'Error 505'
               ); // Error nombre de la tabla
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            if (!empty($materiales)) {
               $materiales = html_purify($materiales);
               $html = '';
               foreach ($materiales as $value) {
                  $html .= 
                  '<tr data-disponibles="'.$value['cantidad'].'">
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
               $json = array(
                  'action' => '1',
                  'tr'    => $html
               ); // success
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            } 
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Materiales del sistema no encontrados'
               ); // Error  404
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
         $this->form_validation->set_rules('idDerechohabiente','ID Derechohabiente','required|trim|integer');
         $this->form_validation->set_rules('fecha','fecha','required|trim');
         $this->form_validation->set_rules('diagnostico','fecha','required|trim');
         $this->form_validation->set_rules('idquirofano','fecha','required|trim|integer');
         $this->form_validation->set_rules('matricula','matrícula','required|trim');
         $this->form_validation->set_error_delimiters('','');
         if ($this->form_validation->run() == FALSE) {
            $json = array(
               'action' => '2',
               'msj'    => validation_errors()
            ); // Error validación
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
         else {
            $idEmpleado = Modules::run('master/filas_c',array(
               'tabla' => 'empleado',
               'condicion' => [
                  'matricula' => $this->input->post('matricula')
               ]
            ));
            if (!empty($idEmpleado)) {
               $post = $this->input->post();
               $post['idEmpleado'] = $idEmpleado[0]['idEmpleado'];
               Modules::run('master/update','cirugia',
                  elements(['idDerechohabiente','fecha','diagnostico','idquirofano','idEmpleado'],$post),
                  elements(['idCirugia'],$this->input->post())
               );
               $config = array(
                  'tabla' => 'cirugia_material_osteosintesis',
                  'elementos' => $this->input->post('elementos_mat'),
                  'idElemento' => 'idMaterial_Osteosintesis',
                  'post' => $this->input->post()
               );
               $this->deleteMatInst($config);
               $json = array(
                  'action' => '1',
                  'msj'    => 'Cambios guardados'
               );
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
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
   public function insert_tratamiento() {
      set_time_limit(300);
      if ($this->input->is_ajax_request()) {
         $this->form_validation->set_rules('id_derechohabiente','ID Derechohabiente','required|trim|integer');
         $this->form_validation->set_rules('fecha','fecha','required|trim');
         $this->form_validation->set_rules('diagnostico','fecha','required|trim');
         $this->form_validation->set_rules('idquirofano','fecha','required|trim|integer');
         $this->form_validation->set_rules('matricula','matrícula','required|trim');
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
            $tipo_usuario = $this->Hospitalizacion_m->tipo_usuario($this->session->sess['idUsuario']);
            $idDepartamento = $this->Hospitalizacion_m->getIdDepartemento($this->session->sess['idUsuario']);
            $idEstado = 1;
            if (!empty($idDepartamento)) {
               // CAMBIAR A DINAMICO
               if ($idDepartamento[0]['idDepartamento'] == '4') {
                  $idEstado = 3;
                     $infoCirugia = [
                     'idDerechohabiente' => $this->input->post('id_derechohabiente'),
                     'idProceso'         => '1',
                     'idModulo'          => '7'
                  ];
               }  
               else if ($idDepartamento[0]['idDepartamento'] == '1') {
                  $idEstado = 1;
                  $infoCirugia = [
                     'idDerechohabiente' => $this->input->post('id_derechohabiente'),
                     'idProceso'         => '1',
                     'idModulo'          => '7'
                     // 'idquirofano' => $this->getIdPiso($this->session->sess['idUsuario'])
                  ];
               }
               else {
                  $idEstado = 1;
                  $infoCirugia = [
                     'idDerechohabiente' => $this->input->post('id_derechohabiente'),
                     'idProceso'         => '1',
                     'idModulo'          => '7'
                     // 'idquirofano' => '4'
                  ];  
               }
            } 
            else {
               $idEstado = 1;
               $infoCirugia = [
                  'idDerechohabiente' => $this->input->post('id_derechohabiente'),
                  'idProceso'         => '1',
                  'idModulo'          => '7'
                  // 'idquirofano' => '0'
               ];
            }
            $idEmpleado = Modules::run('master/filas_c',array(
               'tabla' => 'empleado',
               'condicion' => [
                  'matricula' => $this->input->post('matricula')
               ]
            ));
            if (!empty($idEmpleado)) {
               $infoCirugia['idquirofano'] = $this->input->post('idquirofano');
               $infoCirugia['diagnostico'] = $this->input->post('diagnostico');
               $infoCirugia['idEmpleado'] = $idEmpleado[0]['idEmpleado'];
               $infoCirugia['fecha'] = $this->input->post('fecha');
               // CAMBIAR A DINAMICO
               Modules::run('master/insert','cirugia',$infoCirugia);
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
                  $idMaterialTratamiento = $this->db->insert_id();
                  Modules::run('master/update','cirugia_material_osteosintesis ',array(
                     'codigo_barra' => addNumToStr($idMaterialTratamiento,8).'-'.$value[0]
                  ),[
                     'id' => $idMaterialTratamiento
                  ]);
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
               // INSERT INTO estado_de_cirugia (idCirugia,idEstado_Cirugia) VALUES ("<ID CIRUGIA>","<ID ESTADO DE CIRUGIA>")
               $idEstado = ($sinExistencia ? 2 : $idEstado);
               Modules::run('master/insert','estado_de_cirugia',
                  ['idCirugia' => $id, 'idEstado_Cirugia' => $idEstado]
               );
               $this->crearSolicitudConsumo($id,$infoCirugia);
               $json = array(
                  'action' => '1',
                  'msj'    => 'Cambios guardados'
               );
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
            else {
               $json = array(
                  'action' => '2',
                  'msj'    => 'Médico tratante no válido'
               );
               $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
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
               // case 'instrumentales':
               //    $lista_elementos = $this->Hospitalizacion_m->detalles_sistema_instru($this->input->post('id_cirugia'));
               //    break;
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
                  'msj'    =>  ucfirst($this->input->post('tipo')) . 'no encontrados'
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
         $sistemas = $this->Hospitalizacion_m->sistemas_materiales();
         if (!empty($sistemas)) {
            $html_sis_mat = '';
            foreach ($sistemas as $value) {
               $html_sis_mat .= '<option value="'.$value['idSistema_Material'].'">'.$value['sistema'].'</option>';
            }
            $pisosOptions = $this->getPisosOptions();
            $json = array(
               'action' => '1',
               'html_material' => $html_sis_mat,
               'pisos' => $pisosOptions
            ); // success       
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
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

   private function getPisosOptions() {
      $pisos = Modules::run('master/filas_c',array(
         'tabla' => 'quirofano',
         'condicion' => [
            'tipo' => $this->config->item('tipos_destino')['piso']
         ]
      ));
      $pisosOptions = '<option value="">Seleccionar</option>';
      if (!empty($pisos)) {
         foreach ($pisos as $key => $value) {
            $pisosOptions .= '<option value="'.$value['idquirofano'].'">'.$value['nombre'].'</option>';
         }
      }
      return $pisosOptions;
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
               // $sistemasInstruElementos = $this->Hospitalizacion_m->detalles_sistema_instru($this->input->post('id_cirugia'));
               $cirugia['nombreCompletoDerHabiente'] = $cirugia['nombreDerechohabiente'].' '.$cirugia['paternoDerechohabiente'].' '.$cirugia['maternoDerechohabiente'];
               $cirugia['nombreCompletoEmpleado'] = $cirugia['nombreEmpleado'].' '.$cirugia['paternoEmpleado'].' '.$cirugia['maternoEmpleado'];
               $cirugia['sistemasMatElementos'] = $sistemasMatElementos;
               // $cirugia['sistemasInstruElementos'] = $sistemasInstruElementos;
               $cirugia['pisosOptions'] = $this->getPisosOptions();
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
               'action'   => '2'
               // 'cirugias' => ''
            ); // No encontrado 
           $this->output->set_content_type('application/json')->set_output(json_encode($json));
         }
      }
      else {
         redirect('inicio/index','refresh');
      }
   }

   public function send() {
      $this->load->library('Mailer');
      $config = array(
         'username' => 'umae.magdalena@gmail.com',
         'password' => 'adminadminumae',
         'gmail' => TRUE,
         'fromName' => 'Hospital Magdalena de la Salinas',
         'confirmar' => TRUE
      );
      $this->mailer->init($config);
      
   }

   public function getCirugias() {
      $data = $this->Hospitalizacion_m->ver_cirugia();
      if (!empty($data)) {
         $data = html_purify($data);
         $data = $this->tables->addCellValue($data,'detalles','<i data-toggle="tooltip" title="Ver más" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>');
         // $data = $this->tables->addCellValue($data,'estado_icon','<i data-toggle="tooltip" title="Ver" class="tip acciones fa fa-arrow-circle-right pointer fa-2x"></i>');
         $data = $this->tables->addCellValue($data,'accion',
            '<i data-id-accion="modificar" data-toggle="tooltip" title="Modificar" class="tip acciones fa fa-edit pointer fa-2x"></i>
            <i data-id-accion="eliminar" data-toggle="tooltip" title="Eliminar" class="tip acciones fa fa-trash-o pointer fa-2x"></i>
            <i data-id-accion="ver-documento" data-toggle="tooltip" title="Ver documento" class="tip acciones fa fa-file-text-o pointer fa-2x"></i>
            <i data-id-accion="accion-esperar" class="acciones fa fa-medkit pointer fa-2x icono-disable"></i>'
         );
         $data = $this->tables->setAttr($data,[
            'tr' => [
               'data-no-cirugia'     =>'idCirugia',
               'data-solicitud'      => 'solicitud',
               'data-reajuste'       => 'reajuste',
               'data-reajuste2'      => 'reajuste2',
               'data-cancelacion'    => 'cancelacion',
               'data-tipo-documento' => 'tipo_documento'
            ],
            'idCirugia'    => ['class'=>'text-center'],
            'nom_empleado' => ['data-matricula'=>'matricula' ],
            'detalles' => [
               'class'    => 'detalles iconos-acciones iconos-1',
               'data-sis' => 'materiales'
            ],
            // 'estado_icon' => [
            //    'class' => 'acciones pointer iconos-acciones iconos-1',
            //    'data-id-accion' => 'estado'
            // ],
            'accion' => [
               'class' => 'iconos-acciones iconos-4'
            ]
         ]);
         $data = $this->tables->setCallBack($data,[
            'accion' => 'switchBtn'
         ]);
         $this->tables->noAttr = [
            'matricula','idEstado_Cirugia','idEmpleado','estado','idCirugia','solicitud','reajuste','reajuste2','cancelacion','tipo_documento'
         ];
         return $this->tables->generate($data,'tbodyTr');
      }
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

   /**
    * [getTipoUsuario Regresa el tipo de usuario]
    * $info = [
    *    'filtro' => 'matricula' ó 'idUsuario' ó 'idEmpleado',
    *    'id' => ''
    * ]
    * @param  [array] $info [filtro]
    * @param  [array] $info [ID]
    * @return [type]        [description]
    */
   public function getTipoUsuario($info) {
      if (is_array($info)) { 
         if (isset($info['filtro'])) {
            if ($info['filtro'] == 'matricula') {
               $idUsuario = Modules::run('master/filas_c',array(
                  'tabla' => 'empleado',
                  'condicion' => [
                     'matricula' => $info['info']
                  ]
               ));
               if (!empty($idUsuario)) {
                  $idUsuario = $idUsuario[0]['idEmpleado'];
               }
               else {
                  return FALSE;
               }
            }
            else {
               $idUsuario = $info['id'];
            }
         }
         $usuario = Modules::run('master/filas_c',array(
            'tabla' => 'usuario',
            'condicion' => [
               'idUsuario' => $idUsuario
            ]
         ));
         if (!empty($idUsuario)) {
            return $usuario[0]['idTipo_Usuario'];
         }
         else {
            return FALSE;
         }
      }
      else {
         return FALSE;
      }
   }

   private function getIdPiso($idUsuario) {
      $piso = $this->Hospitalizacion_m->getIdPisoByIdUsuario($idUsuario);
      if (!empty($piso)) {
         return $piso[0]['idquirofano'];
      }
      else {
         return '0';
      }
   }

   private function crearSolicitudConsumo($idTratamiento='53',$infoTramiento='') {
      $fechaEmision = $this->dates->now();
      $infoSolictud = [
         'folio' => $this->getFolio(),
         'fechaEmision'   => $fechaEmision,
         'fechaTratamiento'   => $infoTramiento['fecha'],
         'idProgramaEmpleado' => $this->usuario->getInfoEmpleado()['idEmpleado'],
         'idTratamiento'      => $idTratamiento,
         'solcitudPdf'        => uniq_id().'.pdf',
         'diaMesEmision'      => addNumToStr(date_parse($fechaEmision)['day'],2),
         'mesEmision'         => addNumToStr(date_parse($fechaEmision)['month'],2),
         'yearEmision'        => date_parse($fechaEmision)['year'],
         'diaMesTratamiento'  => addNumToStr(date_parse($infoTramiento['fecha'])['day'],2),
         'mesTratamiento'     => addNumToStr(date_parse($infoTramiento['fecha'])['month'],2),
         'yearTratamiento'    => date_parse($infoTramiento['fecha'])['year'],
         'ruta_save'          => $this->config->item('nombre_documentos')['solicitud_consumo']['ruta']
      ];
      $lista_elementos = $this->Hospitalizacion_m->detalles_sistema_materiales($idTratamiento);
      $medico = $this->usuario->getInfoEmpleado('',$infoTramiento['idEmpleado']);
      $derechohabiente = Modules::run('master/filas_c',[
         'tabla' => 'derechohabiente',
         'condicion' => [
            'idDerechohabiente' => $infoTramiento['idDerechohabiente'],
            'status' => '1'
         ]
      ]);
      if (!empty($derechohabiente)) {
         if ($this->pdf->guardarSolicitudConsumoPDF($infoSolictud,$lista_elementos,$medico,$derechohabiente[0]))  {
            Modules::run('master/insert','documento_solicitud_consumo',
               elements(['folio','fechaEmision','fechaTratamiento','idProgramaEmpleado','idTratamiento','solcitudPdf'],$infoSolictud)
            );
         }
      }
      return FALSE;
   }

   private function getFolio() {
      $lastId = Modules::run('master/last_id','id','documento_solicitud_consumo');
      $folio = $this->config->item('nombre_documentos')['solicitud_consumo']['alias'];
      // CAMBIAR A DINAMICO
      $folio .= $this->config->item('info_umae')['delegacion'];
      $folio .= $this->config->item('info_umae')['umae'];
      $folio .= $this->config->item('info_umae')['unidades']['trauma'];
      $folio .= date('Y');
      $folio .= addNumToStr($lastId+1);
      return $folio;
   }

}
