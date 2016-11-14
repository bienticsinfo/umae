<?php
/**
 * Description of contancia
 *
 * @author felipe de jesus
 */
require_once APPPATH.'third_party/pdf/html2pdf.class.php';
class Constancia extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("constancia_model");
        $this->load->model('user_model');
    }
    public function index() {
        $this->load->view('constancia/index');
    }
    public function getConstancias() {
        $sql=  $this->constancia_model->_getConstancias();
        $tr='';
        if(!empty($sql)){
            foreach ($sql as $value) {
                $plantilla='';
                if($value['archivoC']==''){
                    $plantilla='<i data-id-accion="plantilla"  data-infoS='.$value['idConstancia'].' data-toggle="tooltip" title="Subir plantilla" class="tip accionesS fa fa-cloud-upload fa-2x"></i>';
                }else{
                    $plantilla='<a href="'.base_url().'Queries/'.$value['archivoC'].'" target="_blanck"><i class="tip fa fa-file-text-o fa-2x" data-toggle="tooltip" title="Ver plantilla"></i></a>';
                }
                $tr.='  <tr>
                            <td class="infoConstania" data-id="'.$value['idConstancia'].'" >
                                <div class="text-center tip " data-toggle="tooltip" title="Generar Constancia">'.$value['nombreC'].'</div>
                            </td>
                            <td>'.$value['fechaC'].'</td>
                            <td>'.$value['lugarC'].'</td>
                            <td>
                                '.$plantilla.'
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="row">
                                        <i data-id-accion="modificar" data-infoM="'.$value['idConstancia'].'" data-toggle="tooltip" title="Modificar" class="tip accionesM fa fa-edit pointer fa-2x"></i>   
                                        <i data-id-accion="eliminar"  data-infoE="'.$value['idConstancia'].'" data-toggle="tooltip" title="Eliminar" class="tip accionesE fa fa-trash pointer fa-2x"></i>   
                                    </div>
                             </div>   
                            </td>
                        <tr>';
            }
            $json=array("tr"=>$tr,'accion'=>'1');
        }else{
            $json=array("msj"=>"No hay registros disponibles",'accion'=>'2');
        }
               $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }
    public function insertConstancia() {
        $data = array(
           'nombreC' => $this->input->post("nombre") ,
           'fechaC' => $this->input->post("fecha"),
           'lugarC' => $this->input->post("lugar")
        );     
        if($this->input->post("accion")=='Agregar'){
            $sql=  $this->constancia_model->_insertConstancia($data);
        }else{
            $sql=  $this->constancia_model->_updateContancia($data,  $this->input->post('id'));
        }
        if($sql){
            $json=array('accion'=>'1','msj'=>'Registro realizado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Erro al realizar la acción');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
        
    }
    public function getConstanciaById() {
        $sql=  $this->constancia_model->_getConstanciasById($this->input->post('id'));
        $json=array(
            "nombreC"=>$sql[0]['nombreC'],
            "fechaC"=>$sql[0]['fechaC'],
            "lugarC"=>$sql[0]['lugarC']
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    public function deleteConstancia() {
        $sql=  $this->constancia_model->_deleteConstancia($this->input->post('id'));
        if($sql){
            $json=array('accion'=>'1','msj'=>'Registro realizado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Erro al realizar la acción');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));  
    }
    public function subirInfo() {
        $ext_tmp = explode('.', $_FILES['jtfArchivo']['name']);
        $img=rand(10000,999999)* rand(10000,999999).'.'.end($ext_tmp);        
        if(copy($_FILES['jtfArchivo']['tmp_name'], "Queries/".$img)){
            $sql=$this->constancia_model->_updateContancia(array('archivoC'=>$img),  $this->input->post('idUser'));
            if($sql){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
       
    }
    public function getUsersAll() {
        $sql = $this->user_model->_getUsers();
        $tr='';
        if (!empty($sql)) {
            foreach ($sql as $value) {
                $sql_v=  $this->constancia_model->_getUC($value['idUsuario'],  $this->input->post('idC'));
                $sql_cons=  $this->constancia_model->_getConstanciasById($this->input->post('idC'));
                if(empty($sql_v)){
                    $accion_s='block';
                    $accion_n='none';
                }else{
                    $accion_s='none';
                    $accion_n='block';
                }
                $tr .= 
                    '<tr" id="'.$value['idUsuario'].'">
                        <td>'.$value['nombreUsuario'].'</td>
                        <td>'.$value['apatUsuario'].'</td>
                        <td>'.$value['amatUsuario'].'</td>
                        <td>
                             <div class="text-center">
                                <div class="row ">
                                    <a href="'.  base_url().'ensenanzas/constancia/ConstanciaPdf?idC='.  base64_encode($this->input->post('idC')).'&idU='.  base64_encode($value['idUsuario']).'" target="_blanck">
                                        <i class="tip fa fa-file-pdf-o fa-2x generarPdf" data-toggle="tooltip" title="Generar Pdf" id="'.$value['idUsuario'].'-Pdf" style="display:'.$accion_n.';float:left;margin-left:15px"></i>
                                    </a>
                                    <i class="tip fa fa-envelope-o fa-2x generarEmail" data-toggle="tooltip" title="Enviar via email" id="'.$value['idUsuario'].'-Email" data-user="'.base64_encode($value['idUsuario']).'" data-constancia="'.base64_encode($this->input->post('idC')).'" data-email="'.$value['email'].'"   style="display:'.$accion_n.';float:left;margin-left:7px"></i>
                                    <button id="'.$value['idUsuario'].'-Asistencia" data-id="'.$value['idUsuario'].'" type="button" style="display:'.$accion_s.'" data-toggle="tooltip" title="Agregar asistencia" class="tip btn btn-primary b-green-i btnAccionAsistencia">Asistencia</button>
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
    public function registraUserCons() {
        $data=array(
            'idUser'=>  $this->input->post('idUser'),
            'idC'=>$this->input->post('idConsta')
        );
        $sql=  $this->constancia_model->_insertUC($data);
        if($sql){
            $json=array('accion'=>'1','msj'=>'Registro realizado correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Erro al realizar la acción');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));  
    }
    public function EnviarEmail() {
    $this->load->library('Mailer');
    $nombre=rand(10000,999999)* rand(10000,999999);
      $config = array(
         'username' => 'umae.magdalena@gmail.com',
         'password' => 'adminadminumae',
         'gmail' => TRUE,
         'fromName' => 'Hospital Magdalena de la Salinas',
         'confirmar' => FALSE
      );
      $msj="Generación de Constancia<br><br>";
      $msj.='Haga vlick en el siguiente enlace para visualizar su Constancia';
      $msj.='<br><br><a href="'.  base_url().'Queries/'.$nombre.'.pdf'.'">Visualizar Constancia</a>';
      $this->mailer->init($config);
        $enviado = $this->mailer->emailConstancia($this->input->post('email'),$msj);	
        if($enviado){
            $this->ConstanciaEmail($nombre, $this->input->post("idU"),  $this->input->post("idC"));
            $json=array('accion'=>'1','msj'=>'Constancia enviada correctamente');
        }else{
            $json=array('accion'=>'2','msj'=>'Lo sentimos no se pudo enviar la constancia');
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json)); 
    }     
    public function ConstanciaPdf() {
        $Datos['Accion']='Pdf';
        $Datos['Constancia']=  $this->constancia_model->_geConstanciaUser(
                base64_decode($_REQUEST['idU']),
                base64_decode($_REQUEST['idC']) 
                );
        $this->load->view('constancia/reporte',$Datos);
    }
    public function ConstanciaEmail($nombre,$idU,$idC) {
        $Datos['nombre']=$nombre;
        $Datos['Accion']='Email';
        $Datos['Constancia']=  $this->constancia_model->_geConstanciaUser(base64_decode($idU),base64_decode($idC) );
        $this->load->view('constancia/reporte',$Datos);
    }
}
