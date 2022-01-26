<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
if($session->getVal("query_comisiones")!="") {
	$consulta = new Criteria("comisiones");
	$consulta->query=$session->getVal("query_comisiones");
	$comisiones=$consulta->generarArraylist();
	//var_dump($comisiones);
	//throw new Exception();
}
else {
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("id","=",-1);
	$consulta->orderBy("id","DESC");
	$comisiones=$consulta->execute();
	
}
?>