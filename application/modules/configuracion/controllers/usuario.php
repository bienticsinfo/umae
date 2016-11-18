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
        if($_GET['search_by']){
            $data['usuarios']=  $this->Usuario_m->filtrar_usuarios($_GET['search_by'],$_GET['like']);
        }else{
            $data['usuarios'] = $this->config_mdl->_query('SELECT * FROM os_empleados LIMIT 100');
        }
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
       foreach ($this->input->post('rol_id') as $rol_select) {
           $roles.=$rol_select.',';
        }
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
           //'rol_id'=>                   $this->input->post('rol_id'),
           'empleado_roles'=>  trim($roles, ',')
           
       );
       if($this->input->post('jtf_accion')=='add'){
            $this->config_mdl->_insert('os_empleados',$data);
            $sql_max=  $this->config_mdl->_get_last_id('os_empleados','empleado_id');
            foreach ($this->input->post('rol_id') as $rol_select) {
                $this->config_mdl->_insert('os_empleados_roles',array(
                    'empleado_id'=>$sql_max,
                    'rol_id'=>$rol_select
                ));
            }
            $this->setOutput(array('accion'=>'1'));
       }else{
           unset($data['empleado_matricula']);unset($data['empleado_fecha_registro']);unset($data['empleado_perfil']);
           $this->config_mdl->_update_data('os_empleados',$data,array(
               'empleado_id'=>$this->input->post('empleado_id')
           ));
           $this->config_mdl->_delete_data('os_empleados_roles',array(
               'empleado_id'=>$this->input->post('empleado_id')
           ));
           foreach ($this->input->post('rol_id') as $rol_select) {
                $this->config_mdl->_insert('os_empleados_roles',array(
                    'empleado_id'=>$this->input->post('empleado_id'),
                    'rol_id'=>$rol_select
                ));
            }
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
                    'empleado_roles'=>$rol
                ));
                if($rol!=''){
                    $sql_max=  $this->config_mdl->_get_last_id('os_empleados','empleado_id');
                    $this->config_mdl->_insert('os_empleados_roles',array(
                        'empleado_id'=>$sql_max,
                        'rol_id'=>$rol
                    ));
                }
            }
            
        }
    }
}