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
require_once($path['modelo'].'clasesDTO.php');
$numero = count($_GET);
if($numero)
{
$id = $_GET['id'];
$solicitud = new SolicitudDTO();
$solicitud=$solicitud->find($id);
$imagen=$path['imagenes'].'estados/'.$solicitud->getEstadoId().".png";
}

?>