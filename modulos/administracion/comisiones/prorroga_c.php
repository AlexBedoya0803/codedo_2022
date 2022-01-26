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
if($numero) {
	$id = $_GET['id'];
	$_SESSION["id"]=$id;
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("docente_id","=",$id);
	$consulta->orderBy("id","ASC");
	$comisiones=$consulta->execute();
	$docente=new DocenteDTO();
	$docente=$docente->find($id);
}
$formulario=array();
if(isset($_POST["buscarcomision"])) {
	$id=$_SESSION["id"];
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
	$formulario['fechaf']=$comision->getFechaf();
	$formulario['observaciones']=$comision->getObservaciones();
	$formulario['comisiones']=$comision->getId();
	$formulario['comentarios']=$solicitud->getComentarios();
	$formulario['observaciones']=$solicitud->getObservaciones();
	$puedeGuardar = true;
}
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];

$fechaf = $_POST["fechaf"];

$fechaf2 = date('d/m/Y',strtotime($fechaf . "+366 days"));

var_dump($fechaf);

var_dump($formulario['fechaf']);
var_dump($fechaf2);

$actaCF = $_POST["actaCF"];
$fechaActaCF = $_POST["fechaActaCF"];
if(isset($_POST["prorrogar"]) && $actaCF && $fechaActaCF) {
	$solicitudRelacionada=new SolicitudDTO();
	$solicitudRelacionada->setComisionId($_POST["comisiones"]);
	if($solicitudRelacionada->findId())
		$solicitudRelacionada=$solicitudRelacionada->find($solicitudRelacionada->findId());
	$solicitud=new SolicitudDTO();
	$solicitud->setDocenteId($_SESSION["id"]);
	$solicitud->setActaId(-1);
	$solicitud->setEstadoId(5);
	$solicitud->setTiposolicitudId(3);
	$solicitud->setRespuestaId(3);
	$solicitud->setComisionId($_POST["comisiones"]);
	$solicitud->setMotivoId($solicitudRelacionada->getMotivoId());
	$solicitud->setDedicacionId($solicitudRelacionada->getDedicacionId());
	$solicitud->setPaisId($solicitudRelacionada->getPaisId());
	$solicitud->setFacultadId($solicitudRelacionada->getFacultadId());
	$solicitud->setTipoComisionId($solicitudRelacionada->getTipoComisionId());
	$solicitud->setObjetivo($solicitudRelacionada->getObjetivo());
	$solicitud->setLugar($solicitudRelacionada->getLugar());
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
	$solicitud->setComentarios($solicitudRelacionada->getComentarios);
	$solicitud->setObservaciones($solicitudRelacionada->getObservaciones);
	$idSolicitud=$solicitud->save();
	$ruta = '../../../anexos/'.$idSolicitud;
		//echo $solicitud->getId();
		mkdir($ruta, 0777, true);
		UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
	echo '<div id="dialog" title="solicitud">
			<p>Se creó la solicitud exitosamente.</p>
		</div>';
}
elseif(isset($_POST["prorrogar"])) {
	echo '<div id="error" title="error">
		<p>Verifique los datos.</p>
	</div>';
}
?>