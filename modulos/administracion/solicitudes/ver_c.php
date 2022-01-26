<?php
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
$ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
$imagen=$path['imagenes']."iconos/pdf.png ";
if(file_exists($ruta)){
	$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
}
$link_comision="";
if($solicitud->getComisionId())
{

$link_comision='<a href="../comisiones/ver.php?id='.$solicitud->getComisionId().'">Comisiòn ( '.$solicitud->getComisionId().' )</a>';
}

}

?>
