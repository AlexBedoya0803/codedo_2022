<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
$numero = count($_GET);
if($numero) {
	$id = $_GET['id'];
	$acta = new ActaDTO();
	$acta=$acta->find($id);
	$consulta = new Criteria("solicitudes");
	$consulta->addFiltro("acta_id","=",$id);
	$consulta->orderBy("facultad_id","ASC");
	$solicitudes=$consulta->execute();
	$solicitudes2=$consulta->execute();
}

?>
