<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'modules/config/controllers/Config.php';
    class Inicio extends Config {
      
    public function __construct() {
        parent::__construct();
            $this->load->model('Inicio_m');
        }
    public function index() {
        $this->load->view('inicio');
    }
    public function notificaciones_total() {
       $this->setOutput(array('total'=>0));
    }
    public function jefa_asistentesmedicas() {
        if($_GET['triage_color']=='Todos'){
            $triage_color="";
        }else{
            $triage_color="os_triage.triage_color='".$_GET['triage_color']."' AND";
            $triage_color_like="os_triage.triage_color='".$_GET['triage_color']."'";
        }
        if($_GET['filter_select']){
            if($_GET['filter_select']=='by_fecha'){
                $fi=  $this->input->get('fi');
                $ff=  $this->input->get('ff');
                $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color os_triage.triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ORDER BY triage_id DESC");
                $sql['CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['NO_CLASIFICADOS']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='1' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['triage_rojo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Rojo' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['triage_naranja']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Naranja' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['triage_amarillo']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Amarillo' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['triage_verde']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Verde' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");
                $sql['triage_azul']=  $this->config_mdl->_query("SELECT * FROM os_triage WHERE $triage_color triage_etapa='2' AND os_triage.triage_color='Azul' AND triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ");


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
        $this->load->view('jefa_asistentesmedicas',$sql);
    }
    public function jefa_enfermeras() {
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
        $this->load->view('jefa_enfermeras');
    }
}