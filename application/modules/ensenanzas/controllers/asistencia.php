<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asistencia
 *
 * @author felipe de jesus
 */
class Asistencia extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("asistencia_model");
        $this->load->model('configuracion/Usuario_m');
        $this->load->model('user_model');
    }
    public function index() {
        $this->load->view('asistencia/index');
    }
    public function gestion() {
        $this->load->view('asistencia/gestion');
    }
    public function getUsersAll() {
        $sql = $this->user_model->_getUsers();
        $tr='';
        if (!empty($sql)) {
            
            foreach ($sql as $value) {               
                $tr .= 
                    '<tr id="'.$value['idUsuario'].'" data-matricula="'.$value['matriculaUsuario'].'" data-e="'.$value['entradaAsistencia'].'" data-s="'.$value['salidaAsistencia'].'">
                        <td>&nbsp;&nbsp;&nbsp;'.$value['matriculaUsuario'].'</td>
                        <td>'.$value['nombreUsuario'].' '.$value['apatUsuario'].' '.$value['amatUsuario'].'</td>
                        <td>'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'</td>
                        <td>'.$value['fechaAsistencia'].'</td>
                        <td>'.$value['entradaAsistencia'].' - '.$value['salidaAsistencia'].'</td>
                    </tr>';
            }
           $json = (array(
              'action' => '1',
              'tr'     => $tr
           )); // Error validación 
        }else{
           $json = (array(
              'action' => '2',
               'msj'=>'No hay registros existentes'
           )); // Error validación 
        }
       $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    public function updateAistencia() {	
        $sql_f=  $this->asistencia_model->_buscarUserAsis($this->input->post('id'),  $this->input->post('fecha'));
        if($this->input->post('tipo')=='Entrada'){
            $data=array(
                'entradaAsistencia'=>  $this->input->post("hora"),
                'fechaAsistencia'=>$this->input->post("fecha")
            ); 
            $info=array(
                'idUser'=>$this->input->post('id'),
                'fecha'=>  $this->input->post("fecha"),
                'ae'=>  $this->input->post('hora')
            );
        }else{
            $sql_verfica=  $this->asistencia_model->_getFechaAistencia($this->input->post('id'),  $this->input->post('fecha'));
            if(empty($sql_verfica)){
                $status='No registrado';
            }else{
                $status=$sql_verfica[0]['entradaAsistencia'];
            }
            
            $data=array(
                'entradaAsistencia'=>  $status,
                'salidaAsistencia'=>  $this->input->post("hora"),
                'fechaAsistencia'=>$this->input->post("fecha")
            );  
            $info=array(
                'idUser'=>$this->input->post('id'),
                'fecha'=>  $this->input->post("fecha"),
                'as'=>  $this->input->post('hora')
            );
        }
        if(empty($sql_f)){
            $this->asistencia_model->insertAsistencia($info);
        }else{
            $this->asistencia_model->_updateUserAsis($info,$this->input->post('id'));
        }
        $sql=  $this->asistencia_model->_updateAsistencia($data, $this->input->post('id'));
        if($sql){
            $json=array('accion'=>'1','msj'=>'');
        }else{
            $json=array('accion'=>'2','msj'=>'');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    public function getUsersCalendar() {
        $sf=  explode('-', $this->input->post("date"));
        $sql = $this->user_model->_getUsersCalendar($sf[1].'/'.$sf[2].'/'.$sf[0]);
        $tr='';
        if (!empty($sql)) {
            foreach ($sql as $value) {               
                $tr .= 
                    '<tr id="'.$value['idUsuario'].'" data-matricula="'.$value['matriculaUsuario'].'" data-e="'.$value['entradaAsistencia'].'" data-s="'.$value['salidaAsistencia'].'">
                        <td>&nbsp;&nbsp;&nbsp;'.$value['matriculaUsuario'].'</td>
                        <td>'.$value['nombreUsuario'].' '.$value['apatUsuario'].' '.$value['amatUsuario'].'</td>
                        <td>'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'</td>
                        <td>'.$value['fechaAsistencia'].'</td>
                        <td>'.$value['entradaAsistencia'].' - '.$value['salidaAsistencia'].'</td>
                    </tr>';
            }
           $json = (array(
              'action' => '1',
              'tr'     => $tr
           )); // Error validación 
        }else{
           $json = (array(
              'action' => '2',
               'msj'=>'No hay registros existentes'
           )); // Error validación 
        }
       $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    
}
