<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author felipe de jesus
 */
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
require_once APPPATH.'third_party/ezpdf/class.ezpdf.php';
require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
class Config extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct(); 
        error_reporting(0);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        date_default_timezone_set('America/Mexico_City');
        
        $this->load->model(array(
            'login/login_mdl','conservacion/usuario_mdl','conservacion/contratos_mdl',
            'conservacion/proveedores_mdl','config/config_mdl'
        ));
        if(!isset($_SESSION['UMAE_USER']) && $this->uri->segment(1, 0)!='login'){
            //redirect(base_url());
        }
    }
    public function CerrarSesion() {
        if(in_array('38', $_SESSION['IMSS_ROLES'])){
            $sql['info_c']=  $this->config_mdl->_get_data_condition('os_empleados',array(
                'empleado_id'=>$_SESSION['idUser']
            ));
            $this->config_mdl->_update_data('os_consultorios',array('consultorio_disponibilidad'=> 'No Disponible'),array(
                'consultorio_id'=>  $sql['info_c'][0]['empleado_area']
            ));
        }
        
        session_destroy();
        session_unset();
        redirect('login');
    }
    public function headListad() {
        
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }  
    public function getHeadAdmin() {
        $sql['info']=  $this->usuario_mdl->get_user_data($_SESSION['sess']['idUsuario']);
        $this->load->view('conservacion/headAdmin',$sql);
    }
    public function getFooterAdmin() {
        $this->load->view('conservacion/footerAdmin');
    } 
    public function mapa() {
        $this->load->view('mapa');
    }    
    public function upload_image_pt() {
        $url_sav = $_GET['tipo'];
        $dir = 'assets/' .$url_sav . '/';
        $serverdir = $dir;
        $tmp = explode(',', $_POST['data']['data']);
        $imgdata = base64_decode($tmp[1]);
        $extension = strtolower(end(explode('.', $_POST['data']['name'])));
        $filename = substr($_POST['data']['name'], 0, -(strlen($extension) + 1)) . '.' . substr(sha1(time()), 0, 6) . '.' . $extension;
        $handle = fopen($serverdir . $filename, 'w');
        fwrite($handle, $imgdata);
        fclose($handle);
        $response = array(
            "status" => "success",
            "url" => $filename . '?' . time(),
            "filename" => $filename
        );
        if (!empty($_POST['original'])) {
            $tmp = explode(',', $_POST['original']);
            $originaldata = base64_decode($tmp[1]);
            $original = substr($_POST['name'], 0, -(strlen($extension) + 1)) . '.' . substr(sha1(time()), 0, 6) . '.original.' . $extension;

            $handle = fopen($serverdir . $original, 'w');
            fwrite($handle, $originaldata);
            fclose($handle);
            $response['original'] = $original;
        }
        $this->setOutput($response);
    }
    public function sendMessage($descripcion,$Titulo){
        $content = array(
            "en" => $descripcion
        );
        $heading=array(
            "en"=>  $Titulo
        );
        $fields = array(
            'app_id' => "9fddfc34-171c-447e-be6e-09de7f8a4ed4",
            'included_segments' => array('All'),
            'contents' => $content,
            'headings'=>$heading
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                           'Authorization: Basic NTE1NGUzMDItZmZhNC00OTQyLWEyMjctN2JjOGIwYTU1ZGQ1')
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_exec($ch);
        curl_close($ch);
    }
    public function enviar_email($email) {
        $email_from = 'concanacoservytur@hotmail';
        $email_message = "<!DOCTYPE html> <html> <head> <meta charset='UTF-8'> <meta content='telephone=no' name='format-detection' /> <meta content='width=mobile-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no' name='viewport' />"
                . " <meta content='IE=9; IE=8; IE=7; IE=EDGE' http-equiv='X-UA-Compatible' /> <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,400italic,300italic' rel='stylesheet' type='text/css'> "
                . "<style type='text/css'> table {border-collapse:separate;}a, a:link, a:visited {text-decoration: none; color: #00788a;} h2,h2 a,h2 a:visited,h3,h3 a,h3 a:visited,h4,h5,h6,.t_cht {color:#000 !important;} p {margin-bottom: 0}.ExternalClass p, "
                . ".ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}.ExternalClass {width: 100%;}#outlook a {padding:0;} body, #body-table {height:100% !important; width:100% !important; "
                . "margin:0 auto; padding:0; line-height:100% !important; font-family: 'Lato', sans-serif;} img, a img {border:0; outline:none; text-decoration:none;}.image-fix {display:block;}table, td {border-collapse:collapse;}.ReadMsgBody {width:100%;} "
                . ".ExternalClass{width:100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, "
                . ".ExternalClass div {line-height:100% !important;}.ExternalClass * {line-height: 100% !important;}table, td {mso-table-lspace:0pt;"
                . " mso-table-rspace:0pt;}img {outline: none; border: none; text-decoration: none; -ms-interpolation-mode: bicubic;} body, table, td, p, a, li,"
                . " blockquote {-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;} body.outlook img {width: auto !important;max-width: none !important;}"
                . "body{ -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;} body, #body-table {background-color: #e6e7eb;"
                . " margin:0 auto !important;; text-align:center !important;}p {padding:0; margin: 0; line-height: 24px; font-family: Lato, sans-serif;}a,"
                . " a:link {color: #1c344d;text-decoration: none !important;}.footer-link a, .nav-link a {color: #fff6e5;}.thread-item.expanded .thread-body{background-color: #000000 !important;}.thread-item.expanded .thread-body .body, "
                . ".msg-body{display:block !important;} #body-table .undoreset table {display: table !important;table-layout: fixed !important;} @media only screen and (max-width: 800px) {a[href^='tel'], a[href^='sms'] {text-decoration: none;pointer-events: none;cursor: default;}"
                . ".mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {text-decoration: default;pointer-events: auto;cursor: default;}*[class].mobile-width {width: 700px !important; padding: 0 4px;}*[class]"
                . ".center-stack {padding-bottom:30px !important; text-align:center !important; height:auto !important;}*[class]"
                . ".bottom-stack {padding-bottom:30px !important;}*[class].stack {padding-bottom:30px !important; height: auto !important;}"
                . "*[class].gallery {padding-bottom: 20px!important;}*[class].fluid-img {height:auto !important; max-width:600px !important;"
                . " width: 100% !important;}*[class].block {display: block!important;}*[class].midaling { width:100% !important; border:none !important; }"
                . "*[class].full-width-layout {width: 100%!important;}*[class].test-hidden-space{ height:40px !important;}*[class]"
                . ".test-center{ width:100% !important; height:auto !important;text-align:center;}*[class]"
                . ".bg-res1{ background-position: center center !important;background-size: 100% 200% !important; padding:40px 0px !important;}"
                . "*[class].bg-res2{ background-position: center center !important;background-size: 100% 200% !important;padding:40px 0px !important;}"
                . "*[class].res-space{ height:50px !important;}} @media only screen and (max-width: 700px) { *[class].full-width {width: 100%!important;} "
                . "*[class].mobile-width {width: 600px !important; padding: 0 4px;}*[class].content-width {width: 540px!important;}"
                . "*[class].icon-columns{ width:540px !important; border:none !important; }*[class].mockup-width{ width:33% !important;}"
                . "*[class].center {text-align:center !important; height:auto !important;}*[class].section-white{ background-color:#FFFFFF; "
                . "background:none!important;}*[class].hidden-space{ height:0px !important;}*[class].no-padding{ padding:0px !important;}}"
                . " @media only screen and (max-width: 640px) {*[class].mobile-width {width: 480px!important; padding: 0 4px;}*[class]"
                . ".content-width {width: 360px!important;}*[class].icon-columns{ width:360px !important; border:none !important; }"
                . "*[class].center {text-align:center !important; height:auto !important; width:100%;}} @media only screen and (max-width: 480px) "
                . "{*[class].full-width {width: 100%!important;}*[class].mobile-width {width: 360px!important; padding: 0 4px;}*[class].content-width "
                . "{width: 300px!important;}*[class].icon-columns{ width:300px !important; border:none !important; }*[class].center "
                . "{text-align:center !important; height:auto !important; width:100%;}*[class].center-stack {padding-bottom:30px !important; "
                . "text-align:center !important; height:auto !important;}*[class].stack {padding-bottom:30px !important; height: auto !important;}"
                . "*[class].gallery {padding-bottom: 20px!important;}*[class].midaling { width:100% !important; border:none !important; }} "
                . "@media only screen and (max-width: 360px) { *[class].full-width {width: 100%!important;} *[class].mobile-width "
                . "{width: 100%!important; padding: 0 4px;}*[class].content-width {width: 280px!important;}*[class].icon-columns{ "
                . "width:290px !important; border:none !important; }*[class].center {text-align:center !important; height:auto !important;"
                . " width:100%;}*[class].center-stack {padding-bottom:30px !important; text-align:center !important; height:auto !important;}"
                . "*[class].stack {padding-bottom:30px !important; height: auto !important;}*[class].gallery {padding-bottom: 20px!important;}"
                . "*[class].fluid-img {height:auto !important; max-width:600px !important; width: 100% !important; min-width:320px !important;}"
                . "*[class].midaling { width:100% !important; border:none !important;}} </style> </head> <body> <table id='body-table' bgcolor='#e6e7eb'"
                . " border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout:fixed;'> <tbody> <tr> <td align='center' valign='top'> "
                . "<table width='700' bgcolor='#ffffff' border='0' cellspacing='0' cellpadding='0' class='mobile-width'> <tbody> <tr> <td align='center'> "
                . "<table width='700' border='0' cellspacing='0' cellpadding='0' class='mobile-width'> <tbody> <tr> <td> "
                . "<table bgcolor='#CCCCCC' width='100%' cellspacing='0' background='http://app.concanaco.com.mx/assets/img/slide.png' cellpadding='0' border='0' style='width: 100%;background-size: cover;background-position: center;'> "
                . "<tbody> <tr> <td align='center'> <!-- Menu Section / Logo --> <table width='640' cellspacing='0' cellpadding='0' border='0' class='content-width'> "
                . "<tbody> <tr> <td> <!-- Start Logo --> <table width='640' align='left' cellspacing='0' cellpadding='0' border='0' class='center'> <tbody> <tr> "
                . "<td valign='middle' align='center' class='center'> <img src='http://app.concanaco.com.mx/assets/img/logo-concanaco.png' > </td> </tr> </tbody> </table> "
                . "</td> </tr> </tbody> </table> <!-- Menu Section / Logo Ends --> <!-- Header Content Begins --> "
                . "<table width='640' cellspacing='0' cellpadding='0' border='0' class='content-width'> <tbody> <tr> <td> "
                . "<table width='300' align='center' cellspacing='0' cellpadding='0' border='0' class='content-width'> <tbody> <tr> <td align='center' class='center' height='100px' style='color: white'>"
                . " </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table>"
                . " <table width='700' border='0' cellspacing='0' cellpadding='0' class='mobile-width'> <tbody> <tr> "
                . "<td align='center'> <table width='100%' align='center' border='0' cellspacing='0' cellpadding='0' class='content-width'> "
                . "<tbody> <tr> <td align='center' style='font-family: Lato, sans-serif;text-align: justify; font-size: 25px; text-transform:none;font-weight: 300;"
                . " mso-line-height-rule:exactly; line-height:30px; color: #343a32;text-align: center' mc:edit='post-main-title'> <multiline label='latest-post-main-title'>"
                . " <br> Su mensaje ha sido enviado correctamente, muy pronto nos pondremos en contacto con usted"
                . " <br><br><b>Concanaco Servytur México</b><br> Balderas 144, Centro, 06070 Ciudad de México, D.F.<br> Tel: 5722-9300 <br> "
                . "<img src='http://app.concanaco.com.mx/assets/img/headerConcanaco.png' style='width: 100%' align='center'> <br><br> </multiline> "
            . "</td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </body> </html> ";
        $headers = "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: Concanaco Servytur México <concanacoservytur@hotmail.com>\r\n" .
                'Reply-To: ' . $email_from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        mail($email, 'Concanaco Servytur México', $email_message, $headers);
    }
    public function cambiar_texto_area($String){
        $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
        $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
        $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
        $String = str_replace(array('í','ì','î','ï'),"i",$String);
        $String = str_replace(array('é','è','ê','ë'),"e",$String);
        $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
        $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
        $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
        $String = str_replace(array('ú','ù','û','ü'),"u",$String);
        $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
        $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
        $String = str_replace(' ',"_",$String);
        return strtolower($String);
    }
    public function cambiar_texto($String){
        $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
        $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
        $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
        $String = str_replace(array('í','ì','î','ï'),"i",$String);
        $String = str_replace(array('é','è','ê','ë'),"e",$String);
        $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
        $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
        $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
        $String = str_replace(array('ú','ù','û','ü'),"u",$String);
        $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
        $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
        $String = str_replace("ç","c",$String);
        $String = str_replace("Ç","C",$String);
        $String = str_replace("ñ","n",$String);
        $String = str_replace("Ñ","N",$String);
        $String = str_replace("Ý","Y",$String);
        $String = str_replace("ý","y",$String);
        $String = str_replace("&aacute;","a",$String);
        $String = str_replace("&Aacute;","A",$String);
        $String = str_replace("&eacute;","e",$String);
        $String = str_replace("&Eacute;","E",$String);
        $String = str_replace("&iacute;","i",$String);
        $String = str_replace("&Iacute;","I",$String);
        $String = str_replace("&oacute;","o",$String);
        $String = str_replace("&Oacute;","O",$String);
        $String = str_replace("&uacute;","u",$String);
        $String = str_replace("&Uacute;","U",$String);
        $String = str_replace("_",$String);
        $String=  str_replace(array('”','“','"',",",'&','(',')','’','-'), '', $String);
        $String = preg_replace('/\s+/', '_', $String);
        return strtolower($String);
    }
    public function actualiza_datos() {
        $sql=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_status'=>'Finalizado'
        ));
        foreach ($sql as $value) {
            if($value['triage_puntaje_total']>30){
                $color='#E50914';
                $color_name='Rojo';
                $tiempo='Inmediatamente';
            }if($value['triage_puntaje_total']>=21 && $value['triage_puntaje_total']<=30){
                $color='#FF7028';
                $color_name='Naranja';
                $tiempo='10 Minutos';
            }if($value['triage_puntaje_total']>=11 && $value['triage_puntaje_total']<=20){
                $color='#FDE910';
                $color_name='Amarillo';
                $tiempo='11-60 Minutos';
            }if($value['triage_puntaje_total']>=6 && $value['triage_puntaje_total']<=10){
                $color='#4CBB17';
                $color_name='Verde';
                $tiempo='61-120 Minutos';
            }if($value['triage_puntaje_total']<=5){
                $color='#0000FF';
                $color_name='Azul';
                $tiempo='121-240 Minutos';
            }
            $this->config_mdl->_update_data('os_triage',array(
                'triage_color'=>$color_name
            ),array(
                'triage_id'=>$value['triage_id']
            ));
        }
    }
    public function barcode( $filepath, $text, $size, $orientation, $code_type, $print, $SizeFactor ) {
	$code_string = "";
	// Translate the $text into barcode the correct $code_type
	if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
		$chksum = 104;
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211214" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code128a" ) {
		$chksum = 103;
		$text = strtoupper($text); // Code 128A doesn't support lower case
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211412" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code39" ) {
		$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
		}

		$code_string = "1211212111" . $code_string . "121121211";
	} elseif ( strtolower($code_type) == "code25" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
		$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

		for ( $X = 1; $X <= strlen($text); $X++ ) {
			for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
				if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
					$temp[$X] = $code_array2[$Y];
			}
		}

		for ( $X=1; $X<=strlen($text); $X+=2 ) {
			if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
				$temp1 = explode( "-", $temp[$X] );
				$temp2 = explode( "-", $temp[($X + 1)] );
				for ( $Y = 0; $Y < count($temp1); $Y++ )
					$code_string .= $temp1[$Y] . $temp2[$Y];
			}
		}

		$code_string = "1111" . $code_string . "311";
	} elseif ( strtolower($code_type) == "codabar" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
		$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
				if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
					$code_string .= $code_array2[$Y] . "1";
			}
		}
		$code_string = "11221211" . $code_string . "1122121";
	}

	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 30;
	} else {
		$text_height = 0;
	}
	
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
        }

	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size;
	} else {
		$img_width = $size;
		$img_height = $code_length*$SizeFactor;
	}

	$image = imagecreate($img_width, $img_height + $text_height);
	$black = imagecolorallocate ($image, 0, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	if ( $print ) {
		imagestring($image, 5, 31, $img_height, $text, $black );
	}

	$location = 10;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
		else
			imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	
	// Draw barcode to the screen or save in a file
	if ( $filepath=="" ) {
		header ('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	} else {
		imagepng($image,$filepath);
		imagedestroy($image);		
	}
}

}
