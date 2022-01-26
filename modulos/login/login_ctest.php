<?php

require_once('../../configuracion/path.php');

$path = asignarPath(dirname(__FILE__));
require_once($path['modelo'] . 'criteria.php');
require_once($path['modelo'] . 'clasesDTO.php');
require_once($path['modelo'] . 'udea_ws_lib/info_valida_ws.php');
require_once($path['modelo'] . 'udea_ws_lib/services/authentication_manager.php');
require_once('Session.php');
$session = Session::getInstance();
$info = new info_valida_ws(); //Rest

if (isset($_POST["ingresar"])) {
    $cedula = $_POST["cedula"];
    $clave = $_POST["clave"];
    $usuario = new UsuarioDTO();
    $usuario->setCedula($cedula);
    $id = $usuario->findId2();
    $usuario = $usuario->find($id);

    if ($id > 0 && (($usuario->getRol() == "comite") || ($usuario->getRol() == "auxiliar"))) { //Identifica si el usuario tiene como Rol comité o Auxiliar
        $usuario = $usuario->find($id);

        if ($usuario->getClave() == $clave) {//Verifica que la clave de ese usuario corresponda a la ingresada por el usuario
            $session->setVal("usuario_id", $id);
            $session->setVal("rol", $usuario->getRol());
            $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));

            switch ($session->getVal("rol")) { //Carga las vistas correspondientes al rol del usuario
                case 'auxiliar';
                    echo '<script>location.href="../marcos/marco_auxiliar.php"</script>';
                    break;
                case 'comite';
                    echo '<script>location.href="../marcos/marco_comite.php"</script>';
                    break;
            }
        } else {
            echo "Acceso denegado";
        } //En caso de que no coincidan las claves, no permite acceder al aplicativo.
    } else { //Si no es comité o auxiliar, verifica que el usuario sea una "unidad"
		if(0==1){ ////Para que omita el consumo de servicios universitarios mientras se soluciona el problema.-------------------------------------------------
			 $cedulaService = $info->validarUsuario($cedula, $clave);
		}else{
			$cedulaService= $cedula;
		}
		//$cedulaService= "71693521";
        if ((strpos($cedulaService, 'error') === false)  ) {
			
            $consulta = new Criteria("usuarios");
            $consulta->addFiltro("cedula", "=", $cedulaService);
            $unidad = $consulta->execute();
			$conteo = $consulta->_count();
						
            if ($conteo > 0) { //Si encuentra que el usuario está en la tabla usuarios
                $usuario2 = new UsuarioDTO();
                $usuario2->setCedula($cedulaService);
                $id = $usuario2->findId2();
                $usuario2 = $usuario2->find($id);
			
				
                if ($id > 0) { //en caso de que el usuario sea una unidad le permite su ingreso
                    $session->setVal("usuario_id", $cedulaService);
                    $session->setVal("rol", "unidad");
                    $session->setVal("facultad", $usuario2->getNombre());
                    $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
                    echo '<script>location.href="../marcos/marco_unidad.php"</script>';
                } else {
                    echo "Acceso denegado**";
                }
            } else { //Si no es comité, auxiliar o unidad, el usuario es un docente.
					
					
                    $docente = new DocenteDTO();
                    $docente->setCedula($cedulaService);
                    $id = $docente->findId();	
					
			    if(0==1){ //Para que omita el consumo de servicios universitarios mientras se soluciona el problema.----------------------------
				     if (!($id)) { //en caso de que el docente no esté en la base de datos
					 $infoDocente = $info->obtenerDatos($cedulaService); //se busca informacion del docente para ingresarlo a la base de datos.
					 if($infoDocente===NULL) echo utf8_decode("El servicio de validación está presentando problemas técnicos, por favor inténtelo más tarde."); return;
					 if(!empty($infoDocente)){ //Si el usuario es un docente se registra en la base de datos TERMINAR
					 
						$docente->setCedula($cedulaService);
						$docente->setNombre($infoDocente[9]);
						$docente->setApellido1($infoDocente[12]);
						$docente->setApellido2($infoDocente[13]);
						$docente->setCorreo($infoDocente[5]);
						$cCosto =$infoDocente[2];
						$centroCosto = new CcostoXFacultadDTO();
						$centroCosto->setCcosto($cCosto);
						$idCc = $centroCosto->findId();	
						$centroCosto = $centroCosto->find($idCc);
						$docente->setNCCosto($centroCosto->getNombreCcosto());
						$docente->setFacultadId($centroCosto->getFacultadId());
						//var_dump($idCc);
						
					   // $docente->save();
						//var_dump($docente);
						$session->setVal("usuario_id", $cedulaService);
						$session->setVal("rol", "docente");
						$session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
						echo '<script>location.href="../marcos/marco_docente.php"</script>';
						}else {
							echo "Acceso denegado, el usuario no es docente";				
						}
					}else{
						$session->setVal("usuario_id", $cedulaService);
						$session->setVal("rol", "docente");
						$session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
						echo '<script>location.href="../marcos/marco_docente.php"</script>';
					}
				}else{
					if($id){
						$session->setVal("usuario_id", $cedulaService);
						$session->setVal("rol", "docente");
						$session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
						echo '<script>location.href="../marcos/marco_docente.php"</script>';
					}else{
							echo utf8_decode("Se han presentado inconvenientes con el ingreso. Por favor comuniquese a la extensión 8110.");
						}		
					
				} //Fin del if 
               
                  
                }
				
					
        } else {
			if(strpos($cedulaService, 'incorrectos') !== false){
				 echo utf8_decode("El usuario o contraseña son incorrectos");
			}else{
				echo utf8_decode("El servicio de validación está presentando problemas técnicos, por favor inténtelo más tarde."); 
			}
        }
    }
}
?>