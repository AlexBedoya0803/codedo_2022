<?php

	include($path['modelo'].'udea_ws_lib/info_valida_ws.php');
	
	
	function validateUser($username,$password)
		{
			$wsClienteMares = new info_valida_ws();
			
			$res = false;
			echo $res;
			
			$username = strtolower($username);
			
							
			if (is_numeric($username)){

				try{
					$wsClienteMares->validarUsuario($username,$password);
				}catch(TException $e){
					//ERROR EN EL SERVICIO WEB;
				}
				
				//espera a que termina la ejecucion del servicio web y que el resultado sea valido
				while (!$wsClienteMares->terminoSOAP);

				if($wsClienteMares->IsUserValid){	
					return true; 
				}
                echo $res;
				return $res;
			}
             echo $res;
			return $res;
			
		}
		
		//RECEPCION DE DATOS POR POST
		
		//Llamado a función de validación	
		/*$username = '1128265612';// Prueba
		$wsClienteMares = new WSClientInfoMares();
		$usuario = $wsClienteMares->datosUsuario($username);
		$nombreCompleto= $usuario->Nombres();
		$nombreCompleto.= ' '.$usuario->Apellidos();
		echo $nombreCompleto;*/
		//validateUser($usuario, $clave);
		
		
		
?>