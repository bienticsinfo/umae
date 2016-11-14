<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Listas
 *
 * @author felipe de jesus
 */
class Listas extends MX_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->load->model(array(
            'login/login_mdl','conservacion/usuario_mdl','conservacion/contratos_mdl',
            'conservacion/proveedores_mdl','config/config_mdl'
        ));
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }  
    public function rx() {
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_rx
                                                    WHERE  os_triage.triage_id=os_rx.triage_id AND
                                                    os_triage.triage_asistentesmedicas='Datos Capturados' GROUP BY os_triage.triage_id ORDER BY 
                                                    os_triage.triage_color='Amarillo' DESC, 
                                                    os_triage.triage_color='Verde' DESC,
                                                    os_triage.triage_color='Azul' DESC LIMIT 10");
        $this->load->view('listas/listas_rx',$sql);
    }
    public function consultorios_especialidad() {
//        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad
//                                                    WHERE  
//                                                    os_triage.triage_id=os_consultorios_especialidad.triage_id
//                                                    GROUP BY os_triage.triage_id ORDER BY 
//                                                    os_triage.triage_color='Amarillo' DESC, 
//                                                    os_triage.triage_color='Verde' DESC,
//                                                    os_triage.triage_color='Azul' DESC LIMIT 10");
        $this->load->view('listas/listas_consultorios_especialidad');
    }
    public function last_lista_paciente() {
        $sql_check=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_consultorios
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' AND
            os_consultorios_especialidad.ce_asignado=os_consultorios.consultorio_id");
        
        if(!empty($sql_check)){
            
        $max=  $this->config_mdl->_get_last_id('os_consultorios_especialidad_llamada','ce_id');
        $sql=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' AND
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
                        <h3 style="font-weight: bold;font-size: 40px">'.$sql['triage_consultorio_nombre'].'</h3>

                    </td>';
        }else{
            $result='';
        }
        $sql_ce=  $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada
            WHERE os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_triage.triage_id=os_consultorios_especialidad_llamada.triage_id AND 
            os_consultorios_especialidad.ce_status='Asignado' ORDER BY os_consultorios_especialidad_llamada.ce_id DESC");
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
                            <h3 style="font-weight: bold;font-size: 25px">'.$value['triage_consultorio_nombre'].'</h3>
                        </td>

                    </tr>';
        }
        $this->setOutput(array('last_lista_paciente'=>$result,'result_listas_ce'=>$result_ce));
        
    }
    public function last_lista_paciente_rx() {
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
    
}
