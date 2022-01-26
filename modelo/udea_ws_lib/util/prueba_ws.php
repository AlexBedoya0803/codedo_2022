<?php
include 'math/BigInteger.php';
error_reporting(E_ALL);
ini_set('display_errors',1);
date_default_timezone_set('America/Bogota');

// SETUP

// maximun seconds to allow cURL functions to execute.
const CURL_TIMEOUT = 10;
// institutional web services list.
const URL_WS_LIST = 'http://link.udea.edu.co/listadows';

//$direction = "./log-prueba";

$cedula="1017244568";
$usuario = "joan.gomez"; //nombre de usuario del portal UdeA
$clave = "chocolate180"; //clave del portal UdeA
//$clave = "Jec";
$programa = "504";
$semestre = "20172";
$tipo_homologacion = "TODAS";

// TEST


$service = "validarusuariooidxcn";
$response = call_ws($service, array("usuario" => encrypt("$usuario"), "clave" => encrypt("$clave")));
$response_data = json_decode($response, TRUE);

if(strpos($response_data['object'], "Error")===false){
	$decrypted_data = decrypt($response_data['object'],"518293881492214041749761");
	var_dump($decrypted_data);
 }else{
	echo ("El servicio de validación esta presentando problemas técnicos, por favor innténtelo más tarde.");	
	}


echo ("\n");
echo ("\n");



$service = "consultapersonamares";
$response = call_ws($service, array("cedula" => $cedula));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
echo ("\n");
echo ("\n");
echo "<br>";
echo "<br>";



echo "Profesor";
$service = "consultaempleadossipe";
$response = call_ws($service, array("cedula" => "8029836", "estamentos" => 'DOCEN'));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
if($message===NULL) echo "El servicio está presentando problemas técnicos, por favor inténtelo más tarde.";
echo ("\n");
echo ("\n");

/*
echo "Profesor";
$service = "consultaempleadossipe";
$response = call_ws($service, array("cedula" => $cedula));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
if($message===NULL) echo "El servicio está presentando problemas técnicos, por favor inténtelo más tarde.";
echo ("\n");
echo ("\n");


$service = "consultaempleadossipe";
$response = call_ws($service, array("cedula" => "43730063", "vigentes" => 'S', "estamentos" => 'DOCEN'));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
	if(empty($message)  || strpos($message,"error")){
					echo "N";
				}else{
					echo "S";		
			}	

//phpinfo();


$service = "buscarnombreusuariomua";
$response =  call_ws($service, array("cedula" => $cedula));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
echo ("\n");
echo ("\n");
*/

/*
$service = "consultainformacionacademicamares";
$response = call_ws($service, array("cedula" => $cedula));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
echo ("\n");
echo ("\n");
*/

/*
$service = "consultamateriasestudiantemares";
$response = call_ws($service, array("cedula" => "$cedula", "programa" => "$programa", "semestre" => "$semestre", "tipoHomolog" => "$tipo_homologacion"));
$response_data = json_decode($response, TRUE);
$message = $response_data['object'];
var_dump($message);
echo ("\n");
echo ("\n");
*/
// FUNCTIONS

function logger($service, $message) {
    $date = date('d/m/Y H:i:s');
    $log = "[Error WS] | Date:  ".$date." (GMT-5) | Service: ".$service." | ".$message."\n";
  //  error_log($log, 3, $GLOBALS['direction']);
}

function validate_response($response_data) {
    if(is_array($response_data)){
        return TRUE;
    }
    return (!empty($response_data) && !(strpos($response_data, "ERROR") !== FALSE));
}

