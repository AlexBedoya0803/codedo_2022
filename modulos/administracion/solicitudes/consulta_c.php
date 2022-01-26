<?php 
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'clasesDTO.php');
require_once($path['modelo'].'procedimientos.php');
require_once($path['modelo'].'criteria.php');

$consulta = new Criteria("paises");
$paises=$consulta->execute();
$consulta = new Criteria("motivos");
$motivos=$consulta->execute();
$consulta = new Criteria("dedicaciones");
$dedicaciones=$consulta->execute();
$consulta = new Criteria("actas");
$consulta->orderBy("id","DESC");
$actas=$consulta->execute();
$consulta = new Criteria("estados");
$consulta->addFiltro("archivo","=","solicitudes");
$estados=$consulta->execute();
$consulta = new Criteria("respuestas");
$respuestas=$consulta->execute();
$consulta = new Criteria("docentes");
$consulta->orderBy("nombre","ASC");
$docentes=$consulta->execute();
if( isset($_POST["consulta_simple"])) {
	$palabra = $_POST["palabra"];
	$procedimiento=new Procedimientos();
	$session->setVal("query_solicitudes",$procedimiento->palabraClaveSolicitud($palabra));
}
if( isset($_POST["consulta_compleja"])) {
	$consulta = new Criteria("solicitudes");
	$condicion = "";
	if($_POST["fecha1Min"]!="") 
		$condicion .= " fecha1>='".$_POST["fecha1Min"]."' and";
	if($_POST["fecha1Max"]!="") 
		$condicion .= " fecha1<='".$_POST["fecha1Max"]."' and";
	if($_POST["fecha2Min"]!="") 
		$condicion .= " fecha2>='".$_POST["fecha2Min"]."' and";
	if($_POST["fecha2Max"]!="") 
		$condicion .= " fecha2<='".$_POST["fecha2Max"]."' and";
	if($_POST["numero"]!="") 
		$condicion .= " solicitudes.id='".$_POST["numero"]."' and";
	if($_POST["cedula"]!="") 
		$condicion .= " cedula='".$_POST["cedula"]."' and";
	if($_POST["nombre"]!="") 
		$condicion .= " docentes.nombre='".$_POST["nombre"]."' and";
	if($_POST["paises"]!="") 
		$condicion .= " pais_id=".$_POST["paises"]." and";
	if($_POST["motivos"]!="") 
		$condicion .= " solicitudes.motivo_id='".$_POST["motivos"]."' and";
	if($_POST["respuestas"]!="") 
		$condicion .= " respuesta_id=".$_POST["respuestas"]." and";
	if($_POST["estados"]!="")
		$condicion .= " solicitudes.estado_id=".$_POST["estados"]." and";
	if($_POST["dedicaciones"]!="") 
		$condicion .= " solicitudes.dedicacion_id=".$_POST["dedicaciones"]." and";
	if($_POST["actas"]!="") 
		$condicion .= " acta_id=".$_POST["actas"]." and";
	$query = "select * from docentes, solicitudes where solicitudes.docente_id=docentes.id and";
	$query .= $condicion;
	//$_SESSION["query_solicitudes"]=$consulta->generarQuery();
	$query = substr($query, 0, strlen($query)-4);
	$query .= ';';
	$session->setVal("query_solicitudes",$query);
}
?>