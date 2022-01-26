<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="" || $session->getVal("rol")!="comite") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
require_once('../../../modelo/clasesDTO.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
$numero = count($_GET);
$contenido = "";
if($numero) {
	$id = $_GET['id'];
	$solicitud = new SolicitudDTO();
	$solicitud=$solicitud->find($id);
	
	$consulta = new Criteria("actas");
	$consulta->addFiltro("abierta","=",1);
	$actas=$consulta->execute();

	if( isset($_POST["reagendar"])) {
		$id=$solicitud->getId();
		$solicitud->setActaId($_POST["actas"]);
		$solicitud->update($id);
	}
	if( isset($_POST["guardar"])) {
		$tipo;
		if($solicitud->getTipoSolicitud()==10){
			$tipo = "autocompletarAca";
		}else{
			$tipo = "autocompletar";	
		}
		/*valida que la respuesta sea afirmativa*/
		if($_POST["respuesta"]) {
			if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
				$votacion = new VotacionDTO();
				$votacion->setSolicitud_id($solicitud->getId());
				$votacion->setUsuario($session->getVal("usuario_id"));
				$votacion->setVotacion(1);
				$votacion->setComentarios($_POST["recomendacion"]);
				$votacion->saveVotacion();
			}
			//obtener total usuarios comision
			$criteria = new Criteria("votaciones");
			$query = 'select * from
						(select count(rol) from usuarios where rol="comite" group by rol) as usuarios,
						(select sum(votacion),count(votacion) from votaciones where solicitud_id="'.$solicitud->getId().'")as votos;';
			$votos = $criteria->executeQuery($query);
			if(!$votos){
				echo "error ";	
			}else{
				$registro = mysql_fetch_array($votos);
				$usuariosComite =  $registro["count(rol)"];
				$conteoVotos = $registro["sum(votacion)"];
				$totalVotos = $registro["count(votacion)"];
				
				if($usuariosComite==$conteoVotos){ //todos votaron que si
					todosVotanSi($tipo,$solicitud);
					/*
					$recomendacion = autocompletar($tipo,"si",$solicitud);
					echo "todos votan si";
					$id=$solicitud->getId();
					$solicitud->setRespuestaId(1);
					$solicitud->setRecomendacion();
					$solicitud->update();				
					echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
					*/
					
				}else if($usuariosComite==$totalVotos && $conteoVotos>0){ //algun integrante del comite voto que no
					noTodosVotanSi($solicitud);
					/*
					echo "no todos votan si";
					$id=$solicitud->getId();
					$solicitud->setRespuestaId(0);
					$solicitud->setRecomendacion("");
					$solicitud->update();				
					echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
					*/
				}else if($usuariosComite==$totalVotos && $conteoVotos==0){
					todosVotanNo($tipo,$solicitud);
					//todos votaron que no
					//echo "todos votan no";
				}
			}
			//obtener total votaciones
			//obtener suma votaciones
			
			//Esto se hace cuando todos los usuarios comision hallan botado afirmativamente
			/*
			$id=$solicitud->getId();
			$solicitud->setRespuestaId(1);
			$solicitud->setRecomendacion($_POST["recomendacion"]);
			$solicitud->update();				
			echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			*/
		}else{
			//echo "vota que no";
			if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
				$votacion = new VotacionDTO();
				$votacion->setSolicitud_id($solicitud->getId());
				$votacion->setUsuario($session->getVal("usuario_id"));
				$votacion->setVotacion(0);
				$votacion->setComentarios($_POST["recomendacion"]);
				echo $votacion->getVotacion();
				$votacion->saveVotacion();
			}
			//obtener total usuarios comision
			$criteria = new Criteria("votaciones");
			$query = 'select * from
						(select count(rol) from usuarios where rol="comite" group by rol) as usuarios,
						(select sum(votacion),count(votacion) from votaciones where solicitud_id="'.$solicitud->getId().'")as votos;';
			$votos = $criteria->executeQuery($query);
			if(!$votos){
				echo "error ";	
			}else{
				$registro = mysql_fetch_array($votos);
				$usuariosComite =  $registro["count(rol)"];
				$conteoVotos = $registro["sum(votacion)"];
				$totalVotos = $registro["count(votacion)"];
				
				if($usuariosComite==$conteoVotos){ //todos votaron que si
					todosVotanSi($tipo,$solicitud);
					//echo "todos votan si";
				}else if($usuariosComite==$totalVotos && $conteoVotos>0){ //algun integrante del comite voto que no
					noTodosVotanSi($solicitud);
					/*
					echo "no todos votan si";
					$id=$solicitud->getId();
					$solicitud->setRespuestaId(0);
					$solicitud->setRecomendacion("");
					$solicitud->update();				
					echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
					*/
				}else if($usuariosComite==$totalVotos && $conteoVotos==0){ //todos votan no
					todosVotanNo($tipo,$solicitud);
					/*
					echo "todos votan no";
					$id=$solicitud->getId();
					$solicitud->setRespuestaId(2);
					$solicitud->setRecomendacion($_POST["recomendacion"]);
					$solicitud->update($id);
					echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
					*/
				}
				echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			}
			
			
			/*			
			$id=$solicitud->getId();
			$solicitud->setRespuestaId(2);
			$solicitud->setRecomendacion($_POST["recomendacion"]);
			$solicitud->update($id);
			echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			*/
			//echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"/script>";
		}
    	 echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
	}
	
}

