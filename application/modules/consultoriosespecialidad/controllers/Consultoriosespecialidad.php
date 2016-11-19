<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consultoriosespecialidad
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Consultoriosespecialidad extends Config{
    public function index() {
        //$UMAE_USER=$_SESSION['UMAE_USER'];
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_consultorios_especialidad, os_triage
            WHERE os_consultorios_especialidad.ce_status='Asignado' AND os_triage.triage_id=os_consultorios_especialidad.triage_id GROUP BY os_triage.triage_id");
//        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_consultorios_especialidad, os_triage
//            WHERE os_consultorios_especialidad.ce_asignado='$UMAE_USER' AND os_consultorios_especialidad.ce_status='Asignado' AND os_triage.triage_id=os_consultorios_especialidad.triage_id GROUP BY os_triage.triage_id");
        
        $this->load->view('index',$sql);
    }
    public function solicitud_paciente() {
        $this->load->view('generar_solicitud');
    }
    public function asignar_consultorio() {
        $this->load->view('asignar_consultorio');
    }
    public function reportar_salida() {
        
        $this->config_mdl->_update_data('os_consultorios_especialidad',array(
            'ce_status'=>'Salida',
            'ce_fecha'=>  date('d/m/Y'),
            'ce_hora'=>  date('H:i') ,
            'ce_fs'=>date('d/m/Y'),
            'ce_hs'=>date('H:i')
        ),array(
            'triage_id'=>  $this->input->post('id')
        ));
        $this->config_mdl->_update_data('os_triage',array(
            'triage_accion'=>'hidden'
        ),array(
            'triage_id'=>  $this->input->post('id')
        ));
        $this->config_mdl->_update_data('os_consultorios',array(
            'consultorio_listas'=>'Disponible'
        ),array(
            'consultorio_id'=>  $this->input->post('con')
        ));
        $info=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad',array(
            'triage_id'=>  $this->input->post('id')
        ))[0];
        $triage=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('id')
        ))[0];
        if($info['ce_hf']=='Observación'){
            if($triage['triage_paciente_edad']<18){
                $observacion_area='1';
            }else{
                if($triage['triage_paciente_sexo']=='MUJER'){
                    $observacion_area='2';
                }else{
                    $observacion_area='3';
                }
            }
            $this->config_mdl->_insert('os_observacion',array(
                'observacion_fe'=>  date('d/m/Y'),
                'observacion_he'=>date('H:i'),
                'triage_id'=>$this->input->post('id'),
                'observacion_area'=>$observacion_area
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function llamar_paciente() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad
                                                    WHERE  os_triage.triage_id=os_consultorios_especialidad.triage_id AND 
                                                    os_consultorios_especialidad.ce_status='En Espera' AND 
                                                    os_triage.triage_consultorio_nombre!=''
                                                    GROUP BY os_triage.triage_id ORDER BY 
                                                    os_triage.triage_color='Amarillo' DESC, 
                                                    os_triage.triage_color='Verde' DESC,
                                                    os_triage.triage_color='Azul' DESC LIMIT 1");
        
        foreach ($sql as $value) {
            if($value['triage_consultorio_nombre']=='Filtro'){
                $this->config_mdl->_update_data('os_consultorios_especialidad',array(
                    'ce_status'=>'Asignado',
                    'ce_asignado'=>  $this->input->post('ce_asignado')
                ),array(
                    'triage_id'=>$value['triage_id']
                ));
                $this->config_mdl->_insert('os_consultorios_especialidad_llamada',array(
                    'triage_id'=>$value['triage_id']
                ));
            }else{
                if($this->input->post('ce_asignado')==$value['triage_consultorio']){
                   $this->config_mdl->_update_data('os_consultorios_especialidad',array(
                        'ce_status'=>'Asignado',
                        'ce_asignado'=>  $value['triage_consultorio']
                    ),array(
                        'triage_id'=>$value['triage_id']
                    ));
                    $this->config_mdl->_insert('os_consultorios_especialidad_llamada',array(
                        'triage_id'=>$value['triage_id']
                    )); 
                }
                
            }
            
        }
        $this->setOutput(array('accion'=>'1','id'=>$this->input->post('ce_asignado')));
    }
    public function actualizar_listas() {
        $sql=  $this->config_mdl->_get_data('os_consultorios');
        $this->setOutput(array('sql'=>$sql));
    }
    public function actualizar_listas_Ce() {
        $sql_ce= count($this->config_mdl->_query("SELECT * FROM os_consultorios_especialidad WHERE os_consultorios_especialidad.ce_status='Salida'")); 
        $this->setOutput(array('total'=>$sql_ce));
    }
    public function last_lista_paciente() {
        $sql_check=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_consultorios
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' AND
            os_consultorios_especialidad.ce_asignado=os_consultorios.consultorio_id");
        
        if(!empty($sql_check)){
            
        $max=  $this->config_mdl->_get_last_id('os_consultorios_especialidad_llamada','ce_id');
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_consultorios
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' AND
            os_consultorios_especialidad.ce_asignado=os_consultorios.consultorio_id AND
            os_consultorios_especialidad_llamada.ce_id=".$max)[0];
        if($sql['triage_color']=='Rojo'){
            $color_last='red';
        }if($sql['triage_color']=='Naranja'){
            $color_last='orange';
        }if($sql['triage_color']=='Amarillo'){
            $color_last='amber';
        }if($sql['triage_color']=='Verde'){
            $color_last='green';
        }if($sql['triage_color']=='Azul'){
            $color_last='indigo';
        }
        $result.='  <td style="width: 10%">
                        <img src="'.  base_url().'assets/img/logo.png" style="width: 100px;height: 100px">
                    </td>
                    <td class="'.$color_last.'" style="width: 5%;">
                        
                    </td>
                    <td class="back-imss" style="width: 50%;margin-left:-10px!important">
                        <h3 style="font-weight: bold;font-size: 40px">'.$sql['triage_nombre'].'</h3>

                    </td>
                    <td class="">
                        <h3 style="font-weight: bold;font-size: 40px">'.$sql['consultorio_nombre'].'</h3>

                    </td>';
        }else{
            $result='';
        }
        $sql_ce=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_consultorios
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' AND
            os_consultorios_especialidad.ce_asignado=os_consultorios.consultorio_id ORDER BY os_consultorios_especialidad_llamada.ce_id DESC");
        foreach ($sql_ce as $value) {
            if($value['triage_color']=='Rojo'){
                $color='red';
            }if($value['triage_color']=='Naranja'){
                $color='orange';
            }if($value['triage_color']=='Amarillo'){
                $color='amber';
            }if($value['triage_color']=='Verde'){
                $color='green';
            }if($value['triage_color']=='Azul'){
                $color='indigo';
            }
            $result_ce.='<tr id="'.$value['triage_id'].'">
                        <td style="padding: 0px 5px 0px 5px;color: white;width:5%" class="'.$color.'">
                        </td>
                        <td class="back-imss" style="width: 60%">
                            <h3 style="font-weight: bold;font-size: 25px">'.$value['triage_nombre'].'</h3>
                        </td>
                        <td style="font-weight: bold;font-size: 15px;">
                            <h3 style="font-weight: bold;font-size: 25px">'.$value['consultorio_nombre'].'</h3>
                        </td>

                    </tr>';
        }
        $this->setOutput(array('last_lista_paciente'=>$result,'result_listas_ce'=>$result_ce));
        
    }
    public function get_listas_ce() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_consultorios
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_triage.triage_id=os_consultorios.consultorio_listas");
        foreach ($sql as $value) {
            if($value['triage_color']=='Rojo'){
                $color='red';
            }if($value['triage_color']=='Naranja'){
                $color='orange';
            }if($value['triage_color']=='Amarillo'){
                $color='amber';
            }if($value['triage_color']=='Verde'){
                $color='green';
            }if($value['triage_color']=='Azul'){
                $color='indigo';
            }
            $result.='<tr id="'.$value['triage_id'].'">
                        <td style="padding: 0px 5px 0px 5px;color: white" class="'.$color.'">
                            <h3 style="font-weight: bold;font-size: 34px">'.$value['triage_id'].'</h3>
                        </td>
                        <td class="back-imss" style="width: 50%">
                            <h3 style="font-weight: bold;font-size: 15px">'.$value['triage_nombre'].'</h3>
                        </td>
                        <td style="font-weight: bold;font-size: 15px;">
                            <h3 style="font-weight: bold;font-size: 15px">'.$value['consultorio_nombre'].'</h3>
                        </td>

                    </tr>';
        }
        $this->setOutput(array('result'=>$sql));
    }
    public function solicitar_rx() {
        $this->load->view('solicitar_rx');
    }
    public function guardar_solicitud_rx() {
        foreach ($this->input->post('casoclinico_nombre') as $value) { 
            $casoclinico_nombre=  explode(';', $value);
            $sql_check=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
                'casoclinico_nombre'=>$casoclinico_nombre[1],
                'triage_id'=>  $this->input->post('triage_id')
            ));
            if(empty($sql_check)){
                $this->config_mdl->_insert('os_triage_casosclinicos',array(
                    'casoclinico_nombre'=>$casoclinico_nombre[1],
                    'casoclinico_datos'=>  $this->input->post($casoclinico_nombre[0]),
                    'triage_id'=>  $this->input->post('triage_id')
                ));
            }
            
        }
        $sql_am=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $check_rx=  $this->config_mdl->_get_data_condition('os_rx',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        if(empty($check_rx)){
            $this->config_mdl->_insert('os_rx',array(
                'triage_id'=>  $this->input->post('triage_id'),
                'rs_status'=>'Datos Capturados',
                'rx_fecha_entrada'=>  'S/A',
                'rx_hora_entrada'=>  '',
                'asistentesmedicas_id'=> $sql_am[0]['asistentesmedicas_id']
            ));
            $this->config_mdl->_insert('os_rx_llamada',array(
               'triage_id'=>$this->input->post('triage_id')
            ));
        }else{
            $this->config_mdl->_update_data('os_rx',array(
                'rs_status'=>'Datos Capturados',
                'rx_fecha_entrada'=>  'S/A',
                'rx_hora_entrada'=>  '',
                'asistentesmedicas_id'=> $sql_am[0]['asistentesmedicas_id']
            ),array(
                'triage_id'=>  $this->input->post('triage_id')
            ));
        }
        $this->config_mdl->_update_data('os_consultorios_especialidad',array(
            'ce_status'=>'Enviado a RX'
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));       
    }
    public function hojafrontal() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['hojaforntal']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['rx']=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $sql['INFO_USER']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>  $_SESSION['UMAE_USER']
        ));
        $this->load->view("hojafrontal",$sql);
    }
    public function hojaforntal_save() {
        
        $data=array(
            'hf_intoxitacion'=>  $this->input->post('hf_intoxitacion'),
            'hf_intoxitacion_descrip'=>  $this->input->post('hf_intoxitacion_descrip'),
            'hf_urgencia'=>  $this->input->post('hf_urgencia'),
            'hf_especialidad'=>  $this->input->post('hf_especialidad'),
            'hf_motivo'=>  $this->input->post('hf_motivo'),
            'hf_mecanismolesion_caida'=> $this->input->post('hf_mecanismolesion_mtrs'),
            'hf_mecanismolesion_ab'=>  $this->input->post('hf_mecanismolesion_ab'),
            'hf_mecanismolesion_td'=>  $this->input->post('hf_mecanismolesion_td'),
            'hf_mecanismolesion_av'=>  $this->input->post('hf_mecanismolesion_av'),
            'hf_mecanismolesion_maquinaria'=>  $this->input->post('hf_mecanismolesion_maquinaria'),
            'hf_mecanismolesion_mordedura'=>  $this->input->post('hf_mecanismolesion_mordedura'),
            'hf_mecanismolesion_otros'=>  $this->input->post('hf_mecanismolesion_otros'),
            'hf_quemadura_fd'=>  $this->input->post('hf_quemadura_fd'),
            'hf_quemadura_ce'=>  $this->input->post('hf_quemadura_ce'),
            'hf_quemadura_e'=>  $this->input->post('hf_quemadura_e'),
            'hf_quemadura_q'=>  $this->input->post('hf_quemadura_q'),
            'hf_quemadura_otros'=>  $this->input->post('hf_quemadura_otros'),
            'hf_antecedentes'=>  $this->input->post('hf_antecedentes'),
            'hf_exploracionfisica'=>  $this->input->post('hf_exploracionfisica'),
            'hf_interpretacion'=>  $this->input->post('hf_interpretacion'),
            'hf_diagnosticos'=>  $this->input->post('hf_diagnosticos'),
            'hf_trataminentos_curacion'=> $this->input->post('hf_trataminentos_curacion'),
            'hf_trataminentos_sutura'=> $this->input->post('hf_trataminentos_sutura'),
            'hf_trataminentos_vendaje'=> $this->input->post('hf_trataminentos_vendaje'),
            'hf_trataminentos_ferula'=> $this->input->post('hf_trataminentos_ferula'),
            'hf_trataminentos_vacunas'=> $this->input->post('hf_trataminentos_vacunas'),
            'hf_trataminentos_otros'=>  $this->input->post('hf_trataminentos_otros'),
            'hf_trataminentos_por'=>  $this->input->post('hf_trataminentos_por'),
            'hf_receta_por'=>  $this->input->post('hf_receta_por'),
            'hf_indicaciones'=>  $this->input->post('hf_indicaciones'),
            'hf_ministeriopublico'=>  $this->input->post('hf_ministeriopublico'),
            'hf_alta'=>  $this->input->post('hf_alta'),
            'hf_incapacidad_dias'=>  $this->input->post('hf_incapacidad_dias'),
            'hf_incapacidad_ptr_eg'=>  $this->input->post('hf_incapacidad_ptr_eg'),
            'triage_id'=>  $this->input->post('triage_id')
            
        );
        $data_am=array(
            'asistentesmedicas_da'=>  $this->input->post('asistentesmedicas_da'),
            'asistentesmedicas_dl'=>  $this->input->post('asistentesmedicas_dl'),
            'asistentesmedicas_ip'=>  $this->input->post('asistentesmedicas_ip'),
            'asistentesmedicas_tratamientos'=>  $this->input->post('asistentesmedicas_tratamientos'),
            'asistentesmedicas_ss_in'=>  $this->input->post('asistentesmedicas_ss_in'),
            'asistentesmedicas_ss_ie'=>  $this->input->post('asistentesmedicas_ss_ie'),
            'asistentesmedicas_oc_hr'=>  $this->input->post('asistentesmedicas_oc_hr'),
            'asistentesmedicas_am'=>  $this->input->post('asistentesmedicas_am'),
            'asistentesmedicas_incapacidad_am'=>  $this->input->post('asistentesmedicas_incapacidad_am'),
            'asistentesmedicas_incapacidad_fi'=>  $this->input->post('asistentesmedicas_incapacidad_fi'),
            'asistentesmedicas_incapacidad_da'=>  $this->input->post('asistentesmedicas_incapacidad_da'),
            'asistentesmedicas_mt'=>  $this->input->post('asistentesmedicas_mt'),
            'asistentesmedicas_mt_m'=>  $this->input->post('asistentesmedicas_mt_m'),
            'asistentesmedicas_incapacidad_folio'=>  $this->input->post('asistentesmedicas_incapacidad_folio')
        );
        $sql_hf=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        if(empty($sql_hf)){
            $this->config_mdl->_insert('os_consultorios_especialidad_hf',$data);
        }else{
            $this->config_mdl->_update_data('os_consultorios_especialidad_hf',$data,array(
                'triage_id'=>  $this->input->post('triage_id')
            ));
        }
        
        $this->config_mdl->_update_data('os_asistentesmedicas',$data_am,array(
           'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_consultorios_especialidad',array(
            'ce_hf'=>$this->input->post('hf_alta')
        ),array(
           'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function generarhojafrontal() {
        $sql['hoja']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get('t')
        ))[0];
        $sql['rx']=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
            'triage_id'=>  $this->input->get('t')
        ));
        
        $this->load->view('generarhojafrontal',$sql);
    }
    public function reportes() {
        if($_GET['triage_color']=='Todos'){
            $triage_color="";
        }else{
            $triage_color="os_triage.triage_color='".$_GET['triage_color']."' AND";
            $triage_color_like="os_triage.triage_color='".$_GET['triage_color']."'";
        }
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada WHERE  $triage_color os_triage.triage_id=os_consultorios_especialidad.triage_id AND os_consultorios_especialidad_llamada.triage_id=os_triage.triage_id AND  os_consultorios_especialidad.ce_fe BETWEEN '$fi' AND '$ff' ORDER BY os_triage.triage_id DESC");
            
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');  $hi=  $this->input->get('hi'); $hf=  $this->input->get('hf');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada WHERE $triage_color os_triage.triage_id=os_consultorios_especialidad.triage_id AND os_consultorios_especialidad_llamada.triage_id=os_triage.triage_id AND os_consultorios_especialidad.ce_fe='$fi' AND os_consultorios_especialidad.ce_he BETWEEN '$hi' AND '$hf' ORDER BY os_triage.triage_id DESC");
               
        }if($_GET['filter_select']=='by_like'){
            $filter_by=$_GET['filter_by'];
            $like=$_GET['like'];
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada WHERE $triage_color_like os_triage.triage_id=os_consultorios_especialidad.triage_id AND os_consultorios_especialidad_llamada.triage_id=os_triage.triage_id  $filter_by LIKE '%$like%' ORDER BY os_triage.triage_id DESC");
            
        }
        $this->load->view('reportes',$sql);
    }
    public function cambiar_consultorio() {
        $data=array(
            'triage_consultorio'=>  $this->input->post('triage_consultorio'),
            'triage_consultorio_nombre'=>  $this->input->post('triage_consultorio_nombre')
        );
        $this->config_mdl->_update_data('os_triage',$data,array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_consultorios_especialidad',array(
            'ce_asignado'=>  '',
            'ce_status'=>'En Espera'
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        
        $this->config_mdl->_delete_data('os_consultorios_especialidad_llamada',array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function paciente() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->get('id')
        ));
        $sql['ce']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad',array(
            'triage_id'=>  $this->input->get('id')
        ))[0];
        $this->load->view('paciente',$sql);
    }
    public function obtener_usuario() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad
                                                    WHERE  os_triage.triage_id=os_consultorios_especialidad.triage_id AND 
                                                    os_consultorios_especialidad.ce_status='En Espera' AND 
                                                    os_triage.triage_consultorio_nombre!='' AND os_triage.triage_id=".$this->input->post('id'));
        if(!empty($sql)){
            
            $this->setOutput(array('paciente'=>$sql[0]['triage_id'],'nombre'=>$sql[0]['triage_nombre']));
        }else{
            $this->setOutput(array('accion'=>'NO_RESULT'));
        }
    }
    public function add_usuario_ce() {
        $sql_con=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad
                                                    WHERE  os_triage.triage_id=os_consultorios_especialidad.triage_id AND 
                                                    os_consultorios_especialidad.ce_status='En Espera' AND 
                                                    os_triage.triage_consultorio_nombre!='' AND os_triage.triage_id=".$this->input->post('id'))[0];
        $this->config_mdl->_update_data('os_consultorios_especialidad',array(
            'ce_status'=>'Asignado',
            'ce_asignado'=>  $_SESSION['UMAE_USER'],
            'ce_asignado_consultorio'=>$_SESSION['UMAE_AREA']
        ),array(
            'triage_id'=>$sql_con['triage_id']
        ));
        $this->config_mdl->_insert('os_consultorios_especialidad_llamada',array(
            'triage_id'=>$sql_con['triage_id']
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function formato_4306_lechuga() {
        if($_GET['triage_color']=='Todos'){
            $triage_color="";
        }else{
            $triage_color="os_triage.triage_color='".$_GET['triage_color']."' AND";
            $triage_color_like="os_triage.triage_color='".$_GET['triage_color']."'";
        }
        if($_GET['filter_select']=='by_fecha'){
            $fi=  $this->input->get('fi');
            $ff=  $this->input->get('ff');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada,os_consultorios_especialidad_hf WHERE  $triage_color os_consultorios_especialidad_hf.triage_id=os_triage.triage_id AND os_triage.triage_id=os_consultorios_especialidad.triage_id AND os_consultorios_especialidad_llamada.triage_id=os_triage.triage_id AND  os_consultorios_especialidad.ce_fe BETWEEN '$fi' AND '$ff' ORDER BY os_triage.triage_id DESC");
            
            
        }if($_GET['filter_select']=='by_hora'){
            $fi=  $this->input->get('fi');  $hi=  $this->input->get('hi'); $hf=  $this->input->get('hf');
            $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada,os_consultorios_especialidad_hf WHERE $triage_color os_consultorios_especialidad_hf.triage_id=os_triage.triage_id AND os_triage.triage_id=os_consultorios_especialidad.triage_id AND os_consultorios_especialidad_llamada.triage_id=os_triage.triage_id AND os_consultorios_especialidad.ce_fe='$fi' AND os_consultorios_especialidad.ce_he BETWEEN '$hi' AND '$hf' ORDER BY os_triage.triage_id DESC");
               
        }
        $sql['medico']=$this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>  $_SESSION['UMAE_USER']
        ))[0];
        $this->load->view('formato_4306_lechuga',$sql);
    }
}
