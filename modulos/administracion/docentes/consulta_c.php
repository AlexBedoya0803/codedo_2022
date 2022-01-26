<?php 
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session=Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'procedimientos.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');

$consulta = new Criteria("facultades");
$consulta->orderBy("nombre","ASC");
$facultades=$consulta->execute();

$consulta = new Criteria("dedicaciones");
$consulta->orderBy("nombre","ASC");
$dedicaciones=$consulta->execute();

if( isset($_POST["consulta_compleja"])) {
	$consulta = new Criteria("docentes");
	if($_POST["cedula"]!="") 
	$consulta->addFiltro("cedula","=",$_POST["cedula"]);
	if($_POST["nombre"]!="") 
	$consulta->addFiltro("nombre","LIKE",$_POST["nombre"]);
	if($_POST["facultades"]!="") 
	$consulta->addFiltro("facultad_id","=",$_POST["facultades"]);
	if($_POST["fecha1"]!="") 
	$consulta->addFiltro("fechaVinculacion",">=",$_POST["fecha1"]);
	if($_POST["fecha2"]!="") 
	$consulta->addFiltro("fechaVinculacion","<=",$_POST["fecha2"]);
	if($_POST["dedicaciones"]!="") 
	$consulta->addFiltro("dedicacion_id","=",$_POST["dedicaciones"]);
	$_SESSION["query_docentes"]=$consulta->generarQuery();
}
if( isset($_POST["consulta_simple"])) {
	$palabra = $_POST["palabra"];
	$procedimiento=new Procedimientos();
	$session->setVal("query_docentes",$procedimiento->palabraClaveDocente($palabra));
}
?>