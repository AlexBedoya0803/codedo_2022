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
	//$id = $_GET['id'];
	//$acta = new ActaDTO();
	//$acta=$acta->find($id);
	
	$consulta = new Criteria("solicitudes");
	$facultad = $session->getVal("facultad");
	//var_dump($facultad);
	//throw new Exception();
	$consulta->addFiltro("estado_id","=","1");
	$consulta->addFiltro("facultad_id","=",$facultad);
	$consulta->orderBy("id","DESC");
	$solicitudes=$consulta->execute();
	$solicitudes2=$consulta->execute();
	//echo $consulta->query;
	
	//var_dump($solicitudes);
	//echo $session->getVal("rol");
?>
