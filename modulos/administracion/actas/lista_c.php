<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'clasesDTO.php');
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'procedimientos.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
$consulta = new Criteria("actas");
$consulta->orderBy("id","DESC");
$actas1=$consulta->execute();

if(isset($_POST["nuevo"]) && $_POST["fecha"]) {
	$acta_nueva=new ActaDTO();
	$acta_nueva->setAbierta(1);
	$acta_nueva->setFecha($_POST["fecha"]);
	$acta_nueva->save();
}
if( isset($_POST["consulta"]))
{
$consulta = new Criteria("actas");
if($_POST["actas1"]!="") 
$consulta->addFiltro("id",">=",$_POST["actas1"]);
if($_POST["actas2"]!="") 
$consulta->addFiltro("id","<=",$_POST["actas2"]);
if($_POST["fecha1"]!="") 
$consulta->addFiltro("fecha",">=",$_POST["fecha1"]);
if($_POST["fecha2"]!="") 
$consulta->addFiltro("fecha","<=",$_POST["fecha2"]);
if($_POST["estado"]!="null") 
$consulta->addFiltro("abierta","=",$_POST["estado"]);
$consulta->orderBy("id","DESC");
$_SESSION["query_actas"]=$consulta->generarQuery();
$actas=$consulta->execute();
}
if($session->getVal("query_actas")!="")
	{
	$consulta = new Criteria("actas");
	$consulta->query=$session->getVal("query_actas");
	$actas=$consulta->generarArraylist();
	}
	else
	{
	$consulta = new Criteria("actas");
	$consulta->orderBy("id","DESC");
	$actas=$consulta->execute();
	}
?>