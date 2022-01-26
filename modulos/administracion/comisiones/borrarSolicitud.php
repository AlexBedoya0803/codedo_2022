<?php 
	require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
	require_once('../../../configuracion/path.php');
	$path=asignarPath(dirname(__FILE__));
	require_once('./MsgError.php');
	MsgError::getMsgError("Error","");
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	$consulta = new Criteria("solicitudes");
	$id= $_GET['id'];
	$consulta->addFiltro("id","=",$id);
	$solicitud=$consulta->execute();
	require_once('../../login/Session.php');
	$session = Session::getInstance();
	

	if(isset($solicitud)){
		$solicitudPendiente = new SolicitudDTO();
		$solicitudPendiente = $solicitudPendiente->find($id);
		if($session->getVal("rol")=="auxiliar"){
		$solicitudPendiente->delete();
		eliminarDir($id);
		echo '
				<script>
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML =  "../solicitudes/consulta1.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud ha sido eliminada correctamente";
					document.getElementById("myModal").style.display="block";
					
				</script>		
			';
		}else{
			
			if($session->getVal("rol")=="docente" && $solicitudPendiente->getDocenteId()== $session->getVal("usuario_id")){
				$solicitudPendiente->delete();
				eliminarDir($id);
				echo '
					<script>
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "La solicitud ha sido eliminada correctamente";
						document.getElementById("myModal").style.display="block";
						
					</script>		
				';
			}else{
					echo '
					<script>
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "Usted no tiene permisos para eliminar la solicitud";
						document.getElementById("myModal").style.display="block";
						
					</script>		
				';
				}
			
			}
	}
		
		
	function eliminarDir($carpeta){
	$carpeta= '../../../anexos/'.$carpeta;
    foreach(glob($carpeta . "/*") as $archivos_carpeta){
        if (is_dir($archivos_carpeta)) {
            eliminarDir($archivos_carpeta);
        }
        else{
            unlink($archivos_carpeta);
        }
	}
    rmdir($carpeta);
	}
			
	
?>