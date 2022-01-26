<?php
require_once('../../login/Session.php');
$session = Session::getInstance();

//if($session->getVal("usuario_id")=="" || !($session->getVal("rol")=="comite" || $session->getVal("rol")=="auxiliar"||$session->getVal("rol")=="unidad")) //si no hay ningun usuario registrado muestra la vista general
	/*echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general*/
require_once('../../../configuracion/path.php');
require_once('../../../modelo/clasesDTO.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
$numero = count($_GET);
$contenido = "";
if($numero) {
	$id = $_GET['id'];
	$solicitud = new SolicitudDTO();
	$solicitud=$solicitud->find($id);
}
?>