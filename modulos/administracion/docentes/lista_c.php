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


if($session->getVal("query_docentes")!="")
	{
	$consulta = new Criteria("docentes");
	$consulta->query=$session->getVal("query_docentes");
	$docentes=$consulta->generarArraylist();
	}
	else
	{
	$consulta = new Criteria("docentes");
	$consulta->addFiltro("cedula","=","0");
	$consulta->orderBy("cedula","ASC");
	$docentes=$consulta->execute();
	}
?>