<?php 

require_once 'modulos/login/Session.php';
require_once 'configuracion/path.php';

    function getUserData($identification){
		
		$url = 'https://udearroba.udea.edu.co/udearrobaoauth/consulta_empleados';
        $payload = array("id"=> $identification);
        
        $output = sendRequest($url, $payload);
        
        return json_encode($output);
    }
    
    function user_login($username, $password) {
        
		
		$session = Session::getInstance();
		$path = asignarPath(dirname(__FILE__));
        $url = 'https://udearroba.udea.edu.co/udearrobaoauth/login';
        $payload = array("username"=> $username, "password" => $password);
        
        $output = sendRequest($url, $payload);
		
        if($output->result == "success"){
			$session->setVal("usuario_id", $output->identification);
			require($path['modulos'] . 'login/login_c.php');
			      
            // Store data in session variables
            
            //var_dump($this->getUserData($output->identification));
			//var_dump($this->getUserData(7186317));
			
        }else{
           echo'<script type="text/javascript">
    		alert("Datos inv\u00E1lidos");
			location.href="../../index.php";
    		</script>';
        }
		
    }
    
    function sendRequest($url, $payload, $auth_token=null){
        
        $payload = json_encode($payload);
        
        $ch = curl_init();    
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , "X-Request-Token: 374ed29af04282e8030137df30915ee78309e652835a5dfe363836dbc70c6db8" ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        $output = curl_exec($ch);
        $output = json_decode($output);
        curl_close($ch);
        
        return $output;
        
    }
    
