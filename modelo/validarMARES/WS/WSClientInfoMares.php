<?php

	require_once("nusoap/lib/nusoap.php");
	require_once("WSUsuario.php");
	
	class WSClientInfoMares
	{
		private $nusoapClient;
		
		private $aParam=array(
		"serviciowebMARES"=>"http://mares.udea.edu.co/cci/mares.sw.php",
		"serviciowebMARESValidar"=>"http://www2.udea.edu.co/wsAutenticaOid/WSAutenticarOid",
		"serviciowebMARESmetodoObtenerDatos"=>"obtenerDatos",
		"serviciowebMARESmetodoValidar"=>"AutenticaLogin"	
		);
	
		
		
		public $terminoSOAP = false;
		
		public $IsUserValid;
		
		public function __construct($validar = NULL)
		{
			if($validar){
				$wsdlMares = $this->aParam["serviciowebMARESValidar"];
			}else{				
				$wsdlMares = $this->aParam["serviciowebMARES"];
			}
			
			$this->nusoapClient = new nusoapclient($wsdlMares,false); //I.F. Cambio: 2008-03-19; cirano
			
			$err = $this->nusoapClient->getError();
			if($err)
				throw new TException('Error contruyendo el cliente del servicio web: ' . $err);
		}
		
		public function validarUsuario($cedula,$clave)
		{
			
			//encriptar clave
			$e = '105337396879944889886675';
            $n = '677380655472689127671011';
            $s = 3;
            $mensaje = $clave;
            $c = '';
            for ($i = 0; $i < strlen($mensaje); $i += $s){
                $codigo = '0';
                for($j=0; $j<$s; $j++){
                    $m = strlen($mensaje) > $i + $j ? $mensaje[$i + $j] : ' ';
                    $codigo = bcadd($codigo, bcmul(ord($m), bcpow('256',$j)));
                }

                $c .= bcpowmod($codigo, $e, $n) . ' ';
            }
            
            $sEncripcion = $c;
			//
			$params = array('sUsuario'=>$cedula,'sEncripcion'=>$sEncripcion);
			$metodoValidar = $this->aParam["serviciowebMARESmetodoValidar"];
			$resultado = $this->nusoapClient->call($metodoValidar,$params); //I.F. Cambio: 2008-03-19; cirano
			$err = $this->nusoapClient->getError();
			if($err){
				//Prado::log("Termino con ERROR servicio web" ,TLogger::INFO,"System.Web.UI.TPage");
				//echo "error: ".$err;				
				//$ex = new TException("");
				//$ex->setErrorCode("E001");
				//throw $ex;
			}
			
			//Prado::log("Antes de terminar llamada al servicio web" ,TLogger::INFO,"System.Web.UI.TPage");
			$this->IsUserValid = ($resultado==1) ? true: false;
			$this->terminoSOAP = true;
			
			return $resultado;
		}
		
		public function esDocente($cedula)
		{
			//I. Nuevo: 2008-03-19; cirano
			
			$metodoObtenerDatos = $this->aParam["serviciowebMARESmetodoObtenerDatos"];
			//F. Nuevo: 2008-03-19; cirano

			$params = array('sUsuario'=>$cedula);
			$resultado = $this->nusoapClient->call($metodoObtenerDatos,$params); //I.F. Cambio: 2008-03-19; cirano
			
			$err = $this->nusoapClient->getError();
			if($err)
				throw new TException('Error llamando un método del servicio web: ' . $err);
			
			$temp = explode('|',$resultado);
			//var_dump($temp);
			
			
			if(!strstr($temp[0],'P'))
				return false;
			else
				return true;
		}
		
		public function obtenerDatos($cedula)
		{
			//I. Nuevo: 2008-03-19; cirano
			
			$metodoObtenerDatos = $this->aParam["serviciowebMARESmetodoObtenerDatos"];
			//F. Nuevo: 2008-03-19; cirano

			$params = array('sUsuario'=>$cedula);
			$resultado = $this->nusoapClient->call($metodoObtenerDatos,$params); //I.F. Cambio: 2008-03-19; cirano
			
			$err = $this->nusoapClient->getError();
			if($err)
				throw new TException('Error llamando un método del servicio web: ' . $err);			
			
			$temp = explode('|',$resultado);
			
			$datos = explode(',',$temp[1]);
								
			return $datos;
		}
		
		public function datosUsuario($cedula)
		{
			//I. Nuevo: 2008-03-19; cirano
			$metodoObtenerDatos = $this->aParam["serviciowebMARESmetodoObtenerDatos"];
			//F. Nuevo: 2008-03-19; cirano

			$params = array('sUsuario'=>$cedula);
			$resultado = $this->nusoapClient->call($metodoObtenerDatos,$params); //I.F. Cambio: 2008-03-19; cirano
			
			//$resultado = utf8_encode($resultado);
			
			$err = $this->nusoapClient->getError();
			//if($err)
				//throw new TException('Error llamando un método del servicio web: ' . $err);			
			
			$usuario = new WSUsuario();
			
			$aDatos = explode('#',$resultado);
			
			if (count($aDatos) < 3) {
				return NULL;
			}
			
			$aPersonales = explode('|', $aDatos[0]);
			
			if (count($aPersonales) < 4) {
				return NULL;
			}

			$usuario->Activo($aPersonales[0] == 'S' ? true : false);
			$usuario->Nombres($aPersonales[1]);
			$usuario->Apellidos($aPersonales[2]);
			$usuario->Correo($aPersonales[3]);

			
			$aLaborales = explode(';', $aDatos[2]);
			foreach ($aLaborales as $vinculacion) {
				$datosvinculo = explode('-', $vinculacion);
				if (count($datosvinculo) > 2){
					if ($datosvinculo[0] == 'DOCEN'){
						$usuario->EsDocente(true);
						$usuario->Facultad(substr($datosvinculo[2], -2, 2));
						$usuario->CentroCosto($datosvinculo[1]);
						break;
					}
				}
			}
			
			return $usuario;
		}

	}
?>
