<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rx
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Rx extends Config{
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_asistentesmedicas, os_rx
                                                    WHERE  os_triage.triage_id=os_asistentesmedicas.triage_id AND os_triage.triage_id=os_rx.triage_id AND
                                                    os_triage.triage_asistentesmedicas='Datos Capturados' AND os_rx.rs_status='Asignado' AND
                                                    os_asistentesmedicas.asistentesmedicas_id=os_rx.asistentesmedicas_id ORDER BY 
                                                    os_triage.triage_color='Amarillo' DESC, 
                                                    os_triage.triage_color='Verde' DESC,
                                                    os_triage.triage_color='Azul' DESC");
        $this->load->view('index',$sql);
    }
    public function solicitud_paciente() {
        
    }
    public function acceso_paciente() {
        $this->config_mdl->_update_data('os_rx',array(
            'rx_fecha_salida'=>  date('d/m/Y'),
            'rx_hora_salida'=>  date('h:i'),
            'rs_status'=>'Salida al Consultorio de Especialidad'
        ),array(
            'rx_id'=>  $this->input->post('rx_id')
        ));
        $check_ce=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad',array(
            'triage_id'=>  $this->input->post('triage')
        ));
        if(empty($check_ce)){
            $this->config_mdl->_insert('os_consultorios_especialidad',array(
                'triage_id'=>  $this->input->post('triage'),
                'ce_status'=>'En Espera',
                'ce_via'=>'RX'
            ));
        }else{
            $this->config_mdl->_update_data('os_consultorios_especialidad',array(
                'ce_via'=>'RX',
                'ce_status'=>'Enviado de RX',
            ),array(
                'triage_id'=>  $this->input->post('triage')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    public function estudios_clinicos() {
        $sql['Casos']=  $this->config_mdl->_get_data_condition('os_triage_casosclinicos',array(
            'triage_id'=>  $this->input->get('t')
        ));
        $this->load->view('estudios_clinicos',$sql);
    }
    
    
    public function llamar_paciente_rx() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx
                                                    WHERE  os_triage.triage_id=os_rx.triage_id AND os_rx.rx_fecha_entrada='S/A' AND
                                                    os_triage.triage_asistentesmedicas='Datos Capturados' AND os_rx.rs_status!='Asignado' GROUP BY os_triage.triage_id ORDER BY 
                                                    os_triage.triage_color='Amarillo' DESC, 
                                                    os_triage.triage_color='Verde' DESC,
                                                    os_triage.triage_color='Azul' DESC LIMIT 1");
        
        foreach ($sql as $value) {
            $this->config_mdl->_update_data('os_rx',array(
                'rs_status'=> 'Asignado',
                'rx_fecha_entrada'=>  date('d/m/Y'),
                'rx_hora_entrada'=>  date('h:i')
                ),array(
                
                'rx_id'=> $value['rx_id']
            ));
            $this->config_mdl->_update_data('os_triage',array(
                'triage_crea_rx'=>$_SESSION['UMAE_USER']
            ),array(
                'triage_id'=>$value['triage_id']
            ));
            $sql_check=$this->config_mdl->_get_data_condition('os_rx_llamada',array(
                'triage_id'=>$value['triage_id']
            ));
            if(empty($sql_check)){
                $this->config_mdl->_insert('os_rx_llamada',array(
                    'triage_id'=>$value['triage_id']
                ));
            }
            
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function last_lista_paciente() {
        $sql_check=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx, os_rx_llamada
            WHERE os_rx.triage_id=os_triage.triage_id AND os_rx.rs_status='Asignado' AND
            os_rx_llamada.triage_id=os_triage.triage_id");
        
        if(!empty($sql_check)){
            
        $max=  $this->config_mdl->_get_last_id('os_rx_llamada','llamada_id');
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx, os_rx_llamada
            WHERE os_rx.triage_id=os_triage.triage_id AND os_rx.rs_status='Asignado' AND
            os_rx_llamada.triage_id=os_triage.triage_id AND os_rx_llamada.llamada_id=".$max)[0];
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
                    <td class="back-imss" style="width: 60%;margin-left:-10px!important">
                        <h3 style="font-weight: bold;font-size: 40px">'.$sql['triage_nombre'].'</h3>

                    </td>
                    <td class="">
                        <h3 style="font-weight: bold;font-size: 40px">Rayos X</h3>

                    </td>';
        }else{
            $result='';
        }
        $sql_ce=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx, os_rx_llamada
            WHERE os_rx.triage_id=os_triage.triage_id AND os_rx.rs_status='Asignado' AND
            
            os_rx_llamada.triage_id=os_triage.triage_id ORDER BY os_rx_llamada.llamada_id DESC");
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
                        <td class="back-imss" style="width: 70%">
                            <h3 style="font-weight: bold;font-size: 25px">'.$value['triage_nombre'].'</h3>
                        </td>
                        <td style="font-weight: bold;font-size: 15px;">
                            <h3 style="font-weight: bold;font-size: 25px">Rayos X</h3>
                        </td>

                    </tr>';
        }
        $this->setOutput(array('last_lista_paciente'=>$result,'result_listas_ce'=>$result_ce));
        
    }
    public function actualizar_listas() {
        $sql=  $this->config_mdl->_get_data('os_consultorios');
        $this->setOutput(array('sql'=>$sql));
    }
    public function actualizar_listas_rx() {
        $sql_ce= $this->config_mdl->_query("SELECT * FROM os_rx WHERE os_rx.rs_status='Asignado'"); 
        $this->setOutput(array('sql'=>$sql_ce));
    }
    public function actualizar_listas_rx_salida() {
        $sql_ce= count($this->config_mdl->_query("SELECT * FROM os_rx WHERE os_rx.rs_status='Salida al Consultorio de Especialidad'"));  
        $this->setOutput(array('total'=>$sql_ce));
    }  
    public function actualizar_lista_via_ce() {
        $sql_ce= $this->config_mdl->_query("SELECT * FROM os_rx WHERE os_rx.rs_status='Asignado'"); 
        $this->setOutput(array('total'=>  count($sql_ce))); 
    }
}
