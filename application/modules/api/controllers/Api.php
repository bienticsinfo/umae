<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api
 *
 * @author felipe de jesus
 */
include_once APPPATH.'third_party/fpdf17/fpdf.php';
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
require_once APPPATH.'third_party/ezpdf/class.ezpdf.php';
class Api extends MX_Controller{
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
        parent::__construct();
        $this->load->model('config/config_mdl');
        $this->load->model('centralservicio/centralservicio_mdl');
        $this->load->model('configuracion/empleados_mdl');
        date_default_timezone_set('America/Mexico_City');
        error_reporting(0);
    }
    public function get_paciente() {
        $this->setOuputJSON_FORMAT($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get_post('id')
        )));
    }

    public function guardar_clasificacion() {
        $datas = json_decode(file_get_contents("php://input"));
        $triege_preg_puntaje_s1=$datas->triage_preg1_s1+
                                $datas->triage_preg2_s1+
                                $datas->triage_preg3_s1+
                                $datas->triage_preg4_s1+
                                $datas->triage_preg5_s1;
        $triege_preg_puntaje_s2=$datas->triage_preg1_s2+
                                $datas->triage_preg2_s2+
                                $datas->triage_preg3_s2+
                                $datas->triage_preg4_s2+
                                $datas->triage_preg5_s2+
                                $datas->triage_preg6_s2+
                                $datas->triage_preg7_s2+
                                $datas->triage_preg8_s2+
                                $datas->triage_preg9_s2+
                                $datas->triage_preg10_s2+
                                $datas->triage_preg11_s2+ 
                                $datas->triage_preg12_s2;

        $triege_preg_puntaje_s3=0+0+0+0+0;
        $total_puntos=$triege_preg_puntaje_s1+$triege_preg_puntaje_s2+$triege_preg_puntaje_s3;
        if($total_puntos>30){
            $color='#E50914';
            $color_name='Rojo';
            $tiempo='Inmediatamente';
        }if($total_puntos>=21 && $total_puntos<=30){
            $color='#FF7028';
            $color_name='Naranja';
            $tiempo='10 Minutos';
        }if($total_puntos>=11 && $total_puntos<=20){
            $color='#FDE910';
            $color_name='Amarillo';
            $tiempo='11-60 Minutos';
        }if($total_puntos>=6 && $total_puntos<=10){
            $color='#4CBB17';
            $color_name='Verde';
            $tiempo='61-120 Minutos';
        }if($total_puntos<=5){
            $color='#0000FF';
            $color_name='Azul';
            $tiempo='121-240 Minutos';
        }
        $select_destino_consultorio=  explode(';', $datas->select_destino_consultorio);
        $data=array(
            'triage_fecha_clasifica'=>  date('d/m/Y'),
            'triage_hora_clasifica'=>  date('H:i'),
            'triage_preg1_s1'=>  $datas->triage_preg1_s1,
            'triage_preg2_s1'=>  $datas->triage_preg2_s1,
            'triage_preg3_s1'=>  $datas->triage_preg3_s1,
            'triage_preg4_s1'=>  $datas->triage_preg4_s1,
            'triage_preg5_s1'=>  $datas->triage_preg5_s1,
            'triege_preg_puntaje_s1'=> $triege_preg_puntaje_s1,
            'triage_preg1_s2'=>  $datas->triage_preg1_s2,
            'triage_preg2_s2'=>  $datas->triage_preg2_s2,
            'triage_preg3_s2'=>  $datas->triage_preg3_s2,
            'triage_preg4_s2'=>  $datas->triage_preg4_s2,
            'triage_preg5_s2'=>  $datas->triage_preg5_s2,
            'triage_preg6_s2'=>  $datas->triage_preg6_s2,
            'triage_preg7_s2'=>  $datas->triage_preg7_s2,
            'triage_preg8_s2'=>  $datas->triage_preg8_s2,
            'triage_preg9_s2'=>  $datas->triage_preg9_s2,
            'triage_preg10_s2'=>  $datas->triage_preg10_s2,
            'triage_preg11_s2'=>  $datas->triage_preg11_s2,
            'triage_preg12_s2'=>  $datas->triage_preg12_s2,
            'triege_preg_puntaje_s2'=>$triege_preg_puntaje_s2,
            'triage_preg1_s3'=>  0,
            'triage_preg2_s3'=>  0,
            'triage_preg3_s3'=>  0,
            'triage_preg4_s3'=>  0,
            'triage_preg5_s3'=>  0,
            'triege_preg_puntaje_s3'=>$triege_preg_puntaje_s3,
            'triage_puntaje_total'=>$total_puntos,
            'triage_status'=>'Finalizado',
            'triage_solicitud'=>'Enviado',
            'triage_solicitud_rx'=>'',
            'triage_etapa'=>'2',
            'triage_color'=>$color_name,
            'triage_consultorio'=>  $select_destino_consultorio[0],
            'triage_consultorio_nombre'=> $select_destino_consultorio[1],
            'triage_solicitud_rx'=>  $datas->triage_solicitud_rx,
            'triage_crea_medico'=>$datas->ACCESS_ID
        );

        if($this->config_mdl->_update_data('os_triage',$data,array('triage_id'=>  $datas->triage_id))){
            $this->config_mdl->_insert('os_asistentesmedicas',array(
                'triage_id'=>  $datas->triage_id 
            ));
            $this->setOutput(array('accion'=>'1'));
        }
        
    } 
    public function inser($casoclinico_nombre,$casoclinico_datos,$triage_id) {
        $this->config_mdl->_insert('os_triage_casosclinicos',array(
                    'casoclinico_nombre'=>$casoclinico_nombre,
                    'casoclinico_datos'=> $casoclinico_datos,
                    'triage_id'=>  $triage_id
                ));
    }
    public function guardar_solicitud_rx() {
        $datas = json_decode(file_get_contents("php://input"));
        if($datas->campo1_1!=''){
            $this->inser($datas->campo1_1, $datas->campo1, $datas->triage_id);
        }if(isset($datas->campo2_2)){
            $this->inser($datas->campo2_2, $datas->campo2, $datas->triage_id);
        }if(isset($datas->campo3_3)){
            $this->inser($datas->campo3_3, $datas->campo3, $datas->triage_id);
        }if(isset($datas->campo4_4)){
            $this->inser($datas->campo4_4, $datas->campo4, $datas->triage_id);
        }if(isset($datas->campo5_5)){
            $this->inser($datas->campo5_5, $datas->campo5, $datas->triage_id);
        }if(isset($datas->campo6_6)){
            $this->inser($datas->campo6_6, $datas->campo6, $datas->triage_id);
        }if(isset($datas->campo7_7)){
            $this->inser($datas->campo7_7, $datas->campo7, $datas->triage_id);
        }if(isset($datas->campo8_8)){
            $this->inser($datas->campo8_8, $datas->campo8, $datas->triage_id);
        }if(isset($datas->campo9_9)){
            $this->inser($datas->campo9_9, $datas->campo9, $datas->triage_id);
        }if(isset($datas->campo10_10)){
            $this->inser($datas->campo10_10, $datas->campo10, $datas->triage_id);
        }if(isset($datas->campo11_11)){
            $this->inser($datas->campo11_11, $datas->campo11, $datas->triage_id);
        }
        
        
        
        $sql_am=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $datas->triage_id
        ));
        $this->config_mdl->_insert('os_rx',array(
            'triage_id'=>  $datas->triage_id,
            'rs_status'=>'',
            'rx_fecha_entrada'=>'S/A',
            'asistentesmedicas_id'=> $sql_am[0]['asistentesmedicas_id']
        ));
        $this->setOutput(array('accion'=>'1'));       
    }
    public function generar_solicitud_rx() {
        $sql['Casos']=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $this->load->view('generar_solicitud_rx',$sql);
    }
    public function generar_documento() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['medico']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$sql['info'][0]['medico_id']
        ));

        $this->load->view('generar_documento',$sql);
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }    
    public function setOuputJSON_FORMAT($json){
        header('Content-Type: application/json');
        print_r(json_encode($json, JSON_PRETTY_PRINT));
    }
    public function iniciar_sesion() {
        $datas = json_decode(file_get_contents("php://input"));
        $sql=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=>  $datas->empleado_matricula
        ));
        $areas=array();
        array_push($areas, 'Triage Médico') ;
        array_push($areas, 'Triage Enfermeria') ;
        if(in_array($datas->empleado_area, $areas)){
            if(!empty($sql)){
                $this->config_mdl->_update_data('os_empleados',array(
                    'empleado_area_acceso'=>$datas->empleado_area
                ),array(
                    'empleado_id'=>$sql[0]['empleado_id']
                ));
                $this->setOutput(array(
                    'ACCESS_LOGIN'=>'1',
                    'ACCESS_AREA'=>$datas->empleado_area,
                    'ACCESS_ID'=>$sql[0]['empleado_id'],
                    'ACCESS_USER'=>$sql[0]['empleado_nombre'] .' '.$sql[0]['empleado_apellidos']
                ));
            }else{
                $this->setOutput(array('ACCESS_LOGIN'=>  'MATRICULA_NO_ENCONTRADA'));
            }
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>  'AREA_NO_ENCONTRADA'));
        }
        
    }
    public function guardar_clasificacion_enfermeria() {
        $datas = json_decode(file_get_contents("php://input"));
        $data=array(
            'triage_unidad_medica'=>  $datas->triage_unidad_medica,
            'triage_fecha'=> date('d/m/Y'), 
            'triage_hora'=> date('H:i'), 
            'triage_nombre'=> $datas->triage_nombre,
            'triage_fecha_nac'=> $datas->triage_fecha_nac,
            'triage_tension_arterial'=>  $datas->triage_tension_arterial,
            'triage_temperatura'=>  $datas->triage_temperatura,
            'triage_frecuencia_cardiaco'=>  $datas->triage_frecuencia_cardiaco,
            'triage_frecuencia_respiratoria'=>  $datas->triage_frecuencia_respiratoria,
            'triage_procedencia'=> $datas->triage_procedencia,
            'triage_hospital_procedencia'=> $datas->triage_hospital_procedencia,
            'triage_hostital_nombre_numero'=>  $datas->triage_hostital_nombre_numero,
            'triage_status'=>'En proceso',
            'triage_etapa'=>'1',
            'triage_crea_enfemeria'=>$datas->ACCESS_ID
        );
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $datas->triage_id
        ))[0];
        if($info['triage_etapa']!='0'){ 
            unset($data['triage_fecha']);
            unset($data['triage_hora']); 
            unset($data['triage_status']);
            unset($data['triage_etapa']);
            unset($data['triage_corte']);
            unset($data['triage_corte']);
        }
        $this->config_mdl->_update_data('os_triage',$data,array('triage_id'=>  $datas->triage_id));
        $this->setOutput(array('accion'=>'1'));
        
    }
}