function autocompletar($tipo,$respuesta,$solicitud){ //Genera la recomendación para el acta
	if( $tipo=="autocompletar") {
		if($respuesta=="si")  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipoComisionId()==1) 
			$tipoComision = "de estudios";
		else 
			$tipoComision = "posdoctoral";
		
		switch($solicitud->getTiposolicitudId()){ //verifica que tipo de solicitud es
			case 1:
				$tipo = "comisión";
				break;
			case 2:
				$tipo = "modificación de su comisión";
				break;
			case 3:
				$tipo = "prórroga de su comisión";
				break;
			case 4:
				$tipo = "informe de su comisión";
				break;
			case 5:
				$tipo = "cancelación de su comisión";
				break;
			case 6:
				$tipo = "renuncia de su comisión";
				break;
			case 7:
				$tipo = "suspensión de su comisión";
				break;
			case 8:
				$tipo = "reintegro anticipado con grado de su comisión";
				break;
			case 9:
				$tipo = "reintegro anticipado sin grado de su comisión";
				break;
			case 10:
				$tipo = "prórroga excepcional de su comisión";
				break;
			case 11:
				$tipo = "plazo para cumplir compromisos de su comisión";
				break;
			case 12:
				$tipo = "reintegro sin grado de su comisión";
				break;
			case 13:
				$tipo = "prórroga de la suspención de su comisión";
				break;	
			}
			
		$docente = $solicitud->getDocente();
		
				if($solicitud->getTiposolicitudId()==10){ //Verifica si es prórroga excepcional
			$contenido = "El Consejo Académico ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".utf8_decode($tipo)." ".$tipoComision.",  remunerada con el 100% de su salario básico mensual, con una dedicación del 100% de su jornada, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2().".";
		}else{
			$contenido = "La Vicerrectora de Docencia ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." ".$tipoComision.",  remunerada con el 100% de su salario básico mensual, con una dedicación del 100% de su jornada, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2().".";
		}	
	}
	return $contenido;
}



function todosVotanSi($tipo,$solicitud){
	if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
		$recomendacion = autocompletar($tipo,"si",$solicitud);
		//echo "todos votan si";
		$id=$solicitud->getId();
		$solicitud->setRespuestaId(1);
		$solicitud->setRecomendacion($recomendacion);
		$solicitud->setEstadoId(3);
		$solicitud->update();
	}
	echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
}

function todosVotanNo($tipo,$solicitud){
	if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
		$recomendacion = autocompletar($tipo,"no",$solicitud);
		echo $solicitud->getRespuestaId();
		//echo "todos votan no";
		$id=$solicitud->getId();
		$solicitud->setRespuestaId(2);
		$solicitud->setEstadoId(4);
		$solicitud->setRecomendacion($recomendacion);
		$solicitud->update($id);
	}
	echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
}

function noTodosVotanSi($solicitud){
	echo "no todos votan si ";
	//echo "** ".$solicitud->getActaId();
	
	//$id=$solicitud->getId();
	//$solicitud->setRespuestaId(0);
	//$solicitud->setRecomendacion("");
	//$solicitud->update();
					
	echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
}
?>
