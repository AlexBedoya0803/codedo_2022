<?php
var_dump($_GET['code']);

   $params = array(
  		'client_id' => "deFDj24IQpBBuN5dy6hCScodedoI5M",
		'redirect_uri' => "http://avido.udea.edu.co/dedo/modulos/login/redirect.php",
		'client_secret' => "on140kb231rECVdI24OcDG06UnidTgeC",
		'code' => $_GET['code'], // The code from the previous request
		'grant_type' => 'authorization_code');

	$curl = curl_init( 'https://aprendeenlinea.udea.edu.co/oauth/?action=auth' );
	curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');

	$postData = "";

//This is needed to properly form post the credentials object
	foreach($params as $k => $v)
	{
	   $postData .= $k . '='.urlencode($v).'&';
	}
	
	$postData = rtrim($postData, '&');
	
	var_dump($postData);

	curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
echo "Performing Request...";

$json_response = curl_exec($curl);
var_dump($json_response);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// evaluate for success response
if ($status != 200) {
  throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
}
curl_close($curl);

return $json_response;
	
?>
<h1>Test</h1>

