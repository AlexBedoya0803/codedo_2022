<?php
//session_start();
require_once('../../login/Session.php');
require_once('../comisiones/UploadFiles.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');

$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'procedimientos.php');

$consulta = new Criteria("tiposSolicitudes");
$tiposSolicitudes=$consulta->execute();
$consulta = new Criteria("paises");
$paises=$consulta->execute();
$consulta = new Criteria("motivos");
$motivos=$consulta->execute();
$consulta = new Criteria("dedicaciones");
$dedicaciones=$consulta->execute();
$consulta = new Criteria("facultades");
$consulta->orderBy("nombre","ASC");
$facultades=$consulta->execute();
$consulta = new Criteria("tiposComisiones");
$tiposComisiones=$consulta->execute();


$numero = count($_GET);
$formulario=array();
if($numero) {
	$id = $_GET['id'];
	$session->setVal("id",$id);
	$solicitud = new SolicitudDTO();
	$solicitud = $solicitud->find($id);
	$formulario['motivos']=$solicitud->getMotivoId(); 
	$formulario['dedicaciones']=$solicitud->getDedicacionId(); 
	$formulario['paises']=$solicitud->getPaisId(); 
	$formulario['facultades']=$solicitud->getFacultadId();
	$formulario['tiposolicitudId']=$solicitud->getTiposolicitudId(); 
	$formulario['tiposolicitud']='Editar '.$solicitud->getTiposolicitud()->getTipo(); 
	$formulario['objetivo']=$solicitud->getObjetivo(); 
	$formulario['lugar']=$solicitud->getLugar();
	$formulario['fecha1']=$solicitud->getFecha1();
	$formulario['fecha2']=$solicitud->getFecha2();
	$formulario['observaciones']=$solicitud->getObservaciones();
	$formulario['solicitudes']=$solicitud->getId();
	$formulario['comentarios']=$solicitud->getComentarios();
	$formulario['observaciones']=$solicitud->getObservaciones();
	$formulario['fechaActaCF']=$solicitud->getFechaActaCF();
	$formulario['numeroActaCF']=$solicitud->getNumeroActaCF();
	$formulario['resolucion']=$solicitud->getResolucion();
	$formulario['fechaResolucion']=$solicitud->getFechaResolucion();
	$formulario['inicioResolucion']=$solicitud->getInicioResolucion();
	$formulario['finResolucion']=$solicitud->getFinResolucion();

	
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
$resolucion = $_POST["resolucion"];
$fechaResolucion = $_POST["fechaResolucion"];
$inicioResolucion = $_POST["inicioResolucion"];
$finResolucion = $_POST["finResolucion"];

if(isset($_POST["modificar"]) && $actaCF && $fechaActaCF) {
	if($solicitud->getTiposolicitudId()>4)
		$solicitud->setTiposolicitudId($_POST["tiposSolicitudes"]);
	$solicitud->setMotivoId($motivo);
	$solicitud->setDedicacionId($dedicacion);
	$solicitud->setPaisId($pais);
	$solicitud->setFacultadId($facultad);
	$solicitud->setTipoComisionId($_POST["tipos"]);
	$solicitud->setObjetivo($_POST["objetivo"]);
	$solicitud->setLugar($lugar);
	$solicitud->setFecha1($fecha1);
	$solicitud->setFecha2($fecha2);
	$solicitud->setNumeroActaCF($actaCF);
	$solicitud->setFechaActaCF($fechaActaCF);
	$solicitud->setResolucion($resolucion);
	$solicitud->setFechaResolucion($fechaResolucion);
	$solicitud->setInicioResolucion($inicioResolucion);
	$solicitud->setFinResolucion($finResolucion);

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
	$solicitud->update();
	$idSolicitud= $solicitud->getId();
	
	$ruta = '../../../anexos/'.$idSolicitud;
	if(!file_exists($ruta)){
		mkdir($ruta, 0777, true);
		}
		
		UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
	echo '<div id="dialog" title="solicitud">
			<p>Se modifico la solicitud exitosamente.</p>
		</div>';
}
?>