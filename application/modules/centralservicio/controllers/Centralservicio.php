<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Centralservicio
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
require_once APPPATH.'third_party/ezpdf/class.ezpdf.php';
class Centralservicio extends Config{
    public function __construct() {
        parent::__construct();
        $this->load->model('config/config_mdl');
        $this->load->model('centralservicio_mdl');
        $this->download_database();
    }
    public function index() {
        $this->config_mdl->_update_data('os_programaciones_notificaciones',array(
            'notificacion_status'=>'Leido'
        ),array('idTipo_Usuario'=>$_SESSION['sess']['idRol']));
        
        if($_SESSION['sess']['idRol']=='12'){//Central de Servicio
           $sql['Gestion']= $this->centralservicio_mdl->_get_programacion_cs();
           $this->load->view('central_central_servicio',$sql); 
        }else if($_SESSION['sess']['idRol']=='13'){//Médico primer diagnóstico
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_medicoprimerdiagnostico',$sql);
        }else if($_SESSION['sess']['idRol']=='14'){//Diagnóstico consecutivo
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_diagnosticoconsecutivo',$sql);
        }else if($_SESSION['sess']['idRol']=='15'){//Ortopedia
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_ortopedia',$sql);
        }else if($_SESSION['sess']['idRol']=='16'){//Neurológo
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_neurologo',$sql);
        }else if($_SESSION['sess']['idRol']=='17'){//Pediatría
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_pediatria',$sql);
        }else if($_SESSION['sess']['idRol']=='18'){//Medicina interna y cirugía
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_medicinainterna',$sql);
        }else if($_SESSION['sess']['idRol']=='19'){//Rehabilitación para el trabajo
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_rehabilitacion',$sql);
        }else if($_SESSION['sess']['idRol']=='20'){//Tratamiento en Casa
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_tratamientoencasa',$sql);
        }else if($_SESSION['sess']['idRol']=='21'){//Coordinador de tratamientos
            $sql['Gestion']= $this->centralservicio_mdl->_get_programacion();
            $this->load->view('central_coordinador_tratamientos',$sql);
        }
        
    }
    public function programacion() {
        $this->load->view('central_add');
    }
    public function insert_registro() {
        $data=array(
            'derechohabiente_nss'=>  $this->input->post('derechohabiente_nss'),
            'derechohabiente_nombre'=>  $this->input->post('derechohabiente_nombre'),
            'derechohabiente_apat'=>  $this->input->post('derechohabiente_apat'),
            'derechohabiente_amat'=>  $this->input->post('derechohabiente_amat'),
            'derechohabiente_procedencia'=>  $this->input->post('derechohabiente_procedencia'),
            'derechohabiente_doc'=>$_FILES['derechohabiente_doc']['name']
        );
        $sql_check=  $this->config_mdl->_get_data_condition('os_derechohabiente',array(
            'derechohabiente_nss'=>$this->input->post('derechohabiente_nss')
        ));
        $sql_programs=  $this->config_mdl->_get_data_condition('os_programaciones',array(
            'programacion_fecha'=>  $this->input->post('programacion_fecha')
        ));
        if (count($sql_programs)<5){
            copy($_FILES['derechohabiente_doc']['tmp_name'],'assets/derechohabiente/'.$_FILES['derechohabiente_doc']['name']);
            if(empty($sql_check)){
                if($this->config_mdl->_insert('os_derechohabiente',$data)){
                    
                        $sql_check_pro=  $this->config_mdl->_get_data_condition('os_programaciones',array(
                            'derechohabiente_id'=>$this->config_mdl->_get_last_id('os_derechohabiente','derechohabiente_id'),
                            'programacion_fecha'=>$this->input->post('programacion_fecha')
                        ));
                        if(empty($sql_check_pro)){
                            $this->config_mdl->_insert('os_programaciones',array(
                                'programacion_fecha'=> $this->input->post('programacion_fecha'),
                                'programacion_status'=>'En proceso',
                                'empleado_id'=>$_SESSION['sess']['idUsuario'],
                                'derechohabiente_id'=>$this->config_mdl->_get_last_id('os_derechohabiente','derechohabiente_id')
                            ));
                           $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                                'notificacion_status'=>'Nuevo',
                                'idTipo_Usuario'=>'13'
                            ));
                            $this->setOutput(array('accion'=>'1'));
                        }else{
                            $this->setOutput(array('accion'=>'4'));
                        }
                }else{
                    $this->setOutput(array('accion'=>'2'));
                }
            }else{
                
                $sql_check_pro=  $this->config_mdl->_get_data_condition('os_programaciones',array(
                    'derechohabiente_id'=>$sql_check[0]['derechohabiente_id'],
                    'programacion_fecha'=>$this->input->post('programacion_fecha')
                ));
                copy($_FILES['derechohabiente_doc']['tmp_name'],'assets/derechohabiente/'.$_FILES['derechohabiente_doc']['name']);
                $this->config_mdl->_update_data('os_derechohabiente',$data,array('derechohabiente_id'=>$sql_check[0]['derechohabiente_id']));
                if(empty($sql_check_pro)){
                   $this->config_mdl->_insert('os_programaciones',array(
                        'programacion_fecha'=> $this->input->post('programacion_fecha'),
                        'programacion_status'=>'En proceso',
                        'empleado_id'=>$_SESSION['sess']['idUsuario'],
                        'derechohabiente_id'=>$sql_check[0]['derechohabiente_id']
                    ));
                   $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                        'notificacion_status'=>'Nuevo',
                        'idTipo_Usuario'=>'13'
                    ));
                   $this->setOutput(array('accion'=>'1'));
                }else{
                    $this->setOutput(array('accion'=>'4'));
                }
 
            }   
        }else{
            $this->setOutput(array('accion'=>'3'));
        }
    }
    public function get_derechohabiente() {
        $this->setOutput($this->config_mdl->_get_data_condition('os_derechohabiente',array(
            'derechohabiente_nss'=>  $this->input->post('nss')
        )));
    }
    public function diagnosticoinicial() {
        $this->load->view('central_medicoprimerdiagnostico_add');
    }
    public function agregar_diagnostico() {
        $data=array(
            'programacion_diagnostico'=>  $this->input->post('programacion_diagnostico'),
            'programacion_destino'=>  $this->input->post('programacion_destino'),
            'programacion_status'=>$this->input->post('programacion_destino')
        );
        $sql=  $this->config_mdl->_update_data('os_programaciones',$data,array('programacion_id'=>  $this->input->post('programacion_id')));
        if($sql){
            $destino=$this->input->post('programacion_destino');
            if($destino=='Tratamiento en casa'){
                foreach ($this->input->post('pro_folleto') as $value) {
                    $this->config_mdl->_insert('os_programacion_folletos',array(
                        'programacion_id'=>$this->input->post('programacion_id'),
                        'pro_folleto'=>$value
                    ));
                } 
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'20'
                ));
            }else if($destino=='Segundo diagnóstico inicial'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'14'
                ));
            }else if($destino=='Modulo Ortopédico'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'15'
                ));
            }else if($destino=='Modulo neurológico'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'16'
                ));
            }else if($destino=='Modulo pediatrico'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'17'
                ));
            }else if($destino=='Modulo medicina interna y cirugía'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'18'
                ));
            }else if($destino=='Modulo rehabilitaión para el trabajo'){
                $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                    'notificacion_status'=>'Nuevo',
                    'idTipo_Usuario'=>'19'
                ));
            }
            $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                'notificacion_status'=>'Nuevo',
                'idTipo_Usuario'=>'12'
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function finalizar_tratamiento() {
        $data=array(
            'programacion_destino'  =>'Tratamiento en casa',
            'programacion_status'   =>'Tratamiento Finalizado'
        );
        $sql=  $this->config_mdl->_update_data('os_programaciones',$data,array('programacion_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function agregar_fecha() {
        $data=array(
            'programacion_fecha'  =>  $this->input->post('fecha'),
            'programacion_final'   =>'Fecha Asignada'   
        );
        $sql=  $this->config_mdl->_update_data('os_programaciones',$data,array('programacion_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }  
    }
    public function asignartratamiento() {
        $this->load->view('central_asignartratamiento');
    }
    public function agregar_tratamiento() {
        $data=array(
            'programacion_tratamiento'  =>  'Tratamientos asignados'
        );
        $sql=  $this->config_mdl->_update_data('os_programaciones',$data,array('programacion_id'=>  $this->input->post('programacion_id')));
        if($sql){
            foreach ($this->input->post('tratamientos') as $value) {
                $this->config_mdl->_insert('os_programacion_tratamientos',array(
                    'tratamiento_id'=>$value[0],
                    'terapia_id'=>$value[1],
                    'programacion_id'=>$this->input->post('programacion_id')
                ));
            }
            $this->setOutput(array('accion'=>'1'));
            $this->config_mdl->_insert('os_programaciones_notificaciones',array(
                'notificacion_status'=>'Nuevo',
                'idTipo_Usuario'=>'21'
            ));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }     
    }
    public function tratamientos() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_tratamientos');
        $this->load->view('central_especialidad_tratamientos',$sql);
    }
    public function addtratamiento() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_tratamientos',array('tratamiento_id'=>  $this->input->post('i')));
        $this->load->view('central_especialidad_tratamientos_add',$sql);
        
    }
    public function insert_tratamiento() {
        $data=array(
            'tratamiento_nombre'  =>  $this->input->post('tratamiento_nombre'),
            'tratamiento_descripcion'   =>$this->input->post('tratamiento_descripcion'),
            'empleado_id'=>$_SESSION['sess']['idUsuario']
        );
        $sql=  $this->config_mdl->_insert('os_tratamientos',$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }  
    }
    public function terapias() {
        $sql['Gestion']=  $this->centralservicio_mdl->_get_terapias($this->input->get_post('t'));
        $this->load->view('central_especialidad_terapias',$sql);
    }
    public function addterapias() {
        $this->load->view('central_especialidad_terapias_add');
    }
    public function insert_terapia() {
        $data=array(
            'terapia_nombre'  =>  $this->input->post('terapia_nombre'),
            'terapia_descripcion'   =>$this->input->post('terapia_descripcion'),
            'tratamiento_id' =>$this->input->post('tratamiento_id')
        );
        $sql=  $this->config_mdl->_insert('os_tratamientos_terapias',$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }  
    }  
    public function get_tratamientos() {
        foreach ($this->centralservicio_mdl->_get_tratamientos() as $value) {
            $option.='<option value="'.$value['tratamiento_id'].'">'.$value['tratamiento_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function get_terapias() {
        foreach ($this->centralservicio_mdl->_get_terapias($this->input->post('id')) as $value) { 
            $tr.='
                <tr data-tratamiento="'.$value['tratamiento_id'].'" data-terapia="'.$value['terapia_id'].'">
                    <td>
                        <label class="md-check">
                            <input type="checkbox" class="has-value">
                            <i class="green"></i>
                        </label>
                    </td>
                    <td>'.$value['tratamiento_nombre'].'</td>
                    <td>'.$value['terapia_nombre'].'</td>
                </tr>';
            
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function verterapias() {
        $sql['Gestion']=  $this->centralservicio_mdl->_get_terapias_coordinador($this->input->get_post('p'));
        $this->load->view('central_coordinador_ver_terapias',$sql);
    }
    public function generarcodigo() {
        $sql['pro']=  $this->config_mdl->_get_data_condition('os_programaciones',array(
            'programacion_id'=>  $this->input->get_post('p')
        ));
        $this->load->view('central_generarcodigo',$sql);
    }
    public function download_database() {
        
        $json_string = json_encode($this->centralservicio_mdl->_get_programacion());
        $file = 'assets/bd/programaciones.json';
        file_put_contents($file, $json_string);
        
    }  
    public function administrarfechas() {
        $sql['Gestion']=  $this->centralservicio_mdl->_get_fechas_terapias($this->input->get_post('t'));
        $this->load->view('central_coordinar_administrarfechas',$sql);
    }
    public function add_fecha_terapia() {
        $data=array(
            'terapiafecha_fecha'=>  $this->input->post('fecha'),
            'terapiafecha_hora_i'=>  $this->input->post('terapiafecha_hora_i'),
            'terapiafecha_hora_f'=>  $this->input->post('terapiafecha_hora_f'),
            'terapia_id'=>  $this->input->post('terapia')
        );
        if($this->config_mdl->_insert('os_programaciones_fechas_terapias',$data)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function delete_fecha_terapia() {
        if($this->config_mdl->_delete_data('os_programaciones_fechas_terapias',array(
            'terapiafecha_id'=>  $this->input->post('id')
        ))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function fechasterapias() {
            $pdf = new Cezpdf('a4');
            $pdf->selectFont(APPPATH.'third_party/ezpdf/fonts/Helvetica.afm');
            $pdf->ezSetCmMargins(1,1,1.5,1.5);
            $sql=  $this->centralservicio_mdl->_get_programacion_data($this->input->get_post('p'));
            foreach ($this->centralservicio_mdl->_get_fechas_terapias_ll($this->input->get_post('p')) as $value) {
                    $data[] = array_merge($value);
            }
            
            $titles = array(
                'terapiafecha_id'=>'<b>Num</b>',
                'tratamiento_nombre'=>'<b>Tratamiento</b>',
                'terapia_nombre'=>'<b>Terapia</b>',
                'terapiafecha_fecha'=>'<b>Fecha</b>'
                                    );
            $options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            );
            $pdf->ezText('INSTITUTO MEXICANO DEL SEGURO SOCIAL', 12,array('justification'=>'center'));
            $pdf->ezText("\n", 10);
            $pdf->ezText('N° de programación: '.$sql[0]['programacion_id'], 12,array('justification'=>'left'));
            $pdf->ezText('N.S.S: '.$sql[0]['derechohabiente_nss'], 12,array('justification'=>'left'));
            $pdf->ezText('Derechohabiente: '.$sql[0]['derechohabiente_nombre'].' '.$sql[0]['derechohabiente_apat'].' '.$sql[0]['derechohabiente_apat'], 12,array('justification'=>'left'));
            $pdf->ezText('Fecha de programación: '.$sql[0]['programacion_fecha'], 12,array('justification'=>'left'));
            $pdf->ezText('Diagnostico: '.$sql[0]['programacion_diagnostico'], 12,array('justification'=>'left'));
            $pdf->ezText("\n", 10);
            $pdf->ezText('Fechas de terapias', 12,array('justification'=>'center'));
            $pdf->ezText("\n", 10);
            $pdf->ezTable($data, $titles, '', $options);
            $pdf->ezStream(); 
    }
    public function get_notificaciones() {
        $sql=  $this->config_mdl->_get_data_condition('os_programaciones_notificaciones',array(
            'notificacion_status'=>'Nuevo',
            'idTipo_Usuario'=>$_SESSION['sess']['idRol']
        ));
        $this->setOutput(array('msj'=>  count($sql)));
    }
    public function ver_folletos() {
        $sql['folletos']=  $this->config_mdl->_get_data_condition('os_programacion_folletos',array(
           'programacion_id'=>  $this->input->get('p') 
        ));
        $this->load->view('central_ver_folletos',$sql);
    }
}
