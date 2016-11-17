<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Triage
 *
 * @author felipe de jesus | itifjpp@gmail.com 
 */
include_once APPPATH.'modules/config/controllers/Config.php';
include_once APPPATH.'third_party/fpdf17/fpdf.php';
include_once APPPATH.'third_party/Barcode39.php';
include_once APPPATH.'third_party/UltimateBarcodeGenerator/barcode.class.php';
class Triage extends Config{
    public function __construct() {
        parent::__construct();
        $this->load->model('triage_mdl');
    }
    public function shell_cmd() {
        $bar = new BARCODE();
        $bar->BarCode_save("CODE128", "00000000001", "00000000001", "assets/barcode/", "jpg");
        $test2 = shell_exec('ren assets\barcode\00000000001.jpg 00000000001.bmp');
        echo $test2;
    }
    public function index() {
 
        $this->load->view('index');
    }
    public function triagemedico() {
        $UMAE_USER=$_SESSION['UMAE_USER'];
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE os_triage.triage_crea_medico='$UMAE_USER' AND os_triage.triage_etapa='2' ORDER BY os_triage.triage_id DESC LIMIT 10");
        $this->load->view('v2/triagemedico',$sql);
    }
    public function triageenfermeria() {
        $UMAE_USER=$_SESSION['UMAE_USER'];
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE os_triage.triage_crea_enfemeria='$UMAE_USER' AND os_triage.triage_etapa='1' ORDER BY os_triage.triage_id DESC LIMIT 10");
        $this->load->view('v2/triageenfermeria',$sql);
    }
    public function paso1() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>  $this->input->get('t')));
        $this->load->view('paso1',$sql);
    }
    public function paso2() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>  $this->input->get('t')))[0];
        $this->load->view('paso2',$sql);
    }
    public function inser_paso1() {
        $data=array(
            'triage_unidad_medica'=>  $this->input->post('triage_unidad_medica'),
            'triage_fecha'=> date('d/m/Y'), 
            'triage_hora'=> date('H:i'), 
            'triage_nombre'=> strtoupper($this->input->post('triage_nombre')),
            'triage_fecha_nac'=> strtoupper($this->input->post('triage_fecha_nac')),
            'triage_tension_arterial'=>  $this->input->post('triage_tension_arterial'),
            'triage_temperatura'=>  $this->input->post('triage_temperatura'),
            'triage_frecuencia_cardiaco'=>  $this->input->post('triage_frecuencia_cardiaco'),
            'triage_frecuencia_respiratoria'=>  $this->input->post('triage_frecuencia_respiratoria'),
            'triage_procedencia'=> strtoupper($this->input->post('triage_procedencia')),
            'triage_hospital_procedencia'=> strtoupper($this->input->post('triage_hospital_procedencia')),
            'triage_hostital_nombre_numero'=>  $this->input->post('triage_hostital_nombre_numero'),
            'triage_status'=>'En proceso',
            'triage_etapa'=>'1',
            'triage_crea_enfemeria'=>$_SESSION['UMAE_USER']
        );
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('triage_id')
        ))[0];
        if($info['triage_etapa']!='0'){ 
            unset($data['triage_fecha']);
            unset($data['triage_hora']); 
            unset($data['triage_status']);
            unset($data['triage_etapa']);
            unset($data['triage_corte']);
            unset($data['triage_corte']);
        }
        $this->config_mdl->_update_data('os_triage',$data,array('triage_id'=>  $this->input->post('triage_id')));
        $this->setOutput(array('accion'=>'1'));
        
    }
    public function inser_paso2() {
        $triege_preg_puntaje_s1=$this->input->post('triage_preg1_s1')+
                                $this->input->post('triage_preg2_s1')+
                                $this->input->post('triage_preg3_s1')+
                                $this->input->post('triage_preg4_s1')+
                                $this->input->post('triage_preg5_s1');
        $triege_preg_puntaje_s2=$this->input->post('triage_preg1_s2')+
                                $this->input->post('triage_preg2_s2')+
                                $this->input->post('triage_preg3_s2')+
                                $this->input->post('triage_preg4_s2')+
                                $this->input->post('triage_preg5_s2')+
                                $this->input->post('triage_preg6_s2')+
                                $this->input->post('triage_preg7_s2')+
                                $this->input->post('triage_preg8_s2')+
                                $this->input->post('triage_preg9_s2')+
                                $this->input->post('triage_preg10_s2')+
                                $this->input->post('triage_preg11_s2')+ 
                                $this->input->post('triage_preg12_s2');

        
        
        
        
        $sql_triage=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));

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
        $data=array(
            'triage_fecha_clasifica'=>  date('d/m/Y'),
            'triage_hora_clasifica'=>  date('H:i'),
            'triage_preg1_s1'=>  $this->input->post('triage_preg1_s1'),
            'triage_preg2_s1'=>  $this->input->post('triage_preg2_s1'),
            'triage_preg3_s1'=>  $this->input->post('triage_preg3_s1'),
            'triage_preg4_s1'=>  $this->input->post('triage_preg4_s1'),
            'triage_preg5_s1'=>  $this->input->post('triage_preg5_s1'),
            'triege_preg_puntaje_s1'=> $triege_preg_puntaje_s1,
            'triage_preg1_s2'=>  $this->input->post('triage_preg1_s2'),
            'triage_preg2_s2'=>  $this->input->post('triage_preg2_s2'),
            'triage_preg3_s2'=>  $this->input->post('triage_preg3_s2'),
            'triage_preg4_s2'=>  $this->input->post('triage_preg4_s2'),
            'triage_preg5_s2'=>  $this->input->post('triage_preg5_s2'),
            'triage_preg6_s2'=>  $this->input->post('triage_preg6_s2'),
            'triage_preg7_s2'=>  $this->input->post('triage_preg7_s2'),
            'triage_preg8_s2'=>  $this->input->post('triage_preg8_s2'),
            'triage_preg9_s2'=>  $this->input->post('triage_preg9_s2'),
            'triage_preg10_s2'=>  $this->input->post('triage_preg10_s2'),
            'triage_preg11_s2'=>  $this->input->post('triage_preg11_s2'),
            'triage_preg12_s2'=>  $this->input->post('triage_preg12_s2'),
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
            'triage_consultorio'=>  $this->input->post('triage_consultorio'),
            'triage_consultorio_nombre'=>  $this->input->post('triage_consultorio_nombre'),
            'triage_solicitud_rx'=>  $this->input->post('triage_solicitud_rx'),
            'triage_crea_medico'=>$_SESSION['UMAE_USER']
        );

        if($this->config_mdl->_update_data('os_triage',$data,array('triage_id'=>  $this->input->post('triage_id')))){
            $this->config_mdl->_insert('os_asistentesmedicas',array(
                'triage_id'=>  $this->input->post('triage_id') 
            ));
            $this->setOutput(array('accion'=>'1','triage_id'=>  $this->input->post('triage_id') ));
        }
        
    }    
    public function obtener_etapa() {
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('id')
        ))[0];
        
        if($_SESSION['UMAE_AREA']=='Enfermeria Triage' && $info['triage_status']=='En Captura'){
            $this->setOutput(array('estado'=>'1','etapa'=>$info['triage_etapa']));
        }
        else if($_SESSION['UMAE_AREA']=='Medico Triage' && $info['triage_status']=='En proceso'){
            $this->setOutput(array('estado'=>'2','etapa'=>$info['triage_etapa']));
        }else{
            $this->setOutput(array('estado'=>'3','etapa'=>$info['triage_etapa']));
        }
        
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
    public function eliminar_triage() {
        $this->config_mdl->_delete_data('os_triage_cortes',array(
            'triage_id'=>  $this->input->post('id')
        ));
        if($this->config_mdl->_delete_data('os_triage',array(
            'triage_id'=>  $this->input->post('id')
        ))){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function obtener_total() {
        
        $this->setOutput(array('total'=>  count($this->config_mdl->_get_data('os_triage')))); 
    }
    public function indicadores() { 
        $UMAE_USER=$_SESSION['UMAE_USER'];
        if($_SESSION['UMAE_AREA']=='Enfermeria Triage'){
            $user_crea='triage_crea_enfemeria';
        }else{
            $user_crea='triage_crea_medico';
        } 
         
         
        if($_GET['triage_color']=='Todos'){
            $triage_color="";
        }else{
            $triage_color="os_triage.triage_color='".$_GET['triage_color']."' AND";
            $triage_color_like="os_triage.triage_color='".$_GET['triage_color']."'";
        }
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ORDER BY os_triage.triage_id DESC");
            $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND os_triage.triage_etapa='2' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='1' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND os_triage.triage_color='Rojo' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND os_triage.triage_color='Naranja' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND os_triage.triage_color='Amarillo' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND   os_triage.triage_etapa='2' AND os_triage.triage_color='Verde' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND os_triage.triage_color='Azul' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ");
            
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');
            $hi=  $this->input->get('hi');
            $hf=  $this->input->get('hf');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ORDER BY os_triage.triage_id DESC");
            $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='1' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Rojo' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Naranja' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Amarillo' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Verde' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
            $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Azul' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ");
                 
        }if($_GET['filter_select']=='by_like'){
            $filter_by=$_GET['filter_by'];
            $like=$_GET['like'];
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color_like os_triage.$user_crea='$UMAE_USER' AND  $filter_by LIKE '%$like%' ORDER BY os_triage.triage_id DESC");
            $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND $filter_by LIKE '%$like%'");
            $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='1' AND $filter_by LIKE '%$like%'");
            $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Rojo' AND $filter_by LIKE '%$like%'");
            $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Naranja' AND $filter_by LIKE '%$like%'");
            $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Amarillo' AND $filter_by LIKE '%$like%'");
            $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.$user_crea='$UMAE_USER' AND  os_triage.triage_etapa='2' AND triage_color='Verde' AND $filter_by LIKE '%$like%'");
            $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color  os_triage.$user_crea='$UMAE_USER' AND os_triage.triage_etapa='2' AND triage_color='Azul' AND $filter_by LIKE '%$like%'");
            
        }
        
        $this->load->view('ver_cortes',$sql);
    }    
    public function paciente() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('id')
        ));
        $this->load->view('paciente',$sql);
    }
    public function solicitar_rx() {
        $this->load->view('solicitar_rx');
    }
    public function guardar_solicitud_rx() {
        
        foreach ($this->input->post('casoclinico_nombre') as $value) { 
            $casoclinico_nombre=  explode(';', $value);
            $this->config_mdl->_insert('os_triage_casosclinicos',array(
                'casoclinico_nombre'=>$casoclinico_nombre[1],
                'casoclinico_datos'=>  $this->input->post($casoclinico_nombre[0]),
                'triage_id'=>  $this->input->post('triage_id')
            ));
        }
        $sql_am=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_insert('os_rx',array(
            'triage_id'=>  $this->input->post('triage_id'),
            'rs_status'=>'',
            'rx_fecha_entrada'=>'S/A',
            'asistentesmedicas_id'=> $sql_am[0]['asistentesmedicas_id']
        ));
        $this->setOutput(array('accion'=>'1'));       
    }
    public function actualizar_solicitud() {
        $this->config_mdl->_update_data('os_triage',array(
                'triage_solicitud_rx'=>'No'
                //'triage_corte'=>'Clasificado'
            ),array(
               'triage_id'=>  $this->input->post('id') 
        ));
        $data=array( 'triage_id'=>  $this->input->post('id'));
        if($this->config_mdl->_insert('os_asistentesmedicas',$data)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function listas() {
        $this->load->view('listas/index');
    }
    public function listas_urgencias() {
        $this->load->view('listas/listas_urgencias');
    }
    public function listas_rx() {
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx
                                                    WHERE  os_triage.triage_id=os_rx.triage_id AND
                                                    os_triage.triage_asistentesmedicas='Datos Capturados' GROUP BY os_triage.triage_id ORDER BY 
                                                    os_triage.triage_color='Amarillo' DESC, 
                                                    os_triage.triage_color='Verde' DESC,
                                                    os_triage.triage_color='Azul' DESC LIMIT 10");
        $this->load->view('listas/listas_rx',$sql);
    }
    public function listas_consultorios_especialidad() {
//        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad
//                                                    WHERE  
//                                                    os_triage.triage_id=os_consultorios_especialidad.triage_id
//                                                    GROUP BY os_triage.triage_id ORDER BY 
//                                                    os_triage.triage_color='Amarillo' DESC, 
//                                                    os_triage.triage_color='Verde' DESC,
//                                                    os_triage.triage_color='Azul' DESC LIMIT 10");
        $this->load->view('listas/listas_consultorios_especialidad',$sql);
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
    public function buscar_pacientes() {
        if($_GET['like'] ){
            if($_GET['filtro_by']=='todos'){
                $sql['Gestion']=  $this->config_mdl->_get_data('os_triage');
                
            }else{
                $sql['Gestion']=  $this->triage_mdl->filtro_pacientes($this->input->get('filtro_by'),  $this->input->get('like'));
            }
            
        }else{
            $sql['Gestion']='';
        }
        $this->load->view('buscar_pacientes',$sql);
    }
    //
    public function horacero() {
        $this->load->view('horacero/index');
    }
    public function horacero_paciente() {
        $this->load->view('horacero/add');
    }
    public function insert_horaceropaciente() {
        $data=array(
            'triage_nombre'=>  '',
            'triage_paciente_afiliacion'=>  '',
            'triage_status'=>'En Captura',
            'triage_etapa'=>'0',
            'triage_corte'=>'No Clasificado',
            'triage_corte_am'=>'No Clasificado',
            'triage_horacero_h'=>  date('H:i'),
            'triage_horacero_f'=>  date('d/m/Y'),
            'triage_crea_horacero'=>$_SESSION['UMAE_USER']
        );
        $this->config_mdl->_insert('os_triage',$data);
        $last_id=  $this->config_mdl->_get_last_id('os_triage','triage_id');
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $last_id
        ))[0];
        $this->setOutput(array('accion'=>'1','max_id'=>$last_id));
    }
    public function generar_ticket() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('paciente_num')
        ))[0];
        $this->load->view('horacero/generar_ticket',$sql);
    }
    public function imprimir_ticket() {
//        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
//            'triage_id'=>  $this->input->get('paciente_num')
//        ))[0];
        $printer="POS-58";
        $enlace=printer_open($printer);
        if($enlace){
            $handle = printer_open($printer);
            
            printer_start_doc($handle, "TRIAGE TICKET");
            printer_start_page($handle);
            printer_set_option($handle, PRINTER_MODE, "RAW");
            printer_draw_text($handle,  "TRIAGE", 150, 2); 
            $font = printer_create_font("Arial", 20, 10, PRINTER_FW_BOLD, false, false, false, 0);
            printer_select_font($handle, $font);
            printer_draw_text($handle, "Hospital de Traumatologia", 40, 60); 
            printer_draw_text($handle, "'Dr. Victorio de la Fuente Narvaez'", 20, 90); 
            printer_draw_text($handle, "Av. Colector 15 S/N esq. Av. Instituto", 20, 150);
            printer_draw_text($handle, "Politecnico Nacional, Col. Magdalena de", 17, 180);
            printer_draw_text($handle, "las Salinas Del. Gustavo a. Madero", 20, 210); 
            printer_draw_bmp($handle, "assets/barcode/00000000001.bmp",100, 250,294,80); 
            printer_end_page($handle);
            printer_end_doc($handle);
            printer_close($handle);
            //echo '<script>window.top.close();</script>';
        }else{
            $this->setOutput(array('accion'=>'ERROR'));
           // echo '<script>window.top.close();</script>';
        } 
    }
    public function getConsultorios() {
        $especialidad=$this->config_mdl->_get_data_condition('os_consultorios',array(
            'consultorio_especialidad'=>'Si'
        ));
        foreach ($especialidad as $value) {
            $option.='<option value="'.$value['consultorio_id'].';'.$value['consultorio_nombre'].'">'.$value['consultorio_nombre'].'</option>';
        }
        $option.='<option selected value="0;Filtro">Filtro</option>';
        $this->setOutput(array('option'=>$option));
    }
    public function indicador_horacero() {
        $triage_crea_horacero=$_SESSION['UMAE_USER'];
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE os_triage.triage_crea_horacero='$triage_crea_horacero' AND  os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ORDER BY os_triage.triage_id DESC");
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');
            $hi=  $this->input->get('hi');
            $hf=  $this->input->get('hf');
            
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE os_triage.triage_crea_horacero='$triage_crea_horacero' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ORDER BY os_triage.triage_id DESC");
              
        }
        $this->load->view('horacero/indicador_horacero',$sql);
    }
}
