<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
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
		$solicitud->setEstadoId(3);
		$solicitud->update($id);
	}
	if( isset($_POST["guardar"])) {
		/*si se crea una prorroga -> se crea una prorroga, se actualiza la comision y la solicitud
		/*valida que la respuesta sea afirmativa*/
		if($_POST["respuesta"]) {
			/* valida que la solicitud sea nueva*/
			if($solicitud->getTipoSolicitudId()==1) {
				if($solicitud->getRespuestaId()!=1) {
					$comision=new ComisionDTO();
					$comision->setMotivoId($solicitud->getMotivoId());
					$comision->setDedicacionId($solicitud->getDedicacionId());
					$comision->setDocenteId($solicitud->getDocenteId());
					$comision->setLugar($solicitud->getLugar());
					$comision->setObjetivo($solicitud->getObjetivo());
					$comision->setObservaciones($solicitud->getObservaciones());
					$comision->setFecha1($solicitud->getFecha1());
					$comision->setFecha2($solicitud->getFecha2());
					$comision->setFechaf($solicitud->getFecha2());
					$comision->setPaisId($solicitud->getPaisId());
					$comision->setTipoComisionId($solicitud->getTipoComisionId());
					$comision->setActaId($solicitud->getActaId());
					$comision->setFacultadId($solicitud->getFacultadId());
					$comision->setEstadoId($solicitud->getEstadoId());
					$comision->save();
				}
				$id=$solicitud->getId();
				$solicitud->setEstadoId(6);
				$solicitud->setRespuestaId(1);
				$solicitud->setRecomendacion($_POST["recomendacion"]);
				$solicitud->setComisionId($comision->getId());
				$solicitud->update();
				
				echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			}
		
			/* valida que la solicitud sea prorroga*/
			else if($solicitud->getTiposolicitudId()==3) {
				if($solicitud->getRespuestaId()!=1) {
					$prorroga=new ProrrogaDTO();
					$prorroga->setDedicacionId($solicitud->getDedicacionId());
					$prorroga->setFecha1($solicitud->getFecha1());
					$prorroga->setFecha2($solicitud->getFecha2());
					$prorroga->setComisionId($solicitud->getComisionId());
					$prorroga->setActaId($solicitud->getActaId());
					$prorroga->setFacultadId($solicitud->getFacultadId());
					$prorroga->save();
					$id=$prorroga->getComisionId();
					$comision=$prorroga->getComision();
					$comision->saveBackup();
					$comision->setFechaf($solicitud->getFecha2());
					$comision->update();	
				}
				$id=$solicitud->getId();
				$solicitud->setEstadoId(6);
				$solicitud->setRespuestaId(1);
				$solicitud->setRecomendacion($_POST["recomendacion"]);
				$solicitud->setComisionId($comision->getId());
				$solicitud->update();
				echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			}
			
			/* valida que la solicitud sea modificacion*/
			else if($solicitud->getTiposolicitudId()==2){
				if($solicitud->getRespuestaId()!=1) {
					$modificacion=new ModificacionDTO();
					$modificacion->setMotivoId($solicitud->getMotivoId());
					$modificacion->setDedicacionId($solicitud->getDedicacionId());
					$modificacion->setLugar($solicitud->getLugar());
					$modificacion->setObjetivo($solicitud->getObjetivo());
					$modificacion->setFecha1($solicitud->getFecha1());
					$modificacion->setFecha2($solicitud->getFecha2());
					$modificacion->setPaisId($solicitud->getPaisId());
					$modificacion->setComisionId($solicitud->getComisionId());
					$modificacion->setActaId($solicitud->getActaId());
					$modificacion->setFacultadId($solicitud->getfacultadId());
					$modificacion->setTipoComisionId($solicitud->getTipoComisionId());
					$modificacion->save();
					$id=$modificacion->getComisionId();
					$comision=$modificacion->getComision();
					$comision->setMotivoId($solicitud->getMotivoId());
					$comision->setDedicacionId($solicitud->getDedicacionId());
					$comision->setDocenteId($solicitud->getDocenteId());
					$comision->setLugar($solicitud->getLugar());
					$comision->setObjetivo($solicitud->getObjetivo());
					$comision->setObservaciones($solicitud->getObservaciones());
					$comision->setFecha1($solicitud->getFecha1());
					$comision->setFecha2($solicitud->getFecha2());
					$comision->setPaisId($solicitud->getPaisId());
					$comision->setFacultadId($solicitud->getfacultadId());
					$comision->update();		
				}
				$id=$solicitud->getId();
				$solicitud->setEstadoId(3);
				$solicitud->setRespuestaId(1);
				$solicitud->setRecomendacion($_POST["recomendacion"]);
				$solicitud->setComisionId($comision->getId());
				$solicitud->update();
				echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
			}else{
				if($solicitud->getRespuestaId()!=1) {
					$informe=new InformeDTO();
					$informe->setActaId($solicitud->getActaId());
					$informe->setComisionId($solicitud->getComisionId());
					$informe->setActaCF($solicitud->getNumeroActaCF());
					$informe->setAvalCF($solicitud->getAvalCF());
					$informe->setObtuvoTitulo($solicitud->getObtuvoTitulo() );
					$informe->setInformeEstudiante($solicitud->getInformeEstudiante());
					$informe->setInformeTutor($solicitud->getInformeTutor());
					$informe->setCalificaciones($solicitud->getCalificaciones());
					$informe->setInforme($solicitud->getInforme());
					$informe->setFechaReingreso($solicitud->getFechaReingreso());
					$informe->setFecha($solicitud->getFecha1());		
					$informe->save();
				}
				$id=$solicitud->getId();
				$solicitud->setEstadoId(3);
				$solicitud->setRespuestaId(1);
				$solicitud->setRecomendacion($_POST["recomendacion"]);
				$solicitud->update();
				echo "<script>location.href=\"solicitudes.php?id=".$solicitud->getActaId()."\"</script>";
				
			}
		}
		else {
			if($solicitud->getRespuestaId()==1 && $solicitud->getTiposolicitudId()==1) {
				$comision = new ComisionDTO();
				$comision=$comision->find($solicitud->getComisionId());
				$comision->delete();
			}
			if($solicitud->getTiposolicitudId()==3) {
				$comision = new ComisionDTO();
				$comision=$comision->find($solicitud->getComisionId());
				$comision->rollBack();
				$consulta = new Criteria("prorrogas");
				$consulta->addFiltro("comision_id","=",$solicitud->getComisionId());
				$consulta->addFiltro("acta_id","=",$solicitud->getActaId());
				$prorrogas = $consulta->execute();
				foreach($prorrogas as $prorroga)
					$prorroga->delete();
			}
			$id=$solicitud->getId();
			$solicitud->setEstadoId(4);
			$solicitud->setRespuestaId(2);
			$solicitud->setComisionId(0);
			$solicitud->setRecomendacion($_POST["recomendacion"]);
			$solicitud->update($id);
		}
	}
	if( isset($_POST["autocompletar"])) {
		if($_POST["respuesta"])  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipocomision()==1) 
			$tipoComision = "estudios";
		else 
			$tipoComision = "servicios";
			
		if($solicitud->getTiposolicitudId()==1)
			$tipo = "comisi&oacute;n";
		elseif($solicitud->getTiposolicitudId()==2)
			$tipo = "modificaci&oacute;n de su comisi&oacute;n";
		else
			$tipo = "prórroga de su comisi&oacute;n";
		$docente = $solicitud->getDocente();
		$contenido = "Al se&ntilde;or rector ".$concede."conceder a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." de ".$tipoComision." remunerada con el 100% de su salario b&aacute;sico mensual, equivalente a tiempo completo de su vinculaci&oacute;n, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2();
	}
	if( isset($_POST["autocompletarAca"])) {
		if($_POST["respuesta"])  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipocomision()==1) 
			$tipoComision = "estudios";
		else 
			$tipoComision = "servicios";
			
		if($solicitud->getTiposolicitudId()==1)
			$tipo = "comisi&oacute;n";
		elseif($solicitud->getTiposolicitudId()==2)
			$tipo = "modificaci&oacute;n de su comisi&oacute;n";
		else
			$tipo = "prorroga de su comisi&oacute;n";
		$docente = $solicitud->getDocente();
		$contenido = "Al consejo acad&eacute;mico ".$concede."conceder a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." de ".$tipoComision." remunerada con el 100% de su salario b&aacute;sico mensual, equivalente a tiempo completo de su vinculaci&oacute;n, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2();
	}
}

?>