function get_ws_url($wsname, $params){
    $wsListUrl = URL_WS_LIST;
    $response = $wsList = NULL;
    try {
        $session = curl_init();
        curl_setopt_array($session, array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_TIMEOUT => CURL_TIMEOUT,
            CURLOPT_URL => $wsListUrl,
        ));
        $wsList = curl_exec($session);
        if($wsList === FALSE){
            $message = "cURL(url): ". curl_error($session);
            logger($wsname, $message);
        }
    } catch (Exception $e) {
        $message = "cURL(url): ". curl_error($session);
        logger($wsname, $message);
    }
    curl_close($session);
    $wsarray = preg_split('/\s+/', $wsList);
    foreach($wsarray as $ws) {
        $tokens = explode("=",$ws);
        if($tokens[0] == $wsname) {
            $wsUrl = $tokens[1];
        }
    }
    if (!isset ($wsUrl)){
        return FALSE;
    } else {
        $query = http_build_query($params,"","&");
        $url = $wsUrl.'?'.$query;
        return($url);
    }
}

function call_ws($wsname, $params){
    $url = get_ws_url($wsname, $params);
    $accesstoken = "DCD562FDD8889902D2529C8C34731A4778216B12";              //TOKEN asignado por Gestión Informática
    $connection_type = "Producción";
    $headers = array(
        "OAuth_Token: $accesstoken",
        "Tipo_Conexion: $connection_type",
        "Content-Type: application/json",
        "Accept: application/json"
    );
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => TRUE,        // Set the HTTP request method to GET.
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_HEADER => FALSE,        // Don't include the header in the output.
        CURLOPT_RETURNTRANSFER => TRUE, // Return the transfer as a string of the return value of curl_exec()
        CURLOPT_TIMEOUT => CURL_TIMEOUT,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_SSLVERSION => 3,
        CURLOPT_VERBOSE => FALSE
    );
    $response = FALSE;
    try {
        $session = curl_init();                 // Start a new cURL session.
        curl_setopt_array($session, $options);  // Set the cURL options.
        $response = curl_exec($session);        // Make the request and get the response.
       // var_dump($response);
		if($response === FALSE){
            $message = "cURL(call): ". curl_error($session);
            logger($wsname, $message);
        }
    } catch (Exception $e) {
        $message = "cURL(call): ". curl_error($session);
        logger($wsname, $message);
    }
    curl_close($session);                       // Close the cURL session.
    return $response;
}

function encrypt($word) {
    $plublic_key = "518293881492214041749761";
    $e = "$plublic_key";
    $n = '677380655472689127671011';
    $s = 3;
    $c = '';
    for ($i = 0; $i < strlen($word); $i += $s){
        $code = '0';
        for($j=0; $j<$s; $j++){
            $m = strlen($word) > $i + $j ? $word[$i + $j] : ' ';
            $code = bcadd($code, bcmul(ord($m), bcpow('256',$j)));
        }
        $c .= bcpowmod($code, $e, $n) . ' ';
    }
    return $c;
}

function decrypt($message, $key) {
    $d= new Math_BigInteger($key);
    $mensaje='';
    $puente = explode(" ", trim($message));
    $d=new Math_BigInteger($key);
    $encriptado = array(count($puente));
    $BigInteger = array(count($puente));
    $desencriptado = array(count($puente));
    $n  = new Math_BigInteger('677380655472689127671011');
    $strFragmento='';
    for($j = 0; $j < count($puente); $j++){
        $encriptado[$j]=new Math_BigInteger($puente[$j]);
    }
    for($k = 0; $k < count($puente); $k++)
    {
        $desencriptado[$k]=new Math_BigInteger('677380655472689127671011');
        $desencriptado[$k]=bcpowmod ($encriptado[$k], $d, $n);
        $fragmento= $desencriptado[$k];
        $strFragmento='';
        for ($i = 3; $i > 0; $i--)
        {
            $b2=0.0;
            $b2=bcpow('256',$i-1);
            $b1=0.0;
            $b1=bcmod($fragmento , $b2);
            $Divisor = 0.0;
            $Divisor = ($fragmento - $b1)/($b2);
            $fragmento=$b1;
            $letra=chr($Divisor);
            if ($letra != '')
            {
                    $strFragmento=$letra . $strFragmento ;
            }
        }
        $mensaje=$mensaje . $strFragmento;
    }
    return ($mensaje);
}
