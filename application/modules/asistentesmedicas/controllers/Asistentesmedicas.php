<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asistentesmedicas
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Asistentesmedicas extends Config{
    public function __construct() {
        parent::__construct();
        $this->load->model('asistentesmedicas_mdl');
    }

    public function index() {
        $this->load->view('v2/index');
    }
    public function obtener_etapa() {
        $info=  $this->config_mdl->_query("SELECT * FROM os_triage , os_asistentesmedicas WHERE os_triage.triage_id=os_asistentesmedicas.triage_id ORDER BY
                                                    os_triage.triage_id AND os_triage.triage_id=".$this->input->post('id'));
        if(empty($info)){
            $this->setOutput(array('accion'=>'2'));
        }else{
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function agregar_solicitud() {
        $data=array( 'triage_id'=>  $this->input->post('triage_id'));
        if($this->config_mdl->_insert('os_asistentesmedicas',$data)){
            $this->config_mdl->_update_data('os_triage',array(
                'triage_solicitud'=>'Enviado'
            ),array(
               'triage_id'=>  $this->input->post('triage_id') 
            ));
            $msj=array(
                'notificacion_titulo'=>'Solicitud de TRIAGE',
                'notificacion_descripcion'=>'Solicitud de TRIAGE',
                'notificacion_url'=>'asistentesmedicas/solicitud_paciente?t='.$this->input->post('triage_id'),
                'notificacion_tipo'=>'Roles',
                'notificacion_de'=>'34',
                'notificacion_para'=>'36',
                'notificacion_fecha'=>date('d/m/Y').' '.  date('h:i A'),
                'notificacion_status'=>'Nuevo'
            );
            $this->config_mdl->_insert('os_notificaciones',$msj);
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function solicitud_paciente() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
           'triage_id'=>  $this->input->get('t') 
        ));
        $sql['solicitud']= $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
           'triage_id'=>  $this->input->get('t') 
        ));
        $this->load->view('solicitud_paciente',$sql);
    }
    public function guardar_solicitud() {
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('triage_id')
        ))[0];
        if($info['triage_paciente_dir_cp']==''){
            if($info['triage_color']=='Rojo'){
                $triage_choque='Si';
                $triage_solicitud_rx='Choque';
                $this->config_mdl->_insert('os_choque',array(
                    'choque_fecha'=>  date('d/m/Y'),
                    'choque_hora'=>date('H:i'),
                    'triage_id'=>  $this->input->post('triage_id')
                ));
            }else{
                $triage_choque='No';
                if($info['triage_solicitud_rx']=='Si'){
                    $triage_solicitud_rx='RX';
                    $solicitud='Si';
                    $this->config_mdl->_update_data('os_rx',array(
                        'rs_status'=>'Datos Capturados'
                    ),array(
                        'triage_id'=>  $this->input->post('triage_id')
                    ));
                }else{
                    $triage_solicitud_rx='Triage';
                    $solicitud='No';
                }    

                if($this->input->post('triage_solicitud_rx')=='Si'){

                }else{
                    $this->config_mdl->_insert('os_consultorios_especialidad',array(
                        'triage_id'=>  $this->input->post('triage_id'),
                        'asistentesmedicas_id'=>  $this->input->post('asistentesmedicas_id'),
                        'ce_fe'=>date('d/m/Y'),
                        'ce_he'=>  date('H:i'),
                        'ce_status'=>'En Espera',
                        'ce_via'=>$triage_solicitud_rx
                    ));
                }
            }
        }
        

        $data=array(
            'asistentesmedicas_fecha'=> date('d/m/Y'),
            'asistentesmedicas_hora'=> date('H:i'), 
            'asistentesmedicas_hoja'=>  $this->input->post('asistentesmedicas_hoja'),
            'asistentesmedicas_renglon'=>  $this->input->post('asistentesmedicas_renglon'),
            'asistentesmedicas_status'=>'Datos Capturados',
            'asistentesmedicas_modulo'=>  $triage_solicitud_rx,
            'triage_id'=>  $this->input->post('triage_id')
        );
        if($info['triage_paciente_dir_cp']!=''){
            unset($data['asistentesmedicas_fecha']);
            unset($data['asistentesmedicas_hora']);
            unset($data['asistentesmedicas_modulo']);
        }
        $this->config_mdl->_update_data('os_asistentesmedicas',$data,
                array('triage_id'=>  $this->input->post('triage_id'))
        );
        
        $data_triage=array(
            'triage_solicitud_rx'=>  $this->input->post('triage_solicitud_rx'),
            'triage_asistentesmedicas'=>'Datos Capturados',
            'triage_nombre'=>  strtoupper($this->input->post('triage_nombre')), 
            'triage_paciente_sexo'=> strtoupper($this->input->post('triage_paciente_sexo')),
            'triage_fecha_nac'=>  $this->input->post('triage_fecha_nac'),
            'triage_paciente_edad'=>  $this->calculaedad($this->input->post('triage_fecha_nac'))->y, 
            'triage_paciente_meses'=>  $this->calculaedad($this->input->post('triage_fecha_nac'))->m, 
            'triage_paciente_afiliacion'=> strtoupper($this->input->post('triage_paciente_afiliacion')),
            'triage_paciente_clinica'=> strtoupper($this->input->post('triage_paciente_clinica')),
            'triage_paciente_identificacion'=>  strtoupper($this->input->post('triage_paciente_identificacion')),
            'triage_paciente_estadocivil'=>  strtoupper($this->input->post('triage_paciente_estadocivil')),
            'triage_paciente_telefono'=>  strtoupper($this->input->post('triage_paciente_telefono')),
            'triage_paciente_curp'=>  strtoupper($this->input->post('triage_paciente_curp')),
            'triage_paciente_dir_cp'=> strtoupper($this->input->post('triage_paciente_dir_cp')),
            'triage_paciente_dir_calle'=>  strtoupper($this->input->post('triage_paciente_dir_calle')),
            'triage_paciente_dir_colonia'=>  strtoupper($this->input->post('triage_paciente_dir_colonia')),
            'triage_paciente_dir_municipio'=>  strtoupper($this->input->post('triage_paciente_dir_municipio')),
            'triage_paciente_dir_estado'=>  strtoupper($this->input->post('triage_paciente_dir_estado')),
            'triage_paciente_umf'=> strtoupper($this->input->post('triage_paciente_umf')),
            'triage_paciente_delegacion'=> strtoupper($this->input->post('triage_paciente_delegacion')),
            'triage_paciente_res'=> strtoupper($this->input->post('triage_paciente_res')),
            'triage_paciente_res_telefono'=>  $this->input->post('triage_paciente_res_telefono'),
            'triage_paciente_res_empresa'=> strtoupper($this->input->post('triage_paciente_res_empresa')),
            //'triage_paciente_res_domicilio'=> strtoupper($this->input->post('triage_paciente_res_domicilio')),
            'triage_paciente_medico_tratante'=> strtoupper($this->input->post('triage_paciente_medico_tratante')),
            'triage_paciente_asistente_medica'=> strtoupper($this->input->post('triage_paciente_asistente_medica')), 
            'triage_paciente_accidente_t_hora'=>  $this->input->post('triage_paciente_accidente_t_hora'),
            'triage_paciente_accidente_t_hora_s'=>  $this->input->post('triage_paciente_accidente_t_hora_s'),
            'triage_paciente_accidente_fecha'=>  $this->input->post('triage_paciente_accidente_fecha'),
            'triage_paciente_accidente_hora'=>  $this->input->post('triage_paciente_accidente_hora'),
            'triage_paciente_accidente_lugar'=> strtoupper($this->input->post('triage_paciente_accidente_lugar')),
            'triage_paciente_accidente_cp'=> strtoupper($this->input->post('triage_paciente_accidente_cp')),
            'triage_paciente_accidente_calle'=> strtoupper($this->input->post('triage_paciente_accidente_calle')),
            'triage_paciente_accidente_colonia'=>  strtoupper($this->input->post('triage_paciente_accidente_colonia')),
            'triage_paciente_accidente_municipio'=> strtoupper($this->input->post('triage_paciente_accidente_municipio')),
            'triage_paciente_accidente_estado'=> strtoupper($this->input->post('triage_paciente_accidente_estado')),
            'triage_paciente_accidente_telefono'=> strtoupper($this->input->post('triage_paciente_accidente_telefono')),
            'triage_paciente_accidente_rp'=> strtoupper($this->input->post('triage_paciente_accidente_rp')),
            'triage_paciente_accidente_procedencia'=> strtoupper($this->input->post('triage_paciente_accidente_procedencia')),
            'triage_choque'=>$triage_choque,
            'triage_crea_am'=>$_SESSION['UMAE_USER']
            
        );
        if($info['triage_paciente_dir_cp']!=''){
            unset($data_triage['triage_choque']);
        }
        $this->config_mdl->_update_data('os_triage',$data_triage,
                array('triage_id'=>  $this->input->post('triage_id'))
        );
        
        $this->setOutput(array('accion'=>'1'));        
        
    }
    public function generar_solicitud() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $this->load->view('generar_solicitud',$sql);
    }
    public function st7() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['ce']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $this->load->view('generar_solicitud_st7',$sql);
    }
    public function estudios_clinicos() {
        $sql['Casos']=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $this->load->view('estudios_clinicos',$sql);
    }
    public function calculaedad($fechanac){
        $fecha_hac=  new DateTime(str_replace('/', '-', $fechanac));
        $hoy=  new DateTime(date('d-m-Y')); 
        return $hoy->diff($fecha_hac); 
    }
    public function showedad() {
        echo $this->calculaedad('05/02/1993')->y.'<br>';
        echo $this->calculaedad('05/02/1993')->m.'<br>';
        echo $this->calculaedad('05/02/1993')->d;
    }
    public function realizarcorte() {
        echo 'Espere por favor, realizando corte...';
        $sql=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_corte_am'=>'No Clasificado'
        ));
        foreach ($sql as $value) {
            $this->config_mdl->_insert('os_triage_cortes_am',array(
                'cortes_am_hora'=>  date('H:i'),
                'cortes_am_fecha'=>  date('d/m/Y') ,
                'triage_id'=>$value['triage_id']
            ));
            $this->config_mdl->_update_data('os_triage',array(
                'triage_corte_am'=>'Clasificado'
            ),array(
                'triage_id'=>$value['triage_id']
            ));
        }
        redirect(base_url().'asistentesmedicas');
        //header('Refresh:3;url='.  base_url().'asistentesmedicas');
    }
    public function cortes() {
        $sql['Gestion']=  $this->config_mdl->_query('SELECT * FROM os_triage, os_triage_cortes_am WHERE
                os_triage.triage_id=os_triage_cortes_am.triage_id GROUP BY os_triage_cortes_am.cortes_am_fecha DESC');
        $this->load->view('cortes',$sql); 
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
    public function ver_corte() {
        $fecha=$_GET['fecha'];
        if($_GET['like']){
            if($this->input->get('filtro_by')!='todos'){
                $sql['Gestion']=  $this->asistentesmedicas_mdl->filtro_am($this->input->get('filtro_by'),$this->input->get('like'),$fecha);
            }else{
                $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage,  os_triage_cortes_am
                    WHERE os_triage.triage_id=os_triage_cortes_am.triage_id AND os_triage_cortes_am.cortes_am_fecha='$fecha' 
                    ORDER BY os_triage_cortes_am.cortes_am_id");    
            }
            
        }else{
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage,  os_triage_cortes_am
                WHERE os_triage.triage_id=os_triage_cortes_am.triage_id AND os_triage_cortes_am.cortes_am_fecha='$fecha' 
                ORDER BY os_triage_cortes_am.cortes_am_id DESC LIMIT 100");
        }
        $this->load->view('cortes_ver',$sql);
    }
    public function get_data_cp() {
       $sql=  $this->config_mdl->_get_data_condition('os_codigospostales',array('CodigoPostal'=>  $this->input->post('cp'))) ;
       $this->setOutput(array('result_cp'=>$sql[0]));
    }
    public function reportes() {
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_triage WHERE os_triage.triage_id=os_asistentesmedicas.triage_id AND asistentesmedicas_status='Datos Capturados' AND os_triage.triage_fecha BETWEEN '$fi' AND '$ff' ORDER BY os_triage.triage_id DESC");
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');
            $hi=  $this->input->get('hi');
            $hf=  $this->input->get('hf');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_triage WHERE os_triage.triage_id=os_asistentesmedicas.triage_id AND asistentesmedicas_status='Datos Capturados' AND os_triage.triage_fecha='$fi' AND os_triage.triage_hora BETWEEN '$hi' AND '$hf' ORDER BY os_triage.triage_id DESC");
                
        }if($_GET['filter_select']=='by_like'){
            $filter_by=$_GET['filter_by'];
            $like=$_GET['like'];
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_triage WHERE os_triage.triage_id=os_asistentesmedicas.triage_id AND asistentesmedicas_status='Datos Capturados' AND $filter_by LIKE '%$like%' ORDER BY os_triage.triage_id DESC");
            
        }
        $this->load->view('reportes',$sql);
    }
    public function paciente() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('p')
        ));
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get('p')
        ));
        $this->load->view('paciente',$sql);
    }
}
