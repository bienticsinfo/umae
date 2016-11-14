<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'third_party/pdf/html2pdf.class.php';
class Usuario extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("horarios_model");
        $this->load->model('configuracion/Usuario_m');
        $this->load->model('user_model');
        $this->load->model('responsables_model');
    }
    public function index() {
        $this->load->view("usuario/index");
    }
    public function getUsers() {
        $sql = $this->responsables_model->_getResponsables($this->input->post('busqueda'));
        $tr='';
        if (!empty($sql)) {
            foreach ($sql as $value) {
                $tr .= 
                    '<tr data-id="'.$value['idResponsable'].'" data-nombre="'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'">
                        <td>'.$value['idResponsable'].'</td>
                        <td>'.$value['nombreRes'].$value['apatRes'].$value['amatRes'].'</td>
                        <td>'.$value['apatRes'].'</td>
                        <td>'.$value['amatRes'].'</td>
                    </tr>';
            }
           $json = (array(
              'action' => '1',
              'tr'     => $tr
           )); // Error validación 
        }else{
           $json = (array(
              'action' => '2'
           )); // Error validación 
        }
       $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    public function getUsersAll() {
        $sql = $this->user_model->_getUsers();
        $tr='';
        if (!empty($sql)) {
            foreach ($sql as $value) {
                $cre='';
                if($value['credencial']==''){
                    $cre='No Asignado';
                    $pdf='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }else{
                    $pdf='
                        <a href="'.  base_url().'ensenanzas/usuario/reporteRegistro?u='.$value['idUsuario'].'" target="_blank">
                            <i class="tip fa fa-cloud-download fa-2x downloadPdf" data-info="'.$value['idUsuario'].'" data-toggle="tooltip" title="Generar reporte"></i>
                        </a>';
                    $cre=$value['credencial'];
                }
                $tr .= 
                    '<tr>
                        <td class="text-center">&nbsp;&nbsp;&nbsp;'.$value['matriculaUsuario'].'</td>
                        <td>'.$value['nombreUsuario'].' '.$value['apatUsuario'].' '.$value['amatUsuario'].'</td>
                        <td>'.$value['nombreRes'].' '.$value['apatRes'].' '.$value['amatRes'].'</td>
                        <td>'.$cre.'</td>
                        <td>
                             <div class="text-center">
                                <div class="row">
                                '.$pdf.'
                                <i class="tip fa fa-clock-o infoMas fa-2x" data-info='.$value['idUsuario'].' data-toggle="tooltip" title="Ver horarios"></i>
                                <i data-id-accion="asignar" data-creadencial="'.$cre.'" data-infoA="'.$value['idUsuario'].'" data-toggle="tooltip" title="Asignar Creadencial" class="tip accionesA fa fa-credit-card pointer fa-2x"></i> 
                                <i data-id-accion="modificar" data-infoM='.$value['idUsuario'].' data-toggle="tooltip" title="Modificar" class="tip accionesM fa fa-edit pointer fa-2x"></i>   
                                <i data-id-accion="eliminar"  data-infoE='.$value['idUsuario'].' data-toggle="tooltip" title="Eliminar" class="tip accionesE fa fa-trash pointer fa-2x"></i>   
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
              'action' => '2',
               'msj'=>'No hay registros existentes'
           )); // Error validación 
        }
       $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    public function insertUsuario() {
        if($this->input->post("tipoResidente")=='Sede'){
            $datos=array(
                "nombreUsuario"=>$this->input->post("jtfNombre"),
                "apatUsuario"=>$this->input->post("jtfApat"),
                "amatUsuario"=>$this->input->post("jtfAmat"),
                "matriculaUsuario"=>$this->input->post("jtfMatricula"),
                "email"=>$this->input->post("jtfEmail"),
                "horaEntrada"=>$this->input->post("jtfHoraE"),
                "horaSalida"=>  $this->input->post("jtfHoraS"),
                "dias"=>  $this->input->post("jtfDias"),
                "tipoResidente"=>  $this->input->post("tipoResidente"),
                "especialidad"=>  $this->input->post("jtfEspecialidad"),
                "anio"=>  $this->input->post("jtfAnio"),
                "grado"=>  '',
                "lugarSede"=> $this->input->post("jtfLugarSede"),
                "servicioRotacion"=>  '',
                "frInicio"=>  $this->input->post("jtfFechaInicio"),
                "frFin"=>  $this->input->post("jtfFechaFin"),
                "hospital"=>  '',
                "frFin"=>  $this->input->post("jtfFechaFin"),
                "fechaRegistro"=>  $this->input->post('jtfFechaRegistro'),
                "idResponsable"=>$this->input->post("jtfIdResponsable")
            );
        }else{
            $datos=array(
                "nombreUsuario"=>$this->input->post("jtfNombre"),
                "apatUsuario"=>$this->input->post("jtfApat"),
                "amatUsuario"=>$this->input->post("jtfAmat"),
                "matriculaUsuario"=>$this->input->post("jtfMatricula"),
                "email"=>$this->input->post("jtfEmail"),
                "horaEntrada"=>$this->input->post("jtfHoraE"),
                "horaSalida"=>  $this->input->post("jtfHoraS"),
                "dias"=>  $this->input->post("jtfDias"),
                "tipoResidente"=>  $this->input->post("tipoResidente"),
                "especialidad"=>  $this->input->post("jtfEspecialidad"),
                "anio"=>  $this->input->post("jtfAnio"),
                "grado"=>  $this->input->post("jtfGrado"),
                "lugarSede"=>  $this->input->post("jtfLugarSede"),
                "servicioRotacion"=>  $this->input->post("jtfServicioR"),
                "frInicio"=>  $this->input->post("jtfFechaInicio"),
                "frFin"=>  $this->input->post("jtfFechaFin"),
                "hospital"=>  $this->input->post("jtfHospital"),
                "fechaRegistro"=>  $this->input->post('jtfFechaRegistro'),
                "idResponsable"=>$this->input->post("jtfIdResponsable")
            );
        }
        
        if($this->input->post("jtfAccion")=='Agregar'){
            $sql=  $this->user_model->_insertUser($datos);
        }else{
            $sql=  $this->user_model->_updateUserOk($datos, $this->input->post("idUsuario"));
        }
        if($sql){
            $json = (array( 'action' => '1','tipo'=>$this->input->post("tipoResidente"))); // OK
        }else{
            $json = (array( 'action' => '2','msj'=>'Erro el realizar la acción','tipo'=>$this->input->post("tipoResidente"))); // ('_' )
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function prueba() {
        $this->load->view("usuario/pruebas");
    }
    public function eliminarUser() {
        $sql=  $this->user_model->_eliminarUsuarioV2($this->input->post("id"),array('status'=>'hidden'));
        if($sql){
            $json = (array( 'accion' => '1')); // OK
        }else{
            $json = (array( 'accion' => '2','msj'=>'Erro el realizar el registro')); // ('_' )
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function getHorarios() {
        $option='';
        $option.='<option value="1:00 am">1:00 am</option>';
        $option.='<option value="2:00 am">2:00 am</option>';
        $option.='<option value="3:00 am">3:00 am</option>';
        $option.='<option value="4:00 am">4:00 am</option>';
        $option.='<option value="5:00 am">5:00 am</option>';
        $option.='<option value="6:00 am">6:00 am</option>';
        $option.='<option value="7:00 am">7:00 am</option>';
        $option.='<option value="8:00 am">8:00 am</option>';
        $option.='<option value="8:00 am">9:00 am</option>';
        $option.='<option value="10:00 am">10:00 am</option>';
        $option.='<option value="11:00 am">11:00 am</option>';
        $option.='<option value="12:00 pm">12:00 pm</option>';
        $option.='<option value="1:00 pm">1:00 pm</option>';
        $option.='<option value="2:00 pm">2:00 pm</option>';
        $option.='<option value="4:00 pm">3:00 pm</option>';
        $option.='<option value="">4:00 pm</option>';
        $option.='<option value="7:00 pm">5:00 pm</option>';
        $option.='<option value="">7:00 pm</option>';
        $option.='<option value="9:00 pm">8:00 pm</option>';
        $option.='<option value="">9:00 pm</option>';
        $option.='<option value="10:00 pm">10:00 pm</option>';
        $option.='<option value="11:00 pm">11:00 pm</option>';
        $option.='<option value="12:00 am">12:00 am</option>';
        $json=array('option'=>$option);
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function getUserById() {
        $sql=  $this->user_model->_getUsersById($this->input->post('id'));
        $json=array(
            "nombreUsuario"=>$sql[0]['nombreUsuario'],
            "apatUsuario"=>$sql[0]['apatUsuario'],
            "amatUsuario"=>$sql[0]['amatUsuario'],
            'matriculaUsuario'=>$sql[0]['matriculaUsuario'],
            "email"=>$sql[0]['email'],
            "horaEntrada"=>$sql[0]['horaEntrada'],
            "horaSalida"=>$sql[0]['horaSalida'],
            "entradaAsistencia"=>$sql[0]['entradaAsistencia'],
            "salidaAsistencia"=>$sql[0]['salidaAsistencia'],
            "dias"=>$sql[0]['dias'],
            "tipoResidente"=>$sql[0]['tipoResidente'],
            "especialidad"=>$sql[0]['especialidad'],
            "anio"=>$sql[0]['anio'],
            "grado"=>$sql[0]['grado'],
            "lugarSede"=>$sql[0]['lugarSede'],
            "servicioRotacion"=>$sql[0]['servicioRotacion'],
            "frInicio"=>$sql[0]['frInicio'],
            "frFin"=>$sql[0]['frFin'],
            "hospital"=>$sql[0]['hospital'],
            "fechaRegistro"=>$sql[0]['fechaRegistro'],
            "idResponsable"=>$sql[0]['idResponsable'],
            "jtfResponsable"=>$sql[0]['nombreRes']." ".$sql[0]['apatRes'].' '.$sql[0]['amatRes']
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function editCreadencial() {
        $CredencialAdd=  $this->input->post("CredencialAdd");
        $CredencialReponer=  $this->input->post("CredencialReponer");
        if($CredencialReponer==''){
            $datos=array('credencial'=>$CredencialAdd);
        }else{
            $datos=array('credencial'=>$CredencialReponer);
        }
        $sql=  $this->user_model->_updateCredencial($datos,  $this->input->post("idUsuario"));
        if($sql){
            $json=array('accion'=>'1','msj'=>'Creadencial Asignado','id'=>$this->input->post("idUsuario"));
        }else{
            $json=array('accion'=>'2','msj'=>'Error al realizar la acción','id'=>$this->input->post("idUsuario"));
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function reporteRegistro() {
        $Datos['Info']=$sql=  $this->user_model->_getUsersById($_REQUEST['u']);
        $this->load->view('usuario/registro',$Datos);
    }
}
