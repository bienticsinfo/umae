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
        $data['usuarios'] = $this->Usuario_m->_get_usuarios();
        $this->load->view('usuario/index',$data);
    }
    public function agregar() {
        $sql['info']=   $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>$this->input->get_post('u')));
        $sql['roles']=  $this->config_mdl->_get_data_condition('os_empleados_roles',array(
            'empleado_id'=>  $this->input->get_post('u')
        ));        
        foreach ($sql['roles'] as $value) {
            $roles.=$value['rol_id'].',';
        }
        $sql['roles_asignados']=  trim($roles, ',');
        $this->load->view('usuario/agregar',$sql);
    }
    public function get_select() {
        $option_ro='';
        $option_em='';
        $option_eq='';
        foreach ($this->Usuario_m->_get_roles() as $value) { 
            $option_ro.='<option value="'.$value['idTipo_Usuario'].'">'.$value['tipo'].'</option>';
        }
        foreach ($this->Usuario_m->_get_empleados() as $value) { 
            $option_em.='<option value="'.$value['idEmpleado'].'">'.$value['nombre'].' '.$value['apellido_paterno'].' '.$value['apellido_materno'].' ('.$value['matricula'].')</option>';
        }
        foreach ($this->Usuario_m->_get_equipos() as $value) { 
            $option_eq.='<option value="'.$value['equipo_id'].'">'.$value['equipo_ip'].'</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(
                array('option_ro'=>$option_ro,'option_em'=>$option_em, 'option_eq'=>$option_eq)
        ));
    }
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
       foreach ($this->input->post('empleado_subrol') as $value) {
           $empleado_subrol.=$value.',';
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
           'empleado_usuario'=>         $this->input->post('empleado_usuario'),
           'empleado_contrasena'=>      md5($this->input->post('empleado_contrasena')),
           'empleado_perfil'=>          'default.png',
           'empleado_fecha_registro'=>  $this->input->post('empleado_fecha_registro'),
           'empleado_subrol'=>          trim($empleado_subrol, ','), 
           'empleado_turno'=>           $this->input->post('empleado_turno'),
           'equipo_id'=>                $this->input->post('idEquipo')
           
       );
       if($this->input->post('jtf_accion')=='add'){
            $sql=$this->Usuario_m->_insert('os_empleados',$data);
            if($sql){
                $last_id=  $this->config_mdl->_get_last_id('os_empleados','empleado_id');
                foreach ($this->input->post('idTipo_Usuario') as $value) {
                    $this->config_mdl->_insert('os_empleados_roles',array(
                        'empleado_id'=>$last_id,
                        'rol_id'=>$value
                    ));
                }
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
       }else{
           if($this->input->post('empleado_contrasena')==''){
               unset($data['empleado_contrasena']);
           }
           
           unset($data['empleado_fecha_registro']);
           unset($data['empleado_perfil']);
           $sql=$this->Usuario_m->_update_usuario($this->input->post('jtf_empleado_id'),$data);
           $this->config_mdl->_delete_data('os_empleados_roles',array('empleado_id'=>$this->input->post('jtf_empleado_id')));
            if($sql){
                foreach ($this->input->post('idTipo_Usuario') as $value) {
                    $this->config_mdl->_insert('os_empleados_roles',array(
                        'empleado_id'=>  $this->input->post('jtf_empleado_id'),
                        'rol_id'=>$value
                    ));
                }             
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
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
           'equipo_id'=>                $this->input->post('equipo_id')
           
       );
       $sql=$this->Usuario_m->_update_usuario($_SESSION['sess']['idUsuario'],$data);
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
       $sql=$this->Usuario_m->_update_usuario($_SESSION['sess']['idUsuario'],$data);
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
       $sql=$this->Usuario_m->_update_usuario($_SESSION['sess']['idUsuario'],$data);
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }  
    }
}