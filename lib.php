<?php 
/**
require_once('./configuracion/path.php');
require_once('./modulos/login/Session.php');
**/


class lib{
	
    
    public function getUserData($identification){
        /**
        $url = 'https://udearroba.udea.edu.co/udearrobaoauth/user_information';
        $payload = array("id"=> $identification);
        
        $output = $this->sendRequest($url, $payload);
        
        return json_encode($output);
		**/
		
		$url = 'https://udearroba.udea.edu.co/udearrobaoauth/consulta_empleados';
        $payload = array("id"=> $identification);
        
        $output = $this->sendRequest($url, $payload);
        
        return json_encode($output);
    }
    
    function user_login($username, $password) {
        
		
		//$session = Session::getInstance();
		//$path = asignarPath(dirname(__FILE__));
        $url = 'https://udearroba.udea.edu.co/udearrobaoauth/login';
        $payload = array("username"=> $username, "password" => $password);
        
        $output = $this->sendRequest($url, $payload);
        var_dump($output);
        if($output->result == "success"){
            echo 'Success';
			//$session->setVal("usuario_id", $output->identification);
			//require($path['modulos'] . 'login/login_c.php');
			
			      
            // Store data in session variables
            
            var_dump($this->getUserData($output->identification));
			//var_dump($this->getUserData(7186317));
			
			// No se necesita, por ahora, lo de arriba sí.
			
			/**
            session_start();        
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["identification"] = $output->identification;
            $_SESSION["userdata"] = $this->getUserData($output->identification);
            
            header("location: ../view/index.php");
            **/
        }else{
            echo 'Error';
           // header("location: ../index.php");       
            
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
    
}