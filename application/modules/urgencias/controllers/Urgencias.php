<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Urgencias
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Urgencias extends Config{
    public function __construct() {
        parent::__construct();
        $this->load->model('urgencias_mdl');
    }

    //put your code here
    public function servicios() {
        $sql['Gestion']=  $this->config_mdl->_get_data('urg_servicios');
        $this->load->view('servicios/servicio_gestion',$sql);
    }
    public function add_servicio() {
        $sql['info']=  $this->config_mdl->_get_data_condition('urg_servicios',array('servicio_id'=>  $this->input->get('s')));
       $this->load->view('servicios/servicio_add',$sql); 
    }
    public function insert_servicios() {
        $data=array(
            'servicio_nombre'=>  $this->input->post('servicio_nombre'),
            'servicio_max_medicos'=>  $this->input->post('servicio_max_medicos'),
            'servicio_min_medicos'=>  $this->input->post('servicio_min_medicos')
        );
        if($this->input->post('jtf_accion')=='add'){
            if($this->config_mdl->_insert('urg_servicios',$data)){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            if($this->config_mdl->_update_data('urg_servicios',$data,array('servicio_id'=>  $this->input->post('servicio_id')))){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            } 
        }
    }
    public function camas() {
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
           'area_id'=>  $this->input->get('area') 
        ));
        if($this->input->get('area')){
            $sql['Gestion']=  $this->urgencias_mdl->_get_camas($this->input->get('area'));
            $this->load->view('camas/camas_gestion',$sql);
        }else{
            $sql['Gestion']=  $this->config_mdl->_get_data('os_areas');
       
            $this->load->view('camas/camas_areas',$sql);        
        }
  
    }
    public function camas_area() {
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
           'area_id'=>  $this->input->get('area') 
        ));
        $sql['Gestion']=  $this->urgencias_mdl->_get_camas($this->input->get('area'));
        $this->load->view('camas/camas_gestion',$sql);
    }
    public function camas_add() {
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
           'area_id'=>  $this->input->get('area') 
        ));
        $sql['info']=  $this->config_mdl->_get_data_condition('os_camas',array(
           'cama_id'=>  $this->input->get('c') 
        ));
        $this->load->view('camas/camas_add',$sql);
    }
    public function roles() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_areas');
        $this->load->view('roles/roles_areas',$sql);
    }
    public function roles_areas() {
        $sql['Gestion']=  $this->urgencias_mdl->_get_areas_medicos($this->input->get('area'));
        $this->load->view('roles/roles_gestion',$sql);
    }
    public function roles_add() {
        $sql['Usuario']=  $this->config_mdl->_get_data('os_empleados',array(
            'idTipo_Usuario'=>'25'
        ));
        $sql['Areas']=  $this->config_mdl->_get_data('os_areas');
        $this->load->view('roles/roles_add',$sql);
    }
    public function areas() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_areas');
        $this->load->view('areas/areas_gestion',$sql);
    }
    public function areas_add() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_id'=>  $this->input->get('ar')
        ));
        $this->load->view('areas/areas_add',$sql);
    }
    public function insert_area() {
        $data=array(
            'area_nombre'=>  $this->input->post('area_nombre'),
            'area_camas'=>  $this->input->post('area_camas'),
            'area_acceso'=>$this->cambiar_texto_area($this->input->post('area_nombre')),
            'area_registro'=>  $this->input->post('area_registro')
        );
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('os_areas',$data)){
                $sql_max=  $this->config_mdl->_get_last_id('os_areas','area_id');
                $this->config_mdl->_insert('os_empleados',array(
                    'empleado_matricula'=>'N/E',
                    'empleado_nombre'=>  $this->input->post('area_nombre'),
                    'empleado_usuario'=>  $this->cambiar_texto_area($this->input->post('area_nombre')),
                    'empleado_contrasena'=>  md5($this->cambiar_texto_area($this->input->post('area_nombre'))), 
                    'empleado_area'=>$sql_max
                ));
                $last_id=  $this->config_mdl->_get_last_id('os_empleados','empleado_id');
                $this->config_mdl->_insert('os_empleados_roles',array(
                    'empleado_id'=>$last_id,
                    'rol_id'=>'41'
                ));
                $this->setOutput(array('accion'=>'1'));
            }
        }else{
            if($this->config_mdl->_update_data('os_areas',$data,array('area_id'=>  $this->input->post('area_id')))){
                $this->config_mdl->_update_data('os_empleados',array(
                    'empleado_matricula'=>'N/E',
                    'empleado_nombre'=>  $this->input->post('area_nombre'),
                    'empleado_usuario'=>  $this->cambiar_texto_area($this->input->post('area_nombre')),
                    'empleado_contrasena'=>  md5($this->cambiar_texto_area($this->input->post('area_nombre'))), 
                    'empleado_area'=>$this->input->post('area_id')
                ),array(
                    'empleado_usuario'=>  $this->cambiar_texto_area($this->input->post('area_nombre'))
                ));
                $this->setOutput(array('accion'=>'1'));
            }
        }
    }
    public function insert_cama() {
        $data=array(
            'cama_nombre'=>  $this->input->post('cama_nombre'),
            'cama_status'=>'Disponible',
            'cama_dh'=>'0',
            'area_id'=>  $this->input->post('area_id')
        );
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('os_camas',$data)){
                $this->setOutput(array('accion'=>'1'));
            }
        }else{
            unset($data['cama_status']);
            unset($data['cama_dh']);
            if($this->config_mdl->_update_data('os_camas',$data,array('cama_id'=>  $this->input->post('cama_id')))){
                $this->setOutput(array('accion'=>'1'));
            }
        }
    }
    public function derechohabiente() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_camas',array(
           'cama_id'=>  $this->input->get('c') 
        ));
        $sql['asignacion']=  $this->config_mdl->_get_data_condition('os_camas_derechohabiente',array(
            'derechohabiente_id'=>$sql['info'][0]['cama_dh'],
            'cama_dh_status'=>'Activo'
        ));
        $this->load->view('derechohabiente/entrada',$sql);
    }
    public function eliminar() {
        $sql=  $this->config_mdl->_delete_data('urg_servicios',array(
            'servicio_id'=>  $this->input->post('value')
        ));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function get_derechohabiente() {
        foreach ($this->config_mdl->_get_data('os_derechohabiente') as $value) {
            $option.='<option value="'.$value['derechohabiente_id'].'">'.$value['derechohabiente_nombre'].' '.$value['derechohabiente_apat'].' '.$value['derechohabiente_amat'].' ('.$value['derechohabiente_nss'].')</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function asignar_cama() {
        if($this->input->post('cama_dh')=='0'){
            $accion='Activo';
        }else{
            $accion='No Activo';
        }
        $data=array(
            'cama_dh_hora_entrada'=>  $this->input->post('cama_dh_hora_entrada'),
            'cama_dh_hora_salida'=>  $this->input->post('cama_dh_hora_salida'),
            'cama_dh_fecha_entrada'=>  $this->input->post('cama_dh_fecha_entrada'),
            'cama_dh_fecha_salida'=>  $this->input->post('cama_dh_fecha_salida'),
            'cama_dh_status'=>$accion,
            'cama_id'=>  $this->input->post('cama_id'),
            'derechohabiente_id'=>  $this->input->post('derechohabiente_id')
        );
        if($this->input->post('cama_dh')=='0'){
            if($this->config_mdl->_insert('os_camas_derechohabiente',$data)){
                $this->config_mdl->_update_data('os_camas',array(
                    'cama_status'=>'Ocupado',
                    'cama_dh'=>$this->input->post('derechohabiente_id')
                ),array('cama_id'=>  $this->input->post('cama_id')));
                $this->setOutput(array('accion'=>'1'));
            }
        }else{
            unset($data['cama_dh_hora_entrada']);
            unset($data['cama_dh_fecha_entrada']);
            unset($data['derechohabiente_id']);
            if($this->config_mdl->_update_data('os_camas_derechohabiente',$data,array('cama_dh_id'=>  $this->input->post('cama_dh_id')))){
                $this->config_mdl->_update_data('os_camas',array(
                    'cama_status'=>'Disponible',
                    'cama_dh'=>'0'
                ),array('cama_id'=>  $this->input->post('cama_id')));
                $this->setOutput(array('accion'=>'2'));
            }
        }
    }
    public function dar_mantenimiento() {
        $sql=$this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>  $this->input->post('accion'),
        ),array('cama_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function asignar_empleado_area() {
        foreach ($this->input->post('empleado_id') as $value) {
            $data=array(
                'empleado_id'=>$value,
                'area_id'=>  $this->input->post('area_id')
            );
            $this->config_mdl->_insert('os_areas_medico',$data);
            
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function eliminar_cama() {
        $sql=  $this->config_mdl->_delete_data('os_camas',array('cama_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function eliminar_area() {
        $this->config_mdl->_delete_data('os_camas',array('area_id'=>  $this->input->post('id')));
        $sql=$this->config_mdl->_delete_data('os_areas',array('area_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function eliminar_area_rol() {
        $sql=  $this->config_mdl->_delete_data('os_areas_medico',array('area_medico_id'=>  $this->input->post('id')));
        if($sql){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function agregar_perfiles() {
        $sql['Gestion']=  $this->config_mdl->_get_data_condition('os_areas_roles',array(
            'area_id'=>  $this->input->get('area')
        ));
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_id'=>  $this->input->get('area')
        ));
        $this->load->view('areas/areas_perfiles',$sql);
    }
    public function nuevo_perfil() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>  $this->input->get_post('em')
        ));
        $this->load->view('areas/areas_perfiles_add',$sql);
    }
    public function insert_perfil_area() {
        $val=  explode(';', $this->input->post('area_rol_nombre'));
        $data=array(
            'area_rol_nombre'=>$val[1],
            'rol_id'=>  $val[0],
            'area_id'=>  $this->input->post('area_id')
        );
        if($this->input->post('accion')=='add'){
            if($this->config_mdl->_insert('os_areas_roles',$data)){
                $this->setOutput(array('accion'=>'1'));
            }
        }
    }
    public function agregar_medicos() {
        $area=  $this->input->get_post('area');
        $rol=  $this->input->get_post('rol_id');
        $perfil=  $this->input->get_post('perfil');
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_areas, os_empleados, os_empleados_areas,os_areas_roles
                                            WHERE os_areas.area_id=os_empleados_areas.area_id AND 
                                            os_areas_roles.area_rol_id=os_empleados_areas.area_rol_id AND
                                            os_empleados.empleado_id=os_empleados_areas.empleado_id AND 
                                            os_areas.area_id=$area AND os_empleados_areas.rol_id=$rol AND os_empleados_areas.area_rol_id=$perfil");
        $sql['area']=  $this->config_mdl->_get_data_condition('os_areas',array(
            'area_id'=>  $this->input->get('area')
        ));
        $sql['roles']=  $this->config_mdl->_get_data_condition('os_areas_roles',array(
            'area_id'=>  $this->input->get('area')
        ));
        $this->load->view('areas/areas_agregar_medicos',$sql);
    }
    public function agregar_medicos_list() {
        $sql['roles']=  $this->config_mdl->_get_data_condition('os_areas_roles',array(
            'area_rol_id'=>  $this->input->get('perfil')
        ));
        $sql['usuarios']=  $this->config_mdl->_get_data_condition('os_empleados');
        $this->load->view('areas/areas_agregar_medicos_list',$sql);
    }
    public function insert_perfil_area_medico() {

        $check_emp=  $this->config_mdl->_get_data_condition('os_empleados_areas',array(
            'empleado_id'   =>  $this->input->post('empleado_id'),
            'rol_id'        =>  $this->input->post('rol_id'),
            'area_id'       =>  $this->input->post('area_id'),
            'area_rol_id'   =>  $this->input->post('area_rol_id')
            
        ));
        if(empty($check_emp)){
            $data=array(
                'empleado_id'   =>  $this->input->post('empleado_id'),
                'rol_id'        =>  $this->input->post('rol_id'),
                'area_id'       =>  $this->input->post('area_id'),
                'area_rol_id'   =>  $this->input->post('area_rol_id')
            );
            if($this->config_mdl->_insert('os_empleados_areas',$data)){
               $check_rol=  $this->config_mdl->_get_data_condition('os_empleados_roles',array(
                    'empleado_id'=>  $this->input->post('empleado_id'),
                    'rol_id'=>  $this->input->post('rol_id')
                ));
                if(empty($check_rol)){
                    $this->config_mdl->_insert('os_empleados_roles',array(
                        'empleado_id'=>  $this->input->post('empleado_id'),
                        'rol_id'=>  $this->input->post('rol_id') 
                    ));
                }
            }
//            $this->config_mdl->_update_data('os_empleados',array(
//                'empleado_area'=>  $this->input->post('area_id')
//            ),array(
//                'empleado_id'=>  $this->input->post('empleado_id')
//            ));
 
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function eliminar_usuario_area() {
            $this->config_mdl->_delete_data('os_empleados_areas',array(
                'empleado_area_id'=> $this->input->post('perfil')
            ),array(
                'empleado_id'=>  $this->input->post('id')
            ));
            $this->config_mdl->_delete_data('os_empleados_roles',array(
                'empleado_id'=>  $this->input->post('id'),
                'rol_id'=>  $this->input->post('rol') 
            ));
            $this->setOutput(array('accion'=>'1'));
    }
    public function usuarios() {
        $this->load->view('areas/areas_usuarios');
    }
    public function usuarios_add() {
        $sql['info']=   $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>$this->input->get_post('u')));
        $sql['roles']=  $this->config_mdl->_get_data_condition('os_empleados_roles',array(
            'empleado_id'=>  $this->input->get_post('u')
        ));        
        foreach ($sql['roles'] as $value) {
            $roles.=$value['rol_id'].',';
        }
        $sql['roles_asignados']=  trim($roles, ',');
        $this->load->view('areas/areas_usuarios_add',$sql);
    }
    public function graficas() {
        $sql['Recortes']=  $this->config_mdl->_query("SELECT * FROM os_triage, os_triage_cortes
                                                    WHERE os_triage.triage_id=os_triage_cortes.triage_id GROUP BY os_triage.triage_fecha DESC");
        $sql['triage_clasificados']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_status'=>'Finalizado')));
        $sql['triage_noclasificados']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_status'=>'En proceso')));
        
        
        $sql['triage_rojo']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_color'=>'Rojo')));
        $sql['triage_naranja']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_color'=>'Naranja')));
        $sql['triage_amarillo']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_color'=>'Amarillo')));
        $sql['triage_verde']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_color'=>'Verde')));
        $sql['triage_azul']= count($this->config_mdl->_get_data_condition('os_triage',array('triage_color'=>'Azul')));
        if($_GET['triage_color']=='Todos'){
            $triage_color="";
        }else{
            $triage_color="os_triage.triage_color='".$_GET['triage_color']."' AND";
            $triage_color_like="os_triage.triage_color='".$_GET['triage_color']."'";
        }
        if($_GET['filter_select_v2']){
            $fi=  $this->input->get('fi_v');
            $hi=  $this->input->get('hi_v');
            $hf=  $this->input->get('hf_v');
            $sql['hora_cero']= count($this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='0' AND os_triage.triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf'")); 
            $sql['no_clasificados']= count($this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='1' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf'"));
            $sql['clasificados']= count($this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf'"));
        }else{
            $sql['hora_cero']=0;
            $sql['no_clasificados']=0;
            $sql['clasificados']=0;
        }if($_GET['filter_select']){
            if($_GET['filter_select']=='by_fecha'){
                $fi=  $this->input->get('fi');
                $ff=  $this->input->get('ff');
                $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_horacero_f BETWEEN '$fi' AND '$ff' ORDER BY triage_id DESC");
                $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='1' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Rojo' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Naranja' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Amarillo' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Verde' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");
                $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Azul' AND triage_horacero_f BETWEEN '$fi' AND '$ff' ");


            }if($_GET['filter_select']=='by_hora'){
                $fi=  $this->input->get('fi');
                $hi=  $this->input->get('hi');
                $hf=  $this->input->get('hf');
                $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ORDER BY triage_id DESC");
                $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='1' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Rojo' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Naranja' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Amarillo' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Verde' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");
                $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Azul' AND triage_horacero_f='$fi' AND triage_horacero_h BETWEEN '$hi' AND '$hf' ");

            }if($_GET['filter_select']=='by_like'){
                $filter_by=$_GET['filter_by'];
                $like=$_GET['like'];
                $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color_like $filter_by LIKE '%$like%' ORDER BY triage_id DESC");
                $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND $filter_by LIKE '%$like%'");
                $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='1' AND $filter_by LIKE '%$like%'");
                $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Rojo' AND $filter_by LIKE '%$like%'");
                $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Naranja' AND $filter_by LIKE '%$like%'");
                $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Amarillo' AND $filter_by LIKE '%$like%'");
                $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Verde' AND $filter_by LIKE '%$like%'");
                $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_color='Azul' AND $filter_by LIKE '%$like%'");

            }
        }
        
        $this->load->view('graficas/index',$sql);
    }
    public function cortes() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>  $this->input->get('id')));
        $sql['triage_rojo']= count($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_color'=>'Rojo',
            'triage_fecha'=>$sql['info'][0]['triage_fecha']
        )));
        $sql['triage_naranja']= count($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_color'=>'Naranja',
            'triage_fecha'=>$sql['info'][0]['triage_fecha']
        )));
        $sql['triage_amarillo']= count($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_color'=>'Amarillo',
            'triage_fecha'=>$sql['info'][0]['triage_fecha']
        )));
        $sql['triage_verde']= count($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_color'=>'Verde',
            'triage_fecha'=>$sql['info'][0]['triage_fecha']
        )));
        $sql['triage_azul']= count($this->config_mdl->_get_data_condition('os_triage',array(
            'triage_color'=>'Azul',
            'triage_fecha'=>$sql['info'][0]['triage_fecha']
        )));
        $sql['Gestion']=$this->config_mdl->_get_data_condition('os_triage',array(
            'triage_fecha'=>$sql['info'][0]['triage_fecha'],
            'triage_status'=>'Finalizado'
        ));
        $this->load->view('graficas/recortes',$sql);
    }
    public function realizar_corte_no_clasificado() {
        $sql=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_status'=>'En Proceso',
            'triage_corte'=>'No Clasificado'
        ));
        foreach ($sql as $value) {
            $check=  $this->config_mdl->_get_data_condition('os_triage_cortes',array(
                'triage_id'=>$value['triage_id']
            ));
            if(empty($check)){
                    $this->config_mdl->_update_data('os_triage',array(
                        'triage_corte'=>'Clasificado',
                        'triage_status'=>'Finalizado'
                    ),array(
                        'triage_id'=>$value['triage_id'],
                    ));
                    $this->config_mdl->_insert('os_triage_cortes',array(
                        'corte_hora'=>date('h:i:s A'),
                        'corte_fecha'=>date('d/m/Y'),
                        'triage_id'=>$value['triage_id'],
                        'empleado_id'=>$_SESSION['idUser']
                    ));   
            }

        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function consultorios() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_consultorios');
        $this->load->view('consultorios/index',$sql);
    }
    public function consultorios_add() {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_consultorios',array(
            'consultorio_id'=>  $this->input->get('c')
        ));
        $this->load->view('consultorios/add',$sql);
    }
    public function insert_consultorios() {
        $data=array(
            'consultorio_nombre'=>  $this->input->post('consultorio_nombre'),
            'consultorio_disponibilidad'=>  'No Disponible',
            'consultorio_listas'=>'No Disponible',
            'consultorio_acceso'=>  $this->cambiar_texto_area($this->input->post('consultorio_nombre')),
            'consultorio_especialidad'=>  $this->input->post('consultorio_especialidad')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_consultorios',$data);
            $last_id_c=  $this->config_mdl->_get_last_id('os_consultorios','consultorio_id');
            $this->config_mdl->_insert('os_empleados',array(
                'empleado_matricula'=>'N/E',
                'empleado_nombre'=>$this->input->post('consultorio_nombre'),
                'empleado_apellidos'=>'',
                'empleado_usuario'=> $this->cambiar_texto_area($this->input->post('consultorio_nombre')),
                'empleado_contrasena'=> md5($this->cambiar_texto_area($this->input->post('consultorio_nombre'))),
                'empleado_area'=>$last_id_c,
                'empleado_turno'=>'Matutino'
            )); 
            
            $last_id=  $this->config_mdl->_get_last_id('os_empleados','empleado_id');
            $this->config_mdl->_insert('os_empleados_roles',array(
                'empleado_id'=>$last_id,
                'rol_id'=>'38'
            ));
            
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function disponibilidad_consultorio() {
        $this->config_mdl->_update_data('os_consultorios',array('consultorio_disponibilidad'=>  $this->input->post('accion')),array(
            'consultorio_id'=>  $this->input->post('id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
