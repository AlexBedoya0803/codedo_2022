<?php 

require_once($path['modelo'] . 'criteria.php');
require_once($path['modelo'] . 'clasesDTO.php');
require_once($path['modelo'] . 'udea_ws_lib/info_valida_ws.php');
require_once($path['modelo'] . 'udea_ws_lib/services/authentication_manager.php');
require_once('Session.php');

$session = Session::getInstance();
$info = new info_valida_ws(); //Rest

$cedula = $session->getVal("usuario_id");
$usuario = new UsuarioDTO();
//$cedula="71266740";
$usuario->setCedula($cedula);
$id = $usuario->findId2();
$usuario = $usuario->find($id);

if ($id > 0 && (($usuario->getRol() == "comite") || ($usuario->getRol() == "auxiliar"))) { //Identifica si el usuario tiene como Rol comité o Auxiliar
    $session->setVal("usuario_id", $id);
    $session->setVal("rol", $usuario->getRol());
    $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
	$_SESSION['status']= "true";
    switch ($session->getVal("rol")) { //Carga las vistas correspondientes al rol del usuario
        case 'auxiliar';
            echo '<script>location.href="./modulos/marcos/marco_auxiliar.php"</script>';
            break;
        case 'comite';
            echo '<script>location.href="./modulos/marcos/marco_comite.php"</script>';
            break;
    }
} else { //Si no es comité o auxiliar, verifica que el usuario sea una "unidad"

    $consulta = new Criteria("usuarios");
    $consulta->addFiltro("cedula", "=", $cedula);
    $unidad = $consulta->execute();
    $conteo = $consulta->_count();

    if ($conteo > 0) { //Si encuentra que el usuario está en la tabla usuarios
        $usuario2 = new UsuarioDTO();
        $usuario2->setCedula($cedula);
        $id = $usuario2->findId2();
        $usuario2 = $usuario2->find($id);

        if ($id > 0) { //en caso de que el usuario sea una unidad le permite su ingreso
			$_SESSION['status']= "true";
            $session->setVal("usuario_id", $cedula);
            $session->setVal("rol", "unidad");
            $session->setVal("facultad", $usuario2->getNombre());
            $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
            echo '<script>location.href="./modulos/marcos/marco_unidad.php"</script>';
		}
    } else { //Si no es comité, auxiliar o unidad, el usuario es un docente.

            $docente = new DocenteDTO();
            $docente->setCedula($cedula);
            $id = $docente->findId();

            if (!($id)) { //en caso de que el docente no esté en la base de datos
                $infoDocente = $info->obtenerDatos($cedula); //se busca informacion del docente para ingresarlo a la base de datos.

                if ($infoDocente === NULL) {
                    echo utf8_decode("El servicio de validación está presentando problemas técnicos, por favor inténtelo más tarde.");
                    return;
                }
			
                if (!empty($infoDocente) && !strpos($infoDocente[0], 'no es docente') ) { //Si el usuario es un docente se registra en la base de datos  
				
                    $docente->setCedula($cedula);
                    $docente->setNombre($infoDocente[9]);
                    $docente->setApellido1($infoDocente[12]);
                    $docente->setApellido2($infoDocente[13]);
                    $docente->setCorreo($infoDocente[5]);
                    $cCosto = $infoDocente[2];
                    $docente->setCCosto($cCosto);
                    $centroCosto = new CcostoXFacultadDTO();
                    $centroCosto->setCcosto($cCosto);
                    $idCc = $centroCosto->findId();
                    $centroCosto = $centroCosto->find($idCc);
                    $docente->setNCCosto($centroCosto->getNombreCcosto());
                    $docente->setFacultadId($centroCosto->getFacultadId());
					$docente->save();
				
					$_SESSION['status']= "true";
                    $session->setVal("usuario_id", $cedula);
                    $session->setVal("rol", "docente");
                    $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
                    echo '<script>location.href="./modulos/marcos/marco_docente.php"</script>';
                } else {
					$_SESSION['status']= "false";
					echo '<script>location.href="./modulos/login/login-Copia.php"</script>';
          }
			}else{
			  		$_SESSION['status']= "true";
                    $session->setVal("usuario_id", $cedula);
                    $session->setVal("rol", "docente");
                    $session->setVal("ultimoAcceso", date("Y-n-j H:i:s"));
                    echo '<script>location.href="./modulos/marcos/marco_docente.php"</script>';
		  }
      }
}
?>