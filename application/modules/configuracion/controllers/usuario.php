<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'modules/config/controllers/Config.php';
Class Usuario extends Config {
    private static $msj = ''; 
    function __construct() {
	parent::__construct();
        self::$msj = json_decode(MSJ,TRUE);
        $this->load->model('Usuario_m');
    }
    public function index() {
        $data['usuarios'] = $this->config_mdl->_query('SELECT * FROM os_empleados, os_roles WHERE os_empleados.rol_id=os_roles.rol_id LIMIT 100');
        $this->load->view('usuario/index',$data); 
    }
    public function agregar() {
        $sql['info']=   $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>$this->input->get_post('u')));
        $sql['roles']=  $this->config_mdl->_get_data('os_roles');
        $this->load->view('usuario/agregar',$sql);
    }
    public function check_matricula() {
        $sql=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula')
        ));
        if(empty($sql)){
            $this->setOutput(array('ACCION'=>'NO_EXISTE'));
        }else{
            $this->setOutput(array('ACCION'=>'EXISTE'));
        }
    }
//    public function get_select() {
//        $option_ro='';
//        $option_em='';
//        $option_eq='';
//        foreach ($this->Usuario_m->_get_roles() as $value) { 
//            $option_ro.='<option value="'.$value['idTipo_Usuario'].'">'.$value['tipo'].'</option>';
//        }
//        foreach ($this->Usuario_m->_get_empleados() as $value) { 
//            $option_em.='<option value="'.$value['idEmpleado'].'">'.$value['nombre'].' '.$value['apellido_paterno'].' '.$value['apellido_materno'].' ('.$value['matricula'].')</option>';
//        }
//        foreach ($this->Usuario_m->_get_equipos() as $value) { 
//            $option_eq.='<option value="'.$value['equipo_id'].'">'.$value['equipo_ip'].'</option>';
//        }
//        $this->output->set_content_type('application/json')->set_output(json_encode(
//                array('option_ro'=>$option_ro,'option_em'=>$option_em, 'option_eq'=>$option_eq)
//        ));
//    }
    public function alta() {
        $this->load->view('usuarios/alta');
    }

    public function gestion() {
        $this->load->view('usuarios/gestion');
    }
    public function eliminar() {
        $sql=  $this->Usuario_m->_update_usuario($this->input->post('id_usuario'));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
   }
   public function insert() {
       $data=array(
           'empleado_matricula'=>       $this->input->post('empleado_matricula'),
           'empleado_nombre'=>          $this->input->post('empleado_nombre'),
           'empleado_apellidos'=>       $this->input->post('empleado_apellidos'),
           'empleado_fecha_nac'=>       $this->input->post('empleado_fecha_nac'),
           'empleado_estado'=>          $this->input->post('empleado_estado'),
           'empleado_sexo'=>            $this->input->post('empleado_sexo'),
           'empleado_direccion'=>       $this->input->post('empleado_direccion'),
           'empleado_tel'=>             $this->input->post('empleado_tel'),
           'empleado_telcel'=>          $this->input->post('empleado_telcel'),
           'empleado_email'=>           $this->input->post('empleado_email'),
           'empleado_perfil'=>          'default.png',
           'empleado_fecha_registro'=>  date('d/m/Y'), 
           'empleado_turno'=>           $this->input->post('empleado_turno'),
           'rol_id'=>                   $this->input->post('rol_id')
           
       );
       if($this->input->post('jtf_accion')=='add'){
            $this->config_mdl->_insert('os_empleados',$data);
            $this->setOutput(array('accion'=>'1'));
       }else{
           unset($data['empleado_matricula']);
           unset($data['empleado_fecha_registro']);
           unset($data['empleado_perfil']);
           $this->config_mdl->_update_data('os_empleados',$data,array(
               'empleado_id'=>$this->input->post('empleado_id')
           ));
           $this->setOutput(array('accion'=>'1'));
       }
   }
   public function check_user() {
       $sql=  $this->Usuario_m->_check_user($this->input->post('user'));
       if(empty($sql)){
           $this->setOutput(array('accion'=>'1'));
       }else{
           $this->setOutput(array('accion'=>'2'));
       }
   }
   public function miperfil() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ));
        $this->load->view('usuario/miperfil',$sql);
   }
   public function miperfil_cambiar_image() {
       $this->load->view('usuario/mi_perfil');
   }
   public function cambiar_img_perfil() {
       $this->config_mdl->_update_data('os_empleados',array(
           'empleado_perfil'=>  $this->input->post('empleado_perfil')
       ),array(
           'empleado_id'=>  $this->input->post('empleado_id')
       ));
       $this->setOutput(array('accion'=>'1'));
   }
   public function update_data_profile() {
       $data=array(
           'empleado_matricula'=>       $this->input->post('empleado_matricula'),
           'empleado_nombre'=>          $this->input->post('empleado_nombre'),
           'empleado_apellidos'=>       $this->input->post('empleado_apellidos'),
           'empleado_fecha_nac'=>       $this->input->post('empleado_fecha_nac'),
           'empleado_estado'=>          $this->input->post('empleado_estado'),
           'empleado_sexo'=>            $this->input->post('empleado_sexo'),
           'empleado_direccion'=>       $this->input->post('empleado_direccion'),
           'empleado_tel'=>             $this->input->post('empleado_tel'),
           'empleado_telcel'=>          $this->input->post('empleado_telcel'),
           'empleado_email'=>           $this->input->post('empleado_email'),
           
       );
       $sql=$this->config_mdl->_update_data('os_empleados',$data,array(
           'empleado_id'=>$_SESSION['UMAE_USER']
       ));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    } 
    public function update_user() {
       $data=array(
           'empleado_usuario'=>       $this->input->post('new_user'),
       );
       $sql=$this->Usuario_m->_update_usuario($_SESSION['sess']['idUsuario'],$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function update_pass() {
       $data=array(
           'empleado_contrasena'=>  md5($this->input->post('empleado_contrasena_u_c'))
       );
       $sql=$this->Usuario_m->_update_usuario($_SESSION['UMAE_USER'],$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function update_perfil() {
       $data=array(
           'empleado_perfil'=>  $this->input->post('filename')
       );
       $sql=$this->Usuario_m->_update_usuario($_SESSION['UMAE_USER'],$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }  
    }
    public function importar() {
        $objPHPExcel= PHPExcel_IOFactory::load('assets/doc/PLANTILLA.xlsx');
        $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true);
        foreach ($objHoja as $iIndice=>$objCelda) {
            if($objCelda['A']!='Matricula' || $objCelda['A']!='' || $objCelda['B']!='Nombre'){
                if($objCelda['C']=='MEDICO NO FAMILIAR 80'){
                    $rol='2';
                }else if($objCelda['C']=='ASISTENTE MEDICA 80'){
                    $rol='5';
                }else if($objCelda['C']=='AUX DE ENFERMERIA GRAL 80' || $objCelda['C']=='ENFERMERA GENERAL 80' || $objCelda['C']=='ENFERMERA ESPECIALISTA 80'){
                    $rol='3';
                }else if($objCelda['C']=='AUX UNIV DE OFICINAS 80'){
                    $rol='4';
                }else{
                    $rol='';
                }
                $nombre=  explode('/', $objCelda['B']);
                $this->config_mdl->_insert('os_empleados',array(
                    'empleado_matricula'=>$objCelda['A'],
                    'empleado_nombre'=>$nombre[2],
                    'empleado_apellidos'=>$nombre[0].' '.$nombre[1],
                    'empleado_categoria'=>$objCelda['C'],
                    'empleado_departamento'=>$objCelda['D'],
                    'empleado_horario'=>$objCelda['E'],
                    'rol_id'=>$rol
                ));
            }
            
        }
    }
}