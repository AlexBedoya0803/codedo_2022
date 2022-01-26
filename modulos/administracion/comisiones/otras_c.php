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
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'procedimientos.php'); 
require_once('UploadFiles.php');
$consulta = new Criteria("tiposSolicitudes");
$tiposSolicitudes=$consulta->execute();
$consulta = new Criteria("paises");
$consulta->orderBy("pais", "asc");
$paises=$consulta->execute();
$consulta = new Criteria("motivos");
$motivos=$consulta->execute();
$consulta = new Criteria("dedicaciones");
$dedicaciones=$consulta->execute();
$numero = count($_GET);
if($numero) {
	$id = $_GET['id'];
	$session->setVal("id",$id);
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("docente_id","=",$id);
	$consulta->orderBy("id","ASC");
	$comisiones=$consulta->execute();
	$docente=new DocenteDTO();
	$docente=$docente->find($id);
}
$formulario=array();
if(isset($_POST["buscarcomision"])) {
	$id=$session->getVal("id");
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("docente_id","=",$id);
	$consulta->orderBy("id","ASC");
	$comisiones=$consulta->execute();
	$docente=new DocenteDTO();
	$docente=$docente->find($id);
	$comision=new ComisionDTO();
	$idComision = $_POST["comisiones"];
	$comision=$comision->find($idComision);
	$solicitud=new SolicitudDTO();
	$solicitud->setComisionId($idComision);
	if($solicitud->findId())
		$solicitud=$solicitud->find($solicitud->findId());
	$error="";
	$formulario['motivos']=$comision->getMotivoId(); 
	$formulario['dedicaciones']=$comision->getDedicacionId(); 
	$formulario['paises']=$comision->getPaisId(); 
	$formulario['facultades']=$comision->getFacultadId(); 
	$formulario['tipoComision']=$comision->getTipoComisionId(); 
	$formulario['objetivo']=$comision->getObjetivo(); 
	$formulario['lugar']=$comision->getLugar();
	$formulario['fecha1']=$comision->getFecha1();
	$formulario['fecha2']=$comision->getFecha2();
	$formulario['observaciones']=$comision->getObservaciones();
	$formulario['comisiones']=$comision->getId();
	$formulario['tipoSolicitud']=$solicitud->getTipoSolicitudId();
	$formulario['comentarios']=$solicitud->getComentarios();
	$formulario['observaciones']=$solicitud->getObservaciones();
	$puedeGuardar = true;
}
$motivo=$_POST["motivos"];
$facultad = $_POST["facultades"];
$dedicacion = $_POST["dedicaciones"];
$pais = $_POST["paises"];
$lugar = $_POST["lugar"];
$objetivo = $_POST["objetivo"];
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];
$actaCF = $_POST["actaCF"];
$fechaActaCF = $_POST["fechaActaCF"];
if(isset($_POST["modificar"]) && $actaCF && $fechaActaCF) {
	$solicitud=new SolicitudDTO();
	$solicitud->setDocenteId($_SESSION["id"]);
	$solicitud->setActaId(-1);
	$solicitud->setEstadoId(5);
	$solicitud->setTiposolicitudId($_POST["tiposSolicitudes"]);
	/*
	if($_POST["tiposSolicitudes"]==8||$_POST["tiposSolicitudes"]==9){
		$solicitud->setRespuestaId(1);
	}else{
		$solicitud->setRespuestaId(3);
	}
	*/
	$solicitud->setComisionId($_POST["comisiones"]);
	$solicitud->setMotivoId($motivo);
	$solicitud->setDedicacionId($dedicacion);
	$solicitud->setPaisId($pais);
	$solicitud->setFacultadId($docente->getFacultadId());
	if($motivo == 1 || $motivo == 2 || $motivo == 3 || $motivo == 4 || $motivo == 6 || $motivo == 12 || $motivo == 14 || $motivo == 98 ){
		$solicitud->setTipoComisionId(1);
	}else{
		$solicitud->setTipoComisionId(2);
	}
	$solicitud->setObjetivo($_POST["objetivo"]);
	$solicitud->setLugar($lugar);
	$solicitud->setFecha1($fecha1);
	$solicitud->setFecha2($fecha2);
	$solicitud->setNumeroActaCF($actaCF);
	$solicitud->setFechaActaCF($fechaActaCF);
	if($_POST["avalCF"]=="on") $solicitud->setAvalCF(1);
	else $solicitud->setAvalCF(0);
	if($_POST["solicitudProfesor"]=="on") $solicitud->setSolicitudProfesor(1);
	else $solicitud->setSolicitudProfesor(0);
	if($_POST["cartaAceptacion"]=="on") $solicitud->setCartaAceptacion(1);
	else $solicitud->setCartaAceptacion(0);
	if($_POST["informeEstudiante"]=="on") $solicitud->setInformeEstudiante(1);
	else $solicitud->setInformeEstudiante(0);
	if($_POST["informeTutor"]=="on") $solicitud->setInformeTutor(1);
	else $solicitud->setInformeTutor(0);
	if($_POST["calificaciones"]=="on") $solicitud->setCalificaciones(1);
	else $solicitud->setCalificaciones(0);
	$solicitud->setComentarios($_POST["comentarios"]);
	$solicitud->setObservaciones($_POST["observaciones"]);
	$idSolicitud=$solicitud->save();
	$ruta = '../../../anexos/'.$idSolicitud;
		//echo $solicitud->getId();
		mkdir($ruta, 0777, true);
		UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
	echo '<div id="dialog" title="solicitud">
			<p>Se creó la solicitud exitosamente.</p>
		</div>';
}
elseif(isset($_POST["modificar"])) {
	echo '<div id="error" title="error">
		<p>Verifique los datos.</p>
	</div>';
}
?>