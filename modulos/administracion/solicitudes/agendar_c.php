<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');

$consulta = new Criteria("actas");
$consulta->addFiltro("abierta","=",1);
$consulta->orderBy("id","DESC");
$actas=$consulta->execute();

$consulta = new Criteria("solicitudes");
$consulta->addFiltro("acta_id","=",-1);
$consulta->addFiltro("estado_id","=",5);
$solicitudes=$consulta->execute();
foreach ($solicitudes as $solicitud) {
	$id=$solicitud->getId();
	$actaid = $_POST["actas".$id];
	if(isset($_POST["agendar".$id]) && $actaid) {
		$solicitud->setActaId($actaid);
		$solicitud->setEstadoId(2);
		$solicitud->update($id);
		echo "<script>location.href=\"agendar.php\";</script>";
	}
	if(isset($_POST["noAgendar".$id])){
		$solicitud->setEstadoId(6);
		$solicitud->update2();	
		echo "<script>location.href=\"agendar.php\";</script>";
	}
}

?>