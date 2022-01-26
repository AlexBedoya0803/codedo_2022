<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
$numero = count($_GET);

//var_dump($numero);
//var_dump($_GET['id']);
if($numero)//solicitudes de una comision id
{
	$id = $_GET['id'];
	$consulta = new Criteria("solicitudes");
	$consulta->addFiltro("comision_id","=",$id);
	$solicitudes=$consulta->execute();
}
else {
	if($session->getVal("query_solicitudes")!="") {
		$consulta = new Criteria("solicitudes");
		$consulta->query=$session->getVal("query_solicitudes");
		//var_dump($consulta);
		$solicitudes=$consulta->generarArraylist();
	}
	else {
		$consulta = new Criteria("solicitudes");
		$consulta->addFiltro("comision_id","=",-1);
		$solicitudes=$consulta->execute();
	}
}

?>