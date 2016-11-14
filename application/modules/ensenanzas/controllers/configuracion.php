<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configuracion
 *
 * @author felipe de jesus
 */
class Configuracion extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("horarios_model");
        $this->load->model('responsables_model');
        $this->load->model('user_model');
    }
    public function horarios() {
        $this->load->view('configuracion/horarios');
    }
    public function responsables() {
        $this->load->view('configuracion/responsables');
    }
    public function getHorarios() {
        $sql=  $this->horarios_model->_getHorarios();
        $tr='';
        if(!empty($sql)){
            foreach ($sql as $value) {
                $tr.='  <tr>
                            <td class="text-center">'.$value['horario'].'</td>
                            <td>
                                <div class="text-center">
                                    <div class="row">
                                        <i data-id-accion="'.$value['horario'].'" data-infoM='.$value['idHorario'].' class="accionesM fa fa-edit pointer fa-2x"></i>   
                                        <i data-id-accion="eliminar"  data-infoE='.$value['idHorario'].' class="accionesE fa fa-trash pointer fa-2x"></i>   
                                    </div>
                                </div>   
                            </td>
                        </tr>';
            }
            $json=array('accion'=>'1','tr'=>$tr);
        }else{
            $json=array('accion'=>'2','msj'=>'No hay registros disponibles');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function insertHorarios() {
        $data=array('horario'=>  $this->input->post("jtfHorarios"));
        $sql=  $this->horarios_model->_insertConfig($data,'en_horarios');
        if($sql){
            $json=array('accion'=>'1','msj'=>'Registro realizado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Error al realizar el registro');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function updateHorario() {
        $data=array("horario"  =>  $this->input->post("jtfHorarios"));
        $sql=  $this->horarios_model->_updateConfig($data,'en_horarios',  $this->input->post("jftEditHorarId"));
        if($sql){
            $json=array('accion'=>'1','msj'=>'Completado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Error al realizar el registro');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function deleteConfig() {
        $data=array("idHorario"=>  $this->input->post("id"));
        $sql=  $this->horarios_model->_deleteConfig('en_horarios',$data);
        if($sql){
            $json=array('accion'=>'1','msj'=>'Completado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Error al realizar el registro');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function deleteResponsable() {
        $data=array("idResponsable"=>  $this->input->post("id"));
        $sql=  $this->horarios_model->_deleteConfig('en_responsables',$data);
        if($sql){
            $json=array('accion'=>'1','msj'=>'Completado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Error al realizar el registro');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function getResponsables() {
        $sql = $this->responsables_model->_getResponsables($this->input->post('busqueda'));
        $tr='';
        if (!empty($sql)) {
            foreach ($sql as $value) {
                $tr .= 
                    '<tr data-id="'.$value['idResponsable'].'" data-nombre="'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'">
                        <td>'.$value['idResponsable'].'</td>
                        <td>'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'</td>
                        <td>'.$value['insOrigenRes'].'</td>
                        <td>
                            <div class="text-center">
                                <div class="row">
                                    <i data-infoM="'.$value['idResponsable'].'" data-toggle="tooltip" title="Modificar"  class="tip accionesM fa fa-edit pointer fa-2x"></i>   
                                    <i data-infoE="'.$value['idResponsable'].'" data-toggle="tooltip" title="Eliminar" class="tip accionesE fa fa-trash pointer fa-2x"></i>   
                                </div>
                            </div>   
                        </td>
                    </tr>';
            }
           $json = (array(
              'action' => '1',
              'tr'     => $tr
           )); // Error validación 
        }else{
           $json = (array(
              'action' => '1'
           )); // Error validación 
        }
       $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }    
    public function getResById() {
        $sql=  $this->responsables_model->_getResById($this->input->post('id'));
        $json=array(
            "nombreUsuario"=>$sql[0]['nombreRes'],
            "apatUsuario"=>$sql[0]['apatRes'],
            "amatUsuario"=>$sql[0]['amatRes'],
            "insOrigenRes"=>$sql[0]['insOrigenRes']
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function insertRespo() {
        $datos=array(
            "nombreRes"=>$this->input->post("jtfNombre"),
            "apatRes"=>$this->input->post("jtfApat"),
            "amatRes"=>$this->input->post("jtfAmat"),
            "insOrigenRes"=>  $this->input->post('jtfInstitucion')
        );
        if($this->input->post("jtfAccion")=='Agregar'){
            $sql=  $this->responsables_model->_insertRes($datos);
        }else{
            $sql=  $this->responsables_model->_updateRespondable($datos, $this->input->post("idResponsable"));
        }
        if($sql){
            $json = (array( 'action' => '1')); // OK
        }else{
            $json = (array( 'action' => '2','msj'=>'Erro el realizar la acción')); // ('_' )
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
