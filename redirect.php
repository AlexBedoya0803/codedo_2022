<?php

require_once('./configuracion/path.php');
require_once('./modulos/login/Session.php');

$session = Session::getInstance();
$path = asignarPath(dirname(__FILE__));
$conf = $path['modulos'] . 'login/configuracion.json';
$configuration = json_decode(file_get_contents($conf));

$authorizationCode = $_GET['code']; // se obtiene el código de autorización proporcionado por el oauth

if (!empty($authorizationCode)) { //verifica que el codigo no esté vacio
    $params = array(//Parámetros para obtener el token de autorizacion
        'client_id' => $configuration->oauthCredencials->client_id,
        'redirect_uri' => $configuration->oauthCredencials->redirect_uri,
        'client_secret' => $configuration->oauthCredencials->client_secret,
        'code' => $authorizationCode,
        'grant_type' => $configuration->oauthCredencials->grant_type);

    $curl = curl_init($configuration->oauthCredencials->token_uri);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, 'Content-Type: application/x-www-form-urlencoded');
   // curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    $postData = "";

//se codifican los parámetros
    foreach ($params as $k => $v) {
        $postData .= $k . '=' . urlencode($v) . '&';
    }

    $postData = rtrim($postData, '&');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    $json_response = curl_exec($curl); // se ejecuta la peticion para obtener el token

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// evalua la respuesta exitosa
    if ($status != 200) {
        throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
    }
    curl_close($curl);

//Parámetros para obtener información del usuario
    $json = json_decode($json_response, true);
    $accesToken = $json['access_token'];

    if (!empty($accesToken)) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://aprendeenlinea.udea.edu.co/oauth/?action=me&access_token=' . $accesToken . '&alt=json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//obtenemos la respuesta
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// evalua la respuesta exitosa
        if ($status != 200) {
            throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
        } else {
            $json = json_decode($response, true);
            $session->setVal("usuario_id", $json['user_login']);
			require($path['modulos'] . 'login/login_c.php');
			
        }

// Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($curl);
    } else {
    	throw new Exception(utf8_decode("Error: usuario no autorizado, inténtelo nuevamente. \n"));
	}
} else {
    throw new Exception(utf8_decode("Error: usuario no autorizado, inténtelo nuevamente. \n"));
}
?>
  

