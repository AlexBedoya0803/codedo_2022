<?php
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
	$formulario['dedicaciones']=$comision->getDedicacionId(); //echo 'dedicacion: '.$comision->getDedicacionId();
	$formulario['paises']=$comision->getPaisId(); 
	$formulario['facultades']=$comision->getFacultadId(); 
	$formulario['tipoComision']=$comision->getTipoComisionId(); 
	$formulario['objetivo']=$comision->getObjetivo(); 
	$formulario['lugar']=$comision->getLugar();
	$formulario['fecha1']=$comision->getFecha1();
	$formulario['fecha2']=$comision->getFecha2();
	$formulario['fechaf']=$comision->getFechaF();
	$formulario['observaciones']=$comision->getObservaciones();
	$formulario['comisiones']=$comision->getId();
	$formulario['comentarios']=$solicitud->getComentarios();
	$formulario['observaciones']=$solicitud->getObservaciones();
	$puedeGuardar = true;
}
$actaCF = $_POST["actaCF"];
$fechaActaCF = $_POST["fechaActaCF"];
if(isset($_POST["guardar"]) && $actaCF!="" && $fechaActaCF) {
	/*
	$solicitud=new SolicitudDTO();
	$solicitud->setActaId(-1);
	$solicitud->setComisionId($_POST["comisiones"]);
	$solicitud->setNumeroActaCF($actaCF);
	if($_POST["avalCF"]=="on") $solicitud->setAvalCF(1);
	else $solicitud->setAvalCF(0);
	if($_POST["obtuvoTitulo"]=="on") $solicitud->setObtuvoTitulo(1);
	else $solicitud->setObtuvoTitulo(0);
	if($_POST["informeEstudiante"]=="on") $solicitud->setInformeEstudiante(1);
	else $solicitud->setInformeEstudiante(0);
	if($_POST["informeTutor"]=="on") $solicitud->setInformeTutor(1);
	else $solicitud->setInformeTutor(0);
	if($_POST["calificaciones"]=="on") $solicitud->setCalificaciones(1);
	else $solicitud->setCalificaciones(0);
	$solicitud->setInforme($_POST['detalle']);
	$solicitud->setFecha1($_POST['fechaReingreso']);
	$solicitud->save();
	*/
	$comision=new ComisionDTO();
	$idComision = $_POST["comisiones"];
	$comision=$comision->find($_POST['comisiones']);
	$solicitud=new SolicitudDTO();
	$solicitud->setDocenteId($_SESSION["id"]);
	$solicitud->setActaId(-1);
	$solicitud->setEstadoId(0);
	$solicitud->setTiposolicitudId(4);
	$solicitud->setRespuestaId(1);
	$solicitud->setComisionId($_POST["comisiones"]);
	$solicitud->setMotivoId($formulario['motivos']);
	$solicitud->setDedicacionId($comision->getDedicacionId());
	$solicitud->setPaisId($comision->getPaisId());
	$solicitud->setFacultadId($docente->getFacultadId());
	$solicitud->setTipoComisionId($comision->getTipoComisionId());
	
	$solicitud->setObjetivo($comision->getObjetivo());
	$solicitud->setLugar($comision->getLugar());
	$solicitud->setFecha1($_POST['fechaReingreso']);
	$solicitud->setFecha2('');
	$solicitud->setNumeroActaCF($actaCF);
	$solicitud->setFechaActaCF($_POST['fechaActaCF']);
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
	if($_POST["obtuvoTitulo"]=="on") $solicitud->setObtuvoTitulo(1);
	else $solicitud->setObtuvoTitulo(0);
	$solicitud->setComentarios($_POST["comentarios"]);
	$solicitud->setObservaciones($_POST["observaciones"]);
	$solicitud->setInforme($_POST['detalle']);
	$idSolicitud=$solicitud->save();
	$ruta = '../../../anexos/'.$idSolicitud;
		//echo $solicitud->getId();
		mkdir($ruta, 0777, true);
		UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
	echo '<div id="dialog" title="solicitud">
			<p>Se creó la solicitud exitosamente.</p>
		</div>';
}
elseif(isset($_POST["guardar"])) {
	echo '<div id="error" title="error">
		<p>Verifique los datos.</p>
	</div>';
}
?>