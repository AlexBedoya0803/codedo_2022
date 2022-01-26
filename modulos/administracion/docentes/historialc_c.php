<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'procedimientos.php');
$numero = count($_GET);
$id = $_GET['id'];
$consulta = new Criteria("comisiones");
$consulta->addFiltro("docente_id","=",$id);
$consulta->orderBy("id","DESC");
$comisiones=$consulta->execute();
$docente=new DocenteDTO();
$docente=$docente->find($id);
?>