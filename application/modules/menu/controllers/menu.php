<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends MX_Controller{
    private static $msj = '';
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Menu_m','configuracion/Usuario_m'));
        self::$msj = json_decode(MSJ,TRUE);
    }
    public function index(){
        $data['info']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$_SESSION['UMAE_USER']
        ));
        $this->load->view('menu',$data);
    }
    public function menus() {
        foreach ($this->Menu_m->_get_menuN1($_SESSION['UMAE_AREA']) as $mn1) { 
            if ($mn1['menuN1_c_m'] == '1'){
                echo '<li>';
                        echo'<a md-ink-ripple href="#">';
                            echo'<span class="pull-right text-muted">';
                                echo '<i class="fa fa-caret-down"></i>';
                            echo'</span>';
                            echo'<i class="icon fa '.$mn1['menuN1_icono'].' i-20"></i>';
                            echo'<span class="font-normal" style="margin-left: -15px;">'.$mn1['menuN1_menu'].'</span>';
                        echo '</a>';
                        echo '<ul class="nav nav-sub">';
                        foreach ($this->Menu_m->_get_menuN2($mn1['menuN1_id']) as $mn2) {
                            if ($mn2['menuN2_c_m'] == '1'){
                                echo '<li>';
                                    echo'<a md-ink-ripple style="padding-top: 10px;padding-bottom: 10px;">';
                                        echo'<span class="pull-right text-muted">';
                                            echo'<i class="fa fa-caret-down"></i>';
                                        echo'</span>';
                                        echo'<span class="font-normal">'.$mn2['menuN2_menu'].'</span>';
                                    echo'</a>';
                                    echo'<ul class="nav nav-sub">';
                                    foreach ($this->Menu_m->_get_menuN3($mn2['menuN2_id']) as $mn3) { 
                                        echo '<li>';
                                            echo'<a md-ink-ripple href="'.  base_url().$mn3['menuN3_url'].'" style="padding: 10px 10px 7px 0px;margin-left: 10px">'.$mn3['menuN3_menu'].'</a>';
                                        echo'</li>';
                                    }
                                    echo'</ul>';
                                echo '</li>';
                            }else{
                                echo '<li>';
                                    echo '<a md-ink-ripple href="'.base_url().$mn2['menuN2_url'].'" style="padding-top: 10px;padding-bottom: 10px;">'.$mn2['menuN2_menu'].'</a>';
                                echo '</li>';                     
                            }
                        }
                        echo '</ul>';
                echo '</li>';
            }else{
                echo '<li>';
                    echo '<a md-ink-ripple href="'.  base_url().$mn1['menuN1_url'].'">';
                        echo'<i class="icon '.$mn1['menuN1_icono'].' i-20"></i>';
                    echo'<span class="font-normal " style="margin-left: -15px;">'.$mn1['menuN1_menu'].'</span>';
                    echo'</a>';
                echo'</li>';
            }
        }
    }
    public function header() {

    }

    public function footer() {
            return $this->load->view('includes/footer.php','',TRUE); 
    }

    public function info_usuario() {
            $ajax_request = $this->input->is_ajax_request();
            if ($ajax_request) {
                    $id_usuario = $this->session->sess['idUsuario'];
                    if ($id_usuario) {
                            $info = $this->Menu_m->get_info_usuario($id_usuario);
                            if ($info and !empty($info)) {
                                    $info = html_purify($info);
                                    $json = json_encode(array(
                                            'action'     => '1',
                                            'nombre'     => $info[0]['nombre'],
                                            'apellido_p' => $info[0]['apellido_paterno'],
                                            'apellido_m' => $info[0]['apellido_materno'],
                                            'matricula'  => $info[0]['matricula']
                                    )); // Usuario encontrado
                                    $this->output->set_content_type('application/json')->set_output($json);
                            }
                            else {
                                    $json = json_encode(array(
                                            'action' => '2',
                                            'msj'	 	=> self::$msj[2]
                                    )); // Error usuario no encontrado
                                    $this->output->set_content_type('application/json')->set_output($json);
                            }
                    }
                    else {
                            $json = json_encode(array(
                                    'action' => '3',
                                    'msj'	 	=> self::$msj[7]
                            )); // Error cookie
                            $this->output->set_content_type('application/json')->set_output($json);
                    }
            } 
            else {
                    redirect('inicio/index','refresh');
            }
    }
    public function logout() {
        $ajax_request = $this->input->is_ajax_request();
        if ($ajax_request) {
                $this->session->sess_destroy();
        }
    }
    public function getNotifLista() {
      $idDepartamento = $this->getDepartamentoByIdUsuario($this->session->sess['idUsuario']);
      $notificaciones = $this->Menu_m->getNotificacionesFromDepar($idDepartamento);
      $notifiHTML = 
         '<div data-url="false" class="notification-messages danger">
            <div class="iconholder"> <i class="icon-warning-sign"></i> </div>
            <div class="message-wrapper">
               <div class="heading">No tiene notificaciones</div>
               <div class="description"></div>
            </div>
            <div class="clearfix"></div>
         </div>';
      if (!empty($notificaciones)) {
         $notifiHTML = '';
         foreach ($notificaciones as $key => $notificacion) {
            $departamento = Modules::run('master/filas_c',array(
               'tabla' => 'departamento',
               'condicion' => [
                  'idDepartamento' => $notificacion['remitente']
               ]
            ));
            if (!empty($departamento)) {
               $departamento = $departamento[0]['nombre'];
               $notifiHTML .=
                  '<div data-url="'.base_url($notificacion['url_redirect']).'" class="notification-messages info">
                     <div class="user-profile"> 
                        <img src="'.base_url('assets/img/profiles/'.$notificacion['foto']).'"  alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35"> 
                     </div>
                     <div class="message-wrapper">
                        <div class="heading">'.$departamento.' - '.$notificacion['nota'].' </div>
                        <div class="description">'.$notificacion['subtitulo'].'</div>
                        <div class="date pull-left">'.$this->dates->getDifferHuman($notificacion['fecha']).'</div>
                     </div>
                     <div class="clearfix"></div>
                  </div>'; 
            }
         }
         $notifiHTML .=  
         '<div data-url="'.base_url('inicio/notificaciones').'" class="notification-messages danger">
            <div class="message-wrapper" style="width:100%;float:none;height:15px;">
               <div class="heading text-center">Ver todas</div>
            </div>
            <div class="clearfix"></div>
         </div>';
      }
      return $notifiHTML;
    }

    private function getDepartamentoByIdUsuario($idUsuario) {
      $departamento = $this->Menu_m->getIdDepartemento($idUsuario);
      if (!empty($departamento)) {
         return $departamento[0]['idDepartamento'];
      }
      else {
         return FALSE;
      }
   }

    private function getDate() {
      $monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
      $dayNames = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
      $month = $monthNames[date('m') - 1];
      $day = $dayNames[date('w')];
      $dates = array(
         'ap' => date('A'),
         'dateTime' => $day.' '.date('d').' '.$month.' '.date('Y')
      );
      return $dates;
   }
		
}
