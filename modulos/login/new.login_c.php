<?php  
require_once('../../configuracion/path.php');
//require_once('../../configuracion/Debug.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'udea_ws_lib/info_valida_ws.php');
require_once($path['modelo'].'udea_ws_lib/services/authentication_manager.php');
require_once($path['modelo'].'validarMARES/WS/WSClientInfoMares.php');  //soap
require_once('Session.php');
$session = Session::getInstance();

if( isset($_POST["ingresar"])){
	$cedula=$_POST["cedula"];
	$clave=$_POST["clave"];
	$usuario = new UsuarioDTO();
	$usuario->setCedula($cedula);
	$id =$usuario->findId2();
	$usuario=$usuario->find($id);
	//var_dump($usuario);
	//Fragmento de codigo temporal para loggear docentes
				//$session->setVal("usuario_id",$cedula);
				//$session->setVal("rol","docente");
				//$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
				//echo '<script>location.href="../marcos/marco_docente.php";/script>';
			
	//
	
	if($id>0 && (($usuario->getRol()=="comite")||($usuario->getRol()=="auxiliar"))){
			//echo "usuario";
			if($usuario->getNombre()=="admindedo"){
					//$info = new info_valida_ws();
					//$informacion = $info->datosUsuarios("1152455579");
					//$username = "Jean.Herrera";
					//$wsClienteMares = new WSClientInfoMares();
					//$usuario = $info->obtenerDato("8104770","DOCEN");
					//$usuario = $info->obtenerDatos("8127994");
					//$usuario = $info->datosUsuarios("8104770");
					//$usuario = $info->esDocente("8308668","S","DOCEN");
					//$user = $info->validarUsuario("Jean.herrera","Jecaheme10");
					//var_dump($usuario);
					//var_dump($user);
					//exit;
					
				}
			//var_dump($usuario);
			//throw new Exception();
			$usuario=$usuario->find($id);
	
			if($usuario->getClave()==$clave){
				$session->setVal("usuario_id",$id);
				$session->setVal("rol",$usuario->getRol());
				//echo $usuario->getRol();
				$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
				
				switch($session->getVal("rol")){
						case 'auxiliar';
							echo '<script>location.href="../marcos/marco_auxiliar.php"</script>';   	
						break;
						case 'comite'; 
							echo '<script>location.href="../marcos/marco_comite.php"</script>';
						break;
						case 'unidad';
							echo '<script>location.href="../marcos/marco_unidad.php"</script>';
						break;
						case 'docente';
							echo '<script>location.href="../marcos/marco_docente.php"</script>';
				}
			}else{echo "Acceso denegado";}
		
	}else{
		//echo "docente";
		
		//$wsClienteMares = new WSClientInfoMares(true);
		//$cedulaService = $wsClienteMares->validarUsuario($cedula,$clave);
		
		$info = new info_valida_ws(); //Rest
		$cedulaService = $info->validarUsuario($cedula,$clave); 
		//$datos = $info->obtenerDatos("1152455579");
		//var_dump($cedulaService);
		//exit;
		
		
		//$cedulaService = "43724493"; 	
		

		//$cedulaService = "carlos.congote";
		
		//$cedulaService = "10002787"; //profesor Facultad Ing. id=25
		//$cedulaService = "71651602";  //Edison 
	    
		if((strpos($cedulaService,'ERROR')===false)){
			//echo "Entré";
			//var_dump($cedulaService);
			$wsClienteMares = new WSClientInfoMares();  //soap
			//
			//echo "cedula: ".$cedulaService;
			//throw new Exception();
			//var_dump($usuario);
			$consulta = new Criteria("usuarios");
			$consulta->addFiltro("cedula","=",$cedulaService);
			$unidad = $consulta->execute();
			//var_dump($unidad);
			$conteo = $consulta->_count();
			
			if ($conteo>0){
				$usuario2 = new UsuarioDTO();
				$usuario2->setCedula($cedulaService);
				$id = $usuario2->findId2();
				//echo $id;
				$usuario2=$usuario2->find($id);
				if($id>0){
					//echo "id > 0";
					$session->setVal("usuario_id",$cedulaService);
					$session->setVal("rol","unidad");
					$session->setVal("facultad",$usuario2->getNombre());
					$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
					echo '<script>location.href="../marcos/marco_unidad.php"</script>';
				}else{
					echo "Acceso denegado**";
				}
			}else{
				//echo "En este momemto el servicio de validaci&oacute;n no se encuentra disponible. Int&eacute;ntelo de nuevo m&aacute;s tarde. "; //Este mensaje se podría cambiar
			  if(true || $cedulaService=="1152455579") {
				//echo "<script>alert('es docente');</alert>";
				//echo $cedulaService;
				//throw new Exception();

				$docente=new DocenteDTO();
				$docente->setCedula($cedulaService);
				$id=$docente->findId();

				if(!($id)) {
					//var_dump($usuario);
					//throw new Exception();
					/*$info = new info_valida_ws();
					$infoUsuario = $info->datosUsuarios("66761122");
					echo "             respuesta al servicio    datosUsuarios ";
					var_dump($infoUsuario);*/
					
					/*$info = new info_valida_ws();
					$infoUsuario = $info->obtenerDatos("66761122");
					echo "              respuesta al servicio   obtenerDatos  ";
					var_dump($infoUsuario); */
					
					//var_dump($usuario);
					
		
					$facultad = new FacultadDTO;
					
					//var_dump($usuario); // usuario solo tiene: id, cedula, nombre, clave y rol
					$facultad->find($usuario->Facultad());
					$docente->setCedula($cedulaService);
					$docente->setNombre($usuario->Nombres());
					$apellidos = explode(' ', $usuario->Apellidos());
					$docente->setApellido1($apellidos[0]);
					$docente->setApellido2($apellidos[1]);
					$docente->setCorreo($usuario->Correo());
					$docente->setFacultadId($facultad->getId());
					$docente->setCCosto($usuario->CentroCosto());
					$docente->save();
					
					/*$facultad->find($infoUsuario->Facultad());
					$docente->setCedula($cedulaService);
					$docente->setNombre($infoUsuario->Nombres());
					$apellidos = explode(' ', $infoUsuario->Apellidos());
					$docente->setApellido1($apellidos[0]);
					$docente->setApellido2($apellidos[1]);
					$docente->setCorreo($infoUsuario->Correo());
					$docente->setFacultadId($infoUsuario->Facultad());
					$docente->setCCosto($infoUsuario->CentroCosto());
					*/
					//exit;
					//$docente->save();
					

				}
				
				$session->setVal("usuario_id",$cedulaService);
				$session->setVal("rol","docente");
				$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
				echo '<script>location.href="../marcos/marco_docente.php"</script>';			
						
			}/*else{
				//echo "usuario unidad";
				$usuario2 = new UsuarioDTO();
				$usuario2->setCedula($cedulaService);
				$id = $usuario2->findId2();
				//echo $id;
				$usuario2=$usuario2->find($id);
				if($id>0){
					//echo "id > 0";
					$session->setVal("usuario_id",$cedulaService);
					$session->setVal("rol","unidad");
					$session->setVal("facultad",$usuario2->getNombre());
					$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
					echo '<script>location.href="../marcos/marco_unidad.php"</script>';	
				}else{
					echo "Acceso denegado**";	
				}*/
			}
		}else{
			echo utf8_decode("El usuario o la contraseña son incorrectos.");	
		}	
	}
}

?>